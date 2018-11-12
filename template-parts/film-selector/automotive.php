<main class="page-container">

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/auto-header-menu'); ?>
	</div>

	<div id="header-grid" class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/auto-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/auto-header-menu'); ?>
			</div>
		</div>
	</div>

	<section class="top">
		<div class="grid-container">
			<div class="grid-x grid-margin-y">
				<div class="large-8 small-10 large-offset-2 small-offset-1 cell text-center">
					<h1 class="blue"><?php the_field('page_heading'); ?></h1>
					<aside class="yellow-underline center"></aside>
					<p><?php the_field('page_subheading'); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="select-film">
		<div class="grid-container">
			<div class="grid-x">
				<div class="medium-10 medium-offset-1 cell">
					
					<film-selector></film-selector>
					
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part('template-parts/find-dealer'); ?>
</main>