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
$koffi->Cell(150, 10, utf8_decode("FACTURE PRO-FORMA"), 0, 1, "C");

$koffi->SetFont('times', '', 10);
$koffi->Ln(10);
$koffi->SetX(30);
$koffi->Cell(150, 10, utf8_decode($clientName), 0, 1, "L");

$koffi->Ln(20);
$koffi->setFont("times", "B", 9);

$koffi->Cell(41, 10, utf8_decode("Numéro de client"), 1, 0, "C");
$koffi->Cell(41, 10, utf8_decode("Numéro de la facture"), 1, 0, "C");
$koffi->Cell(31, 10, "Page", 1, 0, "C");
$koffi->Cell(36, 10, utf8_decode("Date de facturation"), 1, 0, "C");
$koffi->Cell(36, 10, utf8_decode("Date d'échéance"), 1, 1, "C");

$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(41, 41, 31, 36, 36));

$numclt = "100" . $orderId;
$numFact = "101" . $orderId;
$page = $koffi->PageNo() . "/{nb}";
$date_facture = date('d-m-Y', strtotime($orderDate));
$date_echeance = "-";

$data = array($numclt, $numFact, $page, $date_facture, $date_echeance);
$koffi->Row($data);

$koffi->Ln(20);
$koffi->setFont("times", "B", 9);

$koffi->Cell(105, 10, utf8_decode("Article"), 1, 0, "L");
$koffi->Cell(20, 10, utf8_decode("Quantité"), 1, 0, "C");
$koffi->Cell(20, 10, "Prix", 1, 0, "C");
$koffi->Cell(20, 10, utf8_decode("TVA"), 1, 0, "C");
$koffi->Cell(20, 10, utf8_decode("Total"), 1, 1, "C");

$koffi->setFont("times", "", 9);

//remplissage du tableau
while ($row = $orderItemResult->fetch_array()) {
    
    $prix = $row[3]/($row[2]*1.18);
    
    $y = $koffi->GetY();
    $koffi->MultiCell(105, 4, utf8_decode(strtoupper($row[4])."\n"." \t\t\t\tTVA : ".number_format($prix*$row[2], 2, ",", " ")." x 18% = ".number_format($prix*$row[2]*0.18, 2, ",", " ")), "LR", "L");
    $koffi->SetXY(115, $y);
    $koffi->Cell(20, 5, utf8_decode($row[2]), "LR", 0, "C");
    $koffi->Cell(20, 5, number_format($prix, 2, ",", " "), "LR", 0, "C");
    $koffi->Cell(20, 5, number_format($prix*$row[2]*0.18, 2, ",", " "), "LR", 0, "C");
    $koffi->Cell(20, 5, utf8_decode($row[3]), "LR", 1, "C");
} // /while
// bas de page fermeture des traits du tableau
$koffi->Cell(105, 12, utf8_decode(""), "LBR", 0, "L");
$koffi->Cell(20, 12, utf8_decode(""), "LBR", 0, "C");
$koffi->Cell(20, 12, "", "LBR", 0, "C");
$koffi->Cell(20, 12, utf8_decode(""), "LBR", 0, "C");
$koffi->Cell(20, 12, utf8_decode(""), "LBR", 1, "C");

$koffi->SetXY(30, 255);
$koffi->SetFont("", "B", 10);
$koffi->Cell(20, 10, utf8_decode($_SESSION['userConn']), 0, 1, "C");
//$koffi->Image('assests/images/cachet.png', 30, 260, 40, 20);

$koffi->SetXY(119, 240);
$koffi->Cell(38, 5, utf8_decode("Total HT"), 0, 0, "L");
$koffi->Cell(38, 5, utf8_decode(number_format($subTotal, 1, ",", " ")." XOF"), 0, 1, "R");

$koffi->SetX(119);
$koffi->Cell(38, 5, utf8_decode("TVA"), 0, 0, "L");
$koffi->Cell(38, 5, utf8_decode(number_format($vat, 1, ",", " ")." XOF"), 0, 1, "R");

$koffi->SetX(119);
$koffi->Cell(38, 5, utf8_decode("Total"), 0, 0, "L");
$koffi->Cell(38, 5, utf8_decode(number_format($totalAmount, 1, ",", " ")." XOF"), 0, 1, "R");

$char = '0123456789';
$code = '';
for ($i = 0; $i < 4; $i++) {
    $code .= $char[rand() % strlen($char)];
}

//changer I en D a la fin
$koffi->Output('I', 'devis-' . $code . '.pdf');
