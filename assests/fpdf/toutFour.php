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
$koffi->Cell(150, 10, utf8_decode("FACTURE FOURNISSEUR"), 0, 1, "C");

$koffi->SetFont('times', '', 10);
$koffi->Ln(10);
$koffi->SetX(30);
$koffi->Cell(150, 10, utf8_decode($fourame), 0, 1, "L");

$koffi->Ln(20);
$koffi->setFont("times", "B", 9);

$koffi->Cell(30, 10, utf8_decode("Date d'Achat"), 1, 0, "C");
$koffi->Cell(20, 10, utf8_decode("Quantité"), 1, 0, "C");
$koffi->Cell(41, 10, utf8_decode("Montant Total"), 1, 0, "C");
$koffi->Cell(31, 10, utf8_decode("Date Paiement"), 1, 0, "C");
$koffi->Cell(36, 10, utf8_decode("Montant Payé"), 1, 0, "C");
$koffi->Cell(36, 10, utf8_decode("Reste à payer"), 1, 1, "C");

$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(30, 20, 41, 31, 36, 36));

$Total = 0;
$paid = 0;
$rest = 0;

while ($value = $orderResult->fetch_array()) {
    $data = array(date("d-m-Y", strtotime($value['date'])), number_format($value['qte'], 0, ",", " "), number_format($value['montant_total'], 0, ",", " "), date("d-m-Y", strtotime($value['date'])), number_format($value['total_paiement'], 0, ",", " "), number_format($value['reste_paiement'], 0, ",", " "));
    $koffi->Row($data);
    $Total += $value['montant_total'];
    $paid += $value['total_paiement'];
    $rest += $value['reste_paiement'];
}


$koffi->SetXY(119, 255);
$koffi->SetFont("", "B", 10);

$koffi->Cell(38, 5, utf8_decode("Montant Total"), 0, 0, "L");
$koffi->Cell(38, 5, utf8_decode(number_format($Total, 1, ",", " ")." XOF"), 0, 1, "R");

$koffi->SetX(119);
$koffi->Cell(38, 5, utf8_decode("Montant Total Payé"), 0, 0, "L");
$koffi->Cell(38, 5, utf8_decode(number_format($paid, 1, ",", " ")." XOF"), 0, 1, "R");

$koffi->SetX(119);
$koffi->Cell(38, 5, utf8_decode("Montant Total Restant"), 0, 0, "L");
$koffi->Cell(38, 5, utf8_decode(number_format($rest, 1, ",", " ")." XOF"), 0, 1, "R");


$char = '0123456789';
$code = '';
for ($i = 0; $i < 4; $i++) {
    $code .= $char[rand() % strlen($char)];
}

//changer I en D a la fin
$koffi->Output('I', 'factureFour-' . $code . '.pdf');
