<?php

require 'mc_table.php';

class LEB extends PDF_MC_Table {

    function Header() {
        $this->Image('assests/images/background.png', 0, 0, 300, 300);
        $this->SetY(8);
        $this->SetFont("times", "", 8);
        $this->SetX(10);
        //$this->SetTextColor(0, 0, 0);
        $this->MultiCell(80, 4, utf8_decode("DIGITAL CORPORATION SARL \nAbidjan Cocody Rivera Bonoumin Ouest\n28 BP 529 Abidjan 28 Abidjan\nTéléphone: (+225) 22 00 84 93,  78 25 76 33/07 19 08 72\nadamakaboreida@gmail.com\nSiren: CI-ABJ-2019-B-06007\n"), 0, "L");
        $this->Image('assests/images/logo1.png', 235, 7, 50, 30);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont("times", "", 8);
        $this->SetX(10);
        $this->MultiCell(280, 4, utf8_decode("Digital Corporation Sarl - 28 PB 529 Abidjan 28 Cocody riviera  Bonoumin Ouest-Côte d'Ivoire   Tel: 22 00 84 93 \nCel: 78 25 76 33 - 09 14 07 59  Email: support@digicorp.ci   N° RCM: CI-ABJ-2019-B-06007 - N° RCC: 1914989 P"), 0, "C");
        $this->AliasNbPages();
    }

}

$koffi = new LEB();

//action
$koffi->AddPage("L", "A4", 0);

$koffi->SetFont('times', 'B', 14);
$koffi->Ln(20);
$koffi->SetX(30);
$koffi->Cell(270, 10, utf8_decode("BÉNÉFICES DU $start_date_affic AU $end_date_aff"), 0, 1, "C");

$koffi->setFont("times", "B", 9);

$koffi->Cell(75, 10, utf8_decode("Entités"), 1, 0, "C");
$koffi->Cell(50, 10, utf8_decode("Quantité Vendue"), 1, 0, "C");
$koffi->Cell(45, 10, utf8_decode("Prix d'achat"), 1, 0, "C");
$koffi->Cell(45, 10, utf8_decode("Prix Vente"), 1, 0, "C");
$koffi->Cell(30, 10, utf8_decode("Bénéfice Unitaire"), 1, 0, "C");
$koffi->Cell(35, 10, utf8_decode("Total"), 1, 1, "C");

$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(75, 50, 45, 45, 30, 35));

$totalAmount = 0;
while ($result = $query->fetch_assoc()) {
    $ben = $result['pv'] - $result['pa'];
    $bt = $ben * $result['qte'];
    $data = array($result['pn'], number_format($result['qte'], 0, ",", " "), number_format($result['pa'], 0, ",", " "), number_format($result['pv'], 2, ",", " "), number_format($ben, 2, ",", " "), number_format($bt, 2, ",", " "));
    $koffi->Row($data);
    $totalAmount += $bt;
}

if ($charges[0][0] == NULL) {
    $char = 0;
} else {
    $char = $charges[0][0];
}
$bn = $totalAmount - $char;
$mec = $bn - $credit[0][0];

$koffi->Ln();
$koffi->Ln();

$koffi->Cell(170, 10, utf8_decode("Bénéfice Brut"), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($totalAmount, 2, ",", " ")), 1, 1, "C");

$koffi->Cell(170, 10, utf8_decode("Charges & Dépenses"), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($char, 2, ",", " ")), 1, 1, "C");

$koffi->Cell(170, 10, utf8_decode("Bénéfice Net"), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($bn, 2, ",", " ")), 1, 1, "C");

$koffi->Cell(170, 10, utf8_decode("Crédit"), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($credit[0][0], 2, ",", " ")), 1, 1, "C");

$koffi->Cell(170, 10, utf8_decode("Montant en Caisse "), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($mec, 2, ",", " ")), 1, 1, "C");




$koffi->AddPage("L", "A4", 0);
$koffi->SetFont('times', 'B', 14);
$koffi->Ln(20);
$koffi->Cell(280, 10, utf8_decode("GESTION BÉNÉFICES"), 0, 1, "C");

$koffi->setFont("times", "B", 10);

$koffi->SetX(50);
$koffi->Cell(100, 10, utf8_decode("Part KABORÉ"), 1, 0, "C");
$koffi->Cell(100, 10, utf8_decode("Part ASSOCIÉ"), 1, 1, "C");

$kaboss = $mec * 0.7;
$asso = $mec * 0.3;

$koffi->setFont("times", "", 10);
$koffi->SetWidths(array(100, 100));
$koffi->SetX(50);
$data = array(number_format($kaboss, 2, ",", " "), number_format($asso, 2, ",", " "));
$koffi->Row($data);


//changer I en D a la fin
$koffi->Output('I', 'Benefice_' . $start_date_affic . '_' . $end_date_aff . '.pdf');
