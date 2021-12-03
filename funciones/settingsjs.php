<?php
$urlImagen = constant('URL') . "Settings/GuardarImg/";

$urlruta = constant('URL') . "public/assets/images/"

?>

<script>
    function SubirFondo() {
        var files = $('#imageFondo')[0].files[0];

        var data = {
            id: "1",
            file: files
        }
        var url = '<?php echo $urlImagen ?>';
        if (files != "") {
            guardarImg(url, data);
        }

    }

    function SubirLogo() {
        var files = $('#imageLogo')[0].files[0];

        var data = {
            id: "1",
            file: files
        }
        var url = '<?php echo $urlImagen ?>';
        if (files != "") {
            guardarImg(url, data);
        }
    }

    function guardarImg(url, data) {
        var formData = new FormData();
        var files = $('#imageFondo')[0].files[0];
        formData.append('file', files);
        console.log(formData);
        $.ajax({
            url: url,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                response = JSON.parse(response);
                console.log("si", response);
                var ruta = '<?php echo $urlruta ?>';
                console.log(ruta + response);
                $("#FondoImg").attr("src", ruta + response);
            }
        });
    }
</script>