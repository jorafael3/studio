<?php


$urlDatosClientes = constant('URL') . "Proforma/DatosClientes/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlguardarCab = constant('URL') . "Proforma/GuardarProformaCab/";
$urlguardarDet = constant('URL') . "Proforma/GuardarProformaDet/";

$urlNumOrden = constant('URL') . "Proforma/GetNumeroOrden/";

$urlCargarPlantillita = constant('URL') . "Proforma/CargarPlantillasDetallesCab/";
$urlCargarPlantillitaDet = constant('URL') . "Proforma/CargarPlantillasDetallesDet/";

$urlPUdateCab = constant('URL') . "Proforma/UpdateProformaCab/";
$urlUpdateDet = constant('URL') . "Proforma/UpdateProformaDet/";

?>


<script>
    var NumeroOrdenGlobal;

    function DatosClientes(id_cliente) {
        console.log(id_cliente);
        var url = '<?php echo $urlDatosClientes ?>';
        var data = {
            id: id_cliente
        };
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);

                var ruc = "Ruc / Cedula: " + data[0]["ruc"];
                var email = "Email: " + data[0]["correo"];

                $(".ruc").text(ruc);
                $(".email").text(email);


            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function DatosProductos() {
        var url = '<?php echo $urlListarProducto ?>';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);
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
            console.log(data);
            var column0 = $(this).closest('tr').children()[0].textContent;
            var column1 = $(this).closest('tr').children()[1].textContent;
            var column2 = $(this).closest('tr').children()[2].textContent;
            var column3 = $(this).closest('tr').children()[3].textContent;
            var column4 = data["id_prod"];
            console.log(column4);


            if ($("#second_table .copy_" + column1).length == 0) {

                $("#second_table").append("<tr class='copy_" + column0 + "'><td class='no'>" + column0 + "</td> <td>" + column1 + "</td> <td class='unit'>" + column2 + "</td> <td class='unit text-left'>" + column3 + "</td> </td><td><input type='number' class='form-control' min='0' value='0'></td><td class='total subtotal'>0.00</td><td><button  class='btn btn-danger btn_remove'>-</button></td><td class='unit text-left' style='display:none'>" + column4 + "</td></tr>");
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
                console.log(NumeroOrdenGlobal);
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
                console.log(data);
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
                    console.log(DatosDetalle);

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
                console.log("aqui ", data);

            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

    }


    /************************************* */
    /** ***************************** */
    //** ACtulizar PROFORMA */

    function CargarPlantillaProf(id) {
        var url = '<?php echo $urlCargarPlantillita ?>';
        var data = {
            id: id
        };
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);

                var a = String(data[0]["id_cab"]).padStart(10, '0');
                var nombrepl = data[0]["nombre"];
                var sub = data[0]["subtotal"];
                var margen = data[0]["margen"];
                var ganancia = data[0]["ganancia"];
                var total = data[0]["total"];


                $('#txtNombreplantilla').val(nombrepl);
                $("#txtNumorden").text("#" + a);
                NumeroOrdenGlobalUpdate = data[0]["id_cab"];

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
                console.log(data);



                for (var i = 0; i < data.length; i++) {
                    var column0 = data[i]["nombre"];
                    var column1 = data[i]["descripcion"];
                    var column2 = data[i]["medida"];
                    var column3 = data[i]["precio"];
                    var column4 = data[i]["cantidad"];
                    var column5 = data[i]["total"];
                    var column6 = data[i]["id_det"];

                    if (column2 == 1) {
                        column2 = "Unidad";
                    } else if (column2 == 0) {
                        column2 = "Metros";

                    }
                    $("#second_table").append("<tr class='copy_" + column0 + "'><td class='no'>" + column0 + "</td> <td>" + column1 + "</td> <td class='unit'>" + column2 + "</td> <td class='unit text-left'>" + column3 + "</td> </td><td><input type='number' class='form-control' min='0' value='" + column4 + "'></td><td class='total subtotal'>" + column5 + "</td><td><button  class='btn btn-danger btn_remove'>-</button></td><td class='unit text-left' style='display:none'>" + column6 + "</td></tr>");

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
                console.log("cab", data);
                var url = '<?php echo $urlPUdateCab ?>';
                ActualizarProforma(url, data)

                var url2 = '<?php echo $urlUpdateDet ?>';
                for (var i = 1; i < tbl + 1; i++) {
                    DatosDetalle = {
                        id_cab: NumeroOrdenGlobalUpdate,
                        cant: document.getElementById("second_table").rows[i].cells[4].children[0].value,
                        total: document.getElementById("second_table").rows[i].cells[5].innerText,
                        id_prod: document.getElementById("second_table").rows[i].cells[7].innerText,
                    }
                    console.log(DatosDetalle);

                    GuardarProformaCab(url2, DatosDetalle)

                }

            }
        }

        function ActualizarProforma(url, data) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = this.responseText;
                    console.log("aqui ", data);

                }
            }
            data = JSON.stringify(data);
            xmlhttp.open("POST", url, true);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(data);
        }
    }
</script>