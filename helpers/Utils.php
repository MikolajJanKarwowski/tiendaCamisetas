<?php 
    class Utils{
        
        public static function  deleteSession($name){
            if(isset($_SESSION[$name])){
                $_SESSION[$name] = null;
                unset($_SESSION[$name]);
            }
            return $name;
        }
        public static function isAdmin(){
            if(!isset($_SESSION['admin'])){
                header("Location: ".base_url);
            }else{
                return true;
            }
        }
        public static function isUser(){
            if(!isset($_SESSION['identity'])){
                header("Location: ".base_url);
            }else{
                return true;
            }
        }
        public static function getCategoriasMenu(){
            require_once 'models/Categoria.php';
            $categoria = new Categoria();
            $categorias = $categoria->getAll();
            return $categorias;
        }
        public static function getCategoryById($id){
            $categoria =  Database::connect()->query("SELECT nombre from categorias WHERE id =". intval($id));
            return $categoria;
        }
        public static function statsCarrito(){
            $stats = array(
                'count' => 0,
                'total' => 0
            );
            if(isset($_SESSION['carrito'])){
                $stats['count'] = count($_SESSION['carrito']);
                foreach($_SESSION['carrito'] as $indice => $value){
                    $producto = $value['producto'];
                    $stats['total'] = (floatval(floatval($producto->precio) * floatval($value['unidades']))) + $stats['total'];
                }
            }
            return $stats;
        }
        public static function showStatus($status){
            $value = 'Pendiente';
            if($status == "confirm" || $status == "confimated"){
                $value = "Pendiente";
            }elseif($status == "preparation"){
                $value = "En preparacion";
            }elseif($status == "ready"){
                $value = "Preparado";
            }elseif($status == "sended"){
                $value = "Enviado";
            }
            return $value;
        }
    }
?>