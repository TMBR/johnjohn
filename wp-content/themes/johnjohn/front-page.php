<?php get_header(); ?>

<?php get_template_part( 'partials/hero' ); ?>

<div class="container-fluid">
  <div class="row">
      <div class="col-sm-3">
        <img src="<?php echo get_template_directory_uri(); ?>/public/images/placeholder.jpg" style="margin-top: 200px;" class="img-responsive" alt="" />
      </div>

      <div class="col-sm-2">
        <?php get_template_part( 'partials/intro' ); ?>
      </div>

      <div class="col-sm-5">
      <?php get_template_part( 'partials/vid-gallery' ); ?>


        <div class="content-card -noimg">

            <h3 class="heading">Billibong Pro Tahiti<br/> Faceoff</h3>
            <div class="content">
            <p class="text">The Billabong Pro was crazy. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tempus tincidunt enim, in mattis orci viverra ac. Ut eleifend egestas tincidunt. Etiam bibendum suscipit augue. Vestibulum malesuada leo id commodo feugiat. Praesent at egestas enim. Ut eleifend egestas tincidunt. Nulla tempus tincidunt enim, in mattis orci viverra ac. Ut eleifend egestas tincidunt. Praesent at egestas enim. Etiam bibendum suscipit augue. </p>
            <a href="" class="link">Read More</a>
            </div>
      </div>
    </div>
    </div>

	<div class="container">

		<div class="row">

				<div class="col-sm-12">
<div style="background: gray; height: 1000px; width: 100%; margin-top: 200px;">




</div>

				</div><!-- /col -->



			<?php get_sidebar(); ?>

		</div><!-- /row -->
	</div><!-- /container -->


<?php get_footer();
