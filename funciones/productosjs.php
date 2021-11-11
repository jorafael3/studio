<?php
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";

?>

<script>
    function MensajeError(mensaje) {
        Swal.fire(
            mensaje,
            'Click para continuar',
            'error'
        )
    }

    function MensajeOk(mensaje) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: mensaje,
            showConfirmButton: false,
            timer: 1500
        })
    }

    function validarNuevoProducto(url) {

        var nombre = $("#txtnombre").val();
        var desc = $("#txtdesc").val();
        var precio = $("#Punitario").val();
        var medida = document.getElementById("customSwitch1");
        var estado = 1;

        if (medida.checked == true) {
            medida = 1;
        } else {
            medida = 0;
        }

        if (nombre == "") {

        } else if (desc == "") {

        } else if (precio == "") {

        } else {
            var data = {
                nombre: nombre,
                descripcion: desc,
                precio: precio,
                medida: medida,
                estado: estado
            };

            console.log(data);
            GuardarProducto(url, data);
        }


    }

    function GuardarProducto(url, data) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                console.log("aqui ", this.responseText);
                if (data == "true") {
                    MensajeOk("Los Datos Se Guardaron Con Exito");
                    var url2 = '<?php echo $urlListarProducto ?>'
                    ListarProductos(url2);
                }

            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

    }

    function ListarProductos(url) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);
                TablaProductos(data);
            }
        }
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

    function TablaProductos(data2) {

        $('#ListaProductos tbody').empty();
        $('#ListaProductos').empty();

        var table = $('#ListaProductos').DataTable({
            destroy: true,
            data: data2,
            dom: 'Bfrtip',
            responsive: true,
            deferRender: true,
            buttons: [
                'excel',
                'print'
            ],
            "columnDefs": [{
                "width": "5%",
                "targets": 1
            }, {
                "orderable": false,
                "targets": 6
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
                    data: "estado",
                    title: "estado "
                },

                {
                    data: null,
                    title: "",
                    className: "dt-center  btn_add",
                    defaultContent: '<button class="btn btn-warning btn_add"> Editar</button>',
                    orderable: false
                },
                {
                    data: null,
                    title: "",
                    className: "dt-center  btn_delete",
                    defaultContent: '<button class="btn btn-danger btn_delete"> Desactivar</button>',
                    orderable: false
                }

            ],
            "createdRow": function(row, data, index) {
                if (data["estado"] == 1) {
                    $('td', row).eq(4).addClass('font-weight-bolder text-success');
                    $('td', row).eq(4).html("Activo");
                }
                if (data["estado"] == 0) {
                    $('td', row).eq(4).addClass('font-weight-bolder text-danger');
                    $('td', row).eq(4).html("Inactivo");
                }
                if (data["medida"] == 1) {
                    $('td', row).eq(2).addClass('font-weight-bolder text-dark');
                    $('td', row).eq(2).html("Unidad");
                }
                if (data["medida"] == 0) {
                    $('td', row).eq(2).addClass('font-weight-bolder text-primary');
                    $('td', row).eq(2).html("Metros");
                }
            }

        });

        $('#Lista tbody').on('click', 'td.btn_add', function(e) {
            e.preventDefault();
            var data = table.row(this).data();
            UpdateData(data);

        });

    }
</script>