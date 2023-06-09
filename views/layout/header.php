<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css">
</head>
<body>
    <div id="container">
    
  
        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">
                    Tienda de camisetas
                </a>
            </div>
        </header>
        <!-- MENU -->
        <nav id="menu">
            <?php $categorias = Utils::getCategoriasMenu()?>
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object()):?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>
                <?php endwhile;?>
            </ul>
        </nav>