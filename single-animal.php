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
  				<span><?php the_field('nome'); ?></span>
          <span class="animal-id">#<?php echo get_the_ID(); ?></span>
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

			<div class="list">
				<!-- <div class="list-header col-md-12">
						<div class="col-md-1">Cód.</div>
						<div class="col-md-3">Nome</div>
						<div class="col-md-6">Nome do dono</div>
						<div class="col-md-1">Plano</div>
				</div> -->





			</div>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
