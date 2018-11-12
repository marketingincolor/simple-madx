<?php 

// Shortcode to add registration (®) mark with superscript tags
function registration_mark() {
  return '<sup>®</sup>';
}

add_shortcode('reg', 'registration_mark');