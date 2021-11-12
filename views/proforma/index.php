<?php



$urlNuevoProducto = constant('URL') . "Productos/NuevoProducto/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlActualizarProd = constant('URL') . "Productos/ActualizarProducto/";




require 'views/header.php'; ?>
<?php require 'funciones/Proformajs.php'; ?>

<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3 font-weight-bolder">Proforma</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Proforma</li>
            </ol>
        </nav>
    </div>
</div>

<?php require 'views/footer.php'; ?>
