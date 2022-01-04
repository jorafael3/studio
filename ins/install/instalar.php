<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalacion</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="col-12">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="card-title"> Asistente de Instalacion Sistema Web</h1>
                <p class="card-text">hola</p>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">Hacer click a continuacion para instalar</h3>
                <button onclick="Install()" class="btn btn-success">Instalar</button>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="card-title">----------------------</h1>
                <p class="card-text"></p>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function Install() {
            var parametros = {
                "install": "1"
            };
            $.ajax({
                data: parametros,
                datatype: 'json',
                url: 'ins.php',
                type: 'POST',
                success: function(Orden) {
                    let data = JSON.parse(Orden);
                    console.log(data);
                    if (data == "err") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al instalar, puede que ya se haya instalado con anterioridad',
                        })
                    } else if (data == "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Muy bien.',
                            text: 'El sistema esta instalado',
                        })

                        setTimeout(greet, 2000);

                        function greet() {
                            window.location.href = '../../';
                        }
                    }
                }
            });
        }
    </script>
</body>

</html>