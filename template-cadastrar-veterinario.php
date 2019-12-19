<?php
/*
 * Template Name: Cadastrar veterinario
 * description: >-
 */

if (!is_user_logged_in()) {
	auth_redirect();
}

function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

if (isset( $_POST["user"] ) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
		$user_login		= $_POST["user"];
		$user_email		= $_POST["email"];
		$user_pass		= $_POST["password"];
		$pass_confirm 	= $_POST["password_repeat"];


		$nome_completo  = $_POST['nome_completo'];
		$clinica        = $_POST['clinica'];
		$celular        = $_POST['celular'];
		$estado         = $_POST['estado'];
		$cidade         = $_POST['cidade'];
		$rua            = $_POST['rua'];
		$numero         = $_POST['numero'];


		// this is required for username checks
		require_once(ABSPATH . WPINC . '/registration.php');

		if(username_exists($user_login)) {
			// echo "Username already registered";
			pippin_errors()->add('username_unavailable', __('Erro: Usuário já está em uso.'));
		}
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
		if(email_exists($user_email)) {
			// echo "Email address already registered";
			pippin_errors()->add('email_used', __('Erro: E-mail já registrado.'));
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
			$new_user_id = wp_insert_user(array(
					'user_login'		=> $user_login,
					'first_name'		=> str_split($nome_completo)[0],
					'last_name'			=> str_split($nome_completo)[1],
					'user_registered'	=> date('Y-m-d H:i:s'),
					'user_pass'	 		=> $user_pass,
					'user_email'		=> $user_email,
					'role'				=> 'um_veterinario'
				)
			);
			if($new_user_id) {
				add_user_meta( $new_user_id, "clinica", $clinica, false);
				add_user_meta( $new_user_id, "nome_completo", $nome_completo, false);
				add_user_meta( $new_user_id, "celular", $celular, false);
				add_user_meta( $new_user_id, "estado", $estado, false);
				add_user_meta( $new_user_id, "cidade", $cidade, false);
				add_user_meta( $new_user_id, "rua", $rua, false);
				add_user_meta( $new_user_id, "numero", $numero, false);

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





get_header();

?>

<div id="primary" class="cadastrar-animal col-md-12">
		<?php get_sidebar(); ?>
		<div class="col-md-9 content-holder">
			<div class="status">
				<?php echo $errors[0];?>
			</div>
			<div class="content-title">
				<span>Cadastrar veterinário</span>
			</div>



			<form method="post" action="" class="row">

		        <div class="">
		            <div class="col-md-6">
		                    <label>Nome completo</label>
		                    <input autofocus type="text" name="nome_completo" placeholder="Nome completo">
		            </div>

		            <div class="col-md-6">
		                    <label>E-mail</label>
		                    <input autofocus type="email" name="email" placeholder="E-mail">
		            </div>

		            <div class="col-md-6">
		                    <label>Clínica</label>
		                    <input autofocus type="text" name="clinica" placeholder="Clínica">
		            </div>

		            <div class="col-md-6">
		                    <label>Celular</label>
		                    <input autofocus type="number" name="celular" placeholder="Celular">
		            </div>

		            <div class="col-md-3">
		                    <label>Estado</label>
		                    <select name="estado" id="estado" data-placeholder="Estado">
						         <option value=""></option>
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
						         <option value="Paraíba (PB)" selected>Paraíba (PB)</option>
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
		                    <input autofocus type="text" name="cidade" placeholder="Cidade">
		            </div>

		            <div class="col-md-4">
		                    <label>Rua</label>
		                    <input autofocus type="text" name="rua" placeholder="Rua">
		            </div>

		            <div class="col-md-2">
		                    <label>Número</label>
		                    <input autofocus type="number" name="numero" placeholder="Número">
		            </div>


		            <div class="col-md-12">
		                    <label>Usuário</label>
		                    <input autofocus type="text" name="user" placeholder="Usuário">
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

			<br> <br><br><br>
			<div clas="col-md-12">
				<?php
				$blogusers = get_users( 'role=um_veterinario' );
				// Array of WP_User objects.
				foreach ( $blogusers as $user ) {
					echo get_user_meta($user->ID, 'clinica', true);
					///print("<pre>".print_r($user->,true)."</pre>");
				    echo '<br><br>';
				} ?>
			</div>

		</div>

	</div><!-- #primary END -->


<?php get_footer(); ?>
