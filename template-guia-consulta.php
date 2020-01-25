<?php
/*
 * Template Name: Guia de Consulta
 * description: >-
 */



if (!is_user_logged_in()){
	auth_redirect();
}

$consultaId = $_GET['consulta_id'];
$animalId = 0;

$connected = new WP_Query( array(
			'relationship' => array(
			'id'   => 'animal_to_consulta',
			'to'   => $consultaId,
			),
			'nopaging'     => true,
	) );
while ($connected->have_posts()){
	$connected->the_post();
	$animalId = get_the_ID();
}
wp_reset_postdata();


?>

<style type="text/css">
.tg {
    border-collapse: collapse;
    border-spacing: 0;
    border-color: #ccc;
}

.tg td {
    font-family: Arial, sans-serif;
    font-size: 14px;
    padding: 10px 5px;
    border-style: solid;
    border-width: 0px;
    overflow: hidden;
    word-break: normal;
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-color: #ccc;
    color: #333;
    background-color: #fff;
}

.tg th {
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    padding: 10px 5px;
    border-style: solid;
    border-width: 0px;
    overflow: hidden;
    word-break: normal;
    border-top-width: 1px;
    border-bottom-width: 1px;
    border-color: #ccc;
    color: #333;
    background-color: #f0f0f0;
}

.tg .tg-c3ow {
    border-color: inherit;
    text-align: center;
    vertical-align: center;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 22px
}

.tg .tg-0pky {
    border-color: inherit;
    text-align: left;
    vertical-align: center
}

.tg .tg-73oq {
    border-color: #000000;
    text-align: left;
    vertical-align: top
}

.logo img {
    width: 125px;
}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 741px">
    <colgroup>
        <col style="width: 204px">
        <col style="width: 365px">
        <col style="width: 172px">
    </colgroup>
    <tr>
        <th class="tg-c3ow">
            <div class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="">
            </div>


        </th>
        <th class="tg-c3ow">Guia de Consulta</th>
        <th class="tg-0pky">Cód. consulta: <br> <strong><?= $consultaId ?></strong></th>
    </tr>
    <?php
		$author_id = get_post_field ('post_author', $consultaId);
		$display_name = get_the_author_meta( 'display_name' , $author_id );
	?>

    <tr>
        <td class="tg-0pky">Cód. animal <br> <strong><?= $animalId ?></strong> </td>
        <td class="tg-0pky" colspan="2">Nome do profissional executante:<br>
            <strong><?= $display_name ?></strong></td>
    </tr>
    <tr>
        <td class="tg-73oq">Data do atendimento: <br><strong><?= get_the_date('d/m/Y', $consultaId) ?></strong></td>
        <td class="tg-73oq" colspan="2">Nome do animal: <br> <strong> <?= get_post_meta($animalId, 'nome')[0] ?>
            </strong></td>
    </tr>
    <tr>
        <td class="tg-0pky">Plano: <br><strong><?= get_post_meta($animalId, 'plano')[0] ?></strong> </td>
        <td class="tg-0pky" colspan="2">Nome do dono: <br><strong><?= get_post_meta($animalId, 'nome_do_dono')[0] ?></strong></td>
    </tr>
    <tr>
        <td class="tg-0pky"></td>
		<td class="tg-0pky" colspan="2">Procedimentos: <br>
			<strong>
			<?php
			$procedures = get_post_meta($consultaId, 'procedimentos')[0];
			foreach($procedures as $procedure) {
				echo $procedure;
				echo "<br>";
			}
			?>

			</strong>
		</td>
	</tr>

	<tr>
        <td class="tg-0pky"></td>
		<td class="tg-0pky" colspan="2">Tipo de Consulta:
			<br><strong><?= get_post_meta($consultaId, 'tipo_de_consulta')[0] ?></strong>
		</td>
    </tr>

    <tr>
        <td class="tg-0pky"></td>
        <td class="tg-0pky" colspan="2">Assinatura do executante: <br> <br></td>
    </tr>
    <tr>
        <td class="tg-0pky"></td>
        <td class="tg-0pky" colspan="2">Assinatura do beneficiário ou responsável: <br> <br></td>
    </tr>
</table>
