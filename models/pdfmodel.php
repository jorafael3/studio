<?php
require('public/fpdf/fpdf.php');
require_once('public/tcpdf_min/tcpdf.php');


class PdfModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }



    function GenerarPdfProforma($data)
    {
        $id = $data["id"];
        $ordentexto = "Proforma # ";

        $nombre = "";
        $fecha = "";

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT * FROM studio.proforma_cab where id_cab = :id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $nombre = $row["nombre"];
                    $fecha = $row["fecha"];
                    $subtotal = round($row["subtotal"], 2);
                    $margen = $row["margen"];
                    $ganancia = $row["ganancia"];
                    $total = $row["total"];
                }
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }

        /*$fecha = explode(" ", $data["fecha"]);
        if (count($fecha) <= 1) {
            $fecha[1] = "";
        }*/
        $fecha = new DateTime($fecha);
        $fecha = $fecha->format('Y-m-d');
        $subtotal =  number_format($subtotal, 2, ',', '');
        $ganancia =  number_format($ganancia, 2, ',', '');

        $total =  number_format($total, 2, ',', '');

        header('Content-type: application/pdf');
        http_response_code(200);
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image('public/assets/images/aj.jpeg', 10, 6, 18);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(71, 10, '', 0, 0);
        $pdf->Cell(59, 5, '', 0, 0);
        $pdf->Cell(59, 10, '', 0, 1);

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(71, 20, 'Datos de la proforma', 0, 0);
        $pdf->Cell(59, 20, '', 0, 0);
        $pdf->Cell(59, 20, $ordentexto . str_pad($id, 10, "0", STR_PAD_LEFT), 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 5, 'Nombre: ' . $nombre, 0, 0);
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->Cell(80, 5, "Fecha: " . $fecha, 0, 1);

        $pdf->Cell(50, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        /*Heading Of the table*/
        $pdf->Cell(30, 6, 'Nombre', 1, 0, 'C');
        $pdf->Cell(60, 6, 'Descripcion', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Medida', 1, 0, 'C');
        $pdf->Cell(28, 6, 'Costo', 1, 0, 'C');
        $pdf->Cell(20, 6, 'cantidad', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Total', 1, 1, 'C');/*end of line*/
        /*Heading Of the table end*/
        $pdf->SetFont('Arial', '', 12);

        try {
            $items = [];
            $query = $this->db->connect()->prepare("SELECT  
            p.nombre ,p.descripcion ,p.medida ,p.precio ,pd.cantidad ,pd.total 
            from studio.proforma_det pd 
            left join studio.productos p
            on pd.id_prod = p.id_prod 
            where pd.id_cab = :id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                //  $c = 0;
                foreach ($result as $row) {
                    $medida = $row["medida"];
                    if ($medida == "1") {
                        $medida = "unidad";
                    } else {
                        $medida = "metros";
                    }

                    $pdf->Cell(30, 6, $row["nombre"], 1, 0);
                    $pdf->Cell(60, 6, $row["descripcion"], 1, 0);
                    $pdf->Cell(20, 6, $medida, 1, 0);
                    $pdf->Cell(28, 6, number_format($row["precio"], 2, ',', '.'), 1, 0, 'R');
                    $pdf->Cell(20, 6, $row["cantidad"], 1, 0, 'R');
                    $pdf->Cell(30, 6, number_format($row["total"], 2, ',', '.'), 1, 1, 'R');
                }
            } else {
                $err = $query->errorInfo();
                echo json_encode($err);
                exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }
        $pdf->Cell(50, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Subtotal', 0, 0);
        $pdf->Cell(45, 6,  "$" . $subtotal, 1, 1, 'R');
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Margen', 0, 0);
        $pdf->Cell(45, 6, $margen . "%", 1, 1, 'R');
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Ganancia', 0, 0);
        $pdf->Cell(45, 6, "$" . $ganancia, 1, 1, 'R');
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Total', 0, 0);
        $pdf->Cell(45, 6, "$" . $total, 1, 1, 'R');
        echo json_encode($pdf->Output("I"));
        exit();
    }


    function GenerarPdfOrden($data)
    {
        $ordentexo = "Proforma # ";
        $id = $data["id"];
        $NombreEmpresa = "Aj Estudio";
        $telefonoEmpresa = "093153115";
        $imagenl =' http://10.5.2.191:8080/studio/public/assets/images/aj.jpeg';
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData($imagenl , PDF_HEADER_LOGO_WIDTH, $NombreEmpresa, $telefonoEmpresa, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
       // $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('helvetica', '', 10, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Set some content to print
        $html = <<<EOD
        <table class="first" cellpadding="4" cellspacing="6">
            <tr>
                <td width="100" align="center">
                    <div style="width: 100%;">
                        <img width="60px" height="60px" src="http://10.5.2.191:8080/studio/public/assets/images/aj.jpeg" alt="">
                    </div>
                </td>
                <td width="500" align="left">
                    <span>$NombreEmpresa</span><br>
                    <span>$telefonoEmpresa</span><br>
                </td>
                
            </tr>
            <tr>
                <td width="30" align="center">1.</td>
                <td width="140" rowspan="6" class="second">XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
                <td width="140">XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td width="80">XXXX</td>
                <td align="center" width="45">XXXX<br />XXXX</td>
            </tr>
            <tr>
                <td width="30" align="center" rowspan="3">2.</td>
                <td width="140" rowspan="3">XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td align="center" width="45">XXXX<br />XXXX</td>
            </tr>
            <tr>
                <td width="80">XXXX<br />XXXX<br />XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td align="center" width="45">XXXX<br />XXXX</td>
            </tr>
            <tr>
                <td width="80" rowspan="2">XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td align="center" width="45">XXXX<br />XXXX</td>
            </tr>
            <tr>
                <td width="30" align="center">3.</td>
                <td width="140">XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td align="center" width="45">XXXX<br />XXXX</td>
            </tr>
            <tr bgcolor="#FFFF80">
                <td width="30" align="center">4.</td>
                <td width="140" bgcolor="#00CC00" color="#FFFF00">XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td width="80">XXXX<br />XXXX</td>
                <td align="center" width="45">XXXX<br />XXXX</td>
            </tr>
        </table>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');
    }
}
