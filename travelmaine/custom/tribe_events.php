<?php
/** custom function for tribe events calendar & tribe events shortcdoe **/

/*add_filter ('ecs_beginning_output','travelmaine_esc_start', 15, 3);
function travelmaine_esc_start ($in_string, $in_posts, $in_atts) {

  return '<div class="rmm-esc-container">'.$in_string;
}
add_filter ('ecs_ending_output','travelmaine_esc_end', 15, 3);
function travelmaine_esc_end ($in_string, $in_posts, $in_atts) {
  return $in_string .'</div>';
}
// tag for each event
add_filter ('ecs_event_start_tag','travelmaine_esc_event_start',15, 3);
function travelmaine_esc_event_start ($in_string, $in_posts, $in_atts) {
//  $out_str = $in_string . 'yep, zig here';
  return '<div class="zags">';
}
add_filter ('ecs_event_end_tag','travelmaine_esc_event_end',15, 3);
function travelmaine_esc_event_end ($in_string, $in_posts, $in_atts) {
//  $out_str = $in_string . 'yep, zig here';
  return $in_string .'</div>';
}
*/
/*
add_filter ('ecs_event_title_tag_start','travelmaine_esc_title_start');
function travelmaine_esc_title_start ($in_title_string) {
  return '<yep, zig here2</p>';
}

add_filter ('ecs_event_title_tag_end','travelmaine_esc_title_start');
function travelmaine_esc_title_start ($in_title_string) {
  return '<yep, zig here2</p>';
} */

// wrap venue in div s.t. we can style it.
add_filter ('ecs_event_venue_tag_start','travelmaine_esc_venue_start');
function travelmaine_esc_venue_start ($in_string) {
  return '<div class="travelme-esc-venue"'.$in_string;
}
add_filter ('ecs_event_venue_tag_end','travelmaine_esc_enddiv');
function travelmaine_esc_enddiv ($in_string) {
  return $in_string."</div>";
}
add_filter ('ecs_event_venue_at_text','travelmaine_esc_nope');
function travelmaine_esc_nope($in_string) {
  return "";
}
