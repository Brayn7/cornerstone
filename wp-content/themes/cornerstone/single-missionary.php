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

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php

			the_field('project_name');

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
