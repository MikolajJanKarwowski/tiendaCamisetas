<?php 
    require_once "models/Producto.php";
    class CarritoController{
        public function index(){
            if(!isset($_SESSION['carrito'])){
                $carrito = [];
            }else{
                $carrito = $_SESSION['carrito'];
            }
            
            require_once 'views/carrito/index.php';
        }
        public function add(){
            if(isset($_GET['id'])){
                $producto_id = $_GET['id'];
                if(isset($_SESSION['carrito'])){
                    $counter = 0;
                    foreach($_SESSION['carrito'] as $indice => $elemento){
                        if($elemento['id_producto'] == $producto_id){
                            $_SESSION['carrito'][$indice]['unidades']++;
                            $counter++;
                        }
                    }
                }
                if(!isset($counter) || $counter == 0){
                    $producto = new Producto();
                    $producto->setId($producto_id);
                    $pro = $producto->getById();
                    if(is_object($pro)){
                        $_SESSION['carrito'][] = array(
                            'id_producto' => $producto_id,
                            'precio' => floatval($pro->precio),
                            'unidades' => 1,
                            'producto' => $pro
                        ); 
                       
                    }
                }
                header('Location: '. base_url . 'carrito/index'); 
            }else{
                header("Location: " . base_url);
            }

            
        }
        public function delete(){
            if(isset($_GET['id'])){
                
                unset($_SESSION['carrito'][$_GET['id']]);
            }
            header('Location: '. base_url . 'carrito/index'); 
        }
        public function delete_all(){
            if(isset($_SESSION['carrito'])){
                unset($_SESSION['carrito']);
            }
            header('Location: '. base_url . 'carrito/index'); 
        }
        public function up(){
            if(isset($_GET['id'])){
                
                $_SESSION['carrito'][$_GET['id']]['unidades']++;
            }
            header('Location: '. base_url . 'carrito/index'); 
        }
        public function down(){
            if(isset($_GET['id'])){
                $unidades = $_SESSION['carrito'][$_GET['id']]['unidades']--; 
                if($unidades  <= 1){
                    unset($_SESSION['carrito'][$_GET['id']]);
                } 
                
            }
            header('Location: '. base_url . 'carrito/index'); 
        }
    }
?>