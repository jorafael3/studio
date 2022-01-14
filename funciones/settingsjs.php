<?php
$urlImagen = constant('URL') . "Settings/GuardarImg/";
$urllogo = constant('URL') . "Settings/GuardarLogo/";


$urlruta = constant('URL') . "public/assets/images/";

$Actualizar = constant('URL') . "settings/ActualizarSett";


?>

<script>

    var urlAct = '<?php echo $Actualizar ?>';

    function SubirFondo() {
        var files = $('#imageFondo')[0].files[0];

        var data = {
            id: "1",
            file: files
        }
        var url = '<?php echo $urlImagen ?>';
        if (files != "") {
            var campo = "imageFondo";
            var campo2 = "FondoImg";

            guardarImg(url, data,campo,campo2);
        }

    }

    function SubirLogo() {
        var files = $('#imageLogo')[0].files[0];

        var data = {
            id: "1",
            file: files
        }
        console.log(data);
        var url = '<?php echo $urllogo ?>';
        if (files != "") {
            var campo = "imageLogo";
            var campo2 = "LogoImg";

            guardarImg(url, data,campo,campo2);
        }
    }

    function guardarImg(url, data,campo,campo2) {
        var formData = new FormData();
        var files = $('#'+campo)[0].files[0];

        formData.append('file', files);
        console.log("files",files);
        $.ajax({
            url: url,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                response = JSON.parse(response);
                console.log("si", response);
                var ruta = '<?php echo $urlruta ?>';
                console.log(ruta + response);
                $("#"+campo2).attr("src", ruta + response);
            }
        });
    }

    function MEnsaje(men) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: men,
        });
    }

    function ValidarSett() {
        var nombreUsu = $('#nombreUsu').val();
        var nombre = $('#nombre').val();
        var direccion = $('#direccion').val();
        var correo = $('#correo').val();
        var tel1 = $('#tel1').val();
        var tel2 = $('#tel2').val();
        var pie = $('#pie').val();

        if (nombre == "") {
            MEnsaje("Escriba un Nombre");
        } else {
            var data = {
                nombre: nombre,
                direccion: direccion,
                correo: correo,
                tel1: tel1,
                tel2: tel2,
                pie: pie,
                nombreUsu,nombreUsu
            }
            console.log(data);
            ActualizarSett(urlAct,data);
        }

    }

    function ActualizarSett(url,data) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                data = JSON.parse(data);
                console.log(data);
                window.location.reload()
            }
        }
        data = JSON.stringify(data);
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);
    }
</script>