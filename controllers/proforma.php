<?php


class Proforma extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
        $this->view->render('Proforma/Index');
    }

    function proforma()
    {
        $clientes =  $this->model->consultarClientes();
        $this->view->client = $clientes;
        $this->render();
    }

    function DatosClientes()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->consultarClientesDetalle($b);
    }
}
