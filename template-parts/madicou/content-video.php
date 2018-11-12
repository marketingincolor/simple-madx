<?php 
$post_slug = $post->post_name;
$video_args = array( 
	'posts_per_page'=>-1,
	'post_type' => 'madicou',
	'madicou_taxonomies' => $post_slug,
	'madicou-types' => 'video'
);
$video_query = new WP_Query( $video_args );
if ( $video_query->have_posts() ) : while ( $video_query->have_posts() ) : $video_query->the_post(); 
	$video_url = get_field('video_url'); // Requires ACF Field for 'video_url'
	$video_meta = get_field('video_meta'); // Requires ACF Field for 'video_meta'
	$video_file = get_field('video_attachment'); // Requires ACF Field for 'video_meta'
	?>

	<div class="medium-3 cell module auto-height <?php echo $post_slug; ?>">
		<div class="image-link" data-videotitle="Title of Video">
			<a href="#!" data-open="video-modal" class="videolink" data-videourl="<?php echo $video_url; ?>" data-videotitle="<?php the_title() ;?>" data-videometa="<?php echo $video_meta; ?>" data-attach="<?php echo $video_file; ?>" data-videotxt="<?php the_content() ;?>"><div class="module-bg" style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></div></a>
		</div>
		<div class="meta">
			<button data-open="video-modal" class="videolink" data-videourl="<?php echo $video_url; ?>" data-videotitle="<?php the_title() ;?>" data-videometa="<?php echo $video_meta; ?>" data-attach="<?php echo $video_file; ?>" data-videotxt="<?php the_content() ;?>"><h4 class="blue"><?php the_title() ;?></h4></button>
			<p><i class="fal fa-clock"></i> &nbsp;<?php echo $video_meta; ?></p>
		</div>
	</div>

<?php endwhile; else: ?> 
	<div class="cell">
		<p style="padding:1em;">There are no <?php echo $post->post_title; ?> Videos to display</p>
	</div>
<?php endif;wp_reset_postdata(); ?>