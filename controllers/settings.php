<?php


class Settings extends Controller
{

    function __construct()
    {

        parent::__construct();
        //$this->view->render('principal/index');
        //echo "nuevo controlaodr";
    }
    function render()
    {
        $this->view->render('settings/settings');
    }
    function Settings()
    {
        $set =  $this->model->Get_settings();
        $this->view->set = $set;
        $this->render();
    }

    function GuardarImg()
    {
        if (($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "image/gif")
        ) {
            $destination_folder = $_SERVER['DOCUMENT_ROOT'].'/studio/public/assets/images/';
            $fileName = $_FILES['file']['name'];

            //echo $destination_folder;
            chmod($destination_folder, 0755);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $destination_folder . $fileName)) {

                $log = $this->model->GuardarImagen($fileName);

            } else {
                echo 0;
            }
            //$log = $this->model->GuardarImagen("adsd");
        }

        /*if (isset($_POST["id"])) {
            $nombre = $_POST['files'];
            $log = $this->model->GuardarImagen("adsd");
        }*/
    }
}
