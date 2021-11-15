<?php


$urlDatosClientes = constant('URL') . "Proforma/DatosClientes/";

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
</script>