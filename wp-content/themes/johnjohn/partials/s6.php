<div class="container-fluid">
  <div class="row">

    <div class="col-xs-4 col-xs-offset-1">
      <div class="speed-wrap -absolute ss-ease" data-scroll-speed="9">
        <?php get_template_part( 'partials/s6/rotator' ); ?>
      </div><!-- /scroll-speed -->
    </div><!-- /col -->

    <div class="col-xs-5 col-xs-offset-1">
      <?php get_template_part( 'partials/s6/content-card' ); ?>

      <div class="vert-caption -right _pull-left animation" data-animation="animation-fade-in-down">
        <p class="caption">Get Some</p>
        <a href="https://www.youtube.com/watch?v=OnqnCoPLdyw" class="vid-wrap -center js-popupvideo" >
          <button class="play-button"></button>
          <img src="<?php echo get_template_directory_uri(); ?>/public/images/image5.jpg" alt="" class="img-responsive" />
        </a>
      </div><!-- /vert-caption -->

    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container -->