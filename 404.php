<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<section class="error-page">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell text-center">
				<div class="yellow-circle">
					<i class="fal fa-exclamation-triangle blue"></i>
				</div>
				<h1 class="blue">Oops! You've reached a 404 page.</h1>
				<aside class="yellow-underline center"></aside>
			</div>
			<div class="small-8 small-offset-2 medium-6 medium-offset-3 large-5 large-offset-4 cell">
				<p style="margin-bottom: 10px">The page you're looking for doesn't exist.</p>
				<ul>
					<li><i class="fal fa-check-circle"></i> &nbsp;Check the URL</li>
					<li><i class="fal fa-arrow-circle-left"></i> &nbsp;Go to our <a href="/">homepage</a></li>
					<li><i class="fal fa-search"></i> &nbsp;Or, use our search bar to find what you're looking for</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
