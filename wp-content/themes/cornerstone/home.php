<?php
/**
/**
 * This is a template for the home/front page.
 *
 * Template Name: Home
 *
 *
 * @package cornerstone
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cornerstone
 */

get_header();?>

   <div id="primary" class="content-area grid-container full">
      <main id="main" class="site-main">
      
      <?php if (!empty(get_header_image())){ ?>
      <div class="splash-container">
        <div class="splash-inner">

            <?php 
              if (!empty(get_header_image())){
                echo "<div class='hero-img' style='background-image: url(" . get_header_image() . ")'></div>";
              }
            ?>


            <?php if (!empty(get_theme_mod('hero_logo'))) { ?>     
            <img class="splash-logo" src="<?php echo get_theme_mod('hero_logo'); ?>" alt="">
            <?php } ?>
        </div>
      </div>
      <?php } ?>

<?php

$sections = new WP_query(array(
	'numberposts' => -1,
	'post_type' => 'section',
	'orderby' => 'menu_order',
	'order' => 'ASC',
));

$query = new WP_Query( array( 'meta_key' => '_is_ns_featured_post', 'meta_value' => 'yes' ) );

$featured_missionaries = new WP_query(array(
  'posts_per_page' => 3,
  'post_type' => 'missionary',
  'meta_key' => '_is_ns_featured_post',
  'meta_value' => 'yes',
));

$featured_stories = new WP_query(array(
  'posts_per_page' => 3,
  'post_type' => 'post',
  'meta_key' => '_is_ns_featured_post',
  'meta_value' => 'yes',
));

?>

  <div class="section-container">

    <div class="section-inner">
      <?php
        $section_id = 1; 
        $full_width_keys = array(104, 197, "Missionaries", "Stories");
        foreach ($sections->posts as $section) {
        $class = (in_array($section->ID, $full_width_keys) ? "" : "medium-8");  
      ?>
       <?php if (get_field('body_on_front',$section->ID)) { ?>
          <?php 
            $content = $section->post_content;

            $elementor_content = \Elementor\Plugin::$instance->frontend->get_builder_content( $section->ID);

            if (!empty($elementor_content)){

              echo '<div id="section-'. $section_id .'">
                        '. $elementor_content .'
                    </div>';
            } else {
              echo '<div id="section-' . $section_id . '"class="grid-container full section">
                    <div class="grid-container section-content">
                      <!-- start grid-x  -->
                      <div class="grid-x grid-margin-x align-center">
                        <div class="cell small-12 <?= $class; ?> text-center">   
                          <h1 class="post-title large-h1">' .esc_html($section->post_title) .'</h1>
                          <div class="post-content padding-bottom-2">
                          '. do_shortcode($content) .'
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
            }

           ?>
      <?php } else { ?>
        <div id="section-<?=$section_id;?>" class="grid-container full section" style='background-image: url("<?=get_field('background_image', $section->ID); ?>"); background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        '>
          <?php 
            if (!empty(get_field('background_image', $section->ID))){
              echo '<div class="overlay"></div>';
            } 
          ?>
          <div class="grid-container section-content">
            <!-- start grid-x  -->
            <div class="grid-x grid-margin-x align-center">
              <div class="cell small-12 <?= $class; ?> text-center">   
                <h1 class="post-title large-h1"><?=esc_html($section->post_title);?></h1>
                <div class="post-content padding-bottom-2">
                  <?php if (get_page_template_slug( $section->ID ) == 'missionaries.php'
) { ?>
                  <div class="grid-container">
                    <div class="grid-x grid-margin-x grid-margin-y align-center">
                      <?php foreach ($featured_missionaries->posts as $missionary) { ?>
                        <div class="cell small-12 medium-4">
                            <div class="missionary">
                              <a href="<?= get_post_permalink($missionary->ID); ?>">  
                                <img src="<?=get_field('missionary_image', $missionary->ID)['url'] ?>" alt="missionary-img">
                                <div class="post-content text-center">
                                  <h4><?= $missionary->post_title; ?></h4>
                                  <?php 
                                    $project_name = get_field('project_name', $missionary->ID);
                                    $region = get_field('region', $missionary->ID);
                                    $one = !empty($project_name) || !empty($region) ? true : false;
                                    $both = !empty($project_name) && !empty($region) ? true : false;
                                   ?>
                                   <?php if ($one) { ?>
                                  <p><?= !empty($project_name) ? $project_name : null; ?><?php $both ? ": " : null; ?> <span><?= $region ? $region : null; ?></span></p>
                                  <?php } ?>
                                </div>
                              </a>
                            </div>
                          

                         </div>
                      <?php } ?>
                    </div>
                  </div>

                  <?php } elseif (get_page_template_slug( $section->ID ) == 'stories.php') { ?>
                    <div class="grid-container">
                      <div class="grid-x grid-margin-x grid-margin-y align-center">
                        <?php foreach ($featured_stories->posts as $story) { ?>
                          <div class="cell small-12 medium-4">
                              <div class="story">
                                <a href="<?= get_post_permalink($story->ID); ?>">  
                                  <img src="<?=get_the_post_thumbnail_url($story->ID); ?>" alt="story-img">
                                  <div class="post-content text-center">
                                    <h3><?= $story->post_title; ?></h3>
                                    <p><?= $story->post_excerpt; ?></p>
                                  </div>
                                </a>
                              </div>
                           </div>
                        <?php } ?>
                      </div>
                    </div>

                  <?php } else { ?>
                  <?=do_shortcode($section->post_excerpt);?>
                  <?php } ?>
                </div>
                <?php if (!empty(get_field("more_info", $section->ID))) {?>
                  <a class="read-on button<?= ($section_id % 3 === 0 || $section_id === 1 )? ' white-hover' : '' ?> <?= ($section_id % 2 === 0)? 'button-invert' : '' ?>" href="<?=get_post_permalink($section->ID);?>">
                    <?=get_field("more_info_text", $section->ID);?>
                  </a>
                <?php }?>
              </div>
            </div> 
            <!-- end grid-x -->
          </div>
        </div>
        <?php } ?>
        <?php $section_id++; ?>
      <?php }?>
    </div>
  </div>


      </main><!-- #main -->
   </div><!-- #primary -->

<?php
get_footer();
