<?php 
$term = get_queried_object();
if ($term->slug == 'case-studies' || $term->slug == 'safety-security') {
	include( locate_template( '/template-parts/taxonomy/commercial/commercial-'.$term->slug.'.php', false, false ) );

}else{ ?>

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/commercial-header-menu'); ?>
	</div>

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/commercial-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/commercial-header-menu'); ?>
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
		</div>
	</section>

	<section id="tax-posts" class="taxonomy-products" style="padding-top: 5%">
		<div class="grid-container">

				<div class="grid-x grid-margin-y">
					<div class="small-10 small-offset-1 large-12 large-offset-0 cell text-center">
						<h2 class="blue"><?php the_field('products_heading',$term); ?></h2>
						<aside class="yellow-underline center"></aside>
						<p class="subhead"></p>
					</div>
				</div>
				<?php if($term->slug == 'solar') { ?>
				  <tax-term-posts></tax-term-posts>
				<?php }else if($term->slug == 'decorative') { ?>
				  <decorative-posts></decorative-posts>
			  <?php } ?>

		</div>
	</section>

<?php get_template_part('/template-parts/top-level-page/find-dealer'); ?>

<?php } ?>