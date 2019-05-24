<?php
/* custom code for the acadp plugin - Advanced Classifieds & Directory Pro plugin */

//add_action('acadp_after_listing_content', 'gotravel_after_content', 10, 2);
function gotravel_after_content ( $in_id) {
      // after everything is printed
      echo "yep.";

} // end of function gotravel_after_content

//add_action('acadp_before_listing_content', 'gotravel_before_content', 10, 1);
function gotravel_before_content ( $in_id) {
  // before the title
      echo "ok.";


} // end of function gotravel_before_content


/**
 * Enables the  custom fields box in listing edit screen.
 */
function gotravel_listing_supports() {
  add_post_type_support('acadp_listings', 'custom-fields');
}
//add_action( 'plugins_loaded', 'gotravel_listing_supports' );
add_action('init', 'gotravel_listing_supports', 100);

function format_phone($in_phone_text) {
  $out_str = preg_replace("/[^\d]/","",$in_phone_text); // strip out non digits
  $slen = strlen($out_str);
  if ($slen == 10) {
    $out_str = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $out_str);
  }
  if ($slen == 7) {
    $out_str = preg_replace("/^1?(\d{3})(\d{4})$/", "$1-$2", $out_str);
  }
  return  $out_str;
}
