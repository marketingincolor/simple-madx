<?php 
/* Template Name: History */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="page-header">

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/about-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/about-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/about-header-menu'); ?>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell text-center">
				<h1 class="blue"><?php the_field('about_hero_heading'); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p><?php the_field('about_hero_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="posts about-content">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-8 large-offset-2 cell">
				<div class="grid-x grid-margin-y">
					<div class="small-12 cell content-block">
						<div class="grid-x">
							<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
					<div class="small-12 cell">
						<div class="grid-x grid-margin-x grid-margin-y">

							<?php
								$args = array(
									'post_type'      => 'timeline',
									'orderby'        => 'menu_order',
									'order'          => 'ASC',
									'posts_per_page' => -1
								);
								$query = new WP_Query( $args );
								while ( $query->have_posts() ) : $query->the_post();
							?>

								<div class="medium-6 cell module auto-height">
									<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
									<div class="meta">
										<h5 class="blue"><?php the_title(); ?></h5>
										<p class="event-date"><?php the_field('event_date'); ?></p>
										<?php the_content(); ?>
									</div>
								</div>

							<?php endwhile; wp_reset_postdata(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
endwhile;endif;
get_footer();