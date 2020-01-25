<?php
/*
 * Template Name: !TEMPORARIO! Adiciona post date paramentro GET
 * description: >-
 */



if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
	$animal_id =  $_POST['animal-id'];

	$postdate = $_POST['data'];

	$post_meta = array(
		'ID' => $animal_id,
		'post_date' => $postdate
	);

	wp_update_post( $post_meta );

	wp_redirect(home_url() . "/animal/" . $animal_id);

}


if ( isset( $_GET['animal'] ) ) {

    if ( $_GET['animal'] == $post->ID )
    {
        $current_post = $post->ID;
    }
}

get_header();


?>



<div id="primary" class="listar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">

			<div class="content-title">
				<span>Adicionar data de cadastro #<?= $_GET['animal'] ?></span>
			</div>

			<div class="list">
				<form action="" method="post">
					<input type="date" placeholder="Data de Registro" name="data">
					<input type="text" placeholder="Data de Registro" name="animal-id" value="<?= $_GET['animal']; ?>" hidden>
					<input type="submit" value="Salvar">

				</form>

			</div>


		</div>

</div><!-- #primary END -->


<?php get_footer(); ?>
