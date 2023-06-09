<h1>Detalles del pedido</h1>
<h3>Numero de pedido: <?= $pedido_id ?></h3>
<h3>Datos del pedido: </h3>
<br>
<ul>
    <li>Provincia: <?= $ped->provincia ?></li>
    <li>Localidad: <?= $ped->localidad ?></li>
    <li>Dirreccion: <?= $ped->dirreccion ?></li>
    <li>Fecha: <?= $ped->fecha ?></li>
    <li>Hora: <?= $ped->hora ?></li>
    <li>Coste: <?= $ped->coste ?></li>
    <li>Estado: <?=$ped->estado?></li>
</ul>
<br>
<?php if (isset($productos)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar estado del pedido</h3>
        <?php if (isset($_SESSION['estado']) && $_SESSION['estado'] == 'updated') : ?>
            <strong class="alert_green">El pedido se ha actualizado correctamente</strong>
        <?php elseif (isset($_SESSION['estado']) && $_SESSION['estado'] == 'fail') : ?>
            <strong class="alert_red">El producto no se ha actualizado</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('estado'); ?>
        <form action="<?= base_url . "pedido/estado" ?>" method="POST">
            <input type="hidden" value="<?=$ped->id?>" name="pedido_id">
            <select name="estado" id="">
                <option value="confirm">Pendiente</option>
                <option value="preparation">en Preparacion</option>
                <option value="ready">Preparado para enviar</option>
                <option value="sended">Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
        <br>
    <?php endif; ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while ($pro = $productos->fetch_object()) : ?>
            <tr>
                <?php if ($pro->imagen != null) : ?>
                    <td><img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="" class="img-carrito"></td>
                <?php else : ?>
                    <td><img src="<?= base_url ?>assest/img/camiseta.png" alt="" class="img-carrito"></td>
                <?php endif; ?>

                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $pro->id ?>"><?= $pro->nombre ?></a>

                <td>
                    <?= $pro->precio ?>
                </td>
                <td>
                    <?= $pro->cantidad ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else : ?>
    <p>El pedido no tiene datos</p>
<?php endif; ?>