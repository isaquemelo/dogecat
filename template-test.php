<?php
/*
 * Template Name: Teste
 * description: >-
 */


/**
 * Add required acf_form_head() function to head of page
 * @uses Advanced Custom Fields Pro
 */
if ( !is_user_logged_in() ) {
	    auth_redirect();
	}
acf_form_head();
get_header(); ?>

<div id="content">

	<?php


	acf_form(array(
		'post_id'		=> 'new_post',
		'post_title'	=> true,
		'post_content'	=> true,
		'new_post'		=> array(
			'post_type'		=> 'animal',
			'post_status'	=> 'publish'
		)
	));

	?>

</div>

<?php
get_footer();
?>
