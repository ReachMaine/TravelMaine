<?php

/**
 * This template displays the ACADP listings in grid view.
 */
?>

<div class="acadp acadp-listings acadp-grid-view">
	<?php if( $can_show_header ) : ?>
		<!-- header here -->
        <?php if( ! empty( $pre_content ) ) echo '<p>'.$pre_content.'</p>'; ?>

    	<div class="row acadp-no-margin">
        	<?php if( $can_show_listings_count ) : ?>
    			<!-- total items count -->
    			<div class="pull-left text-muted">
    				<?php
						$count = ( is_front_page() && is_home() ) ? $acadp_query->post_count : $acadp_query->found_posts;
						printf( __( "%d item(s) found", 'advanced-classifieds-and-directory-pro' ), $count );
					?>
				</div>
            <?php endif; ?>

    		<div class="btn-toolbar pull-right" role="toolbar">
            	<?php if( $can_show_views_selector ) : ?>
      				<!-- Views dropdown -->
      				<div class="btn-group" role="group">
                    	<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<?php _e( "View as", 'advanced-classifieds-and-directory-pro' ); ?> <span class="caret"></span>
  						</button>
                        <ul class="dropdown-menu">
                        	<?php
								$views = acadp_get_listings_view_options();

								foreach( $views as $value => $label ) {
									$active_class = ( 'grid' == $value ) ? ' active' : '';
									printf( '<li class="acadp-no-margin%s"><a href="%s">%s</a></li>', $active_class, add_query_arg( 'view', $value ), $label );
								}
							?>
                        </ul>
       				</div>
                <?php endif; ?>

        		<?php if( $can_show_orderby_dropdown ) : ?>
       				<!-- Orderby dropdown -->
       				<div class="btn-group" role="group">
  						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<?php _e( "Sort by", 'advanced-classifieds-and-directory-pro' ); ?> <span class="caret"></span>
  						</button>
  						<ul class="dropdown-menu">
            				<?php
								$options = acadp_get_listings_orderby_options();

								foreach( $options as $value => $label ) {
									$active_class = ( $value == $current_order ) ? ' active' : '';
									printf( '<li class="acadp-no-margin%s"><a href="%s">%s</a></li>', $active_class, add_query_arg( 'sort', $value ), $label );
								}
							?>
  						</ul>
					</div>
                <?php endif; ?>
    		</div>
		</div>
    <?php endif; ?>

	<!--div class="acadp-divider"></div-->

	<!-- the loop -->
    <div class="acadp-body">
		<?php
            $columns = $listings_settings['columns'];
            $span = 'col-md-' . floor( 12 / $columns )." col-sm-6";
            $i = 0;

        	while( $acadp_query->have_posts() ) : $acadp_query->the_post(); $post_meta = get_post_meta( $post->ID ); ?>

            <?php if( $i % $columns == 0 ) : ?>
                <div class="row row-eq-height">
            <?php endif; ?>

                <div class="<?php echo $span; ?>">
                    <div <?php the_acadp_listing_entry_class( $post_meta, 'thumbnail' ); ?>>

											<div class="acadp-listings-title-block">


													<h4 class="acadp-no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

													<?php
														//echo "<pre>"; var_dump($post_meta); echo "</pre>";
														 $custom_field = "216";// custom field subtitle, id=216
														if (array_key_exists($custom_field,$post_meta) ) {
															if ($post_meta[$custom_field][0] != '') {
																echo '<div class="acadp-listing-subtitle">' ;
																echo $post_meta[$custom_field][0];
																echo "</div>";
															}
														}
													?>
													<?php the_acadp_listing_labels( $post_meta ); ?>
											</div><!-- title block -->
											<div class="acadp-listing-desc-wrap">
												<div class="acadp-listing-image">
													<?php
														$hasthumb = "";
														if ( $can_show_images  &&  (isset( $post_meta['images'])) ) {
															$hasthumb = "hasthumb"; ?>
															<a href="<?php the_permalink(); ?>" class="acadp-responsive-containerX"><?php the_acadp_listing_thumbnail( $post_meta ); ?></a>

													<?php }  else {
														//echo '<div class="acadp-responsive-container"></div>';
													}?>
												</div>



											<?php /* contact info - address, phone website */
												$contact_info = "";

												if (array_key_exists("address",$post_meta) ) {
													if ($post_meta["address"][0]) {
														$gmap_link = preg_replace('/\s/', '+', $post_meta["address"][0]);
														$gmap_link = "https://www.google.com/maps/place/".$gmap_link;
														$contact_info .= '<div class="acadp-listing-addr">';
														$contact_info .= $post_meta["address"][0];
														$contact_info .= '<a target="_blank" href="'.$gmap_link.'"> <i class="fas fa-directions"></i></a>';
														$contact_info .= '</div>';

														//$contact_info .= '<div class="acadp-mapit">';
														//$contact_info .= ' <a target="_blank" href="'.$gmap_link.'"><img src="'.get_stylesheet_directory_uri().'/images/directions.png" ></a>';
														//$contact_info .= '</div>';
													}
												}
												if (array_key_exists("phone",$post_meta) ) {
												 if ($post_meta["phone"][0]){
													 	$contact_info .= '<div class="acadp-listing-phone">';

													  //$contact_info .= '<span class="glyphicon glyphicon-earphone"></span>';
														$contact_info .= format_phone($post_meta["phone"][0]);
														//$contact_info .= '<a target="_blank" href="tel:'.$post_meta["phone"][0].'"> <i class="fas fa-phone-alt"></i></a>';
														$contact_info .= ' <a target="_blank" href="tel:'.$post_meta["phone"][0].'"><i class="fas fa-mobile-alt"></i></a>';
														$contact_info .= '</div>';
													}
												}
												if (array_key_exists("website",$post_meta) ) {
													if ($post_meta["website"][0]) {
														//$contact_info .= '<div class="acadp-listing-url">'.$post_meta["website"][0].'</div>';
														$contact_info .= '<div class="acadp-listing-url">';
													  //$contact_info .= '<span class="glyphicon glyphicon-globe"></span>';
														//$contact_info .= '<i class="fas fa-external-link-alt"></i>';
														$contact_info .= '<a target="_blank" href="'.$post_meta["website"][0].'">website <i class="fas fa-external-link-alt"></i></a>';
														$contact_info .= '</div>';
													}
												}
												echo '<div class="acadp-listing-contactinfo smallX '.$hasthumb.'">';
												echo $contact_info;
												$custom_field = "29";// custom field pet-friendly, id=29
												if (array_key_exists($custom_field,$post_meta) ) {
													if ($post_meta[$custom_field][0] == 'yes') {
														echo '<div class="acadp-listing-pets small">' ;
														echo '<i class="fa fa-paw"></i> Pet Friendly';
														echo "</div>";
													}
												}
												echo '</div>';
											?>

											</div> <!-- desc-wrap -->

											<div class=" acadp-listing-catline">
													<?php
														$cat_glyph = '<span class="glyphicon glyphicon-briefcase"></span>';
														$cat_glyph = rmm_get_category_icon( $post->ID);

															/*  line with category & location */
															$info = array();
															if( $can_show_category && $category = wp_get_object_terms( $post->ID, 'acadp_categories' ) ) {
																	//$info[] = $cat_glyph.'&nbsp;<a href="'.acadp_get_category_page_link( $category[0] ).'">'.$category[0]->name.'</a>';
																	$info[] = $cat_glyph.'&nbsp;'.$category[0]->name;
															}
															if( $can_show_location && $location = wp_get_object_terms( $post->ID, 'acadp_locations' ) ) {
																	//$info[] = '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;<a href="'.acadp_get_location_page_link( $location[0] ).'">'.$location[0]->name.'</a>';
																	//$info[] = '<a href="'.acadp_get_location_page_link( $location[0] ).'">'.$location[0]->name.'</a>';
																	$info[] = $location[0]->name;
															}
															echo '<p class="acadp-no-margin"><small>'.implode( ' / ', $info ).'</small></p>';
													?>
											</div><!-- catline -->
											<?php do_action( 'acadp_after_listing_content', $post->ID, 'grid' ); ?>
                    </div> <!-- thumbnail -->
                </div>

            <?php
                $i++;
                if( $i % $columns == 0 || $i == $acadp_query->post_count ) : ?>
                    </div>
            <?php endif; ?>

        <?php endwhile; ?>
    </div>
    <!-- end of the loop -->

    <!-- Use reset postdata to restore orginal query -->
    <?php wp_reset_postdata(); ?>

    <!-- pagination here -->
    <?php if( $can_show_pagination ) the_acadp_pagination( $acadp_query->max_num_pages, "", $paged ); ?>
</div>

<?php the_acadp_social_sharing_buttons(); ?>
