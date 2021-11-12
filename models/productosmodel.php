<?php
class ProductosModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function guardar($parametros)
    {
        echo json_encode($parametros);
        exit();
    }

    function NuevoProducto($parametros,$tipo)
    {
        $nombre = $parametros["nombre"];
        $descripcion = $parametros["descripcion"];
        $precio = $parametros["precio"];
        $medida = $parametros["medida"];
        $estado = $parametros["estado"];
        $id = $parametros["id"];

        $tipo = $tipo;
        $bandera = false;
        try {

        
                $query = $this->db->connect()->prepare("CALL studio.PRODUCTOS (?,?,?,?,?,?,?)");
                $query->bindParam(1, $nombre, PDO::PARAM_STR);
                $query->bindParam(2, $descripcion, PDO::PARAM_STR);
                $query->bindParam(3, $precio, PDO::PARAM_STR);
                $query->bindParam(4, $medida, PDO::PARAM_STR);
                $query->bindParam(5, $estado, PDO::PARAM_STR);
                $query->bindParam(6, $tipo, PDO::PARAM_STR);
                $query->bindParam(7, $id, PDO::PARAM_STR);

                if ($query->execute()) {

                    $bandera = true;
                    echo json_encode($bandera);
                    exit();
                } else {
                    $err = $query->errorInfo();
                    echo json_encode($err);
                    exit();
                }
            
            //return $parametros;
        } catch (PDOException $e) {
            print_r($e);
        }
    }


    function ListarProducto()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.productos");
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $c = 0;
                /* foreach ($result as $row) {
                    $productos["cedula"] = $row['cli_ruc'];
                    $productos["nombre"] = $row['cli_name'];
                    $productos["email"] = $row['cli_email'];
                    $productos["dir"] = $row['cli_dir'];
                    $productos["telf"] = $row['cli_telf'];
                    $productos["estado"] = $row['cli_estado'];
                    $items[$c] = $productos;
                    $c = $c + 1;
                }*/
                echo json_encode($result);
                exit();
                $bandera = true;
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }
}
