<?php
/**
* This is a template for listing posts.
*
* Template Name: Stories
* Template Post Type: section
*
*
* @package cornerstone
*/
get_header(); ?>
<div id="primary" class="grid-container grid-x align-center">
  <main id="main" class="site-main cell small-12 story">
    <h1 class="margin-top-3"><?= the_title(); ?></h1>
    <hr class="hide-for-small cell small-12">
    <div class="grid-container">
      <?php
      $stories = new WP_query(array(
      'numberposts' => 25,
      'post_type' => 'post',
      ));
      ?>
      <div class="stories grid-x grid-margin-x grid-margin-y">
        <?php foreach ($stories->posts as $story) { ?>
        <div class="story-wrapper cell small-12 medium-4">
          <div class="story">
            <a href="<?= get_post_permalink($story->ID); ?>">
              <div class="post-img" style='
                background-image: url("<?=get_the_post_thumbnail_url($story->ID); ?>"); 
      
                '>
              </div>
              <!-- <img src="<?=get_the_post_thumbnail_url($story->ID); ?>" alt="story-img"> -->
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
    </main><!-- #main -->
    </div><!-- #primary -->
    <?php
    get_footer();