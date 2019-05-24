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

	<div class="acadp-divider"></div>

	<!-- the loop -->
    <div class="acadp-body">
		<?php
            $columns = $listings_settings['columns'];
            $span = 'col-md-' . floor( 12 / $columns );
            $i = 0;

        	while( $acadp_query->have_posts() ) : $acadp_query->the_post(); $post_meta = get_post_meta( $post->ID ); ?>

            <?php if( $i % $columns == 0 ) : ?>
                <div class="row">
            <?php endif; ?>

                <div class="<?php echo $span; ?>">
                    <div <?php the_acadp_listing_entry_class( $post_meta, 'thumbnail' ); ?>>
											<div class="acadp-listings-title-block">
													<h3 class="acadp-no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

													<?php
														//echo "<pre>"; var_dump($post_meta); echo "</pre>";
														 $custom_field = "216";// custom field subtitle, id=216
														if (array_key_exists($custom_field,$post_meta) ) {
															echo '<div class="acadp-listing-subtitle">' ;
															echo $post_meta[$custom_field][0];
															echo "</div>";
														}
													?>
													<?php the_acadp_listing_labels( $post_meta ); ?>
											</div>
											<div class="acadp-listing-image">
                        <?php
													$hasthumb = "";
													if ( $can_show_images  &&  (isset( $post_meta['images'])) ) {
														$hasthumb = "hasthumb"; ?>
                            <a href="<?php the_permalink(); ?>" class="acadp-responsive-containerX"><?php the_acadp_listing_thumbnail( $post_meta ); ?></a>
                        <?php } ?>
											</div>
											<?php /* contact info - address, phone website */
												$contact_info = "";

												if (array_key_exists("address",$post_meta) ) {
													if ($post_meta["address"][0]) {
														$contact_info .= '<div class="acadp-listing-addr">'.$post_meta["address"][0].'</div>';
													}
												}
												if (array_key_exists("phone",$post_meta) ) {
												 if ($post_meta["phone"][0]){
													  $contact_info .= '<span class="glyphicon glyphicon-earphone"></span>';
														$contact_info .= '<div class="acadp-listing-phone">'.$post_meta["phone"][0].'</div>';
													}
													/*	if( ! empty( $post_meta['phone'][0] ) ) {
														echo '<span class="acadp-phone">';
														echo '<span class="glyphicon glyphicon glyphicon-earphone"></span>&nbsp;';
														echo '<span><a class="acadp-show-phone-number" href="javascript: void(0);">'.__( ' Show Phone Number', 'advanced-classifieds-and-directory-pro' ).'</a></span>';
														echo '<span class="acadp-phone-number" style="display: none;">'.$post_meta['phone'][0].'</span>';
														echo '</span>';
													}*/
												}
												if (array_key_exists("website",$post_meta) ) {
													if ($post_meta["website"][0]) {
														$contact_info .= '<div class="acadp-listing-url">'.$post_meta["website"][0].'</div>';
													}
												}
												echo '<div class="acadp-listing-contactinfo small '.$hasthumb.'">';
												echo $contact_info;
												echo '</div>';
											?>
                        <div class="caption acadp-listing-catline">
                            <?php
																/* bottom line with category & location */
                                $info = array();

                                if( $can_show_category && $category = wp_get_object_terms( $post->ID, 'acadp_categories' ) ) {
                                    $info[] = '<span class="glyphicon glyphicon-briefcase"></span>&nbsp;<a href="'.acadp_get_category_page_link( $category[0] ).'">'.$category[0]->name.'</a>';
                                }

                                if( $can_show_location && $location = wp_get_object_terms( $post->ID, 'acadp_locations' ) ) {
                                    $info[] = '<span class="glyphicon glyphicon-map-marker"></span>&nbsp;<a href="'.acadp_get_location_page_link( $location[0] ).'">'.$location[0]->name.'</a>';
                                }

                                if( 'acadp_favourite_listings' == $shortcode ) {
                                    $info[] = '<a href="'.acadp_get_remove_favourites_page_link( $post->ID ).'">'.__( 'Remove from favourites', 'advanced-classifieds-and-directory-pro' ).'</a>';
                                }

                                if( $can_show_views && ! empty( $post_meta['views'][0] ) ) {
                                    $info[] = sprintf( __( "%d views", 'advanced-classifieds-and-directory-pro' ), $post_meta['views'][0] );
                                }

                                echo '<p class="acadp-no-margin"><small>'.implode( ' / ', $info ).'</small></p>';

                                if( $can_show_price && isset( $post_meta['price'] ) && $post_meta['price'][0] > 0 ) {
                                    $price = acadp_format_amount( $post_meta['price'][0] );
                                    echo '<p class="lead acadp-listings-price">'.acadp_currency_filter( $price ).'</p>';
                                }
                            ?>

                            <?php do_action( 'acadp_after_listing_content', $post->ID, 'grid' ); ?>
                        </div>
                    </div>
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
