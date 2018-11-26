
<?php 
/* Template Name: Home */
get_header('home'); ?>

<section class="hero relative" style="background-image: url(<?php bloginfo('template_directory'); ?>/dist/assets/images/home-hero.png);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 large-10 large-offset-0 cell">
				<h1 class="white"><?php the_field('home_hero_heading'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="white" style="margin-bottom:30px"><?php the_field('home_hero_subhead'); ?></p>
				<a href="#!" class="btn-yellow solid"><?php the_field('home_hero_play_button_text'); ?>&nbsp;&nbsp;<i class="fas fa-play-circle"></i></a>&nbsp;<br class="show-for-small-only"><br class="show-for-small-only"><br class="show-for-small-only">
				<a href="/about" class="btn-yellow border"><?php the_field('home_hero_about_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="dealer-callout">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-7 cell text">
				<h2 class="blue"><i class="fal fa-id-badge"></i>&nbsp; <?php the_field('dealer_callout_heading'); ?></h2>
				<p><?php the_field('dealer_callout_subhead'); ?></p>
			</div>
			<div class="small-10 small-offset-1 large-3 large-offset-0 cell text-right">
				<a href="<?php the_field('dealer_callout_button_link'); ?>" class="btn-yellow solid"><?php the_field('dealer_callout_button_text'); ?> <i class="far fa-long-arrow-alt-right"></i></a>
			</div>
		</div>
	</div>
</section>

<section class="home-modules">
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<div class="small-10 small-offset-1 large-12 large-offset-0">
				<div class="grid-x grid-margin-x grid-margin-y">

					<?php if( have_rows('home_modules_small') ):
					    while ( have_rows('home_modules_small') ) : the_row(); ?>

					  <div class="medium-6 large-3 cell module">
					  	<a href="<?php the_sub_field('link_url'); ?>">
					  		<div class="module-bg small relative" style="background-image: url(<?php the_sub_field('image'); ?>);">
					  			<div class="label absolute"><strong><?php the_sub_field('label'); ?></strong></div>
					  	  </div>
					  	</a>
					  	<div class="meta">
					  		<a href="<?php the_sub_field('link_url'); ?>"><h4 class="blue"><?php the_sub_field('icon'); ?>&nbsp; <?php the_sub_field('heading'); ?></h4></a>
					  		<p style="margin-bottom: 30px"><?php the_sub_field('body'); ?></p>
					  		<a class="read-more" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?> &nbsp;<i class="far fa-long-arrow-right"></i></a>
					  	</div>
					  </div>

					<?php endwhile;endif; ?>

					<?php if( have_rows('home_modules_large') ):
					    while ( have_rows('home_modules_large') ) : the_row(); ?>

					  <div class="medium-6 cell module">
					  	<a href="<?php the_sub_field('link_url'); ?>">
					  		<div class="module-bg large relative" style="background-image: url(<?php the_sub_field('image'); ?>);">
					  			<div class="label absolute"><strong><?php the_sub_field('label'); ?></strong></div>
					  		</div>
					  	</a>
					  	<div class="meta">
					  		<a href="<?php the_sub_field('link_url'); ?>"><h4 class="blue"><?php the_sub_field('icon'); ?>&nbsp; <?php the_sub_field('heading'); ?></h4></a>
					  		<p style="margin-bottom: 30px"><?php the_sub_field('body'); ?></p>
					  		<a class="read-more" href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_text'); ?> &nbsp;<i class="far fa-long-arrow-right"></i></a>
					  	</div>
					  </div>

					<?php endwhile;endif; ?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer();