<?php 
    require_once "models/Producto.php";
     class ProductoController{
        public function index(){
            // sacar productos destacados
            $producto = new Producto();
            $productos = $producto->getRandom(6);
            
            require_once 'views/producto/destacados.php';
        }
        public function gestion(){
            Utils::isAdmin();
            $producto = new Producto();
            $productos = $producto->getAll();
            require_once 'views/producto/gestion.php';
        }
        public function crear(){
            Utils::isAdmin();
            require_once 'views/producto/crear.php';
        }
        public function save(){
            Utils::isAdmin();
            if(isset($_POST)){
                
                $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] :false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] :false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] :false;
                $precio = isset($_POST['precio']) ? $_POST['precio'] :false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] :false;
                //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] :false;
                if($nombre && $categoria_id && $descripcion && $precio && $stock){
                    $producto = new Producto();
                    $producto->setCategoria_id($categoria_id);
                    $producto->setNombre($nombre);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setStock($stock);

                    if(isset($_FILES['imagen'])){
                        $file = $_FILES['imagen'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];
    
                        if($mimetype == "image/jpeg" || $mimetype == "image/jpg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                            if(!is_dir("uploads/images")){
                                mkdir("uploads/images",0777,true);
                            }
                            $num = rand(1,40000);
                            $filename =$num . $filename;
                            move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
                            $producto->setImagen($filename);
                        }
    
                    }else{
                        $producto->setImagen(null);
                    }
                    
                    
                    $save = $producto->save();
                    

                    
                    if($save){
                        $_SESSION['producto'] = "complete";
                    }else{
                        $_SESSION['producto'] = "fail";  
                    }
                }else{
                    $_SESSION['producto'] = "fail";

                }

            }else{
                $_SESSION['producto'] = "fail";

            }
            header("Location: ". base_url ."producto/gestion");
        }
        public function editar(){
            Utils::isAdmin();
            
            if(isset($_GET['id'])){
                $edit = true;
                $producto = new Producto();
                $producto->setId($_GET['id']);
                $pro = $producto->getById();
                require_once "views/producto/crear.php";
            }else{
                header("Location: ". base_url ."producto/gestion");
            }
           
        }
        public function eliminar(){
           Utils::isAdmin(); 
           if(isset($_GET['id'])){
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $delete = $producto->detele();
            if($delete){
                $_SESSION['delete'] = "complete";
            }else{
                $_SESSION['delete'] = "fail";
            }
           }else{
            $_SESSION['delete'] = "fail";
            }
            header("Location: ". base_url ."producto/gestion");
        }
        public function edit(){
            Utils::isAdmin();
            if(isset($_POST) && isset($_GET['id'])){
                $id = $_GET['id'];
                $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] :false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] :false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] :false;
                $precio = isset($_POST['precio']) ? $_POST['precio'] :false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] :false;
                //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] :false;
                if($nombre && $categoria_id && $descripcion && $precio && $stock){
                    $producto = new Producto();
                    $producto->setCategoria_id($categoria_id);
                    $producto->setNombre($nombre);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setStock($stock);
                    $producto->setId($id);
                    if(isset($_FILES['imagen'])){
                        $file = $_FILES['imagen'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];
    
                        if($mimetype == "image/jpeg" || $mimetype == "image/jpg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                            if(!is_dir("uploads/images")){
                                mkdir("uploads/images",0777,true);
                            }
                            $num = rand(1,40000);
                            $filename =$num . $filename;
                            move_uploaded_file($file['tmp_name'],'uploads/images/'.$filename);
                            $producto->setImagen($filename);
                        }
    
                    }else{
                        $producto->setImagen(null);
                    }
                    
                    
                    $save = $producto->edit();
                    

                    
                    if($save){
                        $_SESSION['producto'] = "complete";
                    }else{
                        $_SESSION['producto'] = "fail";  
                    }
                }else{
                    $_SESSION['producto'] = "fail";
                }

            }else{
                $_SESSION['producto'] = "fail";

            }
            header("Location: ". base_url ."producto/gestion");
        }
        public function ver(){
             
            if(isset($_GET['id'])){
                $edit = true;
                $producto = new Producto();
                $producto->setId($_GET['id']);
                $pro = $producto->getById();
                require_once "views/producto/ver.php";
            }else{
                header("Location: ". base_url ."producto/gestion");
            }
        }
    }
?>