<?php
require('public/fpdf/fpdf.php');

class PdfModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function GenerarPdf($data)
    {
        $ordentexo = "Venta # ";


        $fecha = explode(" ", $data["fecha"]);
        if (count($fecha) <= 1) {
            $fecha[1] = "";
        }

        header('Content-type: application/pdf');
        http_response_code(200);
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(71, 5, 'Datos del Cliente', 0, 0);
        $pdf->Cell(59, 5, '', 0, 0);
        $pdf->Cell(59, 5,  $ordentexo . $data["idorden"], 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(130, 5, 'Cedula:' . $data["cedula"], 0, 0);
        $pdf->Cell(25, 5, 'Fecha: ', 0, 0);
        $pdf->Cell(34, 5, $fecha[0], 0, 1);

        $pdf->Cell(130, 5, 'Nombre: ' . $data["nombre"], 0, 0);
        $pdf->Cell(25, 5, 'Hora: ', 0, 0);
        $pdf->Cell(34, 5, $fecha[1], 0, 1);

        $pdf->Cell(50, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        /*Heading Of the table*/
        $pdf->Cell(20, 6, 'Codigo', 1, 0, 'C');
        $pdf->Cell(80, 6, 'Producto / Servicio', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Precio unitario', 1, 0, 'C');
        $pdf->Cell(28, 6, 'cantidad', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Total', 1, 0, 'C');
        $pdf->Cell(0, 6, '', 1, 1, 'C');/*end of line*/
        /*Heading Of the table end*/

        try {
            $items = [];

            $procedure = "SELECT 
            det.id_prod as codigo,
            pr.pr_nombre as prod,
            det.precio_uni as uni,
            det.cantidad as cant,
            det.total as total
            FROM inventario_db.inv_factura_detalle as det
            inner join inventario_db.inv_productos pr
            on pr.id_prod = det. id_prod
            where id_factura = '" . $data["idorden"] . "'";

            $query = $this->db->connect()->prepare($procedure);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                //  $c = 0;
                foreach ($result as $row) {
                    $pdf->Cell(20, 6, $row["codigo"], 1, 0);
                    $pdf->Cell(80, 6, $row["prod"], 1, 0);
                    $pdf->Cell(30, 6, $row["uni"], 1, 0, 'R');
                    $pdf->Cell(28, 6, $row["cant"], 1, 0, 'R');
                    $pdf->Cell(30, 6, $row["total"], 1, 0, 'R');
                    $pdf->Cell(0, 6, '', 1, 1, 'R');
                }
            } else {
                $err = $query->errorInfo();
                //echo json_encode($err);
                //exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }




        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Subtotal', 0, 0);
        $pdf->Cell(45, 6, $data["sub"], 1, 1, 'R');
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Iva', 0, 0);
        $pdf->Cell(45, 6, $data["iva"], 1, 1, 'R');
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Total', 0, 0);
        $pdf->Cell(45, 6, $data["total"], 1, 1, 'R');
        echo json_encode($pdf->Output("I"));
        exit();
    }

    function GenerarPdf2($data)
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
        $pdf->SetFont('Arial', '', 10);

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
                    if($medida == "1"){
                        $medida = "unidad";
                    }else{
                        $medida = "metros";
                    }

                    $pdf->Cell(30, 6, $row["nombre"], 1, 0);
                    $pdf->Cell(60, 6, $row["descripcion"], 1, 0);
                    $pdf->Cell(20, 6, $medida, 1, 0);
                    $pdf->Cell(28, 6, number_format($row["precio"],2,',','.'), 1, 0, 'R');
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


    function GenerarPdfProforma($data)
    {
        $ordentexo = "Proforma # ";


        $fecha = explode(" ", $data["fecha"]);
        if (count($fecha) <= 1) {
            $fecha[1] = "";
        }

        header('Content-type: application/pdf');
        http_response_code(200);
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(71, 5, 'Datos del Cliente', 0, 0);
        $pdf->Cell(59, 5, '', 0, 0);
        $pdf->Cell(59, 5,  $ordentexo . $data["idorden"], 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(130, 5, 'Cedula:' . $data["cedula"], 0, 0);
        $pdf->Cell(25, 5, 'Fecha: ', 0, 0);
        $pdf->Cell(34, 5, $fecha[0], 0, 1);

        $pdf->Cell(130, 5, 'Nombre: ' . $data["nombre"], 0, 0);
        $pdf->Cell(25, 5, 'Hora: ', 0, 0);
        $pdf->Cell(34, 5, $fecha[1], 0, 1);

        $pdf->Cell(50, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        /*Heading Of the table*/
        $pdf->Cell(20, 6, 'Codigo', 1, 0, 'C');
        $pdf->Cell(80, 6, 'Producto / Servicio', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Precio unitario', 1, 0, 'C');
        $pdf->Cell(28, 6, 'cantidad', 1, 0, 'C');
        $pdf->Cell(30, 6, 'Total', 1, 0, 'C');
        $pdf->Cell(0, 6, '', 1, 1, 'C');/*end of line*/
        /*Heading Of the table end*/

        try {
            $items = [];

            $procedure = "SELECT 
            det.id_prod as codigo,
            pr.pr_nombre as prod,
            det.precio_uni as uni,
            det.cantidad as cant,
            det.total as total
            FROM inventario_db.inv_proforma_det as det
            inner join inventario_db.inv_productos pr
            on pr.id_prod = det. id_prod
            where id_proforma = '" . $data["idorden"] . "'";

            $query = $this->db->connect()->prepare($procedure);

            if ($query->execute()) {
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                //  $c = 0;
                foreach ($result as $row) {
                    $pdf->Cell(20, 6, $row["codigo"], 1, 0);
                    $pdf->Cell(80, 6, $row["prod"], 1, 0);
                    $pdf->Cell(30, 6, $row["uni"], 1, 0, 'R');
                    $pdf->Cell(28, 6, $row["cant"], 1, 0, 'R');
                    $pdf->Cell(30, 6, $row["total"], 1, 0, 'R');
                    $pdf->Cell(0, 6, '', 1, 1, 'R');
                }
            } else {
                $err = $query->errorInfo();
                //echo json_encode($err);
                //exit();
            }
        } catch (PDOException $e) {
            print_r($query->errorInfo());
        }




        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Subtotal', 0, 0);
        $pdf->Cell(45, 6, $data["sub"], 1, 1, 'R');
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Iva', 0, 0);
        $pdf->Cell(45, 6, $data["iva"], 1, 1, 'R');
        $pdf->Cell(118, 6, '', 0, 0);
        $pdf->Cell(25, 6, 'Total', 0, 0);
        $pdf->Cell(45, 6, $data["total"], 1, 1, 'R');
        echo json_encode($pdf->Output("I"));
        exit();
    }
}
