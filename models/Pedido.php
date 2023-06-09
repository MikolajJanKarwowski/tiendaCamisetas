<?php 
    class Pedido{
        
        private $id;
        private $usuario_id;
        private $provincia;
        private $localidad;
        private $dirreccion;
        private $coste;
        private $estado;
        private $fecha;
        private $hora;

        private $db;
        public function __construct(){
            $this->db = Database::connect();
        }


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of usuario_id
         */ 
        public function getUsuario_id()
        {
                return $this->usuario_id;
        }

        /**
         * Set the value of usuario_id
         *
         * @return  self
         */ 
        public function setUsuario_id($usuario_id)
        {
                $this->usuario_id = $usuario_id;

                return $this;
        }

        /**
         * Get the value of provincia
         */ 
        public function getProvincia()
        {
                return $this->provincia;
        }

        /**
         * Set the value of provincia
         *
         * @return  self
         */ 
        public function setProvincia($provincia)
        {
                $this->provincia = $this->db->real_escape_string($provincia);

                return $this;
        }

        /**
         * Get the value of localidad
         */ 
        public function getLocalidad()
        {
                return $this->localidad;
        }

        /**
         * Set the value of localidad
         *
         * @return  self
         */ 
        public function setLocalidad($localidad)
        {
                $this->localidad =  $this->db->real_escape_string($localidad);

                return $this;
        }

        /**
         * Get the value of dirreccion
         */ 
        public function getDirreccion()
        {
                return $this->dirreccion;
        }

        /**
         * Set the value of dirreccion
         *
         * @return  self
         */ 
        public function setDirreccion($dirreccion)
        {
                $this->dirreccion =  $this->db->real_escape_string($dirreccion);

                return $this;
        }

        /**
         * Get the value of coste
         */ 
        public function getCoste()
        {
                return $this->coste;
        }

        /**
         * Set the value of coste
         *
         * @return  self
         */ 
        public function setCoste($coste)
        {
                $this->coste =  $this->db->real_escape_string($coste);

                return $this;
        }

        /**
         * Get the value of estado
         */ 
        public function getEstado()
        {
                return $this->estado;
        }

        /**
         * Set the value of estado
         *
         * @return  self
         */ 
        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }

        /**
         * Get the value of fecha
         */ 
        public function getFecha()
        {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha)
        {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of hora
         */ 
        public function getHora()
        {
                return $this->hora;
        }

        /**
         * Set the value of hora
         *
         * @return  self
         */ 
        public function setHora($hora)
        {
                $this->hora = $hora;

                return $this;
        }


        public function getAll(){
            
            $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id desc");
            return $productos;
        }
        

        

        public function save(){
                $sql = "INSERT INTO pedidos VALUES(null,{$this->getUsuario_id()},'{$this->getProvincia()}',
                        '{$this->getLocalidad()}','{$this->getDirreccion()}',{$this->getCoste()},'confimated',curdate(),curtime())";
                $save = $this->db->query($sql);
                $result = false;
                if($save){
                        $result = true;
                }
                return $result;
        }

        public function save_line(){
                $sql = "SELECT LAST_INSERT_ID() AS 'pedido'";
                $query = $this->db->query($sql);
                $pedido_id = $query->fetch_object()->pedido;
                foreach($_SESSION['carrito'] as $indice => $elemento){
                        $producto = $elemento['producto'];
                        $sql = "INSERT INTO lineas_pedidos values(null,$pedido_id,{$producto->id},{$elemento['unidades']})";
                        $save = $this->db->query($sql);
                        if(!$save){
                                return false;
                        }
                }
                return true;
        }
       
       
        public function getById(){
            
                $productos = $this->db->query("SELECT * FROM pedidos where id = {$this->getId()}");
                return $productos->fetch_object();
        }
        public function getByUserId(){
                $sql = "Select p.id,p.coste from pedidos p where usuario_id = {$this->getUsuario_id()} order by id desc limit 1";
                $query = $this->db->query($sql);
                $result=false;
                if($query){
                        $result = $query->fetch_object();
                }
                return $result;
        }
        public function getProductsPedido($id){
                $sql = "SELECT pr.*,lp.cantidad from productos pr 
                inner join lineas_pedidos lp on pr.id = lp.producto_id where lp.pedido_id = {$id}";
                $query = $this->db->query($sql);
                $result=false;
                if($query){
                        $result = $query;
                }
                return $result;
        }
        public function getAllByUser(){
                $sql = "Select p.* from pedidos p where usuario_id = {$this->getUsuario_id()} order by id desc";
                $query = $this->db->query($sql);
                $result=false;
                if($query){
                        $result = $query;
                }
                return $result;
        }
        public function updateOne(){
                $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->getId()}";
                $query = $this->db->query($sql);
                $result=false;
                if($query){
                        $result = $query;
                }
                return $result;
        }
    }
?>