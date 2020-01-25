<?php




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
				wp_redirect(home_url() . "/animal/" . $animal_id);
			} else {
				echo '<script language="javascript">';
				echo 'alert("Animal não encontrado.")';
				echo '</script>';
				$requested = null;
			}

		} else {
			$requested = null;
			echo '<script language="javascript">';
			echo 'alert("Animal não encontrado.")';
			echo '</script>';
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

<div id="primary" class="home-wrapper col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">
			<div class="col-md-5 no-padding">
				<div class="content-title col-md-12 no-padding">
					<span>Início</span>
				</div>

				<div class="buttons col-md-12 no-padding">
				<?php if (wp_get_current_user()->roles[0] == "um_veterinario"): ?>
					<a href="<?php echo home_url() . '/nova-consulta'; ?>" class="nova-consulta col-md-12 text-center">Nova consulta</a>
				<?php else: ?>
					<a href="<?php echo home_url() . '/cadastrar-animal'; ?> " class="novo-animal">Cadastrar novo animal</a>
					<a href="<?php echo home_url() . '/nova-consulta'; ?>" class="nova-consulta">Nova consulta</a>

				<?php endif; ?>
				</div>

				<div class="ir-animal col-md-12 no-padding">
					<form action="" method="post">
						<input type="text" placeholder="Código do animal" name="cod">
						<input type="submit" value="Ir">
						<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
						<input type="hidden" name="submitted" id="submitted" value="true">
					</form>
				</div>


				<div class="col-md-12 animal-section no-padding content-holder">

					<div class="content-title">
						<span>Animais</span>
					</div>

					<div class="list">
						<div class="list-header col-md-12 no-padding">
								<div class="col-md-4 no-padding">Cód.</div>
								<div class="col-md-4 no-padding">Nome</div>
								<div class="col-md-3 no-padding">Plano</div>
						</div>

						<?php
							$temp = $wp_query;
							$wp_query = null;
							$wp_query = new WP_Query();
							$wp_query->query('showposts=10&post_type=animal'.'&paged='.$paged);

						?>


						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
							<div class="list-data col-md-12 no-padding">
									<a href="<?php the_permalink() ?>">
										<div class="col-md-4 no-padding">#<?php echo get_the_ID(); ?></div>
										<div class="col-md-4 no-padding"><?php the_field('nome'); ?></div>
										<div class="col-md-3 no-padding" ><?php the_field('plano'); ?></div>
									</a>
							</div>

						<?php endwhile; ?>

						<?php //odin_paging_nav() ?>



					</div>

				</div>
			</div>


			<div class="col-md-7">
				<div class="col-md-12 consulta-section no-padding content-holder">

					<div class="content-title">
						<span>Últimas consultas</span>
					</div>

					<div class="list">
						<div class="list-header col-md-12 no-padding">
								<div class="col-md-2 no-padding">Cód.</div>
								<div class="col-md-4 no-padding">Data</div>
								<div class="col-md-6 no-padding">Procedimentos</div>
						</div>

						<?php
							$temp = $wp_query;
							$wp_query = null;
							$wp_query = new WP_Query();
							$wp_query->query('showposts=5&post_type=consulta'.'&paged='.$paged);

						?>


						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
							<div class="list-data col-md-12 no-padding">
									<a href="<?php the_permalink() ?>">
										<div class="col-md-2">#<?php echo get_the_ID(); ?></div>
										<div class="col-md-4"><?= get_the_date("d/m/Y", get_the_ID()) ?></div>
										<div class="col-md-6" ><?php the_field('procedimentos'); ?></div>
									</a>
							</div>

						<?php endwhile; ?>

						<?php //odin_paging_nav() ?>



					</div>

				</div>
			</div>







		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
