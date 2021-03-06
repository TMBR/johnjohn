
</main>
<!-- #page-main -->
</div>

<footer class="site-footer">
  <div class="img-bg" style="background-image: url('<?php echo get_template_directory_uri(); ?>/public/images/footer.jpg');"></div>
	<img src="<?php echo get_template_directory_uri(); ?>/public/images/footer.jpg" class="img-responsive animation" data-animation="animation-fade-in-down" alt="" />
	<div class="footer-content" >
  <div class="animation" data-animation="animation-fade-in-down">
		<div class="footer-logo">
			<div class="logo-wrapper -light">
   			<?php get_template_part( 'partials/global/logo' ); ?>
   		</div><!-- /logo-wrapper -->
   	</div><!-- /footer-logo -->

		<p class="text">Copyright &copy;<br class="hidden-sm hidden-xs"/> Elegant Seagulls, Inc.<br/> All Rights Reserved<br/> I'm Jack Dusty.</p>


		<a href="mailto:info@johnjohn.com" class="link">info@johnjohn.com</a>
		<a href="" class="top-wrap">
		<span class="top"></span>
		</a>
   </div>
	</div><!-- /footer-content -->
  <div class="sec-trigger" data-section="pg-footer"></div>
</footer><!-- site-footer -->

</div><!-- .body -->

<?php wp_footer(); ?>

</body>
</html>