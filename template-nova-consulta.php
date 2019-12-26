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


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
		$animal_id = $_POST['cod'];
		if (a_post_exists($animal_id)) {
			$post_type = get_post_type($animal_id);
			if (strcmp($post_type, "animal") == 0) {
				$post = get_post($animal_id);
				$requested = true;
			} else {
				$requested = null;
			}

		} else {
			$requested = null;
		}
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['nova_consulta']) {
	MB_Relationships_API::add( $_GET['animal_id'], $_GET['consulta_id'], 'animal_to_consulta' );
	wp_redirect(home_url() . "/animal/" . $_GET['animal_id']);
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
			<?php elseif ($requested == true): ?>
				<div class="dados-container">
					<div class="animal-nome">
					Nome:
					<span class="bold-font"><?php the_field('nome'); ?></span>
					</div>

					<div class="animal-raca">
					Raça:
					<span class="bold-font"><?php the_field('raca'); ?></span>
					</div>

					<div class="animal-sexo">
					Sexo animal:
					<span class="bold-font"><?php the_field('sexo_animal'); ?></span>
					</div>

					<div class="animal-vacinas">
					Vacinas:
					<span class="bold-font"><?php the_field('vacinas'); ?></span>
					</div>

					<div class="animal-plano">
					Plano:
					<span class="bold-font"><?php the_field('plano'); ?></span>
					</div>


					<div class="animal-dono">
					Nome do dono:
					<span class="bold-font"><?php the_field('nome_do_dono'); ?></span>
					</div>

					<div class="animal-cpf">
					CPF:
					<span class="bold-font"><?php the_field('cpf_dono'); ?></span>
					</div>

					<div class="animal-end">
					<?php
					$end = array('rua' => get_field('rua'),
									'cidade' => get_field('cidade'),
									'estado' => get_field('estado')
					);

									$end_concat = "{$end['rua']}". ", ". "{$end['cidade']} - {$end['estado']}"

					?>
					Endereço:
					<span class="bold-font"><?php echo "{$end['rua']}". ", ". "{$end['cidade']} - {$end['estado']}"; ?></span>
					</div>

					<div class="animal-telefone">
					Telefone: <span class="bold-font"><?php the_field('telefone'); ?></span>
					</div>

					<div class="animal-celular">
					Celular: <span class="bold-font"><?php the_field('celular'); ?></span>
					</div>

				</div>
		   <?php
				acf_form(array(
						'post_id'		=> 'new_post',
						'post_title'	=> false,
						'post_content'	=> false,
						'new_post'		=> array(
							'post_type'		=> 'consulta',
							'post_status'	=> 'publish',

						),
						'submit_value'  => __('Salvar consulta'),
						'return' => '?nova_consulta=true&consulta_id=%post_id%&animal_id=' . $animal_id,
					));


			endif;?>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
