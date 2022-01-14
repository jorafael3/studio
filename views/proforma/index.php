<?php



$urlNuevoProducto = constant('URL') . "Productos/NuevoProducto/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlActualizarProd = constant('URL') . "Productos/ActualizarProducto/";


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
    <div class="ml-auto">
        <div class="btn-group">
            <button class="btn" data-toggle="modal" data-target="#help"><i class="bx bx-help-circle"></i> Ayuda</button>

        </div>
    </div>
</div>
<div class="modal fade" id="help">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content p-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">Ayuda</h5>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                <div class="card-body">
                    <div>
                        <h5>1. Para Crear una nueva plantilla
                        </h5>
                        <ul>
                            <li> Click en <button class="btn-sm btn-success">Nueva</button>
                            </li>
                            <li>Colocamos un nombre a la plantilla</li>
                            <li>Click en
                                <button class="btn-sm btn-dark">Agregar productos a la tabla</button>
                            </li>
                            <li>Nos desplegara la lista de productos que tengamos, para agregarlos a la proforma solo hacer click en Agregar </li>
                            <li>Podemos agregar un margen de ganancia</li>
                            <li>Click en guardar </li>
                            <li>Siqueremos modificar o agregar producto nuevos
                                click en
                                <button class="btn-sm btn-warning">Actualizar</button>

                            </li>
                            <li>Exporatar proforma a pdf click
                                <button class="btn-sm btn-danger">Export as Pdf</button>

                            </li>
                            <li>Tambien podemos cargar una plantilla creada anteriormente
                                seleccionando el nombre de la misma en la lista y click en 
                                <button class="btn-sm btn-primary">Cargar</button>

                            </li>
                        </ul>
                    </div>
                    <div>
                        <h5>2. Crear proforma para clientes</h5>
                        <li>En esta seccion crearemos las ordenes basandonos en la proforma creada o seleccionada anteriormente</li>
                        <li>1. seleccionar el cliente al que le queremos realizar la orden</li>
                        <li>2. llenamos con el nombre de la orden y la descripcion de la misma y guardamos</li>
                        <li>
                            con el boton
                            <button class="btn-sm btn-info"><i class="bx bx-refresh"></i></button>
                            recargamos la tabla con las ordenes creadas a ese cliente
                        </li>
                        <li>Para editar o reimprimir una orden seleccionamos en la tabla la ordenque queremofa-spiny damos click
                            en 
                            <button class="btn-sm btn-warning">Editar</button>
                        </li>
                        <li>aqui podremos modificar los datos de la orden 
                            haciendo click 
                            <button class="btn-sm btn-warning">Actualizar</button>
                            o imprimir  haciendo click end
                            <button class="btn-sm btn-danger">Pdf</button>

                            
                        </li>
                    </div>

                </div>
            </div>
        </div>
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

<div class="row" id="CardProforma" style="display: none;">

    <div class="card col-xl-12">
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
                                        <img src="<?php echo constant('URL') . $logo_orden ?>" width="80" alt="" />
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name font-weight-bolder">
                                        <a class="text-red" target="_blank" href="javascript:;">
                                            <?php echo $titulo ?>
                                        </a>
                                    </h2>
                                    <div> <?php echo $direccion ?></div>
                                    <div> <?php echo $telefono1 . " - " . $telefono2 ?></div>
                                    <div> <?php echo $correo ?></div>
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
                                    <tr style="width: 100%;">
                                        <th style="width: 20%;">NOMBRE</th>
                                        <th class="text-left" style="width: 40%;">DESCRIPTION</th>
                                        <th class="text-left">MEDIDA</th>
                                        <th class="text-left">COSTO</th>
                                        <th class="text-left" style="width: 10%;">CANTIDAD</th>
                                        <th class="text-left" style="width: 20%;">TOTAL</th>
                                        <th class="text-left" style="width: 10%;">#</th>
                                        <th class="text-left" style="display: none">id_prod</th>
                                        <th class="text-left" style="display: none">id_det</th>
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
                                    <button id="btnpdf" onclick="BtnPdf()" type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                                </div>
                            </div>
                            <br>


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

    <div class="card col-xl-12 bordered">
        <div class="card-body">
            <hr>
            <div class="row contacts">
                <div class="col invoice">
                    <div class="row d-flex align-items-end">
                        <div class="col-md-12 col-12">
                            <div class="notices">
                                <div class="notice">
                                    <h5 class="font-weight-bolder">Crear Proforma para Cliente</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <h2 class="text-red font-weight-bolder"></h2>
                            <div class="form-group">
                                <button id="btnnuevaordencliente" onclick="BtnNuevaOrClie()" class="btn btn-light-success">Nuevo</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <h4>Cliente</h4>
                            <div class="form-group">
                                <select onchange="DatosClientes(this.value)" class="form-control js-example-basic-single" style="width: 100%;" id="CLienteNombre" required>
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
                        <div class="col-md-2">
                            <h2 class="text-red font-weight-bolder"></h2>
                            <div class="form-group">
                                <button onclick="DatosClientes($('#CLienteNombre').val())" class="btn btn-light-info"><i class="bx bx-refresh"></i></button>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <h2 class="text-red font-weight-bolder">Orden</h2>
                            <div class="form-group">
                                <h2 id="txtNumordenClie" class="text-red font-weight-bolder">Orden#00000001</h2>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-12">
                        <h6 class="font-weight-bolder ">Ruc/Cedula:
                            <span class="ruc"></span>
                        </h6>
                    </div>
                    <div class="col-md-12 col-12">
                        <h6 class=" font-weight-bolder">Correo:
                            <span class="email"></span>
                        </h6>
                    </div>
                    <div class="col-md-12 col-12">
                        <h6 id="wha" class="font-weight-bolder">Telefono:

                        </h6>
                    </div>

                    <hr class="bg-danger" style="height: 1px;">
                    <h3>Ordenes del Cliente Asociadas A esta Proforma</h3>
                    <div class="table-responsive">
                        <table id="TablaAsociados" class="display">


                        </table>
                    </div>
                    <hr class="bg-danger" style="height: 1px;">
                    <div class="col-md-12 col-12">
                        <h4>Nombre</h4>
                        <div class="form-group">
                            <input class="form-control" name="" id="txtNomCliOr" placeholder="Nombre de la Orden"></input>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <h4>Descripcion</h4>
                        <div class="form-group">
                            <textarea placeholder="Descripcion de la Orden" class="form-control" name="" id="txtDescCli" cols="" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="text-left">
                            <button id="btnNcli" onclick="BtnGuardarCliente()" class="btn btn-success">Guardar</button>
                            <button id="btnUpCli" onclick="BtnActualizarCliente()" class="btn btn-warning">Actualizar</button>
                            <button id="btnOrdenPdf" onclick="printDiv()" class="btn btn-danger">PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'pdfOrden.php'; ?>

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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css" />
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

<script>
    function printDiv() {

        SendDataToPdfOrden();
        $("#CardOrdenCliente").show();
        printWindow($('<div/>').append($("#CardOrdenCliente").clone()).html());
    }

    function printWindow(data) {

        var mywindow = window.open('', 'invoice-box', 'height=1000,width=1000');
        mywindow.document.write('<html><head><title></title>');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/bootstrap.min.css" type="text/css" /> <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/css/app.css" /> <link rel="stylesheet"type="text/css" href="<?php echo constant('URL') ?>public/assets/css/custom.css" media="print"/>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');


        setTimeout(function() {
            mywindow.print();
            mywindow.close();
        }, 1500)
        $("#CardOrdenCliente").hide();

        return true;
        //$("#CardOrdenCliente").printElement();

        //printJS('CardOrdenCliente', 'html');
        /*var restorepage = $('body').html();
        var printcontent = $('#CardOrdenCliente').clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);*/

        /*var mywindow = window.open();
        var content = document.getElementById('CardOrdenCliente').innerHTML;
        mywindow.document.write(content);
        mywindow.print();*/

        /* var div = document.getElementById('CardOrdenCliente');

         // Create a window object.
         var win = window.open('', '', 'height=700,width=700'); // Open the window. Its a popup window.
         win.document.write(div.outerHTML); // Write contents in the new window.
         win.document.close();
         win.print(); // Finally, print the contents.*/

    }
</script>


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
        NumOrdenCliente();

        resetValues();
        $("#btnactualizar").hide();
        $("#btnguardar").show();
        $("#btnpdf").hide();
        $("#btnUpCli").hide();
        $("#btnNcli").show();
        $("#btnOrdenPdf").hide();


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
        NumOrdenCliente();

        $("#CardProforma").hide(200);
        $("#CardProforma").show(500);
        $("#btnguardar").hide();
        $("#btnactualizar").show();
        $("#btnpdf").show();
        $("#btnUpCli").hide();
        $("#btnNcli").show();
        $("#btnOrdenPdf").hide();


    }

    function BtnActualizarProforma() {
        ValidarUpdate();
    }

    function BtnPdf() {
        SendDataToPdf();
    }

    function BtnPdfOrden() {
        SendDataToPdfOrden();
    }

    function BtnGuardarCliente() {
        validarProfCliente();
    }

    function BtnActualizarCliente() {
        validarActualizarClienteOr();
    }

    function BtnNuevaOrClie() {
        NumOrdenCliente();
        $("#txtDescCli").val("");
        $("#txtNomCliOr").val("");
        $("#btnUpCli").hide();
        $("#btnNcli").show();
        $("#btnOrdenPdf").hide();

    }
</script>