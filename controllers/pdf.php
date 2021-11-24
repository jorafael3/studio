<?php


class Pdf extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    
    function GenerarPdf(){
        $b = json_decode(file_get_contents( "php://input" ), true);
        $ventas = $this->model->GenerarPdf($b);
    }
    function GenerarPdfCompra(){
        $b = json_decode(file_get_contents( "php://input" ), true);
        $ventas = $this->model->GenerarPdf2($b);
    }

    function GenerarPdfProforma(){
        $b = json_decode(file_get_contents( "php://input" ), true);
        $ventas = $this->model->GenerarPdfProforma($b);
    }
}