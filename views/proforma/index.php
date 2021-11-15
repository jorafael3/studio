<?php



$urlNuevoProducto = constant('URL') . "Productos/NuevoProducto/";
$urlListarProducto = constant('URL') . "Productos/ListarProducto/";
$urlActualizarProd = constant('URL') . "Productos/ActualizarProducto/";




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
</div>

<div class="card">
    <div class="card-body">
        <div id="invoice">
            <div class="toolbar hidden-print">

                <hr />
            </div>
            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <header>
                        <div class="row">
                            <div class="col">
                                <a href="javascript:;">
                                    <img src="<?php echo constant('URL') ?>public/assets/images/aj.jpeg" width="80" alt="" />
                                </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name">
                                    <a target="_blank" href="javascript:;">
                                        Arboshiki
                                    </a>
                                </h2>
                                <div>455 Foggy Heights, AZ 85004, US</div>
                                <div>(123) 456-789</div>
                                <div>company@example.com</div>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">PROFORMA PARA:</div>
                                <div class="row d-flex align-items-end">
                                    <div class="col-md-7 col-12">
                                        <div class="form-group">
                                            <select onchange="DatosClientes(this.value)" class="form-control js-example-basic-single" style="width: 100%;" id="eventoSalas" required>
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
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <button class="btn btn-info">Crear</button>
                                        </div>
                                    </div>
                                </div>
                                <div  class="ruc font-weight-bolder"><h6></h6></div>
                                <div class="email font-weight-bolder">
                                </div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">PROFORMA# 00000001</h1>
                                <div class="date font-weight-bolder">Date of Invoice: 01/10/2018</div>
                                <div class="date font-weight-bolder">Due Date: 30/10/2018</div>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-left">DESCRIPTION</th>
                                    <th class="text-right">HOUR PRICE</th>
                                    <th class="text-right">HOURS</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="no">04</td>
                                    <td class="text-left">
                                        <h3>
                                            <a target="_blank" href="javascript:;">
                                                Youtube channel
                                            </a>
                                        </h3>
                                        <a target="_blank" href="javascript:;">
                                            Useful videos
                                        </a> to improve your Javascript skills. Subscribe and stay tuned :)
                                    </td>
                                    <td class="unit">$0.00</td>
                                    <td class="qty">100</td>
                                    <td class="total">$0.00</td>
                                </tr>
                                <tr>
                                    <td class="no">01</td>
                                    <td class="text-left">
                                        <h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity
                                    </td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">30</td>
                                    <td class="total">$1,200.00</td>
                                </tr>
                                <tr>
                                    <td class="no">02</td>
                                    <td class="text-left">
                                        <h3>Website Development</h3>Developing a Content Management System-based Website
                                    </td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">80</td>
                                    <td class="total">$3,200.00</td>
                                </tr>
                                <tr>
                                    <td class="no">03</td>
                                    <td class="text-left">
                                        <h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)
                                    </td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">20</td>
                                    <td class="total">$800.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">SUBTOTAL</td>
                                    <td>$5,200.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">TAX 25%</td>
                                    <td>$1,300.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">GRAND TOTAL</td>
                                    <td>$6,500.00</td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="thanks">Thank you!</div>
                        <div class="toolbar hidden-print">
                            <div class="text-right">
                                <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                                <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                            </div>
                        </div>

                        <div class="notices">
                            <div>NOTICE:</div>
                            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                        </div>
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

<?php require 'views/footer.php'; ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>


<script>
    $('.js-example-basic-single').select2({
        placeholder: "Seleccione"
    });
</script>