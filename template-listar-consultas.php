<?php
/*
 * Template Name: Listar Consultas
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
				<span>Consultas</span>
			</div>
			<form action="" method="get">
				<select name="author_id" id="select">
				<?php
				$users = get_users();
				$checked = 0;

				if (isset($_GET['author_id'])) {
					$checked = $_GET['author_id'];
				}

				foreach ($users as $user): ?>
					<option value="<?= $user->ID ?>" <?= $user->ID == $_GET['author_id']? 'selected' : null ?>>
						<?= (get_user_meta($user->ID, "crmv")[0] != ""? get_user_meta($user->ID, "crmv")[0] : "Sem CRMV") . " - " . $user->display_name ?>
					</option>


				<?php endforeach; ?>

				</select>

				<input type="submit" value="Filtrar">
			</form>
			<br><br>
			<div class="list">
				<div class="list-header col-md-12">
						<div class="col-md-1">Cód.</div>
						<div class="col-md-2">Data</div>
						<div class="col-md-5">Tipo</div>
						<div class="col-md-2">Responsavel</div>
				</div>


				<?php
					$query = 'order=DESC&orderby=date&showposts=20&post_type=consulta'.'&paged='.$paged;

					if (isset($_GET['author_id'])) {
						$query = $query . "&author=" . $_GET['author_id'];
					}

					$temp = $wp_query;
			  		$wp_query = null;
			  		$wp_query = new WP_Query();
			  		$wp_query->query($query);

				?>


				<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<div class="list-data col-md-12">
							<a href="<?php the_permalink() ?>">
								<div class="col-md-1">#<?php echo get_the_ID(); ?></div>
								<div class="col-md-2"><?= get_the_date('d/m/Y'); ?></div>
								<div class="col-md-5"><?php the_field('tipo_de_consulta'); ?></div>
								<div class="col-md-2"><?php the_author() ?></div>
							</a>
					</div>

				<?php endwhile; ?>

				<?php odin_paging_nav() ?>



			</div>

		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
