<?php
/* Template Name: Success */
get_header(); ?>

<section class="success-page">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell text-center">
				<div class="yellow-circle">
					<i class="fal fa-thumbs-up"></i>
				</div>
				<h1 class="blue"><?php the_field('success_heading'); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('success_subhead'); ?></p>
				<ul class="icons">

					<?php
					  $str = 'protectionpro';
					  if (strpos($_SERVER['HTTP_REFERER'], $str) !== false) { ?>
					  	<li><a href="https://www.youtube.com/user/ClearPlexCorp"><i class="fab fa-youtube blue"></i></a></li>
					<?php }else{ ?>
						<li><a href="https://www.facebook.com/MadicoInc/"><i class="fab fa-facebook-square blue"></i></a></li>
						<li><a href="https://twitter.com/MadicoInc"><i class="fab fa-twitter blue"></i></a></li>
						<li><a href="https://plus.google.com/+MadicoInc"><i class="fab fa-google-plus-g blue"></i></a></li>
						<li><a href="https://www.linkedin.com/company/madicoinc"><i class="fab fa-linkedin blue"></i></a></li>
						<li><a href="https://www.youtube.com/channel/UCu9s60dm8xsrjHsXtqT49Nw"><i class="fab fa-youtube blue"></i></a></li>
						<li><a href="https://www.instagram.com/clearplex"><i class="fab fa-instagram"></i></a></li>
				  <?php } ?>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
