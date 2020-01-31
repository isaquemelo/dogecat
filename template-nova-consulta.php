<?php
/*
 * Template Name: Nova consulta
 * description: >-
 */



if (!is_user_logged_in()){
	auth_redirect();
}

$requested = false;

function a_post_exists($id) {
	return is_string( get_post_status( $id ) );
}


$plans = [
	'Plano Pet Premium' => 1,
	'Plano Pet Plus' => 2,
	'Plano Pet Light' => 3,
];

$consulta_types = [
	"Consultas urgência - emergência" => 1,
	"Consulta clinico geral" => 2,
	"Consulta especialista" => 3,
	"Atendimento domiciliar" => 4,
];


// consulta_id => time_to_use
$consulta_time_to_allow = [
	1 => 30,
	2 => 30,
	3 => 60,
	4 => 60,
];

// plan_id => [...consulta_types_allowed]
$plan_allow = [
	1 => [1, 2, 3, 4],
	2 => [1, 2, 4],
	3 => [2]
];





if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
		$animal_id = $_POST['cod'];
		if (a_post_exists($animal_id)) {
			$post_type = get_post_type($animal_id);
			if (strcmp($post_type, "animal") == 0) {
				$post = get_post($animal_id);
				$requested = true;
				wp_redirect(home_url() . "/animal/" . $animal_id);

			} else {
				$requested = null;
			}

		} else {
			$requested = null;
		}
	}
}


acf_form_head();
get_header();


?>

<div id="primary" class="listar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">
			<?php if ($requested == false): ?>
			<div class="content-title">
				<span>Nova consulta</span>
			</div>

			<div class="list">
				<form action="" method="post">
					<input type="text" placeholder="Código do animal" name="cod">
					<input type="submit" value="Ir">
					<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
					<input type="hidden" name="submitted" id="submitted" value="true">
				</form>

			</div>

			<?php elseif ($requested == null): ?>
				<h3> Animal não cadastrado. </h3>

			<?php endif;?>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
