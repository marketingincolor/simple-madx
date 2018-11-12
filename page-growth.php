<?php 
/* Template Name: Growth */
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


<section class="home-modules">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell text-center">
				<h1 class="blue"><?php the_field('about_film_heading'); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('about_film_subhead'); ?></p></a>
			</div>
		</div>
	</div>
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x grid-margin-x grid-margin-y">

					<?php if( have_rows('growth_module') ):
					  while ( have_rows('growth_module') ) : the_row(); ?>
						
						<div class="medium-6 large-4 cell module auto-height">
							<div class="module-bg small" style="background-image: url(<?php the_sub_field('image'); ?>)"></div>
							<div class="meta">
								<h4 class="blue"><i class="fal fa-car"></i>&nbsp; <?php the_sub_field('heading'); ?></h4>
								<p class="subhead"><?php the_sub_field('subhead'); ?></p>
								<a href="<?php the_sub_field('link_url'); ?>" class="read-more"><?php the_sub_field('link_text'); ?> &nbsp;<i class="far fa-long-arrow-right"></i></a>
								<?php if (get_sub_field('second_link_text')) { ?>
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php the_sub_field('second_link_url'); ?>" class="read-more"><?php the_sub_field('second_link_text'); ?> &nbsp;<i class="far fa-long-arrow-right"></i></a>
								<?php } ?>
							</div>
						</div>

					<?php endwhile;endif; ?>
					
				</div>
			</div>
		</div>
	</div>
</section>


<section class="about-next" style="background-image: url(<?php the_field('about_next_background_image') ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 large-6 large-offset-0 cell">
				<h2 class="white"><?php the_field('about_next_heading') ?></h2>
				<aside class="yellow-underline left"></aside>
				<div class="white subhead"><?php the_field('about_next_subhead') ?></div>
				<p><a href="/specialty-solutions" class="white read-more">View Specialty &nbsp;<i class="far fa-long-arrow-right"></i></a></p>
			</div>
		</div>
	</div>
</section>

<section class="about-content">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 cell content-block">
				<div class="grid-x">
					<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-ppro" style="background-image: url(<?php the_field('about_ppro_background_image') ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-6 medium-offset-5 large-offset-6 small-10 small-offset-1 cell text-right">
				<h2 class="white"><?php the_field('about_ppro_heading'); ?></h2>
				<aside class="yellow-underline right"></aside>
				<p class="white subhead"><?php the_field('about_ppro_subhead'); ?></p>
				<p><a href="/protectionpro" class="white read-more">View ProtectionPro &nbsp;<i class="far fa-long-arrow-right"></i></a></p>
			</div>
		</div>
	</div>
</section>

<?php 
endwhile;endif;
get_footer();