<h1>Gestionar categorias</h1>

<a href="<?=base_url?>producto/crear" class="button button_small">Crear producto</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
    <strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'fail'):?>
    <strong class="alert_red">El producto no se ha registrado</strong>
<?php endif;?>
<?php Utils::deleteSession('producto');?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'):?>
    <strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'fail'):?>
    <strong class="alert_red">El producto no se ha borrado</strong>
<?php endif;?>
<?php Utils::deleteSession('delete');?>

<table >
    <tr>
        <th>
            ID
        </th>
        <th>
            NOMBRE
        </th>
        <th>
            DESCRIPCION
        </th>
        <th>
            PRECIO
        </th>
        <th>
            STOCK
        </th>
        <th>
            CATEGORIA
        </th>
        <th>
            ACCIONES
        </th>
        
    </tr>
    <?php while($pro = $productos->fetch_object()):?>
        <tr>
            <td>
                <?=$pro->id;?>
            </td>
            <td>
                <?=$pro->nombre;?>
            </td>
            <td>
                <?=$pro->descripcion;?>
            </td>
            <td>
                <?=$pro->precio;?>
            </td>
            <td>
                <?=$pro->stock;?>
            </td>
            <td>
                <?php 
                    $categoria =Utils::getCategoryById($pro->categoria_id);
                    while ($cat = $categoria->fetch_object()){
                        echo $cat->nombre;
                    }
                ?>
            </td>
            <td>
                <a href="<?=base_url?>/producto/editar&id=<?=$pro->id?>" class="button button_small">Editar</a>
                <a href="<?=base_url?>/producto/eliminar&id=<?=$pro->id?>" class="button button_small button_red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile;?>
</table>