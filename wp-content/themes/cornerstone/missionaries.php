<?php
/**
* This is a template for a grid of all missionaries.
*
* Template Name: Missionaries
* Template Post Type: section
*
*
* @package cornerstone
*/
get_header(); ?>
<div id="primary" class="grid-container grid-x align-center">
   <main id="main" class="site-main cell small-12 missionary-single">
      <h1 class="margin-top-3"><?= the_title(); ?></h1>
      <hr class="hide-for-small cell small-12">
      <div class="grid-container">
         <?php 
            $missionaries = new WP_query(array(
              'numberposts' => -1,
              'post_type' => 'missionary',
            ));

          ?>

        <div class="grid-x grid-margin-x grid-margin-y align-center">
          <?php foreach ($missionaries->posts as $missionary) { ?>
            <div class="cell small-12 medium-4">
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
   </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();