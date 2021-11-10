<?php


class Clientes extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
        $this->view->render('clientes/nuevo');
    }

    function nuevo()
    {
        $this->render();
    }
    function ListarClientes()
    {
        $log = $this->model->consultarClientes();
    }
    function NuevoCliente()
    {
       /* if (isset($_POST["id"])) {
            $nombre = $_POST['nombre'];
            $log = $this->model->guardar($nombre);
        }*/
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->CrearNuevoCliente($b);

    }
    function ActualizarCliente()
    {

        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->ActualizarCliente($b);

    }
}
