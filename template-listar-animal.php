<?php
/*
 * Template Name: Listar Animais
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
						<div class="col-md-3">Nome</div>
						<div class="col-md-6">Nome do dono</div>
						<div class="col-md-1">Plano</div>
				</div>


				<?php
					$temp = $wp_query;
			  		$wp_query = null;
			  		$wp_query = new WP_Query();
			  		$wp_query->query('order=DESC&orderby=date&showposts=20&post_type=animal'.'&paged='.$paged);

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
