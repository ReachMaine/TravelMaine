<?php  /* customizations for divi */


/* add widget area(s) */
// under content widget area.
	if ( function_exists('register_sidebar') ){

		 // alerts box at top of site
		register_sidebar(array(
			'name' => 'Under Content Widget Area',
			'id' => 'reach-under-content',
			'description' => 'Widget under content',
      'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
  		'after_widget' => '</div> <!-- end .et_pb_widget -->',
  		'before_title' => '<h4 class="widgettitle">',
  		'after_title' => '</h4>',
		));
    }
// add the widget to after the content using hook
  add_action('et_after_main_content', 'spp_under_content_area');
	if ( !function_exists('spp_under_content_area') ){
    function spp_under_content_area () {
      if (is_active_sidebar('reach-under-content')) {
    			echo '<div id="reach-under-content-wrap" >';
            echo '<div id="reach-under-content" class="container clearfix">';
    				    dynamic_sidebar( 'reach-under-content');
             echo '</div><!-- under content -->';
    			echo '</div><!-- under content wrap -->';
    	}
    }
  }
