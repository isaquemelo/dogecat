<?php
/*
 * Template Name: Single Veterinário
 * description: >-
 */




if (!is_user_logged_in()){
	auth_redirect();
}

get_header();


$vet_id = $_GET["id"];
$edit = $_GET["edit"];

function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}



if (isset( $_POST["user"] ) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
		echo "entro" . $_POST["user"];
		$user_login		= $_POST["user"];
		$user_email		= $_POST["email"];
		$user_pass		= $_POST["password"];
		$pass_confirm 	= $_POST["password_repeat"];

		$crmv           = $_POST['crmv'];
		$nome_completo  = $_POST['nome_completo'];
		$clinica        = $_POST['clinica'];
		$celular        = $_POST['celular'];
		$estado         = $_POST['estado'];
		$cidade         = $_POST['cidade'];
		$rua            = $_POST['rua'];
		$numero         = $_POST['numero'];


		// this is required for username checks
		require_once(ABSPATH . WPINC . '/registration.php');

		if(!validate_username($user_login)) {
			// echo "invalid username";
			pippin_errors()->add('username_invalid', __('Erro: Usuário inválido'));
		}
		if($user_login == '') {
			// echo "empty username";
			pippin_errors()->add('username_empty', __('Erro: Por favor digite um usuário'));
		}
		if(!is_email($user_email)) {
			// echo "invalid email";
			pippin_errors()->add('email_invalid', __('Erro: E-mail inválido.'));
		}
		if($user_pass == '') {
			// echo "passwords do not match";
			pippin_errors()->add('password_empty', __('Erro: Digite uma senha valida.'));
		}
		if($user_pass != $pass_confirm) {
			// echo "passwords do not match";
			pippin_errors()->add('password_mismatch', __('Erro: As senhas não são iguais!'));
		}

		$errors = pippin_errors()->get_error_messages();

		// only create the user in if there are no errors
		if(empty($errors)) {
			echo "sem erros";
			$new_user_id = wp_update_user(array(
					'ID'				=> $vet_id,
					'first_name'		=> explode(" ", $nome_completo)[0],
					'last_name'			=> explode(" ", $nome_completo)[1],
					'user_registered'	=> date('Y-m-d H:i:s'),
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'role'				=> 'um_veterinario'
				)
			);
			if($new_user_id) {
				//echo "entro";
				update_user_meta( $new_user_id, "crmv", $crmv, false);
				update_user_meta( $new_user_id, "clinica", $clinica, false);
				update_user_meta( $new_user_id, "nome_completo", $nome_completo, false);
				update_user_meta( $new_user_id, "celular", $celular, false);
				update_user_meta( $new_user_id, "estado", $estado, false);
				update_user_meta( $new_user_id, "cidade", $cidade, false);
				update_user_meta( $new_user_id, "rua", $rua, false);
				update_user_meta( $new_user_id, "numero", $numero, false);


				//echo "asdasd";
				wp_redirect(home_url());

				// send an email to the admin alerting them of the registration
				//wp_new_user_notification($new_user_id);

				// log the new user in
				//wp_setcookie($user_login, $user_pass, true);
				// wp_set_current_user($new_user_id, $user_login);
				// do_action('wp_login', $user_login);

				// send the newly created user to the home page after logging them in
				// wp_redirect(home_url()); exit;
			}

		}

}


if (isset($_GET["delete_user"])) {
	//echo "asdssasd";
	wp_delete_user($vet_id);
	wp_redirect(home_url());
	exit;
}

?>




<div id="primary" class="listar-animal col-md-12">
		<?php get_sidebar(); ?>

		<?php if(!isset($edit)): ?>
		<div class="col-md-9 content-holder">

			<div class="col-md-10 content-title no-padding">
				<span><?= get_the_author_meta( 'nome_completo', $vet_id ); ?></span>
			</div>

			 <div class="actions col-md-2 no-padding">
				<a onclick="return confirm('Tem certeza que deseja excluir esse veterinário? Isso não podera ser desfeito.')" href="?id=<?= $vet_id ?>&delete_user=true">
					<i class="fas fa-trash"></i>
				</a>

				<?php
					$edit_page_id = 27;
					$edit_post = add_query_arg( 'animal', get_the_ID(), get_permalink(
						$edit_page_id+ $_POST['_wp_http_referer'] ) );
				?>

				<a href="?id=<?= $vet_id ?>&edit=true">
					<i class="fas fa-edit"></i>
				</a>

		    </div>

			<div class="list col-md-12 no-padding">
				<div class="vet-crmv">
	               CRMV:
	               <span class="bold-font"><?= get_the_author_meta( 'crmv', $vet_id ); ?></span>
				 </div>
				<div class="vet-email">
	               E-mail:
	               <span class="bold-font"><?= get_the_author_meta( 'user_email', $vet_id ); ?></span>
				 </div>

				 <div class="vet-usr">
	               Usuário:
	               <span class="bold-font"><?= get_the_author_meta( 'user_login', $vet_id ); ?></span>
				 </div>


				 <div class="vet-clinica">
	               Clínica:
	               <span class="bold-font"><?= get_the_author_meta( 'clinica', $vet_id ); ?></span>
				 </div>

				 <div class="vet-celular">
				 	Celular:
	               <span class="bold-font"><?= get_the_author_meta( 'celular', $vet_id ); ?></span>
				 </div>

				 <div class="vet-estado">
				 	Estado:
	               <span class="bold-font"><?= get_the_author_meta( 'estado', $vet_id ); ?></span>
				 </div>

				 <div class="vet-cidade">
				 	Cidade:
	               <span class="bold-font"><?= get_the_author_meta( 'cidade', $vet_id ); ?></span>
				 </div>

				 <div class="vet-rua">
				 	Rua:
	               <span class="bold-font"><?= get_the_author_meta( 'rua', $vet_id ); ?></span>
				 </div>

				 <div class="vet-numero">
				 	Número:
	               <span class="bold-font"><?= get_the_author_meta( 'numero', $vet_id ); ?></span>
	             </div>

			</div>

		</div>

		<?php else: ?>
			<div class="col-md-9 content-holder">
				<div class="status">
					<?php echo $errors[0];?>
				</div>
				<div class="content-title">
					<span>Editar veterinário</span>
				</div>



				<form method="post" action="" class="row">

					<div class="">
						<div class="col-md-6">
								<label>Nome completo</label>
								<input autofocus type="text" name="nome_completo" placeholder="Nome completo" value="<?= get_the_author_meta( 'nome_completo', $vet_id ); ?>">
						</div>

						<div class="col-md-6">
								<label>E-mail</label>
								<input autofocus type="email" name="email" placeholder="E-mail" value="<?= get_the_author_meta( 'user_email', $vet_id ); ?>">
						</div>

						<div class="col-md-6">
								<label>Clínica</label>
								<input autofocus type="text" name="clinica" placeholder="Clínica" value="<?= get_the_author_meta( 'clinica', $vet_id ); ?>">
						</div>

						<div class="col-md-6">
								<label>Celular</label>
								<input autofocus type="tel" name="celular" placeholder="Celular" value="<?= get_the_author_meta( 'celular', $vet_id ); ?>">
						</div>

						<div class="col-md-3">
								<label>Estado</label>
								<select name="estado" id="estado" data-placeholder="Estado">
									<option value="<?= get_the_author_meta( 'estado', $vet_id ); ?>" selected > <?= get_the_author_meta( 'estado', $vet_id ); ?> </option>
									<option value="Acre (AC)">Acre (AC)</option>
									<option value="Alagoas (AL)">Alagoas (AL)</option>
									<option value="Amapá (AP)">Amapá (AP)</option>
									<option value="Amazonas (AM)">Amazonas (AM)</option>
									<option value="Bahia (BA)">Bahia (BA)</option>
									<option value="Ceará (CE)">Ceará (CE)</option>
									<option value="Distrito Federal (DF)">Distrito Federal (DF)</option>
									<option value="Espírito Santo (ES)">Espírito Santo (ES)</option>
									<option value="Goiás (GO)">Goiás (GO)</option>
									<option value="Maranhão (MA)">Maranhão (MA)</option>
									<option value="Mato Grosso (MT)">Mato Grosso (MT)</option>
									<option value="Mato Grosso do Sul (MS)">Mato Grosso do Sul (MS)</option>
									<option value="Minas Gerais (MG)">Minas Gerais (MG)</option>
									<option value="Pará (PA)">Pará (PA)</option>
									<option value="Paraíba (PB)">Paraíba (PB)</option>
									<option value="Paraná (PR)">Paraná (PR)</option>
									<option value="Pernambuco (PE)">Pernambuco (PE)</option>
									<option value="Piauí (PI)">Piauí (PI)</option>
									<option value="Rio de Janeiro (RJ)">Rio de Janeiro (RJ)</option>
									<option value="Rio Grande do Norte (RN)">Rio Grande do Norte (RN)</option>
									<option value="Rio Grande do Sul (RS)">Rio Grande do Sul (RS)</option>
									<option value="Rondônia (RO)">Rondônia (RO)</option>
									<option value="Roraima (RR)">Roraima (RR)</option>
									<option value="Santa Catarina (SC)">Santa Catarina (SC)</option>
									<option value="São Paulo (SP)">São Paulo (SP)</option>
									<option value="Sergipe (SE)">Sergipe (SE)</option>
									<option value="Tocantins (TO)">Tocantins (TO)</option>
								</select>
						</div>

						<div class="col-md-3">
								<label>Cidade</label>
								<input autofocus type="text" name="cidade" placeholder="Cidade" value="<?= get_the_author_meta( 'cidade', $vet_id ); ?>">
						</div>

						<div class="col-md-4">
								<label>Rua</label>
								<input autofocus type="text" name="rua" placeholder="Rua" value="<?= get_the_author_meta( 'rua', $vet_id ); ?>">
						</div>

						<div class="col-md-2">
								<label>Número</label>
								<input autofocus type="number" name="numero" placeholder="Número" value="<?= get_the_author_meta( 'numero', $vet_id ); ?>">
						</div>

						<div class="col-md-12">
								<label>CRMV</label>
								<input autofocus type="number" name="crmv" placeholder="CRMV" value="<?= get_the_author_meta( 'CRMV', $vet_id ); ?>">
						</div>

						<div class="col-md-12">
								<label>Usuário</label>
								<input autofocus type="text" name="user" placeholder="Usuário" value="<?= get_the_author_meta( 'user_login', $vet_id ); ?>">
						</div>



						<div class="col-md-6">
								<label>Senha</label>
								<input autofocus type="password" name="password" placeholder="Senha">
						</div>

						<div class="col-md-6">
								<label>Repita a Senha</label>
								<input autofocus type="password" name="password_repeat" placeholder="Repita a Senha">
						</div>


						<div class="col-md-12">
							<input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>"/>
							<input type="submit" class="col-md-12 col-sm-12" value="<?php _e('Registrar veterinário'); ?>"/>
						</div>





					</div>



				</form>


			</div>


		</div>
		<?php endif; ?>

</div><!-- #primary END -->





<?php get_footer() ?>
