<?php 
require_once "models/Pedido.php";
     class PedidoController{
        public function hacer(){
            require_once "views/pedido/hacer.php";
        }
        public function add(){
            if(isset($_POST) && isset($_SESSION['identity']) && isset($_SESSION['carrito'])){
                $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
                $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
                $dirreccion = isset($_POST['dirreccion']) ? $_POST['dirreccion'] : false;
                $usuario_id = $_SESSION['identity']->id;
                $stats = Utils::statsCarrito();
                $coste = $stats['total'];
                if($provincia && $localidad && $dirreccion){
                    $pedido = new Pedido();
                    $pedido->setProvincia($provincia);
                    $pedido->setLocalidad($localidad);
                    $pedido->setDirreccion($dirreccion);
                    $pedido->setCoste($coste);
                    $pedido->setUsuario_id($usuario_id);
                    $save = $pedido->save();
                    if($save){
                        $linea = $pedido->save_line();
                        if($linea){
                            Utils::deleteSession('carrito');
                            $_SESSION['pedido'] = 'complete';
                        }else{
                            $_SESSION['pedido'] = 'fail';
                        }
                        
                    }else{
                        $_SESSION['pedido'] = 'fail';
                    }
                }else{
                        $_SESSION['pedido'] = 'fail';
                    }
            }else{
                $_SESSION['pedido'] = 'fail';
            }
            header('Location: ' . base_url . 'pedido/confirmado' );
        }
        public function confirmado(){
            if(isset($_SESSION['identity'])){
                $usuario_id = $_SESSION['identity']->id;
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $ped = $pedido->getByUserId();
                
                $producto = new Pedido();
                $productos = $producto->getProductsPedido($ped->id);
                require_once 'views/pedido/confirmado.php';
            }else{
                header('Location: ' . base_url);
            }
           
        }
        public function mis_pedidos(){
            Utils::isUser();
            $usuario_id = $_SESSION['identity']->id;
            $pedido = new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedidos = $pedido->getAllByUser();
            require_once 'views/pedido/mis_pedidos.php';
        }
        public function detalles(){
            Utils::isUser();
            if(isset($_GET['id'])){
                $pedido_id = $_GET['id'];
                $producto = new Pedido();
                $productos = $producto->getProductsPedido($pedido_id);
                $pedido = new Pedido();
                $pedido->setId($pedido_id);
                $ped = $pedido->getById();
                require_once 'views/pedido/detalles.php'; 
            }else{
                header("Location: ".base_url);
            }
        }
        public function gestion(){
            Utils::isAdmin();
            $gestion = true;

            $pedido = new Pedido();
            $pedidos = $pedido->getAll();
            require_once 'views/pedido/mis_pedidos.php';
        }
        public function estado(){
            Utils::isAdmin();
            if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
                $pedido_id = $_POST['pedido_id']; 
                $estado = $_POST['estado'];
                // 
                if($estado){
                    $update = new Pedido();
                    $update->setId($pedido_id);
                    $update->setEstado($estado);
                    $confirm = $update->updateOne();
                    if($confirm){
                        $_SESSION['estado'] = "updated";
                    }else{
                        $_SESSION['estado'] = "fail";
                    }
                    header("Location: ".base_url . "pedido/detalles&id=".$pedido_id);
                }else{
                    $_SESSION['estado'] = "fail";
                    header("Location: ".base_url . "pedido/detalles&id=".$pedido_id);
                }
            }else{
                header("Location: ".base_url);
            }
        }
        
    }
?>