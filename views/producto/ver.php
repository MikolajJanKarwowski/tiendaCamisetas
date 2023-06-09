<?php if (isset($pro) && $pro != null) : ?>
    <h1><?= $pro->nombre ?></h1>
    <div id="detail-product">
        <div class="imagen">
            <?php if ($pro->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" alt="<?= $pro->descripcion ?>">
            <?php else : ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="<?= $pro->descripcion ?>">
            <?php endif; ?>
        </div>
        <div class="data">
            <h2><?= $pro->descripcion ?></h2>
            <h3>
                <?php
                $categoria = Utils::getCategoryById($pro->categoria_id);
                while ($cat = $categoria->fetch_object()) {
                    echo $cat->nombre;
                }
                ?>
            </h3>
            <p><?= $pro->precio ?></p>

            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
        </div>

    </div>

<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>