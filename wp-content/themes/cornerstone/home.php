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

echo '<script> console.log(' . json_encode($featured_missionaries) . ')</script>';
?>

  <div class="section-container">
    <div class="section-inner">
      <?php
        $section_id = 1; 
        $full_width_keys = array(104, 197, "Missionaries", "Stories");
        foreach ($sections->posts as $section) {
        $class = (in_array($section->ID, $full_width_keys) ? "" : "medium-8");  
      ?>
        <div id="section-<?=$section_id;?>" class="grid-container full section">
          <div class="grid-container section-content">
            <!-- start grid-x  -->
            <div class="grid-x grid-margin-x align-center">
              <div class="cell small-12 <?= $class; ?> text-center">   
                <h1 class="post-title large-h1"><?=esc_html($section->post_title);?></h1>
                <div class="post-content padding-bottom-2">

                  <?php if ($section->ID === 104 || $section->title == "Missionaries") { ?>
                  <div class="grid-container">
                    <div class="grid-x grid-margin-x grid-margin-y align-center">
                      <?php foreach ($featured_missionaries->posts as $missionary) { ?>
                        <div class="cell small-10 medium-4">
                            <div class="missionary">
                              <a href="<?= get_post_permalink($missionary->ID); ?>">  
                                <img src="<?=get_field('missionary_image', $missionary->ID)['url'] ?>" alt="missionary-img">
                                <div class="post-content text-center">
                                  <h4><?= $missionary->post_title; ?></h4>
                                  <p><?= get_field('project_name', $missionary->ID); ?>: <span><?= get_field('region', $missionary->ID); ?></span></p>
                                </div>
                              </a>
                            </div>
                          

                         </div>
                      <?php } ?>
                    </div>
                  </div>

                  <?php } elseif ($section->ID === 197 || $section->title == "Stories") { ?>
                    <div class="grid-container">
                      <div class="grid-x grid-margin-x grid-margin-y align-center">
                        <?php foreach ($featured_stories->posts as $story) { ?>
                          <div class="cell small-10 medium-4">
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
        <?php $section_id++; ?>
      <?php }?>
    </div>
  </div>


      </main><!-- #main -->
   </div><!-- #primary -->

<?php
get_footer();
