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
        $plantillas =  $this->model->CargarPlantillas();
        $this->view->plant = $plantillas;
        $clientes =  $this->model->consultarClientes();
        $this->view->client = $clientes;
        $this->render();
    }

    function DatosClientes()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->consultarClientesDetalle($b);
    }

    function GuardarProformaCab()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->GuardarProformaCab($b);
    }
    function GuardarProformaDet()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->GuardarProformaDet($b);
    }


    function GetNumeroOrden()
    {
        $log = $this->model->consultarNunOrden();
    }

    function CargarPlantillasDetallesCab()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->CargarPlantillasDetallesCab($b);
    }

    function CargarPlantillasDetallesDet()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->CargarPlantillasDetallesDet($b);
    }









    function UpdateProformaCab()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->UpdateProformaCab($b);
    }

    function UpdateProformaDet()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->UpdateProformaDet($b);
    }
}
