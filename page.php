<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

global $post; 
$pageslug = $post->post_name;
$url = $_SERVER['REQUEST_URI'];

if (strpos($url, 'general') !== false) {
    $lookup = 'general';
}

get_header(); ?>

<section class="page-content">
	<div class="grid-container">
		<div class="grid-x grid-margin-y">
			<div class="small-10 small-offset-1 large-8 large-offset-2 cell columns">
				<?php if (function_exists('wordpress_breadcrumbs')) wordpress_breadcrumbs(); ?>
			</div>
		</div>

		<main class="grid-x grid-margin-y">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php endwhile; ?>
		</main>
		</div>
	</div>
</section>

<section class="page-downloads">

    <div class="grid-container">
        <main class="grid-x grid-margin-y">
            <article id="post-<?php the_ID(); ?>" <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
                <div class="entry-content">
                    <h5>downloads shortcode with pageslug category</h5>
                    <?php echo do_shortcode('[downloads category="'.$pageslug.'" template="brandhub"]'); ?>
                </div>
            </article>
        </main>
    </div>








    <div class="grid-container">
        <main class="grid-x grid-margin-y">
            <article id="post-<?php the_ID(); ?>" <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
                <div class="entry-content">
                
                <h5>get_the_terms method for DLM post type with pageslug</h5>
                <?php
                    $args = array(
                        'post_type' => 'dlm_download',
                		'showposts'    => '999',
                        //'dlm_download_category' => $term->slug,
                        //'dlm_download_category' => $lookup,
                        'dlm_download_category' => $pageslug,
                	'order'          => 'ASC',
                    	'orderby'        => 'title'
                    );
                    $query = new WP_Query( $args ); 
                ?>
                <?php  while ( $query->have_posts() ) : $query->the_post(); //var_dump($dlm_download); ?>

                    <div><a class="document-link" href="<?php $dlm_download->the_download_link(); ?>"><?php echo $dlm_download->get_the_title(); ?></a></div>
                    <div class="description"><?php echo $dlm_download->get_the_short_description(); ?></div>
                    <div class="date">Published: <?php $date = $dlm_download->get_the_file_date(); $date = date_create($date); echo date_format($date, 'F j, Y');?></div>
                    <div class="dl-button"><a href="<?php $dlm_download->the_download_link(); ?>">Download</a></div>
                    <div class="dl-count"><?php echo $dlm_download->get_the_download_count(); ?> downloads</div>

                	<div class="dl-count">Category: 
                		<?php 
                			foreach (get_the_terms($dlm_download->get_id(), 'dlm_download_category') as $cat) {
                				echo $cat->name;
                			}
                			//$dlm_download->get_id(); 
                		?> 
                	</div>

                <?php endwhile;  wp_reset_postdata(); ?>  


                </div>
            </article>
        </main>
    </div>
</section>



<section class="page-downloads">
	<div class="grid-container">
		<main class="grid-x grid-margin-y">
			<article id="post-<?php the_ID(); ?>" <?php post_class('small-10 small-offset-1 large-8 large-offset-2'); ?>>
				<div class="entry-content">
					<?php if ( is_user_logged_in() ) { ?>
					<?php //if ( current_user_can( 'view_sunscape' ) ) {  ?>
                    
                    <h5>get_terms method for DLM post type using slug</h5>
						<?php

						echo "<div class='grid-x grid-padding-x medium-up-3 large-up-4'>";
						$terms = get_terms( 'dlm_download_category' );
		//var_dump($terms);
						foreach ( $terms as $term ) {
							$slug = $term->slug;
							echo "<div class='cell'>";
							echo "<h4><a href='".site_url()."/?dlm_download_category=" . $term->slug . "'>" . $term->name . "</a></h4>";
							echo do_shortcode( "[downloads category='$slug' template='brandhub']" );
							echo "</div>";
						}
						echo "</div>";
						//echo do_shortcode( "[downloads template='brandhub']" );
						?>

					<?php } else { ?>
					    <h4>Users must be&nbsp;<a href="<?php echo site_url(); ?>/wp-login.php" title="Members Area Login" rel="home">logged in</a>&nbsp;to view downloads!</h4>
					<?php } ?>
				</div>
			</article>
		</main>
		</div>
	</div>
</section>







<div class="single-post-wrap">
    <div class="container">  
        <h5>get_terms method for DLM post type using slug (w/content render)</h5>
    	 <?php //start by fetching the terms for the dlm_download_category taxonomy
$terms = get_terms( 'dlm_download_category', array(
    'orderby'    => 'count',
'showposts'    => '999',
    'hide_empty' => 1
) );
?>

<?php
// now run a query for each category - display results in alpha order
foreach( $terms as $term ) {
 
    // Define the query
    $args = array(
        'post_type' => 'dlm_download',
		'showposts'    => '999',
        'dlm_download_category' => $term->slug,
	'order'          => 'ASC',
    	'orderby'        => 'title'
    );
    $query = new WP_Query( $args ); ?>
             
    <h5 class="trigger"><?php echo $term->name; ?></h5>
     
    <div class="toggle_container">
     	<table class="form-downloads" border="0" cellspacing="0" cellpadding="0">
          <tbody>
          	<tr>
             	<th>Document Title</th>
                <th>Version</th>
                <th>Link</th>
                <th class="type">Type</th>
            </tr>
      		<?php  while ( $query->have_posts() ) : $query->the_post(); //var_dump($dlm_download); ?>
            
			<tr>
       			<td>
                  <strong><a class="document-link" href="<?php $dlm_download->the_download_link(); ?>"><?php echo $dlm_download->get_the_title(); ?></a></strong><br>
                  <div class="description"><?php echo $dlm_download->get_the_short_description(); ?></div>
                </td>
                <td class="version">Published: <?php $date = $dlm_download->get_the_file_date(); $date = date_create($date); echo date_format($date, 'F j, Y');?></td>
                <td class="dl-btn">
                	<div class="dl-button"><a href="<?php $dlm_download->the_download_link(); ?>">Download</a></div>
                	<div class="dl-count"><?php echo $dlm_download->get_the_download_count(); ?> downloads</div>
                	<div class="dl-count"><?php echo $dlm_download->get_id(); ?> </div>
                	<div class="dl-count">Category: <?php 

								foreach (get_the_terms($dlm_download->get_id(), 'dlm_download_category') as $cat) {
								   echo $cat->name;
								}

                	 $dlm_download->get_id(); ?> </div>
                </td>
                <td class="type"><a href="<?php $dlm_download->the_download_link(); ?>"><img class="doc-icon" src="<?php bloginfo('template_url'); ?>/images/filetype-<?php echo $dlm_download->get_the_filetype(); ?>.svg" title="download the <?php echo $dlm_download->get_the_filetype(); ?>" alt="download the <?php echo $dlm_download->get_the_filetype(); ?>" border="0" /></a></td>
        	</tr> 
            
        	<?php endwhile; ?> 
            </tbody>
        </table>
        </div>
<?php  wp_reset_postdata();} ?>        
       
   </div>
 </div>  


<?php
get_footer();
