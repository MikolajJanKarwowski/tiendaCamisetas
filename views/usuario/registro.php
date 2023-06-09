<h1>
    Registrarse
</h1>
<?php 
    if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'):
?>
    <strong class="alert_green">El usaurio se ha registrado de manera correcta</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'fail'):?>
    <strong class="alert_red">El usaurio no se ha registrado correctamente vuelva a intentarlo</strong>
<?php endif;?>
<?php Utils::deleteSession('register');?>
<form action="<?=base_url?>Usuario/save" method="post">
    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre">
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="">
    <label for="email">Email</label>
    <input type="email" name="email">
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="">
    <input type="submit" value="Enviar">
</form>