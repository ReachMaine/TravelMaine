// script for hiding & showing stuff on home page.
jQuery(function ($) {
    $( document ).ready(function() {
      	// tab0 = state of maine
        $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_0").on("click", function(){
          hide_maps_desc(); // hide everything

        	document.getElementById('map-maine').style.display="block";
          document.getElementById('desc-maine').style.display="block";

        });
      	// tab1 = beaches
        $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_1").on("click", function(){
          hide_maps_desc(); // hide everything

          document.getElementById('map-beaches').style.display="block";
          document.getElementById('desc-beaches').style.display="block";
        });
       // tab2 = portland
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_2").on("click", function(){
          hide_maps_desc(); // hide everything

        	document.getElementById('map-portland').style.display="block";
          document.getElementById('desc-portland').style.display="block";
        });
      // tab3 = midclast
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_3").on("click", function(){
         hide_maps_desc(); // hide everything

         document.getElementById('map-midcoast').style.display="block";
         document.getElementById('desc-midcoast').style.display="block";
        });
       // tab4 = downeast
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_4").on("click", function(){
        	hide_maps_desc(); // hide everything

         document.getElementById('map-downeast').style.display="block";
          document.getElementById('desc-downeast').style.display="block";
        });
        // tab5 = lakes & mountains
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_5").on("click", function(){
        	hide_maps_desc();

         document.getElementById('desc-lakes-mounts').style.display="block";
         document.getElementById('map-lakes-mounts').style.display="block";
        });
         // tab6 = kennebec valley
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_6").on("click", function(){
        	hide_maps_desc();

         document.getElementById('map-kennebec').style.display="block";
          document.getElementById('desc-kennebec').style.display="block";
        });
               // tab7 = hignland
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_7").on("click", function(){
        	hide_maps_desc();

          document.getElementById('desc-highlands').style.display="block";
         document.getElementById('map-highlands').style.display="block";
        });
       // tab8 = aroostook
       $("#tabs-regions .et_pb_tabs_controls .et_pb_tab_8").on("click", function(){
         hide_maps_desc();

         document.getElementById('map-aroostook').style.display="block";
         document.getElementById('desc-aroostook').style.display="block";
        });
    });
    function hide_maps_desc() {


      document.getElementById('map-maine').style.display="none";
      var block = document.getElementById('map-maine');
      if ($(block).length) {  block.style.display="none"; }

      block = document.getElementById('map-beaches');
      if ($(block).length) {  block.style.display="none"; }
      block = document.getElementById('map-beaches');
      if ($(block).length) { block.style.display="none";  }
      block = document.getElementById('map-portland');
      if ($(block).length) { block.style.display="none";  }
      block = document.getElementById('map-midcoast');
      if ($(block).length) { block.style.display="none";  }
      block = document.getElementById('map-downeast');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('map-lakes-mounts');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('map-highlands');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('map-kennebec');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('map-aroostook');
      if ($(block).length) { block.style.display="none";  }

      block = document.getElementById('desc-maine');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('desc-beaches');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('desc-portland');
      if ($(block).length) { block.style.display="none";  }
      block = document.getElementById('desc-midcoast');
      if ($(block).length) { block.style.display="none";  }
      block = document.getElementById('desc-downeast');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('desc-lakes-mounts');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('desc-highlands');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('desc-kennebec');
      if ($(block).length) { block.style.display="none";  }
        block = document.getElementById('desc-aroostook');
      if ($(block).length) { block.style.display="none";  }
    }// end of hide_maps_desc function

});
// a "show more"/reveal rv_button
// 1.  add module with ID of reveal that is initially hidden
// 2. add button with class rv_button
// 3 need css for button
 jQuery(document).ready(function() {
// Hide the div
  jQuery('#reveal').hide();
  jQuery('.rv_button').click(function(e) {
    e.preventDefault();
    jQuery("#reveal").slideToggle();
    jQuery('.rv_button').toggleClass('opened closed');
    });
});
