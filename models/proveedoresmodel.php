<?php
class ProveedoresModel extends Model
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

    function CrearNuevoProveedor($parametros)
    {
        $nombre = $parametros["nombre"];
        $ciudad = $parametros["ciudad"];
        $telefono = $parametros["telefono"];
        $whatsapp = $parametros["whatsapp"];
        $contacto = $parametros["contacto"];
        $correo = $parametros["correo"];
        $direccion = $parametros["direccion"];
        $pagina = $parametros["pagina"];
        $observacion = $parametros["observacion"];

        $estado = $parametros["estado"];
        $creador = $parametros["creador"];
        $tipo = 1;
        $id_cliente = "1";

        $bandera = false;
        try {

            $query = $this->db->connect()->prepare("CALL studio.PROVEEDORES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $nombre, PDO::PARAM_STR);
            $query->bindParam(2, $ciudad, PDO::PARAM_STR);
            $query->bindParam(3, $telefono, PDO::PARAM_STR);
            $query->bindParam(4, $whatsapp, PDO::PARAM_STR);
            $query->bindParam(5, $contacto, PDO::PARAM_STR);
            $query->bindParam(6, $correo, PDO::PARAM_STR);
            $query->bindParam(7, $direccion, PDO::PARAM_STR);
            $query->bindParam(8, $pagina, PDO::PARAM_STR);
            $query->bindParam(9, $observacion, PDO::PARAM_STR);
            $query->bindParam(10, $estado, PDO::PARAM_STR);
            $query->bindParam(11, $creador, PDO::PARAM_STR);
            $query->bindParam(12, $tipo, PDO::PARAM_STR);
            $query->bindParam(13, $id_cliente, PDO::PARAM_STR);


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




    function ActualizarProveedor($parametros)
    {
        $nombre = $parametros["nombre"];
        $ciudad = $parametros["ciudad"];
        $telefono = $parametros["telefono"];
        $whatsapp = $parametros["whatsapp"];
        $contacto = $parametros["contacto"];
        $correo = $parametros["correo"];
        $direccion = $parametros["direccion"];
        $pagina = $parametros["pagina"];
        $observacion = $parametros["observacion"];

        $estado = $parametros["estado"];
        $creador = $parametros["creador"];
        $tipo = 2;
        $id_cliente = "1";

        $bandera = false;
        try {

            $query = $this->db->connect()->prepare("CALL studio.PROVEEDORES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $nombre, PDO::PARAM_STR);
            $query->bindParam(2, $ciudad, PDO::PARAM_STR);
            $query->bindParam(3, $telefono, PDO::PARAM_STR);
            $query->bindParam(4, $whatsapp, PDO::PARAM_STR);
            $query->bindParam(5, $contacto, PDO::PARAM_STR);
            $query->bindParam(6, $correo, PDO::PARAM_STR);
            $query->bindParam(7, $direccion, PDO::PARAM_STR);
            $query->bindParam(8, $pagina, PDO::PARAM_STR);
            $query->bindParam(9, $observacion, PDO::PARAM_STR);
            $query->bindParam(10, $estado, PDO::PARAM_STR);
            $query->bindParam(11, $creador, PDO::PARAM_STR);
            $query->bindParam(12, $tipo, PDO::PARAM_STR);
            $query->bindParam(13, $id_cliente, PDO::PARAM_STR);


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

    function consultarProveedores()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.Proveedores");
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
