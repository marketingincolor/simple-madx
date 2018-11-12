<section class="warranty" style="background-image: url(<?php the_field('warranty_background_image'); ?>)">
	<div class="grid-container">
		<div class="grid-x">
			<div class="medium-6 medium-offset-5 large-offset-6 small-10 small-offset-1 cell text-right">
				<h2 class="white"><?php the_field('warranty_heading'); ?></h2>
				<aside class="yellow-underline right"></aside>
				<p class="white"><?php the_field('warranty_subhead'); ?></p>
				<?php if(get_field('warranty_link_url')) { ?>
				  <p style="margin-top:30px"><a href="<?php the_field('warranty_link_url'); ?>" class="white read-more"><?php the_field('warranty_link_text'); ?> &nbsp;<i class="far fa-long-arrow-alt-right white"></i></a></p>
				<?php } ?>
			</div>
		</div>
	</div>
</section>