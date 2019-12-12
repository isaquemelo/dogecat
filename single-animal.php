<?php

if (!is_user_logged_in()){
	auth_redirect();
}

get_header();
?>

<div id="primary" class="single-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">
      <div class="animal-header">
  			<div class="content-title col-md-3 no-padding">
  				<span class=""><?php the_field('nome'); ?></span>
          <span class="animal-id">#<?php echo get_the_ID(); ?></span>
          <a href="#" class="nova-consulta-btn default-btn col-md-11">
            Nova consulta
          </a>

  			</div>

        <div class="cota-mensal col-md-9 no-padding">

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
      </div>

			<div class="animal-dados">
			     <div class="animal-data">
             Dados
           </div>

           <div class="dados-container">
             <div class="animal-nome">
               Nome: <span class="bold-font"><?php the_field('nome'); ?></span>
             </div>

             <div class="animal-plano">
               Plano: <span class="bold-font"><?php the_field('plano'); ?></span>
             </div>

             <div class="animal-dono">
               Nome do dono: <span class="bold-font"><?php the_field('nome_do_dono'); ?></span>
             </div>

             <div class="animal-cpf">
               CPF: <span class="bold-font"><?php the_field('cpf_dono'); ?></span>
             </div>

             <div class="animal-end">
               <?php
                $end = array('rua' => get_field('rua'),
                             'cidade' => get_field('cidade'),
                             'estado' => get_field('estado')
                );

               ?>
               Endereço: <span class="bold-font"><?php echo "{$end['rua']}". ", ". "{$end['cidade']} - {$end['estado']}"; ?></span>
             </div>

             <div class="animal-telefone">
               Telefone: <span class="bold-font"><?php the_field('telefone'); ?></span>
             </div>

             <div class="animal-celular">
               Celular: <span class="bold-font"><?php the_field('celular'); ?></span>
             </div>

           </div>





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

</div><!-- #primary END -->


<?php get_footer(); ?>
