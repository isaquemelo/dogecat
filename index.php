<?php



if (!is_user_logged_in()) {
	auth_redirect();
}


get_header();

?>

<div id="primary" class="home-wrapper col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Início</span>
			</div>



		</div>

	</div><!-- #primary END -->


<?php get_footer(); ?>
