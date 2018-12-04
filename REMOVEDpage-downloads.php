<?php
/**
 * The template for displaying Download custom page
 *
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
get_header();
global $post; ?>

<section class="page-content">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'download' ); ?>
			<?php endwhile; ?>
		</main>
		</div>
	</div>
</section>

<section class="page-content" style="display:none;">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<div <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
				<div class="entry-content">

					!!!!!!!!!!

				</div>
			</div>
		</main>
	</div>
</section>

<section class="page-downloads" style="display:none;">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<article id="post-<?php the_ID(); ?>" <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
				<div class="entry-content">

					<?php if ( is_user_logged_in() ) { ?>
					<?php //if ( current_user_can( 'view_sunscape' ) ) {  ?>
						<h3>Downloads Shortcode (in page-downloads container)</h3>
						<?php

						echo "<div class='grid-x grid-padding-x medium-up-3 large-up-4'>";
						$terms = get_terms( 'dlm_download_category' );
						foreach ( $terms as $term ) {
							$slug = $term->slug;
							echo "<div class='cell'>";
							echo "<h4><a href='../?dlm_download_category=" . $term->slug . "'>" . $term->name . "</a></h4>";
							echo do_shortcode( "[downloads category='$slug' template='brandhub']" );
							echo "</div>";
						}
						echo "</div>";
						//echo do_shortcode( "[downloads template='brandhub']" );
						//echo do_shortcode( "[categorylist]" );
						?>

					<?php } else { ?>
					    <h4>Users must be&nbsp;<a href="<?php echo site_url(); ?>/wp-login.php" title="Members Area Login" rel="home">logged in</a>&nbsp;to view downloads!</h4>
					<?php } ?>
				</div>
			</article>
		</main>
		</div>
	</div>
</section>

<?php
get_footer();
