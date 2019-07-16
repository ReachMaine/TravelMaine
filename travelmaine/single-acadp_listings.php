<?php
/***  template for single listing ***/
/* 10Jun19 - zig - copy page templates & rename for single listing
								 - remove conditionals for $is_page_builder_used */

get_header();

//$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">


	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-content">
					<?php
						the_content();

					?>
					</div> <!-- .entry-content -->


				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>
			<?php get_sidebar(); ?>
			</div> 


		</div> <!-- #content-area -->
	</div> <!-- .container -->



</div> <!-- #main-content -->

<?php

get_footer();
