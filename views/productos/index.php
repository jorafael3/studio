<?php



$urlNuevoProducto = constant('URL') . "Productos/NuevoProducto/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlActualizarProd = constant('URL') . "Productos/ActualizarProducto/";




require 'views/header.php'; ?>
<?php require 'funciones/Productosjs.php'; ?>

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3 font-weight-bolder">Productos</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card" id="CardNuevoProducto" style="display: none;">
    <div class="card-header">
        <h5>Nuevo Producto</h5>
    </div>
    <div class="card-body">
        <form class="needs-validation" novalidate onsubmit="return false">
            <div class="row d-flex align-items-end">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="txtTelefono">Nombre / Material</label>
                            <input placeholder="lona" type="text" class="form-control" id="txtnombre" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="form-group">
                        <label for="txtRuc">Descripcion</label>
                        <textarea placeholder="4mm de 1 pulgada" type="text" class="form-control" id="txtdesc" required></textarea>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-end">

                <div class="col-md-4 col-12">
                    <label for="txtNombre">Precio unitario</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input required id="Punitario" min="0" type="text" pattern="^\d*(\.\d{0,2})?$" class="form-control" placeholder="1.00" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-sm-2 col-12">
                    <div class="form-group">
                        <div class=" custom-control-success custom-switch custom-control-inline">
                            <input onclick="" type="radio" class="custom-control-input" id="customSwitch1" name="ChekVentaT" checked />
                            <label class="custom-control-label font-weight-bolder" for="customSwitch1">Unidades
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 col-12">
                    <div class="form-group">
                        <div class=" custom-control-success custom-switch custom-control-inline">
                            <input onclick="" type="radio" class="custom-control-input" id="customSwitch2" name="ChekVentaT" />
                            <label class="custom-control-label font-weight-bolder" for="customSwitch2">Metros
                                <span class="switch-icon-left"><i data-feather="check"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!--   <div class="row d-flex align-items-end" style="display: none;">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="txtTelefono">cantidad</label>
                        <input min="1" placeholder="1" id="txtcantidad" type="number" class="form-control" id="txtTelefono" required>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <label for="txtNombre">total</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input id="txttotal" readonly min="0" type="number" class="form-control" placeholder="5.00" aria-label="Username" aria-describedby="basic-addon1">
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                </div>

            </div>-->

            <div class="row d-flex align-items-end">
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <button id="btnguardar" onclick="BtnGuardar()" class="btn btn-primary">Guardar</button>
                        <button onclick="BtnActualizar()" id="btnactualizar" onclick="" class="btn btn-warning">Actualizar</button>

                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <button onclick="BtnNUevo()" id="btnnuevo" onclick="" class="btn btn-success">Crear Nuevo</button>

                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="form-group">

                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="ListaProductos" style="width: 100%;" class="table hover tabla-clientes  table-bordered">

            </table>
        </div>
    </div>
</div>

<?php require 'views/footer.php'; ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();


    $("#CardNuevoProducto").show(500);

    $("#btnactualizar").hide();
    $("#btnnuevo").hide();

   
    var url = '<?php echo $urlListarProducto ?>';

    ListarProductos(url);

    function BtnNUevo() {
        $("#btnactualizar").hide();
        $("#btnnuevo").hide();
        $("#btnguardar").show();
        resetValues();
    }
    function BtnGuardar() {
        var url = '<?php echo $urlNuevoProducto ?>';
        validarNuevoProducto(url,1);
    }
    function BtnActualizar() {
        var url = '<?php echo $urlActualizarProd ?>';
        validarNuevoProducto(url,2);
    }
  
  
    /* $("#Punitario").on("input", function() {
         var punitario = $("#Punitario").val();
         var cantidad = $("#txtcantidad").val();
         var total = punitario * cantidad;
         $("#txttotal").val(total);
         console.log(total);
     });*/
    /*  $("#txtcantidad").on("input", function() {
          var punitario = $("#Punitario").val();
          var cantidad = $("#txtcantidad").val();
          var total = punitario * cantidad;
          $("#txttotal").val(total);
          console.log(total);
      });*/
</script>