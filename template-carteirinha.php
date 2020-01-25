<?php
/*
 * Template Name: Carteirinha
 * description: >-
 */



if (!is_user_logged_in()){
	auth_redirect();
}


$animalId = 0;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$animalId = $_GET['animal_id'];
}


?>

<style>
	* {
		font-family: "Roboto", sans-serif;
	}

	.carteirinha_wrapper {
		border: 2px dashed;
		padding: 0.2cm;
		width: fit-content;
		border-radius: 24px;
	}

	.carteirinha {
		width: 9.5cm;
		height: 6cm;
		background: url(<?= get_template_directory_uri() ?>/assets/images/bone.png);
		background-size: 25.5cm;
		border-radius: 24px;
		padding: 15px;
	}

	.logo {
		width: fit-content;
	    display: inline-block;
	}

	.logo img {
		width: 125px;
	}

	.animal-id {
		display: inline-block;
		font-size: 25px;
		text-transform: uppercase;
		font-weight: 900;
	}

	header {
		display: flex;
		align-items: center;
		justify-content: space-between;
	}
	.name-content {
		padding: 15px 0px 8px 13px;
		border: 2px solid #f9bb4b;
		border-radius: 30px;
		font-weight: bold;
	}

	.name {
		width: calc(50% - 2px);
		margin-bottom: 15px;
	}

	.vencimento {
		width: 100%;
	}

	.vencimento div:first-child {
		margin-left: 16px;
		font-size: 12px;
		margin-bottom: -17px;
	}



	section {
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;

	}

	.name div:first-child {
		margin-left: 16px;
		font-size: 12px;
		margin-bottom: -17px;
	}

	.animal-pic {
		width: 90px;
		height: 100px;
		overflow: hidden;
		border: 1px solid rgba(0,0,0,0.05);
	}

	.animal-pic img {
		width: inherit;
	}

</style>

<div class="carteirinha_wrapper">
<div class="carteirinha">
	<header>
		<div class="logo">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="">
		</div>

		<div class="animal-id"> #<?= $animalId ?> </div>

		<?php
		$image = get_post_meta($animalId, 'imagens');
		$image_url = wp_get_attachment_url($image[0][0]);
		?>

		<div class="animal-pic">
			<img src="<?= $image_url ?>" alt="">
		</div>

	</header>



	<section>
		<div class="name">
			<div> Nome: </div>
			<div class="name-content"> <?= get_post_meta($animalId, "nome")[0] ?> </div>
		</div>

		<div class="name">
			<div> Raça: </div>
			<div class="name-content"> <?= get_post_meta($animalId, "raca")[0] ?> </div>
		</div>

		<div class="vencimento">
			<div> Data de Cadastro: </div>
			<div class="name-content"> <?= get_the_date("d/m/Y", get_the_ID()) ?> </div>
		</div>

	</section>
</div>
</div>



