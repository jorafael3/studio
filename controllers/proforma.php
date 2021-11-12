<?php


class Proforma extends Controller{

    function __construct(){
       
        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render(){
            $this->view->render('Proforma/Index');
    }

    function proforma(){
        $this->render();
    }


    
}


?>