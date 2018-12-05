<?php
/**
 * CUSTOM output for a download via the [download] shortcode using template="brand-hub"
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/** @var DLM_Download $dlm_download */
$filetag = $dlm_download->get_version()->get_filetype(); // pdf, xls, or other
switch ($filetag) {
	case "pdf":
		$fileicon = '<i class="fas fa-file-pdf"></i>';
		break;
	case "xls":
		$fileicon = '<i class="fas fa-file-excel"></i>';
		break;
	case "csv":
		$fileicon = '<i class="fas fa-file-csv"></i>';
		break;
	case "doc":
		$fileicon = '<i class="fas fa-file-alt"></i>';
		break;
	case "jpg":
		$fileicon = '<i class="fas fa-file-image"></i>';
		break;
	case "png":
		$fileicon = '<i class="fas fa-file-image"></i>';
		break;
	case "eps":
		$fileicon = '<i class="fas fa-file-image"></i>';
		break;
	case "zip":
		$fileicon = '<i class="fas fa-file-archive"></i>';
		break;
	default:
		$fileicon = '<i class="fas fa-file"></i>';
}
$fileimg = $dlm_download->get_image();
$default_image = stripos($fileimg, 'placeholder');
if ($default_image == false) {
	//echo 'use fileimg';
	$dlm_icon = $fileimg;
} else {
	//echo 'use placeholder';
	$dlm_icon = $fileicon;
}
?>
<a class="download-link brand-hub" title="<?php if ( $dlm_download->get_version()->has_version_number() ) { printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_version()->get_version_number() ); } ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
<?php echo $dlm_icon; ?><p><?php $dlm_download->the_title(); ?></p></a>
<p>(<small><?php echo $dlm_download->get_version()->get_filename(); ?> <br> <?php echo $dlm_download->get_version()->get_filesize_formatted(); ?></small>)</p>
