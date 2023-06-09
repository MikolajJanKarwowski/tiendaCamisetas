<?php if(isset($gestion)):?>
<h1>Gestionar Pedidos</h1>
<?php else:?>
    <h1>Mis Pedidos</h1>
<?php endif;?>
<table>
    <tr>
        <th>
            ID
        </th>
        <th>
            COSTE
        </th>
        <th>
            FECHA
        </th>
        <th>
            ESTADO
        </th>
    </tr>
    <?php while ($ped = $pedidos->fetch_object()) : ?>

        <tr>
            <td>
               <a href="<?=base_url . "pedido/detalles&id=".$ped->id?>"><?= $ped->id ?></a> 
            </td>
            <td>
                <?= $ped->coste ?>
            </td>
            <td>
                <?= $ped->fecha ?>
            </td>
            <td>
            <?= Utils::showStatus($ped->estado) ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
