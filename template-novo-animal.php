<?php
/*
 * Template Name: Cadastrar novo animal
 * description: >-
 */


/**
 * Add required acf_form_head() function to head of page
 * @uses Advanced Custom Fields Pro
 */

$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}


	$post_information = array(
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => esc_attr(strip_tags($_POST['postContent'])),
		'post_type' => 'animal',
		'post_status' => 'publised'
	);

	if (is_user_logged_in()){
		$post_id = wp_insert_post($post_information);
		echo $post_id;
	} else {
		auth_redirect();
	}
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
					'new_post'		=> array(
						'post_type'		=> 'animal',
						'post_status'	=> 'publish'
					),

				));

			?>

		</div>

	</div><!-- #primary END -->


<?php get_footer(); ?>
