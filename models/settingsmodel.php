<?php
class SettingsModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function Get_settings()
    {
        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.settings");
            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return ($result);
                $bandera = true;
            } else {
                $err = $query->errorInfo();
                return ($err);
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
    }

    function GuardarImagen($parametros, $tipo)
    {
        $logo = "public/assets/images/".$parametros;
        if ($tipo == 1) {
            $campo = "logo_orden";
        } else {
            $campo = "img_orden";
        }
        try {
            $items = [];
            $query = $this->db->connect()->prepare("UPDATE studio.settings
            SET 
            ".$campo." = '" . $logo . "'");

            if ($query->execute()) {
                echo json_encode($parametros);
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

    function ActualizarSett($parametros)
    {
        $nombre = $parametros["nombre"];
        $direccion = $parametros["direccion"];
        $correo = $parametros["correo"];
        $tel1 = $parametros["tel1"];
        $tel2 = $parametros["tel2"];
        $pie = $parametros["pie"];
        $nombreUsu = $parametros["nombreUsu"];

        try {
            $items = [];
            $query = $this->db->connect()->prepare("UPDATE studio.settings
            SET 
            usuario = '" . $nombreUsu . "',
            Titulo_pr = '" . $nombre . "',
            direccion = '" . $direccion . "',
            correo = '" . $correo . "',
            telefono1 = '" . $tel1 . "',
            telefono2 = '" . $tel2 . "',
            pie_orden = '" . $pie . "'
            ");

            if ($query->execute()) {
                echo json_encode(true);
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
