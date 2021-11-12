<?php


class Productos extends Controller{

    function __construct(){
       
        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render(){
            $this->view->render('productos/index');
    }

    function Productos(){
        $this->render();
    }

    function NuevoProducto()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->NuevoProducto($b,1);
    }
    function ActualizarProducto()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->NuevoProducto($b,2);
    }

    function ListarProducto()
    {
        $b = json_decode(file_get_contents("php://input"), true);
        $log = $this->model->ListarProducto($b);
    }



    
}


?>