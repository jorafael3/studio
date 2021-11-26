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
        $id = $parametros["id"];
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
    function consultarNunOrden()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("select max(id_cab) as n from studio.proforma_cab");
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $result = $result[0]["n"];
                if ($result == null) {
                    $result = 1;
                } else {
                    $result = $result + 1;
                }
                $nunOrden = 0;
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



    function GuardarProformaCab($parametros)
    {
        $nombre = $parametros["nombre"];
        $subtotal = $parametros["subtotal"];
        $margen = $parametros["margen"];
        $ganancia = $parametros["ganancia"];
        $total = $parametros["total"];
        $id = "1";

        $tipo = 1;
        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("CALL studio.PROFORMA_CAB (?,?,?,?,?,?,?)");
            $query->bindParam(1, $nombre, PDO::PARAM_STR);
            $query->bindParam(2, $subtotal, PDO::PARAM_STR);
            $query->bindParam(3, $margen, PDO::PARAM_STR);
            $query->bindParam(4, $ganancia, PDO::PARAM_STR);
            $query->bindParam(5, $total, PDO::PARAM_STR);
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
    function GuardarProformaDet($parametros)
    {
        $id_cab = $parametros["id_cab"];
        $cant = $parametros["cant"];
        $total = $parametros["total"];
        $id_prod = $parametros["id_prod"];
        $tipo = 1;
        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("CALL studio.PROFORMA_DET (?,?,?,?,?)");
            $query->bindParam(1, $id_cab, PDO::PARAM_STR);
            $query->bindParam(2, $cant, PDO::PARAM_STR);
            $query->bindParam(3, $total, PDO::PARAM_STR);
            $query->bindParam(4, $id_prod, PDO::PARAM_STR);
            $query->bindParam(5, $tipo, PDO::PARAM_STR);
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


    function CargarPlantillas()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.proforma_cab");
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

    function CargarPlantillasDetallesCab($parametros)
    {
        $id_cab = $parametros["id"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.proforma_cab WHERE id_cab = :id");
            $query->bindParam(":id", $id_cab, PDO::PARAM_STR);

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


    function CargarPlantillasDetallesDet($parametros)
    {
        $id_cab = $parametros["id"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("select 
            pd.id_prod, pd.id_det,
            p.nombre,
            p.descripcion,
            p.medida,p.precio,pd.cantidad,pd.total 
            from studio.proforma_det pd 
            left join studio.productos p 
            on p.id_prod = pd.id_prod
            where id_cab = :id");
            $query->bindParam(":id", $id_cab, PDO::PARAM_STR);

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




    function UpdateProformaCab($parametros)
    {
        $nombre = $parametros["nombre"];
        $subtotal = $parametros["subtotal"];
        $margen = $parametros["margen"];
        $ganancia = $parametros["ganancia"];
        $total = $parametros["total"];
        $id = $parametros["id_cab"];

        $tipo = 2;
        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("CALL studio.PROFORMA_CAB (?,?,?,?,?,?,?)");
            $query->bindParam(1, $nombre, PDO::PARAM_STR);
            $query->bindParam(2, $subtotal, PDO::PARAM_STR);
            $query->bindParam(3, $margen, PDO::PARAM_STR);
            $query->bindParam(4, $ganancia, PDO::PARAM_STR);
            $query->bindParam(5, $total, PDO::PARAM_STR);
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

    function UpdateProformaDet($parametros)
    {
        $id_cab = $parametros["id_cab"];
        $cant = $parametros["cant"];
        $total = $parametros["total"];
        $id_prod = $parametros["id_prod"];
        $tipo = 2;
        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("CALL studio.PROFORMA_DET (?,?,?,?,?)");
            $query->bindParam(1, $id_cab, PDO::PARAM_STR);
            $query->bindParam(2, $cant, PDO::PARAM_STR);
            $query->bindParam(3, $total, PDO::PARAM_STR);
            $query->bindParam(4, $id_prod, PDO::PARAM_STR);
            $query->bindParam(5, $tipo, PDO::PARAM_STR);
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


    //******          CLIENTES FACT */

    function consultarNunOrdenCliente()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("select max(id_fact) as n from studio.factura");
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $result = $result[0]["n"];
                if ($result == null) {
                    $result = 1;
                } else {
                    $result = $result + 1;
                }
                $nunOrden = 0;
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

    function Guardarfactura($parametros)
    {
        $id_cli = $parametros["ordencli"];
        $id_prof = $parametros["ordenProf"];
        $nom = $parametros["NombreOrden"];
        $descrip = $parametros["Descripcion"];
        $id = "1";

        $tipo = 1;
        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("CALL studio.FACTURAS (?,?,?,?,?)");
            $query->bindParam(1, $id_prof, PDO::PARAM_STR);
            $query->bindParam(2, $id_cli, PDO::PARAM_STR);
            $query->bindParam(3, $nom, PDO::PARAM_STR);
            $query->bindParam(4, $descrip, PDO::PARAM_STR);
            $query->bindParam(5, $tipo, PDO::PARAM_STR);

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

    function OrdenesAsociadasAProf($parametros)
    {
        $id_fact = $parametros["id_fact"];
        $id_cliente = $parametros["id_cliente"];


        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.factura 
            WHERE id_cab = :id_fact and id_cliente = :id_cliente");
            $query->bindParam(":id_fact", $id_fact, PDO::PARAM_STR);
            $query->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);


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

    function ActualizarFactura($parametros)
    {
        $id_cli = "1";
        $id_cab = $parametros["id_fact"];
        $nom = $parametros["nombre"];
        $descrip = $parametros["descripcion"];
        $id = "1";

        $tipo = 2;
        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("CALL studio.FACTURAS (?,?,?,?,?)");
            $query->bindParam(1, $id_cab, PDO::PARAM_STR);
            $query->bindParam(2, $id_cli, PDO::PARAM_STR);
            $query->bindParam(3, $nom, PDO::PARAM_STR);
            $query->bindParam(4, $descrip, PDO::PARAM_STR);
            $query->bindParam(5, $tipo, PDO::PARAM_STR);

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

    function CargarPlantillaORden($parametros)
    {
        $id_cli = "1";
        $id = $parametros["id_fact"];

        $bandera = false;
        try {
            $query = $this->db->connect()->prepare("SELECT * FROM studio.factura where id_fact = :id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                $bandera = true;
                echo json_encode($result);
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
}
