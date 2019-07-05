<?php

/**
 * This template displays the listing detail page content.
 */
?>

<div class="acadp acadp-listing">

	<div class="row">
        <!-- Main content -->
				<!-- Title & subtitle -->
				<div class="col-md-12">
					<div class="acadp-post-title">
							<h1 class="acadp-no-margin"><?php echo $post->post_title; ?></h1>
							<?php
								//echo "<pre>"; var_dump($post_meta); echo "</pre>";
								 $custom_field = "216";// custom field subtitle, id=216
								if (array_key_exists($custom_field,$post_meta) ) {
									echo '<div class="acadp-listing-subtitle">' ;
									echo $post_meta[$custom_field][0];
									echo "</div>";
								}
							?>
							<?php the_acadp_listing_labels( $post_meta );
									$usermeta = array();

									if( $can_show_date ) {
											$usermeta[] = sprintf( __( 'Posted %s ago', 'advanced-classifieds-and-directory-pro' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
									}

									if( $can_show_user ) {
											$usermeta[] = '<a href="'.acadp_get_user_page_link( $post->post_author ).'">'.get_the_author().'</a>';
									}
						?>
						<?php if( $can_show_category ) {
								echo sprintf( rmm_get_category_icon( $post->ID).'&nbsp;<a href="%s">%s</a>', acadp_get_category_page_link( $category ), $category->name );
						} ?>
					</div> <!-- end post title -->
				</div>

        <div class="<?php echo $can_show_images ? 'col-md-4' : 'col-md-8'; ?>">


							<!-- post-meta -->
							<div class="acadp-post-meta"> <?php
                    $meta = array();

                    /* if( $can_show_category ) {
												$meta[] = sprintf( rmm_get_category_icon( $post->ID).'&nbsp;<a href="%s">%s</a>', acadp_get_category_page_link( $category ), $category->name );
                    } */

                    if( count( $usermeta ) ) {
                        $meta[] = implode( ' '.__( 'by', 'advanced-classifieds-and-directory-pro' ).' ', $usermeta );
                    }

                    if( $can_show_views ) {
                        $meta[] = sprintf( __( "%d views", 'advanced-classifieds-and-directory-pro' ), $post_meta['views'][0] );
                    }

                    if( count( $meta ) ) {
                        echo '<p><small class="text-muted">'.implode( ' / ', $meta ).'</small></p>';
                    }

										if( $can_show_category_desc ) {
											echo '<p><small class="text-muted">'.$category->description.'</small></p>';
										}

                ?>
            </div> <!-- post meta -->

						<?php /* <!-- Address --> */
						 if( $has_location ) {
							 echo '<div class="acadp-post-location">';
								the_acadp_address( $post_meta, $location->term_id );
								echo '</div>';
						 } ?>

            <!-- Price -->
            <?php if( $can_show_price ) : ?>
                <div class="pull-right text-right acadp-price-block">
                    <?php
                        $price = acadp_format_amount( $post_meta['price'][0] );
                        echo '<p class="lead acadp-no-margin">'.acadp_currency_filter( $price ).'</p>';
                    ?>
                </div>
            <?php endif; ?>
					</div> <!-- end col 9/12 -->
					<?php if( $can_show_images ) { ?>
						<div class="col-md-4"> <?php
								$images = unserialize( $post_meta['images'][0] );
								$image_attributes = wp_get_attachment_image_src( $images[0], 'large' ); ?>
								<div class="acadp-logo-image"><img src="<?php echo $image_attributes[0]; ?>" /></div>
						</div>
					<?php } /* end images */ ?>
					<!-- map -->
					<div class="col-md-4">
						<?php if( $can_show_map && ($post_meta['address'][0] != "") ) :
									 //echo '<p> lat is:{'.$post_meta['latitude'][0].'} and lon is: {'.$post_meta['longitude'][0].'}</p>';
									 //echo '<p>address is:{'.$post_meta['address'][0].'}</p>';
									 //echo '<pre>';var_dump($post_meta['address'][0]); echo '</pre>';
									 ?>
									<div class="embed-responsive embed-responsive-16by9 acadp-margin-bottom">
											<div class="acadp-map embed-responsive-item">
													<div class="marker" data-latitude="<?php echo $post_meta['latitude'][0]; ?>" data-longitude="<?php echo $post_meta['longitude'][0]; ?>"></div>
											</div>
									</div>
									<div class="acadp-mapdir">
											<?php
											$gmap_addstr  = preg_replace('/\s/', '+', $post_meta["address"][0]);
											$gmap_link = "https://www.google.com/maps/dir//".$gmap_addstr;
											?>
											<a href="<?php echo $gmap_link;?>" target="blank">
												Get Directions
												<img src="<?php echo get_stylesheet_directory_uri();?>/images/directions.png">
											</a>
									</div>
							<?php endif; ?>
					</div>
          <div class="clearfix"></div>


            <!-- Description -->
						<div class="col-md-12">
							<div class="acadp-desc">
		            <?php echo $description; ?>
							</div>
						</div>

            <!-- Custom fields -->
            <?php if( count( $fields )  && false ) : ?>
                <ul class="list-group acadp-margin-bottom">
									<?php /* echo "<pre>";  var_dump($fields); echo "</pre>";  */ ?>
                    <?php foreach( $fields as $field )  :
											echo "field -> ID is: ".$field->ID."~"; ?>
                        <?php if ( ! empty( $post_meta[ $field->ID ][0] )  ) :  ?>
                            <li class="list-group-item acadp-no-margin-left acadp-field-<?php echo $field->type; ?>">
                                <span class="text-primary"><?php echo $field->post_title; ?></span> :
                                <span class="text-muted">
                                    <?php echo acadp_get_custom_field_display_text( $post_meta[ $field->ID ][0], $field ); ?>
                                </span>
                            </li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- Footer -->
            <?php if( $can_show_user || $can_add_favourites || $can_report_abuse ) : ?>
                <ol class="breadcrumb">
                    <?php if( $can_show_user ) : ?>
                        <li class="acadp-no-margin">
                            <a href="<?php echo acadp_get_user_page_link( $post->post_author ); ?>"><?php _e( 'Check all listings by this user', 'advanced-classifieds-and-directory-pro' ); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if( $can_add_favourites ) : ?>
                        <li id="acadp-favourites" class="acadp-no-margin"><?php the_acadp_favourites_link(); ?></li>
                    <?php endif; ?>

                    <?php if( $can_report_abuse ) : ?>
                        <li class="acadp-no-margin">
                            <?php if( is_user_logged_in() ) { ?>
                                <a href="#" data-toggle="modal" data-target="#acadp-report-abuse-modal"><?php _e( 'Report abuse', 'advanced-classifieds-and-directory-pro' ); ?></a>

                                <!-- Modal (report abuse form) -->
                                <div class="modal fade" id="acadp-report-abuse-modal" tabindex="-1" role="dialog" aria-labelledby="acadp-report-abuse-modal-label">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form id="acadp-report-abuse-form" class="form-vertical" role="form">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    <h3 class="modal-title" id="acadp-report-abuse-modal-label"><?php _e( 'Report Abuse', 'advanced-classifieds-and-directory-pro' ); ?></h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="acadp-report-abuse-message"><?php _e( 'Your Complaint', 'advanced-classifieds-and-directory-pro' ); ?><span class="acadp-star">*</span></label>
                                                        <textarea class="form-control" id="acadp-report-abuse-message" rows="3" placeholder="<?php _e( 'Message', 'advanced-classifieds-and-directory-pro' ); ?>..." required></textarea>
                                                    </div>
                                                    <div id="acadp-report-abuse-g-recaptcha"></div>
                                                    <div id="acadp-report-abuse-message-display"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e( 'Close', 'advanced-classifieds-and-directory-pro' ); ?></button>
                                                    <button type="submit" class="btn btn-primary"><?php _e( 'Submit', 'advanced-classifieds-and-directory-pro' ); ?></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <a href="#" class="acadp-require-login"><?php _e( 'Report abuse', 'advanced-classifieds-and-directory-pro' ); ?></a>
                            <?php } ?>
                        </li>
                    <?php endif; ?>
                </ol>
            <?php endif; ?>
        </div>

    </div>

	<input type="hidden" id="acadp-post-id" value="<?php echo $post->ID; ?>" />
</div>

<?php the_acadp_social_sharing_buttons(); ?>
