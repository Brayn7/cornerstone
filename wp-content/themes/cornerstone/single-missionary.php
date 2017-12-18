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
<div id="primary" class="grid-container grid-x align-center">
   <main id="main" class="site-main cell small-12 margin-top-3  missionary-single">
      <?php
      $current_id = get_the_id();
      $name = get_the_title();
      $project = get_field('project_name');
      $region = get_field('region');
      $img = get_field('missionary_image')['url'];
      $bio = get_field('missionary_bio');
      $has_posts = get_field('missionary_has_blog_posts');
      $user = get_field('missionary_user');
      ?>
      <div class="section missionary-single-content grid-x grid-margin-x small-text-center medium-text-left">
         <div class="post-title cell small-12">
            <h1 class=""><?= $name ;?></h1>
         </div>
         <div class="project-info cell small-12 ">
            <h5><?= $project; ?> - <span><?= $region; ?></span></h5>
         </div>
         <div class="media-links h6 cell small-12 ">
            <ul class="no-bullet">
               <li>media</li>
               <li>media</li>
               <li>media</li>
               <li>media</li>
            </ul>
         </div>
         <hr class="hide-for-small cell small-12">
         <div class="post-img cell small-12  medium-4 medium-order-2">
            <img src="<?= $img; ?>" alt="missionary-img">
            <div class="donate">
               <button class="button read-on">
               Donate
               </button>
            </div>
         </div>
         <div class="post-content cell small-12  medium-8  medium-order-1">
            <p>
               <?= $bio; ?>
            </p>
         </div>
      </div>
      <?php if ($has_posts) { ?>
      <?php 
      $args = array(
           'author'        =>  $user['ID'], 
           'orderby'       =>  'post_date',
           'order'         =>  'ASC',
           'posts_per_page' => 3,
         );


         $missionary_posts = get_posts( $args );
       ?>
      <div class="section missionary-blog-posts cell small-12 ">
      <h1 class="">Blog</h1>
      <hr class="hide-for-small cell small-12">
         <?= "<script>console.log(". json_encode($user['ID']) .")</script>" ?>
         <?= "<script>console.log(". json_encode($missionary_posts) .")</script>" ?>
         <div class="grid-x grid-padding-x grid-padding-y">
            <?php foreach ($missionary_posts as $post) { ?>
               <div class="small-12">
                  <div class="grid-x grid-margin-x align-middle">
                     <div class="post-img cell small-12  medium-4"><img src="<?= get_the_post_thumbnail_url($post->ID) ?>" alt=""></div>
                     <div class="post-content small-12  medium-8">
                        <div class="post-title"><a href="<?= get_post_permalink($post->ID); ?>"><h2><?= $post->post_title; ?></h2></a></div>
                        <div class="post-body"><p><?= $post->post_excerpt; ?></p></div> 
                        <a class="read-on button" href="<?= get_post_permalink($post->ID); ?>">Read On</a>
                     </div>
                  </div>
                  
               </div>
            <?php } ?>
         </div>
      </div>
      <?php } ?>
      <?php $gallery = acf_photo_gallery('photo_gallery', $current_id);?>
      <?php if (count($gallery)) { ?>
         <div class="section missionary-media cell small-12 ">
         <h1>Gallery</h1>
         <hr class="hide-for-small cell small-12">
            <div class="grid-x grid-padding-x grid-padding-y">
               <?php foreach ($gallery as $img) { ?>
               <?php 
                  $full_image_url= $img['full_image_url'];
                  $img_url = acf_photo_gallery_resize_image($full_image_url, 400, 400);
               ?>
                                    
                  <div class="cell small-12  medium-4">
                     <a href="<?= $full_image_url; ?>">
                        <img src="<?= $img_url; ?>" alt="<?= $img['title']; ?>">
                     </a>
                     
                  </div>
               <?php } ?>
            </div>
         </div>
      <?php } ?>
      </main><!-- #main -->
      </div><!-- #primary -->
      <?php
      get_footer();