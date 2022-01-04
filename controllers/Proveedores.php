<?php


class Proveedores extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
        $this->view->render('proveedores/nuevo');
    }

    function nuevo()
    {
        $this->render();
    }
    function ListarProveedores()
    {
        $log = $this->model->consultarProveedores();
    }
    function NuevoProveedor()
    {
       /* if (isset($_POST["id"])) {
            $nombre = $_POST['nombre'];
            $log = $this->model->guardar($nombre);
        }*/
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->CrearNuevoProveedor($b);

    }
    function ActualizarProveedor()
    {

        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->ActualizarProveedor($b);

    }
}
