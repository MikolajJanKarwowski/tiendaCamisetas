<?php if(isset($edit) && isset($pro) && is_object($pro)):?>
    <h1>Editar producto <?=$pro->nombre?></h1>
    <?php
    $url_action = base_url."producto/edit&id=".$pro->id;
    ?>
<?php else:?>
<h1>Crear nuevos productos</h1>
<?php
    $url_action = base_url."producto/save";
?>
<?php endif;?>

<form action="<?=$url_action?>" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ""?>">

    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" id="" cols="30" rows="10"  ><?=isset($pro) && is_object($pro) ? $pro->descripcion : ""?></textarea>

    <label for="precio">Precio</label>
    <input type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ""?>">

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ""?>">

    <label for="categoria">Categoria</label>
    <?php $categorias = Utils::getCategoriasMenu()?>
    
    <select name="categoria" id="">
        
        <?php while($cat = $categorias->fetch_object()):?>
            <option value="<?=$cat->id?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? "selected" : ""?>>
            <?=$cat->nombre?>
        </option>
        <?php endwhile;?>
    </select>
    
    <label for="imagen">Imagen</label>
    <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)):?>
        <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="">
    <?php endif;?>
    <input type="file" name="imagen">

    <input type="submit" value="Guardar productos">
</form>