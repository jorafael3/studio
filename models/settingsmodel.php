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

    function GuardarImagen($parametros)
    {
        echo json_encode($parametros);
        exit();
    }
}
