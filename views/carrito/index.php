<h1>Carrito de la compra</h1>
<?php if ($carrito == []) : ?>
    <h3>No existe ningun elemento en el carrito</h3>
<?php else : ?>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['producto']; ?>
            <tr>
                <?php if ($producto->imagen != null) : ?>
                    <td><img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="" class="img-carrito"></td>
                <?php else : ?>
                    <td><img src="<?= base_url ?>assest/img/camiseta.png" alt="" class="img-carrito"></td>
                <?php endif; ?>

                <td>
                    <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>

                <td>
                    <?= $producto->precio ?>
                </td>
                <td>
                    <?= $elemento['unidades'] ?>
                    <div class="updown">
                        <a href="<?= base_url ?>carrito/up&id=<?= $indice ?>" class="button">+</a>
                        <a href="<?= base_url ?>carrito/down&id=<?= $indice ?>" class="button">-</a>
                    </div>


                </td>
                <td>
                    <a class="button button_red  button_carrito" href="<?= base_url . "carrito/delete&id=" . $indice ?>">Eliminar producto</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
    <div class="delete_carrito">
        <a href="<?= base_url ?>carrito/delete_all" class="button button_delete_all button_red">Borrar carrito</a>
    </div>
    <div class="total_carrito">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3>Precio total: <?= $stats['total'] ?>$</h3>
        <a href="<?= base_url ?>pedido/hacer" class="button button_pedido">Hacer pedido</a>
    </div>
<?php endif; ?>