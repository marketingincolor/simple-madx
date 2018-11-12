
<?php 
/* Template Name: International */
get_header('international'); ?>

<section class="hero relative" style="background-image: url(<?php the_field('international_hero_background_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 large-offset-0 cell">
				<h1 class="white"><?php the_field('international_hero_heading'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="white subhead"><?php the_field('international_hero_subhead'); ?></p>
				<a href="<?php the_field('international_hero_button_link'); ?>" class="btn-yellow solid"><?php the_field('international_hero_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="about-next" style="background-image: url(<?php the_field('international_film_background_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-6 large-4 large-offset-0 cell">
				<h2 class="blue"><?php the_field('international_film_heading'); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p><?php the_field('international_film_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="about-ppro" style="background-image: url(<?php the_field('international_specialty_background_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-6 medium-offset-5 large-offset-8 large-4 small-10 small-offset-1 cell text-right">
				<h2 class="white"><?php the_field('international_specialty_heading'); ?></h2>
				<aside class="yellow-underline right"></aside>
				<p class="white"><?php the_field('international_specialty_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="about-next ppro" style="background-image: url(<?php the_field('international_protectionpro_background_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-6 large-4 large-offset-0 cell">
				<h2 class="white"><?php the_field('international_protectionpro_heading'); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p class="white"><?php the_field('international_protectionpro_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section id="contact" class="about-content">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 cell content-block">
				<div class="grid-x">
					<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
						<h4 class="blue"><?php the_field('international_contact_heading'); ?></h4>
						<p class="subhead"><?php the_field('international_contact_subhead'); ?></p>
						<jot-form form-id="82806170486158"></jot-form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer();