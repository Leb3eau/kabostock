<?php

require 'mc_table.php';

class LEB extends PDF_MC_Table {

    function Header() {
        $this->Image('assests/images/background.png', 0, 0, 240, 340);
        $this->SetY(8);
        $this->SetFont("times", "", 8);
        $this->SetX(10);
        //$this->SetTextColor(0, 0, 0);
        $this->MultiCell(80, 4, utf8_decode("DIGITAL CORPORATION SARL \nAbidjan Cocody Rivera Bonoumin Ouest\n28 BP 529 Abidjan 28 Abidjan\nTéléphone: (+225) 22 00 84 93,  78 25 76 33/07 19 08 72\nadamakaboreida@gmail.com\nSiren: CI-ABJ-2019-B-06007\n"), 0, "L");
        $this->Image('assests/images/logo1.png', 145, 7, 50, 30);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont("times", "", 8);
        $this->SetX(10);
        $this->MultiCell(180, 4, utf8_decode("Digital Corporation Sarl - 28 PB 529 Abidjan 28 Cocody riviera  Bonoumin Ouest-Côte d'Ivoire   Tel: 22 00 84 93 \nCel: 78 25 76 33 - 09 14 07 59  Email: support@digicorp.ci   N° RCM: CI-ABJ-2019-B-06007 - N° RCC: 1914989 P"), 0, "C");
        $this->AliasNbPages();
    }

}

$koffi = new LEB();

//action
$koffi->AddPage("", "A4", 0);

$koffi->SetFont('times', 'B', 14);
$koffi->Ln(20);
$koffi->SetX(30);
$koffi->Cell(150, 10, utf8_decode("GESTION DU STOCK $start_date_affic AU $end_date_aff"), 0, 1, "C");

$koffi->setFont("times", "B", 9);

$koffi->Cell(40, 10, utf8_decode("Libellé"), 1, 0, "C");
$koffi->Cell(45, 10, utf8_decode("Fournisseur"), 1, 0, "C");
//$x = $koffi->GetX();
//$y = $koffi->GetY();
$koffi->Cell(27, 10, utf8_decode("Quantité Initiale"), 1, 0, "C");
//$koffi->SetXY($x+27, $y);
$koffi->Cell(27, 10, utf8_decode("Quantité Vendue"), 1, 0, "C");
//$koffi->SetXY($x+54, $y);
//$koffi->MultiCell(27, 5, utf8_decode("Quantité en Stock"), 1, "C");
$koffi->Cell(27, 10, utf8_decode("Quantité en Stock"), 1, 0, "C");
//$koffi->SetXY($x+81, $y);
$koffi->Cell(25, 10, utf8_decode("État"), 1, 1, "C");

$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(40, 45, 27, 27, 27, 25));

while ($result = $query->fetch_assoc()) {
    $id = $result['id'];

    $sql = "SELECT SUM(order_item.quantity) AS qte_vendue FROM order_item,product,orders WHERE orders.order_status = 1 AND product.product_id=order_item.product_id AND order_item.order_id=orders.order_id AND product.product_id='$id'";
    $qte_v = $connect->query($sql);
    $qte_vendue = $qte_v->fetch_all();

    if ($result['stock'] == 0) {
        $stock = "Rupture de Stock";
    } else if ($result['stock'] <= 6) {
        $stock = "Aletre! Stock Minimal";
    } else {
        $stock = "Stock Satisfaisant";
    }


    $data = array($result['pn'], $result['fournisseurs'], number_format($result['initial'], 0, ",", " "), number_format($qte_vendue[0][0], 0, ",", " "), number_format($result['stock'], 0, ",", " "), $stock);
    $koffi->Row($data);
}

//changer I en D a la fin
$koffi->Output('I', 'Stock-' .$start_date_affic. '_'.$end_date_aff.'.pdf');
