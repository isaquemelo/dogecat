<?php
/*
 * Template Name: Listar Veterinarios
 * description: >-
 */



acf_form_head();

if (!is_user_logged_in()){
	auth_redirect();
}

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
						<div class="col-md-6">Nome</div>
						<div class="col-md-3">Clinica</div>
						<div class="col-md-1">Celular</div>
				</div>

				<?php
					$vets = get_users( 'role=um_veterinario' );
					// Array of WP_User objects.
					foreach ( $vets as $user ):


				?>


					<div class="list-data col-md-12">
							<a href="<?php echo get_author_posts_url($user->ID) . '?id=' . $user->ID; ?>">
								<div class="col-md-1">#<?php echo $user->ID; ?></div>
								<div class="col-md-6"><?php echo get_user_meta($user->ID, 'nome_completo', true); ?></div>
								<div class="col-md-3"><?php echo get_user_meta($user->ID, 'clinica', true); ?></div>
								<div class="col-md-1"><?php echo get_user_meta($user->ID, 'celular', true);; ?></div>
							</a>
					</div>

				<?php endforeach; ?>

				<?php odin_paging_nav() ?>



			</div>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
