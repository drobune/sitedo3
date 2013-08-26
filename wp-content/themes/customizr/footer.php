<?php
 /**
 * The template for displaying the footer.
 *
 *
 * @package Customizr
 * @since Customizr 3.0
 */
?>
		 </div><!--/#main-wrapper"-->

		 <!-- FOOTER -->
		<footer id="footer">

		 	<?php
				do_action( '__sidebar' , 'footer' );

		 		do_action( '__footer' );//display template, you can hook here
		 	?>
		 </footer>
		 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43490940-1', 'sitedo3.net');
  ga('send', 'pageview');

</script>

		<?php wp_footer(); ?>

	</body>

</html>