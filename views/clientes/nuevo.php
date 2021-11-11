<?php

$urlClientes = constant('URL') . "Clientes/ListarClientes/";
$urlNuevoClientes = constant('URL') . "Clientes/NuevoCliente/";
$urlClientesUpdate = constant('URL') . "Clientes/ActualizarCliente/";

require 'views/header.php';
?>


<!--breadcrumb-->
<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
    <div class="breadcrumb-title pr-3">Clientes</div>
    <div class="pl-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="card">
    <div class="card-header">
        <button class="btn btn-primary btn-toggle-sidebar" id="BtnNuevoEvento" data-toggle="modal" data-target="#add-new-sidebar">Nuevo Cliente</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="Lista" style="width: 100%;" class="table hover tabla-clientes  table-bordered">

            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="add-new-sidebar">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">Cliente Nuevo</h5>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                <div class="card-body">
                    <form class="needs-validation" novalidate onsubmit="return false">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="txtNombre">Nombre</label>
                                <input type="text" class="form-control" id="txtNombre" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Ingresa un nombre</div>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="txtRuc">Cedula/Ruc</label>
                                <input required minlength="10" maxlength="13" type="text" class="form-control" id="txtRuc" required>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">verifica la cedula</div>

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="txtTelefono">Telefono</label>
                                <input type="text" class="form-control" id="txtTelefono">
                                <div class="invalid-feedback">Please provide a valid city.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="txtWhatsapp">Whatsapp</label>
                                <input type="text" class="form-control" id="txtWhatsapp">
                                <div class="invalid-feedback">Please provide a valid city.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="txtCorreo">Correo</label>
                                <input type="text" class="form-control" id="txtCorreo">
                                <div class="invalid-feedback">Please provide a whatsapp.</div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="txtDireccion">Direccion</label>
                                <textarea type="text" class="form-control" id="txtDireccion"></textarea>
                                <div class="invalid-feedback">Please provide a direccion.</div>
                            </div>
                        </div>
                        <div class="form-row" id="seccEstado">
                            <div class="col-md-12 mb-1">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">estado</label>
                                </div>
                            </div>
                        </div><br>
                        <div class="form-row">

                            <button id="btnguardar" onclick="Btnguardar(1)" class="btn btn-primary">Guardar</button>
                            <button id="btnactualizar" onclick="Btnguardar(2)" class="btn btn-warning">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
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

    $(document).on('keydown', 'input[pattern]', function(e){
  var input = $(this);
  var oldVal = input.val();
  var regex = new RegExp(input.attr('pattern'), 'g');

  setTimeout(function(){
    var newVal = input.val();
    if(!regex.test(newVal)){
      input.val(oldVal); 
    }
  }, 1);
});
</script>
<script>
    $("#seccEstado").hide();
    $("#btnactualizar").hide();

    var url = '<?php echo $urlClientes ?>'
    ValidarListaClientes(url);

    $("#BtnNuevoEvento").click(function() {
        $("#btnguardar").show();
        $("#btnactualizar").hide();
        $("#seccEstado").hide();

        reset();
    });

    function reset() {
        $("#txtNombre").val("");
        $("#txtRuc").val("");
        $("#txtTelefono").val("");
        $("#txtWhatsapp").val("");
        $("#txtCorreo").val("");
        $("#txtDireccion").val("");
    }

    function Btnguardar(tipo) {
        var url = '<?php echo $urlNuevoClientes ?>'
        var url2 = '<?php echo $urlClientesUpdate ?>'
        if (tipo == 2) {
            url = url2
        }
        ValidarCliente(url, tipo);

    }
</script>