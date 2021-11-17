<?php


$urlDatosClientes = constant('URL') . "Proforma/DatosClientes/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";

?>


<script>
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



            if ($("#second_table .copy_" + column1).length == 0) {

                $("#second_table").append("<tr class='copy_" + column0 + "'><td class='no'>" + column0 + "</td> <td>" + column1 + "</td> <td class='unit'>" + column2 + "</td> <td class='unit text-left'>" + column3 + "</td></td><td><input type='number' class='form-control' min='0' value='0'></td><td class='total subtotal'>0.00</td><td><button  class='btn btn-danger btn_remove'>-</button></td></tr>");
            }
        });

    }
</script>