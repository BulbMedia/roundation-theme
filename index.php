<?php get_header(); ?>

	<main role="main" id="indexphp">
		<!-- section -->
		<section>

			<h1><?php _e( 'Latest Posts', 'roundation' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
