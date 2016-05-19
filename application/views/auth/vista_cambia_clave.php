<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Cambio de contrase&ntilde;a</h1>
            <div id="infoMessage"><?php echo $message;?></div>
			<div class="account-wall">			
				<?php echo form_open('auth/change_password', array('class' => 'form-signin', 'id' => 'Formulario')); ?>		
                <input type="password" class="form-control" id='ClaveActual' name='ClaveActual' placeholder="Contrase&ntilde;a actual" required>
				<input type="password" class="form-control" id='Clave1' name='Clave1' placeholder="Nueva contrase&ntilde;a" pattern="<?php echo '^.{'.$min_password_length.'}.*$'; ?>" required>
				<input type="password" class="form-control" id='Clave2' name='Clave2' placeholder="Confirme contrase&ntilde;a" pattern="<?php echo '^.{'.$min_password_length.'}.*$'; ?>" required>
				<input type="hidden" id='user_id' name='user_id' value="<?php echo $user_id; ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Cambiar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
.form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>