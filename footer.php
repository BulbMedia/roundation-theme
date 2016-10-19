			<footer class="footer" role="contentinfo">
					<div class="footer-wrapper container-fluid">
						<div class="row">
							<div class="col col-md-3 footerColumn" id="footerColumn1">

								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) ?>

							</div>
							<div class="col col-md-3 footerColumn" id="footerColumn2">

								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') )  ?>

							</div>
							<div class="col col-md-3 footerColumn" id="footerColumn3">

								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') )  ?>

							</div>
							<div class="col col-md-3 footerColumn" id="footerColumn4">

								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer4') )  ?>

							</div>
						</div>
					</div>

				<p class="copyright">
					&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
				</p>

			</footer>

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>-->

	</body>
</html>
