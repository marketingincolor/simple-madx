<?php 
  get_header();
  // This takes in a zip code and returns all zip codes in a specific radius
  // using the zip code api: https://www.zipcodeapi.com/API#radius
  $api_root   = 'https://www.zipcodeapi.com/rest';
	$api_key    = $ZIP_CODE_API_KEY;
	$zip_radius = isset($_POST['radius']) ? $_POST['radius'] : 25;
	$zip_code   = $_POST['zip'];
	$type       = $_POST['type'];
	
	$api_url    = $api_root.'/'.$api_key.'/radius.json/'.$zip_code.'/'.$zip_radius.'/miles?minimal';

	$curl = curl_init($api_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additional info: ' . var_export($info));
	}

	// This will return an array of zip codes in the specified radius
	header('Content-Type: application/json');
	header("Location: /");
	echo $curl_response;

?>



<?php get_footer();