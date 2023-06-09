<?php 
    require_once "models/Usuario.php";
    require_once "helpers/Utils.php";
    class UsuarioController{
        public function index(){
            echo "Controlador usuarios index";
        }
        public function registro(){
            require_once "views/usuario/registro.php";
        }

        public function save(){
            if(isset($_POST)){
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] :false;
                $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] :false;
                $email = isset($_POST['email']) ? $_POST['email'] :false;
                $password = isset($_POST['password']) ? $_POST['password'] :false;



                if($nombre && $apellidos && $email && $password){
                    $usuario = new Usuario();
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
                    $save = $usuario->save();
                    if($save){
                        $_SESSION['register'] = "complete";
                    }else{
                        $_SESSION['register'] = "fail";
                    }
                }else{
                    $_SESSION['register'] = "fail"; 
                }
               
                
            }else{
                $_SESSION['register'] = "fail";
            }
            header('Location:'.base_url.'Usuario/registro');
        }
        public function login(){
            if(isset($_POST)){
                //identificar usuario
                //crear query
                $usuario = new Usuario();
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['password']);
                $identity = $usuario->login();
                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;
                    if($identity->rol == 'admin'){
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login'] = "Identificacion fallida";
                }
            }
            header("Location:".base_url);
        }
        public function logOut(){
            Utils::deleteSession('identity');
            Utils::deleteSession('admin');
            header("Location:".base_url);
        }
    }
?>