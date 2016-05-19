<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 text-center">
            
            <div id="infoMessage"><?php echo $message;?></div>
			<div class="account-wall">
                <img class="profile-img" src="<?php echo base_url('assets/img/calificacion120.jpg'); ?>" alt="" />
				
				<?php echo form_open('auth/login', array('class' => 'form-signin', 'id' => 'Formulario')); ?>		
                <input type="text" class="form-control" id='Usuario' name='Usuario' placeholder="Usuario" required autofocus>
                <input type="password" class="form-control" id='Clave' name='Clave' placeholder="Contrase&ntilde;a" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Ingresar</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" id='Recordarme' value="remember-me">
                    Recordarme
                </label>
                <a href="<?php echo site_url('varios/RecuperaClave')?>" class="pull-right need-help">Olvid&oacute; la contrase&ntilde;a? </a><span class="clearfix"></span> 
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

</style>