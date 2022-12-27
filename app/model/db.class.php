<?php
class BaseDeDatos{
    protected $conexion;
    protected $isConnected=false;
    //metodo que conecta con mi base de datos
    public function conectar()
    {
        $this->conexion=new mysqli("localhost","root","Zazque0.","pedidos");
        if ($this->conexion->connect_errno) {
            echo "Error de conexion:{$this->conexion->connect_errno}";
            $this->isConnected=false;
        }else{
            $this->isConnected=true;

        }
        return $this->isConnected;
    }
    //metodo para ejecutar consultas SELECT
    public function executeQuery($consulta)
    {
        $result=$this->conexion->query($consulta);
        $records=array();
        while ($record=$result->fetch_assoc()) {
            $records[]=$record;
            
        }
        return $records;
    }
    //metodo para ejecutar consultas INSERT
    public function executeInsert($consulta)
    {
        $result=$this->conexion->query($consulta);
        return $this->conexion->insert_id;
    }
    //metodo para ejecutar consultas UPDATE
    public function executeUpdate($consulta)
    {
        $result=$this->conexion->query($consulta);
        return true;
    }

    
}
?>