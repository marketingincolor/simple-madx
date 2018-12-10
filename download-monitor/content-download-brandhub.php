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
		$fileicon = '<i class="fal fa-file-pdf"></i>'; // change to fal for light outline version of icons
		break;
	case "xls":
		$fileicon = '<i class="fal fa-file-excel"></i>';
		break;
	case "csv":
		$fileicon = '<i class="fal fa-file-csv"></i>';
		break;
	case "doc":
		$fileicon = '<i class="fal fa-file-alt"></i>';
		break;
	case "jpg":
		$fileicon = '<i class="fal fa-file-image"></i>';
		break;
	case "jpeg":
		$fileicon = '<i class="fal fa-file-image"></i>';
		break;
	case "tif":
		$fileicon = '<i class="fal fa-file-image"></i>';
		break;
	case "png":
		$fileicon = '<i class="fal fa-file-image"></i>';
		break;
	case "eps":
		$fileicon = '<i class="fal fa-file-image"></i>';
		break;
	case "ppt":
		$fileicon = '<i class="fal fa-file-powerpoint"></i>';
		break;
	case "wav":
		$fileicon = '<i class="fal fa-file-audio"></i>';
		break;
	case "mp3":
		$fileicon = '<i class="fal fa-file-audio"></i>';
		break;
	case "mp4":
		$fileicon = '<i class="fal fa-file-video"></i>';
		break;
	case "mov":
		$fileicon = '<i class="fal fa-file-video"></i>';
		break;		
	case "zip":
		$fileicon = '<i class="fal fa-file-archive"></i>';
		break;
	default:
		$fileicon = '<i class="fal fa-file"></i>';
}
$fileimg = $dlm_download->get_image();
$default_image = stripos($fileimg, 'placeholder');
$dlm_icon = ( $default_image == false ? $fileimg : $fileicon );
?>
<a class="download-link brand-hub" title="<?php if ( $dlm_download->get_version()->has_version_number() ) { printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_version()->get_version_number() ); } ?><?php if ( $dlm_download->the_title() ) { printf( __( 'File %s', 'download-monitor' ), $dlm_download->the_title() ); } ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
<?php echo $dlm_icon; ?><p><?php $dlm_download->the_title(); ?></p></a>
<p><small>( <?php echo $dlm_download->get_version()->get_filetype(); ?> <?php if ( $dlm_download->get_version()->get_filesize_formatted() ) { printf( __( '&ndash; %s', 'download-monitor' ), $dlm_download->get_version()->get_filesize_formatted() ); } ?> )</small></p>
