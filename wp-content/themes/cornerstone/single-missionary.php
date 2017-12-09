<?php
/**
* This is a template for indidual missionary pages.
*
* Template Name: Missionary
*
*
* @package cornerstone
*/
get_header(); ?>
<div id="primary" class="grid-container">
   <main id="main" class="site-main">
      <?php
      $name = get_the_title();
      $project = get_field('project_name');
      $region = get_field('region');
      $img = get_field('missionary_image')['url'];
      $bio = get_field('missionary_bio');
      $has_posts = get_field('missionary_has_blog_posts');
      $user = get_field('missionary_user');
      ?>
      <div class="missionary-single-content grid-x grid-margin-x small-text-center medium-text-left">
         <div class="post-title cell small-12">
            <h1 class=""><?= $name ;?></h1>
         </div>
         <div class="project-info cell small-12">
            <h5><?= $project; ?> - <span><?= $region; ?></span></h5>
         </div>
         <div class="media-links h6 cell small-12">
            <ul class="no-bullet">
               <li>media</li>
               <li>media</li>
               <li>media</li>
               <li>media</li>
            </ul>
         </div>
         <hr class="hide-for-small cell small-12">
         <div class="post-img cell small-12 medium-4 medium-order-2">
            <img src="<?= $img; ?>" alt="missionary-img">
            <div class="donate">
               <button class="button read-on">
               Donate
               </button>
            </div>
         </div>
         <div class="post-content cell small-12 medium-8  medium-order-1">
            <p>
               <?= $bio; ?>
            </p>
         </div>
      </div>
      <div class="missionary-blog-posts cell small-12">
         
      </div>
      <div class="missionary-media cell small-12">
         
      </div>
      
      </main><!-- #main -->
      </div><!-- #primary -->
      <?php
      get_footer();