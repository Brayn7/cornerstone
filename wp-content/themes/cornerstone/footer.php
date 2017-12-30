<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cornerstone
 */

?>

	</div><!-- #content -->
	
	<footer id="colophon" class="site-footer section-container grid-x  align-center <?= (is_home() || is_front_page() ? '' : 'margin-top-3');  ?>">
		<div class="site-info section-inner cell small-12 medium-8">
			<div class="grid-container full section">
				<div class="grid-container">
					<div class="grid-x grid-padding-x grid-padding-y align-center text-center">
						<?php if (!empty(get_theme_mod('footer_menu'))) { ?>
							<div class="footer-cell cell small-12 margin-bottom-2">
								<?php

									$footer_nav = wp_nav_menu(array(
										'menu' => get_theme_mod('footer_menu'),
									));

								?>
							</div>
						<?php } ?>
						<?php if (!empty(get_theme_mod('text_section_1'))) { ?>
							<div class="footer-cell cell small-12">
								<?= get_theme_mod('text_section_1') ?>
							</div>
						<?php } ?>
						<?php if (!empty(get_theme_mod('text_section_2'))) { ?>
							<div class="footer-cell cell small-12">
								<?= get_theme_mod('text_section_2') ?>
							</div>
						<?php } ?>
						<?php if (!empty(get_theme_mod('text_section_3'))) { ?>
							<div class="footer-cell cell small-12">
								<?= get_theme_mod('text_section_3'); ?>
							</div>
						<?php } ?>
			
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
