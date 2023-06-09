
    <h1>Productos destacados</h1>
    
   
    <?php while($pro = $productos->fetch_object()):?>
    <div class="product">
        
        <?php if($pro->imagen != null):?>
            <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" alt="<?=$pro->descripcion?>">
        <?php else:?>
            <img src="<?=base_url?>assets/img/camiseta.png" alt="<?=$pro->descripcion?>">
        <?php endif;?>
        <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>"><h2><?=$pro->nombre?></h2></a>
        <p><?=$pro->precio?></p>
        <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
    </div>
    <?php endwhile;?>
    
