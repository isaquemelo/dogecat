<?php

if (!is_user_logged_in()){
	auth_redirect();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
		$animal = array(
			"id" =>  $_POST['id'],
			"nome" =>  $_POST['nome'],
			"raca" =>  $_POST['raca'],
			"sexo" =>  $_POST['sexo'],
			"vacinas" =>  $_POST['vacinas'],
			"plano" =>  $_POST['plano'],
			"dono" =>  $_POST['dono'],
			"cpf" =>  $_POST['cpf'],
			"endereco" =>  $_POST['endereco'],
			"telefone" =>  $_POST['telefone'],
			"celular" =>  $_POST['celular']
		);

		$is_consulta = true;


		if($post_id){
			wp_redirect(home_url());
			exit;
		}
	}

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	MB_Relationships_API::add( get_the_ID(), $_GET['consulta_id'], 'animal_to_consulta' );
}


acf_form_head();
get_header();



?>


<div id="primary" class="single-animal-holder col-md-12">
	<?php get_sidebar(); ?>
	<div class="col-md-9 content-holder">
		<?php if(!$is_consulta): ?>
	      	<div class="animal-header">
	  			<div class="content-title col-md-3 no-padding">
	  				<span class=""><?php the_field('nome'); ?></span>
	         		<span class="animal-id">#<?php echo get_the_ID(); ?></span>

						<form class="" action="" method="POST">
							<input type="text" value="<?php the_field('nome'); ?>" class="hidden" name="nome">
							<input type="text" value="<?php the_field('raca'); ?>" class="hidden" name="raca">
							<input type="text" value="<?php the_field('sexo_animal'); ?>" class="hidden" name="sexo">
							<input type="text" value="<?php the_field('vacinas'); ?>" class="hidden" name="vacinas">
							<input type="text" value="<?php the_field('plano'); ?>" class="hidden" name="plano">
							<input type="text" value="<?php the_field('nome_do_dono'); ?>" class="hidden" name="dono">
							<input type="text" value="<?php the_field('cpf_dono'); ?>" class="hidden" name="cpf">
							<input type="text" value="<?php echo get_the_ID();  ?>" class="hidden" name="id">
							<input type="text" value="<?php $end = array('rua' => get_field('rua'),
													 'cidade' => get_field('cidade'),
													 'estado' => get_field('estado')
							);

							 echo "{$end['rua']}". ", ". "{$end['cidade']} - {$end['estado']}"; ?>" class="hidden" name="endereco">
							<input type="text" value="<?php the_field('telefone'); ?>" class="hidden" name="telefone">
							<input type="text" value="<?php the_field('celular'); ?>" class="hidden" name="celular">

							<input class="nova-consulta-btn default-btn col-md-11" type="submit" name="" value="Nova consulta">
							<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
							<input type="hidden" name="submitted" id="submitted" value="true">
						</form>



	  			</div>

		        <div class="cota-mensal col-md-7 no-padding col-sm-12">

		          <div class="col-md-12">
		            <span class="cota-title">Cota mensal:</span>
		          </div>

		          <div class="col-md-12">
		            <span class="cota-info"> O usuário pode realizar: </span>
		          </div>

		          <div class="col-md-12">
		            <span class="cota-cota"> 1 vacina  </span>
		            <span class="cota-cota"> 1 castração </span>
		            <span class="cota-cota"> 2 consultas </span>
		          </div>

		        </div>

		        <div class="actions col-md-2">

		        	<?php if( !(get_post_status() == 'trash') ) : ?>

					    <a onclick="return confirm('Tem certeza que deseja excluir esse animal?')"href="<?php echo get_delete_post_link( get_the_ID() ); ?>">
					    	<i class="fas fa-trash"></i>
					    </a>

					<?php endif; ?>

					<?php
						$edit_page_id = 121;
						$edit_post = add_query_arg( 'animal', get_the_ID(), get_permalink(
							$edit_page_id+ $_POST['_wp_http_referer'] ) );
					?>

		        	<a href="<?php echo $edit_post; ?>">
		        		<i class="fas fa-edit"></i>
		        	</a>
		        	<a href="" onclick="print()">
		        		<i class="fas fa-print"></i>
		        	</a>



		        </div>

  			</div>


		<?php else: ?>
			<div class="content-title">
				<span>Nova consulta</span>
			</div>
		<?php endif; ?>


		<div class="animal-dados">
	     	<div class="animal-data subtitle">Dados:</div>

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
			 $connected = new WP_Query( array(
					 'relationship' => array(
							 'id'   => 'animal_to_consulta',
							 'from' => get_the_ID(), // You can pass object ID or full object
					 ),
					 'nopaging'     => true,
			 ) );

			 if ($connected->have_posts()):

			?>
				<?php if (!$is_consulta): ?>
				<div class="animal-data subtitle consulta-title">
	     			Consultas:
	   			</div>

				<div class="list-header col-md-12">
							<div class="col-md-2">Cód.</div>
							<div class="col-md-3">Data</div>
							<div class="col-md-6">Procedimentos</div>
				</div>
				<?php endif; ?>

			<?php endif; ?>

			<div class="consultas-holder col-md-12 no-padding">

			 <?php if (!$is_consulta):
				 $connected = new WP_Query( array(
						 'relationship' => array(
								 'id'   => 'animal_to_consulta',
								 'from' => get_the_ID(), // You can pass object ID or full object
						 ),
						 'nopaging'     => true,
				 ) );
				 while ( $connected->have_posts() ) : $connected->the_post();
						 ?>
						 <a href="<?php the_permalink(); ?>" class="single-consulta-item col-md-12">
								 <div class="col-md-2 no-padding"><?php echo get_the_ID(); ?></div>
	 	 						 <div class="col-md-3 no-padding"><?php the_field('data'); ?></div>
	 	 						 <div class="col-md-6 no-padding"><?php the_field('procedimentos'); ?></div>


						 </a>

						 <?php
				 endwhile;
				 wp_reset_postdata();


				 ?>

			</div>


			<div class="fotos">
				 <div class="subtitle">Fotos:</div>
		           <?php
		           $images = get_field('imagens');
		           $size = 'full'; // (thumbnail, medium, large, full or custom size)
		           if( $images ): ?>
		               <ul>
		                   <?php foreach( $images as $image_id ): ?>

		                           <img src="<?php echo $image_id; ?>" alt="" width="150">

		                   <?php endforeach; ?>
		               </ul>
		           <?php endif; ?>
		 	</div>
			<?php else: ?>
				<?php
					acf_form(array(
						'post_id'		=> 'new_post',
						'post_title'	=> false,
						'post_content'	=> false,
						'new_post'		=> array(
							'post_type'		=> 'consulta',
							'post_status'	=> 'publish',

						),
						'return' => '?consulta_id=%post_id%',
					));

				?>


			<?php endif; ?>

		</div>

	</div>

</div><!-- #primary END -->

<div class="carteirinha">


	<div class="animal-data subtitle">Dados:</div>

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

	<div class="fotos">
				 <div class="subtitle">Fotos:</div>
		           <?php
		           $images = get_field('imagens');
		           $size = 'full'; // (thumbnail, medium, large, full or custom size)
		           if( $images ): ?>
		               <ul>
		                   <?php foreach( $images as $image_id ): ?>

		                           <img src="<?php echo $image_id; ?>" alt="" width="150">

		                   <?php endforeach; ?>
		               </ul>
		           <?php endif; ?>
 	</div>


</div>


<?php get_footer(); ?>
