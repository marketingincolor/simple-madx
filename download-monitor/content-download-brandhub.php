<?php
/**
 * CUSTOM output for a download via the [download] shortcode using template="brand-hub"
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>
<a class="download-link brand-hub" title="<?php if ( $dlm_download->get_version()->has_version_number() ) {
	printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_version()->get_version_number() );
} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
	<?php $dlm_download->the_title(); ?></a>
	(<small><?php echo $dlm_download->get_version()->get_filename(); ?> &ndash; <?php echo $dlm_download->get_version()->get_filesize_formatted(); ?></small>)
