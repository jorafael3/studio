<?php



$urlNuevoProducto = constant('URL') . "Productos/NuevoProducto/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlActualizarProd = constant('URL') . "Productos/ActualizarProducto/";




require 'views/header.php'; ?>
<?php require 'funciones/Proformasjs.php'; ?>

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

<div class="row contacts">
    <div class="col invoice-to">

        <div class="row d-flex align-items-end">
            <div class="col-md-6 col-12">
                <h4 class="text-gray font-weight-bolder">Cargar Plantilla</h4>

                <div class="form-group">
                    <select class="form-control js-example-basic-single" style="width: 100%;" id="CbPlantillas" required>
                        <option class="" value=""></option>

                        <?php
                        foreach ($this->plant as $row) {
                        ?>
                            <option class="font-weight-bolder to" value=<?php echo ($row["id_cab"]); ?>><?php echo ($row["nombre"]); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-12">
                <div class="form-group">
                    <button onclick="DatosPlantilla()" class="btn btn-primary">Cargar</button>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-end">
            <div class="col-md-12 col-12">
                <h4 class="text-gray font-weight-bolder">Nueva Plantilla</h4>
                <div class="form-group">
                    <button onclick="BtnNuevaPlantilla()" class="btn btn-success">Nueva</button>
                </div>
            </div>

        </div>
    </div>

</div>

<div class="card" id="CardProforma" style="display: none;">
    <div class="card-body">
        <div id="invoice">
            <div class="toolbar hidden-print">
                <hr />
            </div>
            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <div>
                        <div class="row">
                            <div class="col">
                                <a href="javascript:;">
                                    <img src="<?php echo constant('URL') ?>public/assets/images/aj.jpeg" width="80" alt="" />
                                </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name font-weight-bolder">
                                    <a class="text-red" target="_blank" href="javascript:;">
                                        Arboshiki
                                    </a>
                                </h2>
                                <div>455 Foggy Heights, AZ 85004, US</div>
                                <div>(123) 456-789</div>
                                <div>company@example.com</div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-danger" style="height: 1px;">
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-10 col-12">
                                        <h4 class="text-gray font-weight-bolder">Nombre de la plantilla</h4>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="" id="txtNombreplantilla" placeholder="Nombre">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id text-red font-weight-bolder ">PROFORMA</h1>
                                <h1 id="txtNumorden" class="invoice-id text-red font-weight-bolder "># 00000001</h1>

                                <div class="date font-weight-bolder" style="font-size: 20px;">
                                    Fecha: <span id="txtfecha">sadasd</span>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-danger" style="height: 1px;">

                        <div class="row">
                            <div class="col-sm-6">
                                <button onclick="BtnAgregarProducto()" class="btn btn-dark" data-toggle="modal" data-target="#add-new-sidebar">Agregar Producto a la tabla</button>
                            </div>
                            <br>

                        </div>
                        <br>
                        <table id="second_table">
                            <thead>
                                <tr>
                                    <th style="width: 300px;">NOMBRE</th>
                                    <th class="text-left" style="width: 500px;">DESCRIPTION</th>
                                    <th class="text-left">MEDIDA</th>
                                    <th class="text-left">COSTO</th>
                                    <th class="text-left" style="width: 50px;">CANTIDAD</th>
                                    <th class="text-left" style="width: 120px;">TOTAL</th>
                                    <th class="text-left">#</th>
                                    <th class="text-left" style="display: none;">id</th>


                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                            <tfoot>
                                <tr style="font-size: 18px;">
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td colspan="2" class="text-primary font-weight-bolder">SUBTOTAL</td>
                                    <td id="PrSubtotal" class="font-weight-bolder">$0.00</td>
                                </tr>
                                <tr style="font-size: 16px;">
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td colspan="2">MARGEN DE GANANCIA %</td>
                                    <td>
                                        <input id="PrGanancia" type="number" value="0" min="0" class="form-control">
                                    </td>
                                </tr>
                                <tr style="font-size: 20px;">
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td colspan="2">GANANCIA TOTAL</td>
                                    <td id="prgananciaTotal" class="text-info font-weight-bolder">$0.00 </td>
                                </tr>
                                <tr style="font-size: 24px;">
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td colspan="2" class="text-red font-weight-bolder">TOTAL</td>
                                    <td id="PrTotal" class="text-red font-weight-bolder">$0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="toolbar hidden-print">
                            <div class="text-right">
                                <button id="btnguardar" onclick="BtnGuardarProforma()" type="button" class="btn btn-dark"><i class="fa fa-print"></i> Guardar</button>
                                <button id="btnactualizar" onclick="BtnActualizarProforma()" type="button" class="btn btn-warning"><i class="fa fa-print"></i> Actualizar</button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                            </div>
                        </div>
                        <br>
                        <div class="notices">
                            <div>NOTICE:</div>
                            <div class="notice">

                                <h4 class="font-weight-bolder">Crear Proforma para Cliente</h4>
                                <button class="btn btn-success" data-toggle="modal" data-target="#Prof_cliente">Crear</button>
                            </div>
                        </div>

                    </main>
                    <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                <div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-new-sidebar">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">Lista de Productos</h5>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ListaProductos" style="width: 100%;" class="table hover table-bordered">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Prof_cliente">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">Cliente</h5>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                <div class="card-body">
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="row d-flex align-items-end">
                                <div class="col-md-7 col-12">
                                    <div class="form-group">
                                        <select onchange="DatosClientes(this.value)" class="form-control js-example-basic-single" style="width: 100%;" id="eventoSalas" required>
                                            <option class="" value=""></option>

                                            <?php
                                            foreach ($this->client as $row) {
                                            ?>
                                                <option class="font-weight-bolder to" value=<?php echo ($row["id_cliente"]); ?>><?php echo ($row["nombre"]); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <button class="btn btn-info">Crear</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ruc font-weight-bolder" style="font-size: 20px;">
                                <h6></h6>
                            </div>
                            <div class="email font-weight-bolder" style="font-size: 20px;">
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/footer.php'; ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/es.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-colvis-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<script>
    $('.js-example-basic-single').select2({
        placeholder: "Seleccione"
    });
    $('.js-example-basic-single2').select2({
        placeholder: "Seleccione Proforma predefinida"
    });
    var fecha = moment().format("YYYY-MM-DD");
    $("#txtfecha").text(fecha);


    function BtnAgregarProducto() {
        DatosProductos();
    }

    $("#second_table").on("input", "input", function() {
        var input = $(this);
        var columns = input.closest("tr").children();

        var price = columns.eq(3).text();
        var calculated = input.val() * parseFloat(price).toFixed(2);
        calculated = parseFloat(calculated).toFixed(2);
        columns.eq(5).text(calculated);


        sumar_columnas();

    });

    function sumar_columnas() {
        var sum = 0;
        var iva = 0;

        //itera cada input de clase .subtotal y la suma
        $('.subtotal').each(function() {
            sum += parseFloat($(this).text());
            $('#PrSubtotal').text(formatter.format(sum.toFixed(2)));
        });

        var margen = $('#PrGanancia').val();
        if (margen != 0) {
            margen = margen / 100;
            var total = sum * margen;
            $('#prgananciaTotal').text(formatter.format(total));
            total = parseFloat(total + sum).toFixed(2);

            $('#PrTotal').text(formatter.format(total));

        } else {
            $('#PrTotal').text(formatter.format(sum));
            $('#prgananciaTotal').text("$0.00");

        }

    }

    $("body").on("click", ".btn_remove", function() {
        var input = $(this);
        var columns = input.closest("tr").children();
        var tot = columns.eq(5).text();
        console.log(tot);
        restar(tot);
        //
        $(this).closest("tr").remove();
    });

    function restar(tot) {
        //  
        var a = $('#second_table tbody tr').length;


        var sub = $('#PrSubtotal').text();
        var sub = sub.split("$")[1]
        console.log(sub);
        var subtemp = sub - tot;
        console.log(subtemp);
        $('#PrSubtotal').text(formatter.format(subtemp));
        var margen = $('#PrGanancia').val();

        if (margen != 0) {
            margen = margen / 100;
            var total = subtemp * margen;
            $('#prgananciaTotal').text(formatter.format(total));
            total = parseFloat(total + subtemp).toFixed(2);
            $('#PrTotal').text(formatter.format(total));

        } else {
            $('#PrTotal').text(formatter.format(subtemp));
            $('#prgananciaTotal').text("$0.00");

        }

        //$('#PrSubtotal').text(sub.toFixed(2));
        // $('#totaltotal').text(sum.toFixed(2));

    }

    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    })


    function BtnNuevaPlantilla() {
        $("#CardProforma").hide(200);
        $("#CardProforma").show(500);
        NumOrden();
        resetValues();
        $("#btnactualizar").hide();
        $("#btnguardar").show();


    }

    function BtnGuardarProforma() {

        ValidarNuevaProforma();
    }

    function resetValues() {

        $('#txtNombreplantilla').val("");
        $('#PrSubtotal').text("$0.00");
        $('#PrGanancia').val(0);
        $('#prgananciaTotal').text("$0.00");
        $('#PrTotal').text("$0.00");
        $("#second_table tbody").empty();

    }


    /*** **************** */
    /*** **************** */
    //*** ACTUALIZAR PROFROMA */

    function DatosPlantilla() {
        $("#second_table tbody").empty();

        var id = $('#CbPlantillas').val();
        console.log(id);
        CargarPlantillaProf(id);
        $("#CardProforma").hide(200);
        $("#CardProforma").show(500);
        $("#btnguardar").hide();
        $("#btnactualizar").show();
    }

    function BtnActualizarProforma() {
        ValidarUpdate();
    }
</script>