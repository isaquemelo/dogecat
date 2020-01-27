<?php

if (!is_user_logged_in()){
	auth_redirect();
}

$plans = [
	'Plano A' => 1,
	'Plano B' => 2,
	'Plano C' => 3,
	'Plano D' => 3, //retirar versão final
];

$consulta_types = [
	"Consultas urgência - emergência" => 1,
	"Consulta clinico geral" => 2,
	"Consulta especialista" => 3,
	"Atendimento domiciliar" => 4,
	"Procedimento" => 5,
];


// consulta_id => time_to_use
$consulta_time_to_allow = [
	1 => 30,
	2 => 30,
	3 => 60,
	4 => 60,
	5 => 30,
];

// plan_id => [...consulta_types_allowed]
$plan_allow = [
	1 => [1, 2, 3, 4, 5],
	2 => [1, 2, 4, 5],
	3 => [2, 5]
];


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

} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['consulta_id']) {
	// Getting ready
	function dateDiffInDays($date1, $date2)	{
		// Calulating the difference in timestamps
		$diff = strtotime($date2) - strtotime($date1);

		// 1 day = 24 hours
		// 24 * 60 * 60 = 86400 seconds
		return abs($diff / 86400);
	}

	function showMessageandRedirect($message) {
		echo "<script>";
		echo "alert('" . $message . "');" ;
		echo "</script>";
		//wp_redirect(home_url() . "/animal/" . get_the_ID());
	}

	$animal_register_day = get_the_date("d-m-Y", get_the_ID());
	$animal_plan = get_field('plano');

	$time_since_registred = date_diff(date_create($animal_register_day), date_create(date("d-m-Y")));
	$time_since_registred =  intval($time_since_registred->format('%R%a'));

	$consulta_type = get_post_meta( $_GET['consulta_id'], 'tipo_de_consulta', true );


	// verificar se o plano comporta a consulta
	$consulta_id = $consulta_types[$consulta_type];
	$plan_id = $plans[$animal_plan];
	$supported_consultas = $plan_allow[$plan_id];

	if (in_array($consulta_id, $supported_consultas)) {
		// o plano comporta a consulta
		if ($time_since_registred >= $consulta_time_to_allow[$consulta_id]) {
			// o tempo de carencia já passou
			// verificar se ele ja realizou uma consulta no intervalo de dias limite

			$args = array(
				'post_type' => 'consulta',

				'relationship' => array(
					'id'   => 'animal_to_consulta',
					'from' => get_the_ID(), // You can pass object ID or full object
				),

				'meta_query' => array(
					array(
						'key' => 'tipo_de_consulta',
						'value' => $consulta_type,
						'compare' => '=',
					)
				),

				'date_query'    => array(
					'column'  => 'post_date',
					'after'   => '- ' . $consulta_time_to_allow[$consulta_id] .' days'
				),

				'post__not_in' => array($_GET['consulta_id']), // exclui post atual da lista

			 );


			$query = new WP_Query($args);

			if ($query->found_posts >= 1 && !($consulta_id == 5)) {
				//echo "Intervalo entre as consultas do tipo não foi atendido.";
				wp_delete_post($_GET['consulta_id']);
				showMessageandRedirect("Intervalo entre as consultas do tipo não foi atendido.");

			} else {
				// echo "Sucesso.";
				MB_Relationships_API::add( get_the_ID(), $_GET['consulta_id'], 'animal_to_consulta' );
			}

			wp_reset_postdata();


		} else {
			//echo "Tempo de carencia ainda não atendido. O usuário possui " . $time_since_registred . " dias.";
			wp_delete_post($_GET['consulta_id']);
			showMessageandRedirect("Tempo de carencia ainda não atendido. O usuário possui " . $time_since_registred . " dias.");

		}

	} else {
		// o plano nao comporta o tipo de consulta selecionado
		//echo "o plano nao comporta o tipo de consulta selecionado";
		showMessageandRedirect("O plano não comporta o tipo de consulta selecionado");
		wp_delete_post($_GET['consulta_id']);
		wp_redirect(home_url() . "/animal/" . get_the_ID());
	}


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

            <div class="cota-mensal col-md-6 no-padding col-sm-12">

                <?php
				$connected = new WP_Query( array(
					'relationship' => array(
							'id'   => 'animal_to_consulta',
							'from' => get_the_ID(), // You can pass object ID or full object
					),
					'nopaging'     => true,
				) );

				$procedures = [];

				while ( $connected->have_posts() ) : $connected->the_post();
						$post_procedures = get_field('procedimentos');
						$field = get_the_date('d/m/Y H:i') . "h";
						$field = substr($field, 0, 10);
						$field = explode("/", $field );


						if ($field[1] == getdate()['mon'] && $field[2] == getdate()['year']):
							foreach ($post_procedures as $procedure) {
								if (array_key_exists($procedure, $procedures)){
									$procedures[$procedure] += 1;
								} else {
									$procedures[$procedure] = 1;
								}
							}
						endif;
				?>



                <?php
				endwhile;
				wp_reset_postdata();
				?>


                <div class="col-md-12">
                    <span class="cota-title">Executados no mês:</span>
                </div>

                <div class="col-md-12">
					<?php if (count($procedures) >= 1): ?>
						<span class="cota-info"> O usuário realizou: </span>

					<?php else: ?>
						<span class="cota-info"> O usuário não realizou nenhuma ação. </span>
					<?php endif; ?>
                </div>

                <div class="col-md-12">
                    <?php foreach ($procedures as $key=>$value): ?>
                    <span class="cota-cota"> <?= $value  . " - " . $key ?> </span>
                    <br>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="actions col-md-3">

                <?php if( !(get_post_status() == 'trash') ) : ?>

                <a onclick="return confirm('Tem certeza que deseja excluir esse animal?')"
                    href="<?php echo get_delete_post_link( get_the_ID() ); ?>">
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

                <?php
						$plans_page_id = 211;
						$plans_redirect = add_query_arg( 'plano', $plans[get_field('plano')], get_permalink(
							$plans_page_id + $_POST['_wp_http_referer'] ) );


				?>

                <a
                    href="JavaScript:window.open(<?= "'" . $plans_redirect . "'" ?>,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')">
                    <i class="fas fa-info-circle"></i>
                </a>

				<?php

				$carteirinha_page_id = 312;
				$carteirinha_redirect = add_query_arg( 'animal_id', get_the_ID(), get_permalink(
					$carteirinha_page_id + $_POST['_wp_http_referer'] ) );

				?>

                <a href="<?= $carteirinha_redirect ?>" target="__blank">
                    <i class="fas fa-print"></i>
                </a>



            </div>

        </div>


        <?php else: ?>
		<script>
			//alert("Lembrete: Verifique se o procedimento é aceito pelo plano e se está no intervalo de uso.")
		</script>
        <div class="content-title">
            <span>Nova consulta</span>
		</div>
		<?php
				$adiciona_postdata_page_id = 309;
				$edit_post = add_query_arg( 'animal', get_the_ID(), get_permalink(
											$adiciona_postdata_page_id . $_POST['_wp_http_referer'] ) );
			?>

			<a href="<?= $edit_post ?>">ADICIONE A DATA DE REGISTRO DO ANIMAL</a>
			<br><br>
        <?php endif; ?>

		<br>

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
                    <span
                        class="bold-font"><?php echo "{$end['rua']}". ", ". "{$end['cidade']} - {$end['estado']}"; ?></span>
                </div>

                <div class="animal-telefone">
                    Telefone: <span class="bold-font"><?php the_field('telefone'); ?></span>
                </div>

                <div class="animal-celular">
                    Celular: <span class="bold-font"><?php the_field('celular'); ?></span>
				</div>


				<div class="animal-data">
					Dia de Cadastro: <span class="bold-font"><?= get_the_date("d/m/Y", get_the_ID()) ?></span>
				</div>
				<br>

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
                <div class="col-md-1">Cód.</div>
				<div class="col-md-2">Data</div>
				<div class="col-md-3"> Tipo </div>
				<div class="col-md-6">Procedimentos</div>

            </div>
            <?php endif; ?>

            <?php endif; ?>

            <div class="consultas-holder col-md-12 no-padding">

                <?php if (!$is_consulta):
				 $connected = new WP_Query( array(
						'orderby' => 'date',
						'order'   => 'DESC',
						 'relationship' => array(
								 'id'   => 'animal_to_consulta',
								 'from' => get_the_ID(), // You can pass object ID or full object
						 ),
						 'nopaging'     => true,

				 ) );
				 while ( $connected->have_posts() ) : $connected->the_post();
						 ?>
                <a href="<?php the_permalink(); ?>" class="single-consulta-item col-md-12">
                    <div class="col-md-1 no-padding"><?php echo get_the_ID(); ?></div>
					<div class="col-md-2 no-padding"><?= get_the_date('d/m/Y') ?></div>
					<div class="col-md-3 no-padding"> <?php the_field('tipo_de_consulta'); ?> </div>
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
						'submit_value' => 'Cadastrar consulta',
						'updated_message' => 'Consulta cadastrada',
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



<script>
// Popup window function
function basicPopup(url) {
    popupWindow = window.open(url, 'popUpWindow',
        'height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes'
    );
}
</script>
<?php get_footer(); ?>
