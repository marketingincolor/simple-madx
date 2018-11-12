<?php 
/* Template Name: Madico U */
global $post;
get_header('madicou'); ?>

<?php if (is_page('madicou')) { ?> 
	<?php get_template_part('template-parts/madicou/page-hero'); ?>
<?php //} else { ?>
	<?php //get_template_part('template-parts/madicou/page-search'); ?>
<?php } ?>

<?php get_template_part('template-parts/madicou/submenu'); ?>

<?php if (is_page('madicou')) { ?> 
	<?php get_template_part('template-parts/madicou/virtual-campus') ?>
	<?php get_template_part('template-parts/madicou/business-resources') ?>
	<?php get_template_part('template-parts/madicou/sales-resources') ?>
	<?php get_template_part('template-parts/madicou/marketing-resources') ?>
	<madu-video-modal></madu-video-modal>
<?php } elseif (is_page('ask-a-question') || is_page('glossary')) { ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part('template-parts/madicou/page-titleblock') ?>
	<?php endwhile;endif; ?>
<?php } else { ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part('template-parts/madicou/page-titleblock') ?>
	<?php endwhile;endif; ?>

<madu-video-modal></madu-video-modal>
<section class="page-content">
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<div class="cell small-10 small-offset-1 large-12 large-offset-0">
				<div class="grid-x grid-margin-x grid-margin-y">
					<div class="cell heading">
						<h3 class="section-h3">Videos <a href="<?php echo site_url('/mu-types/video/'); ?>" class="see-more">Watch More Videos &nbsp;<i class="fal fa-long-arrow-right"></i></a></h3>
					</div>

					<!-- ////////// BEGIN Body Cells for VIDEOS ////////// -->
					<div class="cell page-videos">
						<div class="grid-x grid-margin-x grid-margin-y">
							<!-- BEGIN LOOP for VIDEOS by SECTION/SLUG -->
							<?php get_template_part('template-parts/madicou/content-video') ?>
							<!-- END LOOP for VIDEOS by SECTION/SLUG -->
						</div>
					</div>

					<!-- ////////// BEGIN Body Cells for FAQs ////////// -->
					<?php
						$post_slug = $post->post_name;
						$doc_args = array( 
							'posts_per_page'=>-1,
							'post_type' => 'faq',
							'faq_taxonomies' => $post_slug
						);
						$doc_query = new WP_Query( $doc_args );
					?>
					<?php if($doc_query->have_posts()){ ?>
					<div class="cell heading">
						<h3 class="section-h3">Frequently Asked Questions <a href="<?php echo site_url('/faqs/'); ?>" class="see-more">More &nbsp;<i class="fal fa-long-arrow-right"></i></a></h3>
					</div>
					<div class="cell module page-faqs">
						<div class="grid-y grid-margin-x grid-margin-y">
							<!-- BEGIN LOOP for FAQS by SECTION/SLUG -->
							<?php include(locate_template('template-parts/madicou/content-faq.php')); ?>
							<!-- END LOOP for FAQS by SECTION/SLUG -->
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
			<div class="cell small-10 small-offset-1 medium-3 medium-offset-0">
				<div class="grid-x grid-margin-x grid-margin-y">

					<?php
						$post_slug = $post->post_name;
						$article_args = array( 
							'posts_per_page'=>-1,
							'post_type' => 'madicou',
							'madicou_taxonomies' => $post_slug,
							'madicou-types' => 'article'
						);
						$article_query = new WP_Query( $article_args );
					?>

					<!-- ////////// BEGIN Sidebar Cells for ARTICLES ////////// -->
					<?php if($article_query->have_posts()){ ?>
					<div class="cell heading">
						<h3 class="section-h3">Articles <a href="<?php echo site_url('/mu-types/article/'); ?>" class="see-more">More &nbsp;<i class="fal fa-long-arrow-right"></i></a></h3>
					</div>
					<div class="cell module side-articles">
						<div class="grid-y grid-margin-x grid-margin-y">
						<!-- BEGIN LOOP for ARTICLES by SECTION/SLUG -->
						<?php include(locate_template('template-parts/madicou/content-article.php')); ?>
						<!-- END LOOP for ARTICLES by SECTION/SLUG -->
						</div>
					</div>
					<?php } ?>

					<?php
						$post_slug = $post->post_name;
						$doc_args = array( 
							'posts_per_page'=>-1,
							'post_type' => 'madicou',
							'madicou_taxonomies' => $post_slug,
							'madicou-types' => 'document'
						);
						$doc_query = new WP_Query( $doc_args );
					?>
					<!-- ////////// BEGIN Sidebar Cells for DOCUMENTS ////////// -->
					<?php if($doc_query->have_posts()){ ?>
					<div class="cell heading">
						<h3 class="section-h3">Documents <a href="<?php echo site_url('/mu-types/document/'); ?>" class="see-more">More &nbsp;<i class="fal fa-long-arrow-right"></i></a></h3>
					</div>
					<div class="cell module side-documents">
						<div class="grid-y grid-margin-x grid-margin-y">
						<!-- BEGIN LOOP for DOCUMENTS by SECTION/SLUG -->
						<?php include(locate_template('template-parts/madicou/content-document.php')); ?>
						<!-- END LOOP for DOCUMENTS by SECTION/SLUG -->
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php get_footer('madicou'); //needs custom MadicoU footer