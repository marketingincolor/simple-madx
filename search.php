<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
if ($_GET['post_type'] === 'madicou') {
	get_header('madicou');
}else{
  get_header();
}
?>

<section class="main-container">
	<div class="grid-container">
		<main id="search-results" class="grid-x" <?php if ($_GET['post_type'] === 'madicou') {echo 'style="margin-top:40px"';} ?>>
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x grid-margin-x grid-margin-y">
					<div class="small-12 cell">
						<header>
							<h1 class="entry-title"><?php _e( 'Search Results for', 'foundationpress' ); ?> "<?php echo get_search_query(); ?>"</h1>
						</header>
					</div>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							
						<div class="medium-6 large-4 cell module auto-height">
							<div class="meta">
								<a href="<?php the_permalink(); ?>"><h4 class="blue" style="margin-bottom:20px"><?php echo wp_trim_words(get_the_title(),10,'...'); ?></h4></a>
								<p><?php echo wp_trim_words(get_the_content(),30,'...'); ?></p>
							</div>
						</div>
							
					<?php endwhile;endif; ?>

					<?php
					if ( function_exists( 'foundationpress_pagination' ) ) :
						echo '<div class="small-12 cell">';
						  foundationpress_pagination();
						echo '</div>';
					elseif ( is_paged() ) :
					?>
					<div class="small-12 cell">
						<nav id="post-nav">
							<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
							<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
						</nav>
					</div>

					<?php endif; ?>

				</div>
			</div>
		</main>
	</div>
</section>
<?php get_footer();
