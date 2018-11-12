<?php 
/* Template Name: Madico Cares */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="page-hero" style="background-image: url(<?php the_field('about_hero_background_image'); ?>);">

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
			<div class="small-10 small-offset-1 medium-8 large-offset-0 cell">
				<h1 class="blue"><?php the_field('about_hero_heading'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="subhead"><?php the_field('about_hero_subhead'); ?></p></a>
			</div>
		</div>
	</div>
</section>

<section class="posts">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x grid-margin-x grid-margin-y">
					<div class="small-12 cell">
						<div class="grid-x module auto-height side-module">
							<div class="medium-4 cell desktop">
								<img src="<?php the_field('top_post_image') ?>" alt="<?php the_title(); ?>">
							</div>
							<div class="medium-8 cell desktop">
								<div class="meta">
									<p><?php the_field('top_post_content'); ?></p>
								</div>
							</div>
							<div class="small-12 cell module auto-height mobile">
								<img src="<?php the_field('top_post_image') ?>" alt="<?php the_title(); ?>">
								<div class="meta">
									<p><?php the_field('top_post_content'); ?></p>
								</div>
							</div>
						</div>
					</div>

					<?php
						$args = array(
							'post_type' => 'post',
							'category_name' => 'madico-cares'
						);
						$query = new WP_Query( $args );
						while ( $query->have_posts() ) : $query->the_post();
					?>

						<div class="medium-6 cell module auto-height"><a href="">
							<div class="module-bg large" style="background-image:url(<?php the_post_thumbnail_url(); ?>)"></div>
							<div class="meta">
								<h5 class="blue"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p class="event-date"><?php the_field('event_date'); ?></p>
								<?php the_content(); ?>
							</div>
						</div>

					<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php 
endwhile;endif;
get_footer();