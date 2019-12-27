<?php
/*
 * Template Name: Cadastrar novo animal
 * description: >-
 */


/**
 * Add required acf_form_head() function to head of page
 * @uses Advanced Custom Fields Pro
 */

if (!is_user_logged_in()) {
	auth_redirect();
}

$postTitleError = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$post_url = "este_eh_o_link";
	$post_title = "Esse eh o titulo do post";
	$author   = "O outor desse negocio";
	$subject  = 'Post publish notification';
	$message  = "Hello,";
	$message .= "<a href='". $post_url. "'>'".$post_title."'</a>\n\n";
	wp_mail("isaquegbmelo2@gmail.com", $subject, $message );

}


acf_form_head();
acf_enqueue_uploader();
get_header();


?>

<div id="primary" class="cadastrar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Cadastrar animal</span>
			</div>

			<?php
				acf_form(array(
					'post_id'		=> 'new_post',
					'post_title'	=> false,
					'post_content'	=> false,
					'uploader' => 'basic',
					'submit_value' => 'Cadastrar animal',
					'updated_message' => 'Animal cadastrado',
					'return' => '%post_url%',
					'instruction_placement' => 'field',
					'new_post'		=> array(
						'post_type'		=> 'animal',
						'post_status'	=> 'publish'
					),

				));

			?>

		</div>

	</div><!-- #primary END -->


<?php get_footer(); ?>
