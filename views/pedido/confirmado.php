<?php

?>

<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete') : ?>
    <h1>El pedido ha sido confirmado</h1>
    <p> Pedido creado correctamente </p>
    <br>
    <p>Numero de pedido:<?= $ped->id ?> </p>
    <br>
    <p>Coste: <?= $ped->coste ?></p>
    <br>
    <p>Productos: </p>
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

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'fail') : ?>
    <h1>El pedido no se ha sido confirmado</h1>
    <p><a href="<?= base_url ?>pedido/hacer">El pedido no ha sido creado correctamente</a></p>
<?php else : header('Location:' . base_url) ?>
<?php endif; ?>