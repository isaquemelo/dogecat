<?php
/*
 * Template Name: Editar Animal
 */
/**
 * Add required acf_form_head() function to head of page
 * @uses Advanced Custom Fields Pro
 */

acf_form_head();
get_header();



?>

<?php



if (!is_user_logged_in()){
	auth_redirect();
}

if ( isset( $_GET['animal'] ) ) {

    if ( $_GET['animal'] == $post->ID )
    {
        $current_post = $post->ID;
    }
}


?>

<div id="primary" class="cadastrar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Editar animal</span>
			</div>


			<?php
				acf_form(array(
					'post_id'		=> $current_post,
					'post_title'	=> false,
					'post_content'	=> false,
					'return' => '%post_url%',
					'new_post'		=> array(
						'post_type'		=> 'animal',
						'post_status'	=> 'publish'
					),
					'uploader' => 'basic',
				));

			?>

		</div>

	</div><!-- #primary END -->


<?php get_footer(); ?>

