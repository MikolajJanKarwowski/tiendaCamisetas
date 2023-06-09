<?php if (isset($cat)) : ?>
    <h1>Productos de <?= $cat->nombre ?></h1>
    <?php if ($productos->num_rows == 0) : ?>
        <p>No hay productos en esta categoria</p>
    <?php else : ?>
        <?php while ($pro = $productos->fetch_object()) : ?>
            <div class="product">
                <?php if ($pro->imagen != null) : ?>
                    <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="<?= $pro->descripcion ?>">
                <?php else : ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="<?= $pro->descripcion ?>">
                <?php endif; ?>
                <h2><?= $pro->nombre ?></h2>
                <p><?= $pro->precio ?></p>
                <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
<?php else : ?>
    <h1>La categoria no existe</h1>
<?php endif; ?>