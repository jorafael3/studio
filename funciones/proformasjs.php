<?php


$urlDatosClientes = constant('URL') . "Proforma/DatosClientes/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlguardarCab = constant('URL') . "Proforma/GuardarProformaCab/";
$urlguardarDet = constant('URL') . "Proforma/GuardarProformaDet/";

$urlNumOrden = constant('URL') . "Proforma/GetNumeroOrden/";
$urlNumOrdenCliente = constant('URL') . "Proforma/GetNumeroOrdenCliente/";


$urlCargarPlantillita = constant('URL') . "Proforma/CargarPlantillasDetallesCab/";
$urlCargarPlantillitaDet = constant('URL') . "Proforma/CargarPlantillasDetallesDet/";

$urlPUdateCab = constant('URL') . "Proforma/UpdateProformaCab/";
$urlUpdateDet = constant('URL') . "Proforma/UpdateProformaDet/";


$urlGuardarfactura = constant('URL') . "Proforma/Guardarfactura/";
$urlActualizarFactura = constant('URL') . "Proforma/ActualizarFactura/";

$urlOrdenesAsociadasAProf = constant('URL') . "Proforma/OrdenesAsociadasAProf/";
$urlCargarPlantillaORden = constant('URL') . "Proforma/CargarPlantillaORden/";


$urlPDfprofforma = constant('URL') . "Pdf/GenerarPdfCompra/";
$urlPDfOrden = constant('URL') . "Pdf/GenerarPdfOrden/";






?>


<script>
    var NumeroOrdenGlobal;
    var PlantillaIdG;
    var Id_ClienteG = "";
    var NumeroOrdenGlobalCliente;

    function Mensajeok(mensaje) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: mensaje,
            showConfirmButton: false,
            timer: 1000
        })
    }

    function Mensajeerr(mensaje) {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: mensaje,
            showConfirmButton: false,
            timer: 1000
        })
    }


    function DatosProductos() {
        var url = '<?php echo $urlListarProducto ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);

                tablaProductos(data);
            }
        }
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }


    function tablaProductos(data) {

        $('#ListaProductos tbody').empty();
        $('#ListaProductos').empty();

        var table = $('#ListaProductos').DataTable({
            destroy: true,
            data: data,
            dom: 'Bfrtip',
            responsive: true,
            deferRender: true,
            buttons: [

            ],
            "columnDefs": [{
                "width": "5%",
                "targets": 0
            }, {
                "width": "40%",
                "targets": 1
            }],
            columns: [{
                    data: "nombre",
                    title: "Nombre / Material"
                },
                {
                    data: "descripcion",
                    title: "Descripcion "
                }, {
                    data: "medida",
                    title: "medida "
                }, {
                    data: "precio",
                    title: "precio "
                },

                {
                    data: null,
                    title: "",
                    className: "dt-center  btn_add",
                    defaultContent: '<button class="btn btn-success btn_add">Agregar</button>',
                    orderable: false
                }

            ],
            "createdRow": function(row, data, index) {

                if (data["medida"] == 1) {
                    $('td', row).eq(2).addClass('font-weight-bolder text-dark');
                    $('td', row).eq(2).html("Unidad");
                }
                if (data["medida"] == 0) {
                    $('td', row).eq(2).addClass('font-weight-bolder text-info');
                    $('td', row).eq(2).html("Metros");
                }
                $('td', row).eq(0).addClass('font-weight-bolder');
                $('td', row).eq(1).addClass('font-weight-bolder');
                $('td', row).eq(2).addClass('font-weight-bolder');
                $('td', row).eq(3).addClass('font-weight-bolder');
                $('td', row).eq(4).addClass('font-weight-bolder');


            }

        });

        $('#ListaProductos tbody').on('click', 'td.btn_add', function(e) {
            e.preventDefault();
            var data = table.row(this).data();

            var column0 = $(this).closest('tr').children()[0].textContent;
            var column1 = $(this).closest('tr').children()[1].textContent;
            var column2 = $(this).closest('tr').children()[2].textContent;
            var column3 = $(this).closest('tr').children()[3].textContent;
            var column4 = data["id_prod"];
            var column5 = null;




            if ($("#second_table .copy_" + column1).length == 0) {

                $("#second_table").append("<tr class='copy_" + column0 + "'><td class='no'>" + column0 + "</td> <td>" + column1 + "</td> <td class='unit'>" + column2 + "</td> <td class='unit text-left'>" + column3 + "</td> </td><td><input type='number' class='form-control' min='1' value='1'></td><td class='total subtotal'>0.00</td><td><button  class='btn btn-danger btn_remove'>-</button></td><td class='' style='display: none'>" + column4 + "</td><td class='' style='display: none'>" + column5 + "</td></tr>");
            }
        });

    }

    function NumOrden() {
        var url = '<?php echo $urlNumOrden ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                NumeroOrdenGlobal = data;

                var a = String(data).padStart(10, '0')

                $("#txtNumorden").text("#" + a);
            }
        }
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

    function ValidarNuevaProforma() {
        var nombreplant = $("#txtNombreplantilla").val();
        var subtotal = $("#PrSubtotal").text();
        var margen = $("#PrGanancia").val();
        var gananciaTotal = $("#prgananciaTotal").text();
        var total = $("#PrTotal").text();
        var tbl = document.querySelectorAll('#second_table tbody tr').length;


        if (nombreplant == "") {

        } else {

            if (total == "$0.00") {

            } else {

                var data = {
                    nombre: nombreplant,
                    subtotal: subtotal.split("$")[1],
                    margen: margen,
                    ganancia: gananciaTotal.split("$")[1],
                    total: total.split("$")[1]
                };

                var url = '<?php echo $urlguardarCab ?>';
                GuardarProformaCab(url, data)

                var url2 = '<?php echo $urlguardarDet ?>';

                for (var i = 1; i < tbl + 1; i++) {
                    DatosDetalle = {
                        id_cab: NumeroOrdenGlobal,
                        cant: document.getElementById("second_table").rows[i].cells[4].children[0].value,
                        total: document.getElementById("second_table").rows[i].cells[5].innerText,
                        id_prod: document.getElementById("second_table").rows[i].cells[7].innerText,
                    }


                    GuardarProformaCab(url2, DatosDetalle)

                }




            }
        }
    }

    function GuardarProformaCab(url, data) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;


                if (data == "true") {
                    Mensajeok("Datos Guardados");
                    CargarPlantillaProf(NumeroOrdenGlobal);
                    $("#btnguardar").hide();
                    $("#btnactualizar").show();
                    $("#btnpdf").show();

                } else {
                    Mensajeerr("Error al guardar")
                }

            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

    }

    //************************************************************ */
    //************************************************************ */
    //**  PROFORMA CLIENTE */

    function NumOrdenCliente() {
        var url = '<?php echo $urlNumOrdenCliente ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                NumeroOrdenGlobalCliente = data;

                var a = String(data).padStart(10, '0')

                $("#txtNumordenClie").text("#" + a);
            }
        }
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

    function DatosClientes(id_cliente) {
        if (id_cliente.length != 0) {
            DatosClientesDet(id_cliente);
            DatosClientesProfAsociadas(id_cliente);
        }

    }

    function DatosClientesDet(id_cliente) {
        NumOrdenCliente();

        var url = '<?php echo $urlDatosClientes ?>';
        var data = {
            id: id_cliente
        };
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);

                Id_ClienteG = id_cliente;

                var ruc = data[0]["ruc"];
                var email = data[0]["correo"];
                var telf = data[0]["whatsapp"];

                $("#btnNcli").show();
                $("#btnUpCli").hide();
                $("#txtDescCli").val("");

                $(".ruc").text(ruc);
                $(".email").text(email);
                $("#telf").remove();
                var a = '<a id="telf" class="text-info" href="http://web.whatsapp.com/send?phone=+593' + telf + '" target="_blank">' + telf + '</a>'
                $("#wha").append(a);



            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function DatosClientesProfAsociadas(id_cliente) {

        var data = {
            id_cliente: id_cliente,
            id_fact: NumeroOrdenGlobal
        }
        var url = '<?php echo $urlOrdenesAsociadasAProf ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);
                Id_ClienteG = id_cliente;
                TablaAsociados(data);

            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function TablaAsociados(data) {
        $('#TablaAsociados tbody').empty();
        $('#TablaAsociados').empty();

        var table = $('#TablaAsociados').DataTable({
            destroy: true,
            data: data,
            dom: 'Bfrtip',
            responsive: true,
            "pageLength": 5,
            deferRender: true,
            buttons: [
                'excel',
                'print'
            ],
            "columnDefs": [{
                //"width": "15%",
                //"targets": 0
            }],
            columns: [{
                    data: "fecha_creacion",
                    title: "Fecha de Creacion"
                },
                {
                    data: "id_fact",
                    title: "N. Orden "
                },
                {
                    data: "nombre",
                    title: "NOMBRE "
                }, {
                    data: "descripcion",
                    title: "Descripcion "
                },

                {
                    data: null,
                    title: "",
                    className: "dt-center  btn_add",
                    defaultContent: '<button class="btn btn-warning btn_add"> Editar</button>',
                    orderable: false
                }

            ],
            "createdRow": function(row, data, index) {

                if (data["id_fact"]) {
                    var a = String(data["id_fact"]).padStart(10, '0')
                    $('td', row).eq(1).html(a);

                }

                $('td', row).eq(0).addClass('font-weight-bolder');
                $('td', row).eq(1).addClass('font-weight-bolder');
                $('td', row).eq(2).addClass('font-weight-bolder');
                $('td', row).eq(3).addClass('font-weight-bolder');
            }

        });

        $('#TablaAsociados tbody').on('click', 'td.btn_add', function(e) {
            e.preventDefault();
            var data = table.row(this).data();
            UpdateDataClientes(data);

        });
    }
    var DataOrdenAct;
    var IdOrdenGup;

    function UpdateDataClientes(data) {
        console.log(data);
        $("#btnNcli").hide();
        $("#btnUpCli").show();
        $("#btnOrdenPdf").show();

        $("#txtDescCli").val(data["descripcion"]);
        $("#txtNomCliOr").val(data["nombre"]);

        DataOrdenAct = data;
        IdOrdenGup = data["id_fact"];
        NumeroOrdenGlobalCliente = IdOrdenGup;

    }

    function validarActualizarClienteOr() {
        //  console.log(DataOrdenAct);
        var descripcion = $("#txtDescCli").val();
        var Nombre = $("#txtNomCliOr").val();

        var data = {
            id_fact: NumeroOrdenGlobalCliente,
            descripcion: descripcion,
            nombre: Nombre
        }
        console.log(data);
        var url = '<?php echo $urlActualizarFactura ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                console.log(data);

                if (data == "true") {
                    Mensajeok("Datos Guardados");
                    CargarPlantillaORden(NumeroOrdenGlobalCliente);
                    //  $("#btnguardar").hide();
                    //  $("#btnactualizar").show();
                    //  $("#btnpdf").show();
                } else {
                    Mensajeerr("Error al guardar")
                }
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function CargarPlantillaORden(IdOrden) {
        var data = {
            id_fact: IdOrden
        };
        var url = '<?php echo $urlCargarPlantillaORden ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);
                $("#txtDescCli").val(data[0]["descripcion"]);
                $("#txtNomCliOr").val(data[0]["nombre"]);
                $("#btnNcli").hide();
                $("#btnUpCli").show();
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }




    function validarProfCliente() {

        var url = '<?php echo $urlGuardarfactura ?>';
        var descripcion = $("#txtDescCli").val();
        var NombreOr = $("#txtNomCliOr").val();

        if (Id_ClienteG == "") {
            Mensajeerr("Seleccione un Cliente");
        } else if (descripcion == "") {
            Mensajeerr("Escriba una descripcion");

        } else if (NombreOr == "") {
            Mensajeerr("Escriba un Nombre para la orden");

        } else {

            var data = {
                ordencli: Id_ClienteG,
                ordenProf: NumeroOrdenGlobal,
                NombreOrden: NombreOr,
                Descripcion: descripcion
            }

            GuardarFactura(url, data);
        }

    }

    function GuardarFactura(url, data) {
        console.log(data);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                console.log(data);

                if (data == "true") {
                    console.log(NumeroOrdenGlobalCliente);
                    Mensajeok("Datos Guardados");
                    CargarPlantillaORden(NumeroOrdenGlobalCliente);
                    //  $("#btnguardar").hide();
                    $("#btnUpCli").show();
                    $("#btnOrdenPdf").show();

                    //  $("#btnpdf").show();

                } else {
                    Mensajeerr("Error al guardar")
                }

            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }




    /************************************* */
    /** ***************************** */
    //** ACTUAlizar PROFORMA */

    function CargarPlantillaProf(id) {
        PlantillaIdG = id
        var url = '<?php echo $urlCargarPlantillita ?>';
        var data = {
            id: id
        };
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);


                var a = String(data[0]["id_cab"]).padStart(10, '0');


                var nombrepl = data[0]["nombre"];
                var sub = data[0]["subtotal"];
                var margen = data[0]["margen"];
                var ganancia = data[0]["ganancia"];
                var total = data[0]["total"];


                $('#txtNombreplantilla').val(nombrepl);
                $("#txtNumorden").text("#" + a);
                NumeroOrdenGlobalUpdate = data[0]["id_cab"];
                NumeroOrdenGlobal = NumeroOrdenGlobalUpdate;

                $('#PrSubtotal').text(formatter.format(sub));
                $('#PrGanancia').val(margen);
                $('#prgananciaTotal').text(formatter.format(ganancia));
                $('#PrTotal').text(formatter.format(total));

                CargarPlantillaDet(data[0]["id_cab"]);
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function CargarPlantillaDet(id) {
        var url = '<?php echo $urlCargarPlantillitaDet ?>';
        var data = {
            id: id
        };
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);



                $("#second_table tbody").empty();

                for (var i = 0; i < data.length; i++) {
                    var column0 = data[i]["nombre"];
                    var column1 = data[i]["descripcion"];
                    var column2 = data[i]["medida"];
                    var column3 = data[i]["precio"];
                    var column4 = data[i]["cantidad"];
                    var column5 = data[i]["total"];
                    var column6 = data[i]["id_prod"];
                    var column7 = data[i]["id_det"];

                    if (column2 == 1) {
                        column2 = "Unidad";
                    } else if (column2 == 0) {
                        column2 = "Metros";

                    }
                    $("#second_table").append("<tr class='copy_" + column0 + "'><td class='no'>" + column0 + "</td> <td>" + column1 + "</td> <td class='unit'>" + column2 + "</td> <td class='unit text-left'>" + column3 + "</td> </td><td><input type='number' class='form-control' min='1' value='" + column4 + "'></td><td class='total subtotal'>" + column5 + "</td><td><button  class='btn btn-danger btn_remove'>-</button></td><td class='unit text-left' style='display: none'>" + column6 + "</td><td class='unit text-left' style='display: none'>" + column7 + "</td></tr>");

                }



            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    var NumeroOrdenGlobalUpdate;

    function ValidarUpdate() {
        var nombreplant = $("#txtNombreplantilla").val();
        var subtotal = $("#PrSubtotal").text();
        var margen = $("#PrGanancia").val();
        var gananciaTotal = $("#prgananciaTotal").text();
        var total = $("#PrTotal").text();
        var tbl = document.querySelectorAll('#second_table tbody tr').length;

        if (nombreplant == "") {

        } else {

            if (total == "$0.00") {

            } else {

                var data = {
                    id_cab: NumeroOrdenGlobalUpdate,
                    nombre: nombreplant,
                    subtotal: subtotal.split("$")[1],
                    margen: margen,
                    ganancia: gananciaTotal.split("$")[1],
                    total: total.split("$")[1]
                };

                var url = '<?php echo $urlPUdateCab ?>';
                ActualizarProforma(url, data)

                var url2 = '<?php echo $urlUpdateDet ?>';
                for (var i = 1; i < tbl + 1; i++) {

                    var id_cab = NumeroOrdenGlobalUpdate;
                    var id_det = document.getElementById("second_table").rows[i].cells[8].innerText;
                    var id_prod = document.getElementById("second_table").rows[i].cells[7].innerText;
                    var cant = document.getElementById("second_table").rows[i].cells[4].children[0].value;
                    var total = document.getElementById("second_table").rows[i].cells[5].innerText;

                    DatosDetalle = {
                        id_cab: id_cab,
                        cant: cant,
                        total: total,
                        id_prod: id_det,
                        id_det: id_det
                    }

                    if (id_det == "null") {

                        DatosDetalle.id_prod = id_prod;
                        var url3 = '<?php echo $urlguardarDet ?>';
                        GuardarProformaCab(url3, DatosDetalle)

                    } else {

                        ActualizarProforma(url2, DatosDetalle)

                    }


                }

            }
        }


    }

    function ActualizarProforma(url, data) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;

                if (data == "true") {
                    Mensajeok("Datos Actualizados")
                } else {
                    Mensajeerr("Error al actualizar")
                }
                CargarPlantillaProf(PlantillaIdG);
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }


    //************************* PDF ****************//

    function SendDataToPdf() {

        var data = {
            id: NumeroOrdenGlobalUpdate
        }
        var url = ('<?php echo $urlPDfprofforma ?>');

        Pdf(data,url)
    }

    function SendDataToPdfOrden() {
        var data = {
            id: NumeroOrdenGlobalCliente
        }
        var url = ('<?php echo $urlPDfOrden ?>');

        console.log(data);
        Pdf(data,url)
    }

    function Pdf(data,url) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            if (this.readyState == 4 && this.status == 200) {
                var disposition = xmlhttp.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : 'file.pdf');

                // The actual download
                //** PARA ABRIR PDF  */
                var file = window.URL.createObjectURL(xmlhttp.response);
                var a = document.createElement("a");
                a.href = file;
                window.open(file);

                //* PARA DESCARGAR PDF */
                var blob = new Blob([xmlhttp.response], {
                    type: 'application/pdf'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xmlhttp.responseType = 'blob';
        xmlhttp.send(data);
    }
</script>