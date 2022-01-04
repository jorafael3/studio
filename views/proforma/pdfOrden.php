<?php

require_once("libs/database.php");

$con = new Database();
$pr = "No Name";
if ($con->connect()) {
	$pr = "conec";
	$query = $con->connect()->prepare("SELECT * FROM studio.settings");

	if ($query->execute()) {
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$titulo = $result[0]["Titulo_pr"];
		$correo = $result[0]["correo"];
		$telefono1 = $result[0]["telefono1"];
		$telefono2 = $result[0]["telefono2"];
		$direccion = $result[0]["direccion"];
		$pie = $result[0]["pie_orden"];

		$logo_orden = $result[0]["logo_orden"];
		$img_orden = $result[0]["img_orden"];

	} else {
		$err = $query->errorInfo();
		echo $err;
	}
} else {
	$pr = "No name";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/bootstrap.min.css" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/icons.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/app.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/dark-header.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/custom.css" />
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>

    <style>
        .center {
            margin: auto;
            width: 50%;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="row" id="CardOrdenCliente" style="display: none;">
        <div class="card col-xl-12 bordered">
            <div class="card-body">
                <div class="invoice">
                    <div>
                        <div class="row">
                            <div class="col">
                                <a href="javascript:;">
                                    <img src="<?php echo constant('URL').$logo_orden ?>" width="80" alt="" />
                                </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name font-weight-bolder">
                                    <a class="text-red" target="_blank" href="javascript:;">
                                        <?php echo $titulo ?>
                                    </a>
                                </h2>
                                <div> <?php echo $direccion ?></div>
                                <div> <?php echo $telefono1." - ".$telefono2 ?></div>
                                <div> <?php echo $correo ?></div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-danger" style="height: 1px;">
                    <div class=" card-body col-xl-12" style="height: 346mm; size: A4; background:url(../<?php echo $img_orden ?>);background-size: cover;">
                        <div class="row">
                            <div class="col-sm-12" style="text-align: right;">
                                <span id="NumOrdenImp" class="font-weight-bolder" style="font-size: 18px;" >Orden#: 00000000028</span><br>
                                <span id="Fechaprint" class="font-weight-bolder" style="font-size: 14px;">Fecha: 2021-11-15</span>
                            </div>

                            <div class="col-12">
                                <br><br><br><br><br><br><br><br><br><br>
                                <div class="col-12" style="margin: auto; width: 75%; padding: 10px;">
                                    <span class="font-weight-bolder" style="font-size: 18px;" id="txtOrdenIm">Para: superexitos</span>
                                </div>
                                <div class="col-12" style="margin: auto; width: 75%; padding: 10px;">
                                    <span class="font-weight-bolder" style="font-size: 18px;" id="txtTituloIm">Titulo: superexitos</span>
                                </div>
                                <div class="col-12" style="margin: auto; width: 75%; padding: 10px;  text-align: justify; text-justify: inter-word;">
                                    <span id="txtDescIMp" style="font-size: 16px;">it is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer><?php echo $pie ?></footer>
                </div>
            </div>
        </div>
    </div>

</body>

</html>