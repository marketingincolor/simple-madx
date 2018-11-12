<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="input-group relative">
		<input type="text" class="input-group-field" value="" name="s" id="s" placeholder="<?php esc_attr_e( "Search site", 'foundationpress' ); ?>">
		<input type="hidden" value="page" name="post_type">
		<button type="submit" class="absolute">
		   <i class="fas fa-search"></i>
		</button>
	</div>
</form>