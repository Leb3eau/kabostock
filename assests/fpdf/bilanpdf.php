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
$koffi->Cell(270, 10, utf8_decode("BILAN DU $start_date_affic AU $end_date_aff"), 0, 1, "C");

$koffi->setFont("times", "B", 9);

$koffi->Cell(75, 10, utf8_decode("Entités"), 1, 0, "C");
$koffi->Cell(50, 10, utf8_decode("Quantité Vendue"), 1, 0, "C");
$koffi->Cell(45, 10, utf8_decode("Prix d'achat"), 1, 0, "C");
$koffi->Cell(45, 10, utf8_decode("Prix Vente"), 1, 0, "C");
$koffi->Cell(65, 10, utf8_decode("Montant Total Vendu"), 1, 1, "C");

$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(75, 50, 45, 45, 65));

while ($result = $query->fetch_assoc()) {
    $data = array($result['pn'], number_format($result['qte'], 0, ",", " "), number_format($result['pa'], 0, ",", " "), number_format($result['pv'], 2, ",", " "), number_format($result['total'], 2, ",", " "));
    $koffi->Row($data);
}

$koffi->Ln();
$koffi->Ln();
$koffi->Cell(170, 10, utf8_decode("Recettes Encaissées"), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($recettes[0][0], 2, ",", " ")), 1, 1, "C");

$koffi->Cell(170, 10, utf8_decode("Recettes en crédit"), 1, 0, "C");
$koffi->Cell(110, 10, utf8_decode(number_format($recettes[0][1], 2, ",", " ")), 1, 1, "C");




$koffi->AddPage("L", "A4", 0);
$koffi->SetFont('times', 'B', 14);
$koffi->Ln(20);
$koffi->SetX(30);
$koffi->Cell(270, 10, utf8_decode("LISTE DES CLIENTS DÉBITEURS"), 0, 1, "C");

$koffi->setFont("times", "B", 10);

$koffi->Cell(30, 10, utf8_decode("Date d'achat"), 1, 0, "C");
$koffi->Cell(50, 10, utf8_decode("Nom Client"), 1, 0, "C");
$koffi->Cell(30, 10, utf8_decode("Contact Client"), 1, 0, "C");
$koffi->Cell(35, 10, utf8_decode("Montant Total"), 1, 0, "C");
$koffi->Cell(25, 10, utf8_decode("Remise"), 1, 0, "C");
$koffi->Cell(40, 10, utf8_decode("Montant Total Définitif"), 1, 0, "C");
$koffi->Cell(35, 10, utf8_decode("Montant Payé"), 1, 0, "C");
$koffi->Cell(35, 10, utf8_decode("Montant Restant"), 1, 1, "C");

$koffi->setFont("times", "", 10);
$koffi->SetWidths(array(30, 50, 30, 35, 25, 40, 35, 35));

while ($result = $clients_credit->fetch_assoc()) {

    $data = array(date('d-m-Y', strtotime($result['order_date'])), $result['client_name'], $result['client_contact'], number_format($result['total_amount'], 2, ",", " "), number_format($result['discount'], 2, ",", " "), number_format($result['grand_total'], 2, ",", " "), number_format($result['paid'], 2, ",", " "), number_format($result['due'], 2, ",", " "));
    $koffi->Row($data);
}


//changer I en D a la fin
$koffi->Output('I', 'Bilan_' . $start_date_affic . '_' . $end_date_aff . '.pdf');
