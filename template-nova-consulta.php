<?php
/*
 * Template Name: Nova consulta
 * description: >-
 */



if (!is_user_logged_in()){
	auth_redirect();
}

get_header();


?>

<div id="primary" class="listar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Nova consulta</span>
			</div>

			<div class="list">


			</div>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
