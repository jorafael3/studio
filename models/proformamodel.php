<?php
class ProformaModel extends Model
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

    function CrearNuevoCliente($parametros)
    {
        $cedula = $parametros["ruc"];
        $nombre = $parametros["nombre"];
        $correo = $parametros["correo"];
        $direccion = $parametros["direccion"];
        $telefono = $parametros["telefono"];
        $whatsapp = $parametros["whatsapp"];
        $estado = $parametros["estado"];
        $creador = $parametros["creador"];
        $tipo = 1;
        $id_cliente = "1";

        $bandera = false;
        try {

            $ok = $this->validarCedulaExiste($cedula);
            if ($ok == "ok") {
                $query = $this->db->connect()->prepare("CALL studio.CLIENTES (?,?,?,?,?,?,?,?,?,?)");
                $query->bindParam(1, $nombre, PDO::PARAM_STR);
                $query->bindParam(2, $cedula, PDO::PARAM_STR);
                $query->bindParam(3, $correo, PDO::PARAM_STR);
                $query->bindParam(4, $telefono, PDO::PARAM_STR);
                $query->bindParam(5, $whatsapp, PDO::PARAM_STR);
                $query->bindParam(6, $direccion, PDO::PARAM_STR);
                $query->bindParam(7, $estado, PDO::PARAM_STR);
                $query->bindParam(8, $creador, PDO::PARAM_STR);
                $query->bindParam(9, $tipo, PDO::PARAM_STR);
                $query->bindParam(10, $id_cliente, PDO::PARAM_STR);


                if ($query->execute()) {

                    $bandera = true;
                    echo json_encode($bandera);
                    exit();
                } else {
                    $err = $query->errorInfo();
                    echo json_encode($err);
                    exit();
                }
            } else {
                $ex = 0;
                echo json_encode($ex);
                exit();
            }
            //return $parametros;
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    function validarCedulaExiste($cedula)
    {
        try {
            $query = $this->db->connect()->prepare("select ruc from studio.clientes i where ruc = '" . $cedula . "'");
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) == 0) {
                    return "ok";
                } else {
                    return "err";
                }
            } else {
                $err = $query->errorInfo();
                return $err;
            }

            //return $parametros;
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }


    function ActualizarCliente($parametros)
    {
        $cedula = $parametros["ruc"];
        $nombre = $parametros["nombre"];
        $correo = $parametros["correo"];
        $direccion = $parametros["direccion"];
        $telefono = $parametros["telefono"];
        $whatsapp = $parametros["whatsapp"];
        $estado = $parametros["estado"];
        $creador = $parametros["creador"];
        $tipo = 2;
        $id_cliente =  $parametros["id"];
        $bandera = false;

        try {

            $query = $this->db->connect()->prepare("CALL studio.CLIENTES (?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $nombre, PDO::PARAM_STR);
            $query->bindParam(2, $cedula, PDO::PARAM_STR);
            $query->bindParam(3, $correo, PDO::PARAM_STR);
            $query->bindParam(4, $telefono, PDO::PARAM_STR);
            $query->bindParam(5, $whatsapp, PDO::PARAM_STR);
            $query->bindParam(6, $direccion, PDO::PARAM_STR);
            $query->bindParam(7, $estado, PDO::PARAM_STR);
            $query->bindParam(8, $creador, PDO::PARAM_STR);
            $query->bindParam(9, $tipo, PDO::PARAM_STR);
            $query->bindParam(10, $id_cliente, PDO::PARAM_STR);


            if ($query->execute()) {

                $bandera = true;
                // $ok = $this->validarCedulaExiste($cedula);
                echo json_encode($bandera);
                exit();
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
                // print_r($query->errorInfo());
            }
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    function consultarClientes()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.Clientes");
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
                $bandera = true;
            } else {
                $err = $query->errorInfo();
                return $err;

            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }
    function consultarClientesDetalle($parametros)
    {
        $id =$parametros["id"];
        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.Clientes WHERE id_cliente = :id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
                exit();
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
