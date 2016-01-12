<div class="hero-overlap">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-sm-offset-1">
        <img src="<?php echo get_template_directory_uri(); ?>/public/images/placeholder.jpg" style="margin-top: 200px;" class="img-responsive" alt="" />
      </div>

      <div class="col-sm-2">
        <?php get_template_part( 'partials/s2/-overlap-content-card' ); ?>
      </div>

      <div class="col-sm-5">

        <?php get_template_part( 'partials/s2/vid-gallery' ); ?>
        <?php get_template_part( 'partials/s2/content-card' ); ?>

      </div><!-- .col -->

    </div><!-- .row -->
  </div><!-- .container -->
</div><!-- .hero-overlap -->