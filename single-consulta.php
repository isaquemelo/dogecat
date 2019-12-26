<?php

if (!is_user_logged_in()){
	auth_redirect();
}

get_header();



?>


<div id="primary" class="single-consulta-holder col-md-12">
	<?php get_sidebar(); ?>
	<div class="col-md-9 content-holder">
		<div class="animal-header">
			<div class="content-title col-md-10 no-padding">
				<span class="consulta-id">Consulta #<?php echo get_the_ID(); ?></span>
			</div>


			<div class="actions col-md-2">

				<?php if( !(get_post_status() == 'trash') ) : ?>

					<a onclick="return confirm('Tem certeza que deseja excluir essa consulta?')" href="<?php echo get_delete_post_link( get_the_ID() ); ?>">
						<i class="fas fa-trash"></i>
					</a>

				<?php endif; ?>

				<?php
					$edit_page_id = 121;
					$edit_post = add_query_arg( 'animal', get_the_ID(), get_permalink(
						$edit_page_id+ $_POST['_wp_http_referer'] ) );
				?>

				<a href="" onclick="print()">
					<i class="fas fa-print"></i>
				</a>



			</div>

		</div>

		<div class="procedures col-md-12 no-padding">
			<div class="animal-data subtitle">
				<h4><strong>Dados:</strong></h4>
			</div>

			<?php
				$connected = new WP_Query( array(
						 'relationship' => array(
							'id'   => 'animal_to_consulta',
							'to'   => get_the_ID(),
						 ),
						 'nopaging'     => true,
				 ) );
				 while ($connected->have_posts()) :
					$connected->the_post(); ?>

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
				 endwhile;
				 wp_reset_postdata();
				?>

        	<div class="dados-container">
				<div class="list-header col-md-12 no-padding">
					<br> <br>
					<h4> <strong>	Procedimentos: </strong> </h4>

					<div class="procedimentos">
						<?php the_field('procedimentos'); ?>
					</div>
				</div>

				<div class="list-header col-md-12 no-padding">
					<br> <br>
					<h4> <strong>	Data: </strong> </h4>

					<div class="procedimentos">
						<?php the_field('data'); ?>
					</div>
				</div>
			</div>

	</div>

</div><!-- #primary END -->



<?php get_footer(); ?>
