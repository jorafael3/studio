<?php
$urlClientes = constant('URL') . "Proveedores/ListarProveedores/";

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
            timer: 2000
        })
    }

    var id_cliente;

    function ValidarCliente(url, tipo) {
        var txtNombre = $("#txtNombre").val();
        var txtciudad = $("#txtciudad").val();
        var txtTelefono = $("#txtTelefono").val();
        var txtWhatsapp = $("#txtWhatsapp").val();

        var txtContacto = $("#txtContacto").val();
        var txtPagina = $("#txtPagina").val();
        var txtObservacion = $("#txtObservacion").val();

        var txtCorreo = $("#txtCorreo").val();
        var txtDireccion = $("#txtDireccion").val();

        var data = {
            id: "1",
            nombre: txtNombre,
            ciudad: txtciudad,
            telefono: txtTelefono,
            whatsapp: txtWhatsapp,
            correo: txtCorreo,
            direccion: txtDireccion,
            contacto: txtContacto,
            pagina: txtPagina,
            observacion: txtObservacion,
            estado: "1",
            creador: "katherine"
        };

        if (txtNombre == "") {

        } else {

            if (tipo == 1) {
                console.log(data);
                GuardarCliente(url, data);
            }
            if (tipo == 2) {

                data.id = id_cliente
                console.log(data);
                ActualizarCliente(url, data);
            }
        }

    }

    function GuardarCliente(url, data) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                console.log("aqui ", data);
                if (data[0] == 0) {
                    MensajeError("El numero de Cedula ya se encuentra registrado");
                } else if (data == "false") {
                    MensajeError("Error al Guardar los datos");
                    $('#add-new-sidebar').modal('hide');

                } else {
                    $('#add-new-sidebar').modal('hide');
                    MensajeOk("Los Datos Se Guardaron Con Exito");
                    var url2 = '<?php echo $urlClientes ?>'
                    ValidarListaClientes(url2);
                }
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function GuardarCliente2(url, data) {
        var baseurl = window.location.origin;
        console.log(url);
        $.ajax({
            data: data,
            datatype: 'json',
            url: '../controlleres/clientes.php',
            type: 'POST',
            success: function(htrabajo) {
                let jsonhtrabajo = JSON.parse(htrabajo);
                console.log(jsonhtrabajo);
            },
            error: function(err) {
                console.log(err);
            }
        })
    }

    function UpdateData(data) {
        console.log(data);
        $('#add-new-sidebar').modal('show');
        $("#btnguardar").hide();
        $("#btnactualizar").show();
       // $("#seccEstado").show();
        $("#txtNombre").val(data["nombre"]);
        $("#txtciudad").val(data["ciudad"]);
        $("#txtTelefono").val(data["telefono"]);
        $("#txtWhatsapp").val(data["whatsapp"]);
        $("#txtCorreo").val(data["email"]);
        $("#txtDireccion").val(data["direccion"]);

        $("#txtContacto").val(data["contacto"]);
        $("#txtPagina").val(data["pagina"]);
        $("#txtObservacion").val(data["observacion"]);


        id_cliente = data["id_proveedor"];
        if (data["estado"] == 1) {
            $('#customSwitch1').prop('checked', true);
        } else {
            $('#customSwitch1').prop('checked', false);
        }

    }

    function ActualizarCliente(url, data) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);

                console.log(data);

                //  if(data == "true"){
                $('#add-new-sidebar').modal('hide');
                MensajeOk("Los Datos Se Actualizaron Con Exito");
                var url2 = '<?php echo $urlClientes ?>'

                ValidarListaClientes(url2);
                // }
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }

    function ValidarListaClientes(url) {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);
                TablaClientes(data);
            }
        }
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

    function TablaClientes(data2) {

        $('#Lista tbody').empty();
        $('#Lista').empty();

        var table = $('#Lista').DataTable({
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
                    data: null,
                    title: "",
                    className: "dt-center  btn_add",
                    defaultContent: '<button class="btn btn-warning btn_add"> Editar</button>',
                    orderable: false
                },
                {
                    data: "nombre",
                    title: "NOMBRE <br> RAZON SOCIAL "
                }, {
                    data: "ciudad",
                    title: "CIUDAD "
                }, {
                    data: "contacto",
                    title: "Persona <br>de Contacto "
                }, {
                    data: "direccion",
                    title: "DIRECCION "
                }, {
                    data: "telefono",
                    title: "TELEFONO"
                },
                {
                    data: "whatsapp",
                    title: "WHATSAPP ",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            var d = data;
                            console.log(d);
                            if (d != null) {
                                data = '<a  class="text-info" href="http://web.whatsapp.com/send?phone=+593' + d + '" target="_blank">' + d + '</a>';
                            }
                        }
                        return data;

                    }
                },{
                    data: "email",
                    title: "EMAIL"
                },{
                    data: "pagina",
                    title: "PAGINA WEB",
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            var d = data;
                            console.log(d);
                            if (d != null) {
                                data = '<a  class="text-info" href="' + d + '" target="_blank">' + d + '</a>';
                            }
                        }
                        return data;

                    }
                },{
                    data: "observacion",
                    title: "OBSERVACIONES"
                }
                

                
            ],
            "createdRow": function(row, data, index) {
               
            }

        });

        $('#Lista tbody').on('click', 'td.btn_add', function(e) {
            e.preventDefault();
            var data = table.row(this).data();
            UpdateData(data);

        });

    }
</script>