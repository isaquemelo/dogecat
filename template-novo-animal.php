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
get_header();


?>

<div id="primary" class="cadastrar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Cadastrar animal</span>
			</div>

			<!-- <form action="" id="primaryPostForm" method="POST">

				<fieldset>

					<label for="postTitle"><?php _e('Post\'s Title:', 'framework') ?></label>

					<input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" />

				</fieldset>

				<?php if($postTitleError != '') { ?>
					<span class="error"><?php echo $postTitleError; ?></span>
					<div class="clearfix"></div>
				<?php } ?>

				<fieldset>

					<label for="postContent"><?php _e('Post\'s Content:', 'framework') ?></label>

					<textarea name="postContent" id="postContent" rows="8" cols="30"><?php if(isset($_POST['postContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['postContent']); } else { echo $_POST['postContent']; } } ?></textarea>

				</fieldset>

				<fieldset>

					<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

					<input type="hidden" name="submitted" id="submitted" value="true" />
					<button type="submit"><?php _e('Add Post', 'framework') ?></button>

				</fieldset>

			</form> -->

			<?php
				acf_form(array(
					'post_id'		=> 'new_post',
					'post_title'	=> false,
					'post_content'	=> false,
					'new_post'		=> array(
						'post_type'		=> 'animal',
						'post_status'	=> 'publish'
					)
				));

			?>

		</div>

	</div><!-- #primary END -->


<?php get_footer(); ?>
