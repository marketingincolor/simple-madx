<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<section class="page-hero relative" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
	<div class="overlay absolute"></div>
	<div class="grid-container" id='header-grid'>
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<?php if(get_post_type() == 'post') { ?>
				  <?php get_template_part('template-parts/menus/blog-header-menu'); ?>
				<?php } ?>
			</div>
		</div>
	</div>

	<?php $cat = get_the_category(); ?>

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 large-10 medium-8 small-offset-1 large-offset-0 cell">
				<h1 class="blue"><?php the_title(); ?></h1>
			</div>
			<div class="small-12 large-10 medium-8 medium-offset-1 large-offset-0 cell">
				<ul class="post-meta absolute">
					<li><i class="fal fa-calendar-alt light-blue"></i> &nbsp; <?php the_date(); ?></li>
					<li><i class="fal fa-folder-open light-blue"></i> <?php echo $cat[0]->name; ?></li>
					<li>
						<ul class="social">
							<li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="post-content">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="medium-6 small-10 small-offset-1 cell">

				<?php the_content(); ?>

				<div class="grid-x next-prev">
					<div class="small-6 cell text-left">

						<?php //previous_post_link('%link','<i class="far fa-long-arrow-left"></i>',false,''); ?>
						<?php previous_post_link( '%link', '<i class="far fa-long-arrow-left"></i>&nbsp; %title', false, '' ); ?>

					</div>
					<div class="small-6 cell text-right">

						<?php next_post_link( '%link', '%title &nbsp;<i class="far fa-long-arrow-right"></i>', false, '' ); ?>
						
					</div>
				</div>

			</div>
			<div class="medium-4 small-10 small-offset-1 cell single-sidebar">

				<?php get_sidebar(); ?>

			</div>
		</div>
	</div>
</section>

<section class="related-posts">
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<?php $cat = get_the_category($post->ID); ?>

				<h3>Related Posts &nbsp;<span><a href="/blog/category/<?php echo $cat[0]->slug; ?>">See More <i class="far fa-long-arrow-right"></i></a></span></h3>
				<div class="grid-x grid-margin-x grid-margin-y">
					<?php

						$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
						if( $related ) foreach( $related as $post ) {
						setup_postdata($post);
						$date = strtotime($post->post_date_gmt); ?>

			      <div class="medium-4 cell module auto-height">
				     	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>
				     	<div class="meta">
				     		<p class="post-date"><i class="fal fa-calendar-alt"></i> &nbsp; <?php echo date('F d, Y',$date); ?></p>
				     		<h4 class="blue"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				     		<p class="content">
				     			<?php echo wp_trim_words(get_the_content(),25,'...'); ?>
				     		</p>
				     		<a href="<?php the_permalink(); ?>" class="read-more">Read More &nbsp;<i class="far fa-long-arrow-right"></i></a>
				     	</div>
			      </div>

					<?php }
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endwhile; ?>


<?php get_footer();
