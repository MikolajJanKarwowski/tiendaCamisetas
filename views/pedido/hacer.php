<?php if(isset($_SESSION['identity'])):?>
    <h1>Hacer pedido</h1>
    <p><a href="<?=base_url?>carrito/index">Ver los elementos del pedido</a></p> 
    <br>
    <h3>Introduzca su dirreccion    </h3>
    <form action="<?=base_url.'pedido/add'?>" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia">

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad">

        <label for="dirreccion">Dirreccion</label>
        <input type="text" name="dirreccion">

        <input type="submit" value="Enviar">
    </form>
<?php else:?>
    <h1>Usuario no registrado</h1>
    <a href="<?=base_url?>usuario/registro">Debes estar registrado para poder hacer un pedido</a>
<?php endif;?>