<?php

require 'views/header.php';
require 'funciones/settingsjs.php';


$sett = $this->set;

$empresa = $sett[0]["Titulo_pr"];
$direccion = $sett[0]["direccion"];
$correo = $sett[0]["correo"];
$telefono1 = $sett[0]["telefono1"];
$telefono2 = $sett[0]["telefono2"];
$logo_p = $sett[0]["logo_p"];
$logo_orden = $sett[0]["logo_orden"];
$img_orden = $sett[0]["img_orden"];
$pie_orden = $sett[0]["pie_orden"];


?>
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3 font-weight-bolder">Ajustes</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Ajustes</li>
            </ol>
        </nav>
    </div>
</div>


<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card radius-15">
            <div class="card-header border-bottom-0">

            </div>
            <div class="card-body">
                <div class="d-lg-flex align-items-end">
                    <form class="needs-validation" novalidate onsubmit="return false">
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Nombre Empresa</span>
                                </div>
                                <input value="<?php echo $empresa ?>" required id="nombre" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span style="width: 150px;" class="input-group-text" id="basic-addon1">direccion</span>
                                </div>
                                <input value="<?php echo $direccion ?>" required id="direccion" type="text"class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span style="width: 150px;" class="input-group-text" id="basic-addon1">Correo </span>
                                </div>
                                <input value="<?php echo $correo ?>" required id="correo" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span style="width: 150px;" class="input-group-text" id="basic-addon1">Telefono 1 </span>
                                </div>
                                <input value="<?php echo $telefono1 ?>" required id="tel1"  type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span style="width: 150px;" class="input-group-text" id="basic-addon1">Telefono 2</span>
                                </div>
                                <input value="<?php echo $telefono2 ?>" required id="tel2"  type="text"class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Orden Pie de pagina</span>
                                </div>
                                <input value="<?php echo $pie_orden ?>" autocomplete="off" required id="pie" min="0" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="input-group mb-3">

                                <button onclick="ValidarSett()" class="btn btn-success"> Actualizar</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">

        <div class="card radius-15">
            <div class="d-lg-flex align-items-end">

                <div class="card-body col-6">
                    <div class="card">
                        <img id="FondoImg" class="card-img-top" style="width: 200px; height: 200px; border: 1px solid gray" src="<?php echo constant("URL") . $img_orden ?>">
                        <div class="card-body">
                            <form method="post" action="#" enctype="multipart/form-data">

                                <h5 class="card-title">Imagen fondo Orden</h5>
                                <p class="card-text">Sube una imagen...</p>
                                <div class="form-group">
                                    <label for="image">Nueva imagen</label>
                                    <input type="file" class="form-control-file" name="image" id="imageFondo">
                                </div>
                                <input onclick="SubirFondo()" type="button" class="btn btn-primary upload" value="Subir">
                            </form>

                        </div>
                    </div>
                    </ul>
                </div>
                <div class="card-body col-6">
                    <div class="card">
                        <img id="LogoImg"class="card-img-top" style="width: 200px; height: 200px;border: 1px solid gray" src="<?php echo constant("URL") . $logo_orden ?>">
                        <div class="card-body">
                            <form method="post" action="#" enctype="multipart/form-data">
                                <h5 class="card-title">Logo</h5>
                                <p class="card-text">Sube una imagen...</p>
                                <div class="form-group">
                                    <label for="image">Nueva imagen</label>
                                    <input type="file" class="form-control-file" name="image" id="imageLogo">
                                </div>
                                <input onclick="SubirLogo()" type="button" class="btn btn-primary upload" value="Subir">
                            </form>
                        </div>
                    </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <?php require 'views/footer.php'; ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
