<?php 
$term = get_queried_object();
if ($term->slug == 'case-studies' || $term->slug == 'products') {
	include( locate_template( '/template-parts/taxonomy/specialty-solutions/specialty-'.$term->slug.'.php', false, false ) );
}else{ ?>
	
<div class="show-for-small-only">
	<?php get_template_part('template-parts/menus/specialty-header-menu'); ?>
</div>

<div class="grid-container">
	<div class="grid-x">
		<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
			<?php get_template_part('template-parts/menus/specialty-tablet-menu'); ?>
		</div>
		<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
			<?php get_template_part('template-parts/menus/specialty-header-menu'); ?>
		</div>
	</div>
</div>

<section class="taxonomy-intro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 small-10 small-offset-1 large-offset-2 cell text-center">
				<h1 class="blue"><?php the_field('intro_heading',$term); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('intro_subhead',$term); ?></p>
			</div>
		</div>
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x grid-margin-x grid-margin-y">

				<?php
					$args = array(
						'post_type'      => 'specialty',
						'posts_per_page' => 99,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'tax_query'      => array(
							array(
								'taxonomy'   => 'specialty_taxonomies',
								'field'      => 'slug',
								'terms'      => 'industries',
							),
						),
					);
					$query = new WP_Query( $args );
					while ( $query->have_posts() ) : $query->the_post();
					if (get_the_title() == "Contract Coating" || get_the_title() == "Information Display") {
						$cta = 'Start Your Project';
					}else{
						$cta = 'Start A Project';
					}
				?>

					<div class="large-4 medium-6 cell text-center benefit">
						<?php the_field('specialty_category_icon'); ?>
						<h5 class="blue"><?php the_title(); ?></h5>
						<p class="subhead" style="margin-bottom:30px"><?php the_field('specialty_short_description'); ?></p>
						<p class="text-center"><a href="/specialty-solutions/contact" class="btn-yellow border"><?php _e( $cta, 'madx' ); ?></a></p>
					</div>

				<?php endwhile; wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php } ?>
<?php get_template_part('template-parts/taxonomy/specialty-solutions/contact'); ?>
