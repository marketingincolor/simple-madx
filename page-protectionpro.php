<?php 
/* Template Name: ProtectionPro */
get_header(); ?>

<section class="hero relative" style="background-image: url(<?php the_field('about_hero_background_image'); ?>);">
	
	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/protectionpro-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x relative">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell show-for-medium-only">
				<?php get_template_part('template-parts/menus/protectionpro-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell show-for-large">
				<?php get_template_part('template-parts/menus/protectionpro-header-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 medium-6 large-offset-0 cell">
				<h1 class="white"><?php the_field('about_hero_heading'); ?></h1>
				<aside class="yellow-underline left"></aside>
				<p class="white"><?php the_field('about_hero_subhead'); ?></p>
			</div>
		</div>
	</div>
</section>

<section id="touchscreen-protection" class="touchscreen-pro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 cell">
				<div class="grid-x grid-margin-x grid-margin-y">
					<div class="medium-6 cell text-center">
						<img src="<?php the_field('touchscreen_image'); ?>" alt="<?php the_field('touchscreen_heading'); ?>">
					</div>
					<div class="medium-6 cell">
						<h2 class="blue"><?php the_field('touchscreen_heading'); ?></h2>
						<aside class="yellow-underline left"></aside>
						<p><?php the_field('touchscreen_subhead'); ?></p>
						<ul class="checklist">

							<?php
							if( have_rows('touchscreen_checklist') ):
							  while ( have_rows('touchscreen_checklist') ) : the_row(); ?>

							    <li><i class="far fa-check"></i>&nbsp;&nbsp;<?php the_sub_field('list_item_text'); ?></li>

							<?php endwhile;endif; ?>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="body-protection" class="touchscreen-pro" style="padding-top:0">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 cell">
				<div class="grid-x grid-margin-x grid-margin-y">
					<div class="medium-6 small-order-2 medium-order-1 cell">
						<h2 class="blue"><?php the_field('body_protection_heading'); ?></h2>
						<aside class="yellow-underline left"></aside>
						<p><?php the_field('body_protection_subhead'); ?></p>
						<ul class="checklist">

							<?php
							if( have_rows('body_checklist') ):
							  while ( have_rows('body_checklist') ) : the_row(); ?>

							    <li><i class="far fa-check"></i>&nbsp;&nbsp;<?php the_sub_field('list_item_text'); ?></li>

							<?php endwhile;endif; ?>

						</ul>
					</div>
					<div class="medium-6 small-order-1 medium-order-2 cell text-center">
						<!-- Owl Carousel goes here -->
						<div class="full-body-carousel owl-carousel owl-theme">
							
							<?php
							$args = array(
								'post_type'      => 'ppro_covers', 
								'posts_per_page' => -1,
								'orderby'        => 'menu_order',
								'order'          => 'ASC'
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); ?>

						    <div class="item" data-hash="<?php echo $post->menu_order + 1; ?>">
						    	<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
						    	<h4 style="margin-bottom:15px;font-size: 1.25rem;"><?php the_title(); ?></h4>
						    </div>

					    <?php $count++;endwhile; wp_reset_postdata(); ?>

						</div>
					<!-- End Owl Carousel -->
						
					<!-- Foundation 6 Orbit goes here -->
						<div id="swatch-carousel" class="orbit" role="region" aria-label="ProtectionPro Cases" v-f-orbit data-auto-play="false">
							<p style="margin-bottom:15px">SELECT TO PREVIEW (CLICK ARROWS TO SEE ALL PATTERNS)</p>
						  <div class="orbit-wrapper relative">
						    <div class="orbit-controls">
						      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span><i class="fas fa-chevron-left"></i></button>
						      <button class="orbit-next"><span class="show-for-sr">Next Slide</span><i class="fas fa-chevron-right"></i></button>
						    </div>
						    <!-- CIRCULAR SWATCH CAROUSEL -->
						    <ul class="orbit-container">
						      <li class="is-active orbit-slide">

							    	<?php
								    	$swatch_count = 0;
								    	$swatches_per_slide = 5;
								    	$total_post_count = wp_count_posts('ppro_covers')->publish;
								    	$args = array(
								    		'post_type'      => 'ppro_covers', 
								    		'posts_per_page' => -1,
								    		'orderby'        => 'menu_order',
								    		'order'          => 'ASC'
								    	);
								    	$loop = new WP_Query( $args );
								    	while ( $loop->have_posts() ) : $loop->the_post();
								    ?>

						      		<a href="#<?php echo $swatch_count + 1; ?>"><img src="<?php the_field('color_swatch'); ?>" alt="<?php the_title(); ?>" <?php if ($swatch_count == 0){echo 'class="active-swatch"';} ?>></a>

											<?php $swatch_count++; ?>
											<?php if ($swatch_count % $swatches_per_slide == 0 && $swatch_count != $total_post_count) { ?>
											  	
											</li><li class="orbit-slide">

											<?php } ?>
											<?php if ($swatch_count == $total_post_count) { ?>

											</li>

											<?php } ?>

						        <?php endwhile; wp_reset_postdata(); ?>

						    </ul>
						  </div>
						</div>
					<!-- End foundation orbit -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('/template-parts/taxonomy/testimonials'); ?>

<section id="contact" class="about-content">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-12 cell content-block">
				<div class="grid-x">
					<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
						<h4><?php the_field('protectionpro_contact_header'); ?></h4>
						<p class="subhead"><?php the_field('protectionpro_contact_subhead'); ?></p>
						<p><jot-form form-id="82823879486173"></jot-form></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="find-dealer" class="find-dealer" style="background-image: url(<?php the_field('find_retailer_background_image'); ?>);">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-7 large-5 large-offset-0 cell">
				<h2 class="white"><?php the_field('find_retailer_heading'); ?></h2>
				<aside class="yellow-underline left"></aside>
				<p class="white subhead"><?php the_field('find_retailer_subhead'); ?></p>
				<a href="<?php the_field('find_retailer_button_link'); ?>" class="btn-yellow solid"><?php the_field('find_retailer_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<?php get_footer();