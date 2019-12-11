<?php
/*
 * Template Name: Listar Animais
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

<div id="primary" class="listar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Animais</span>
			</div>

			<div class="list">
				<div class="list-header col-md-12">
						<div class="col-md-1">Cód.</div>
						<div class="col-md-3">Nome</div>
						<div class="col-md-6">Nome do dono</div>
						<div class="col-md-1">Plano</div>
				</div>

				<?php
				$temp = $wp_query;
			  $wp_query = null;
			  $wp_query = new WP_Query();
			  $wp_query->query('showposts=20&post_type=animal'.'&paged='.$paged);

				?>


				<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<div class="list-data col-md-12">
							<a href="<?php the_permalink() ?>">
								<div class="col-md-1">#<?php echo get_the_ID(); ?></div>
								<div class="col-md-3"><?php the_field('nome'); ?></div>
								<div class="col-md-6"><?php the_field('nome_do_dono'); ?></div>
								<div class="col-md-1"><?php the_field('plano'); ?></div>
							</a>
					</div>

				<?php endwhile; ?>

				<?php odin_paging_nav() ?>



			</div>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
