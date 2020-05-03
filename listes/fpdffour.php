<?php

require '../assests/fpdf/mc_table.php';

class LEB extends PDF_MC_Table {

       function Header() {
        $this->Image('../assests/images/background.png', 0, 0, 300, 300);
        $this->SetY(8);
        $this->SetFont("times", "", 8);
        $this->SetX(10);
        //$this->SetTextColor(0, 0, 0);
        $this->MultiCell(80, 4, utf8_decode("DIGITAL CORPORATION SARL \nAbidjan Cocody Rivera Bonoumin Ouest\n28 BP 529 Abidjan 28 Abidjan\nTéléphone: (+225) 22 00 84 93,  78 25 76 33/07 19 08 72\nadamakaboreida@gmail.com\nSiren: CI-ABJ-2019-B-06007\n"), 0, "L");
        $this->Image('../assests/images/logo1.png', 235, 7, 50, 30);
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
$koffi->Cell(300, 10, utf8_decode("REGLEMENTS DES FOURNISSEURS"), 0, 1, "C");

$koffi->setFont("times", "B", 10);

$koffi->Cell(50, 10, utf8_decode("Fournisseur"), 1, 0, "C");
$koffi->Cell(35, 10, utf8_decode("Quantité Produits"), 1, 0, "C");
$koffi->Cell(40, 10, utf8_decode("Montant Total"), 1, 0, "C");
$koffi->Cell(40, 10, utf8_decode("Total Payé"), 1, 0, "C");
$koffi->Cell(40, 10, utf8_decode("Reste à payer"), 1, 0, "C");
$koffi->Cell(30, 10, utf8_decode("Date Paiement"), 1,0, "C");
$koffi->Cell(35, 10, utf8_decode("État Facture"), 1, 1, "C");

$koffi->setFont("times", "", 10);
$koffi->SetWidths(array(50, 35, 40, 40, 40, 30, 35));

while ($result = $query->fetch_assoc()) {
    if ($result['reste_paiement'] == 0) {
            $paymentStatus = "Facture reglée";
        } else {
            $paymentStatus = "Facture non reglée";
        }
    $data = array(utf8_decode($result['four_name']), number_format($result['qte'], 0, ",", " "), number_format($result['montant_total'], 0, ",", " "), number_format($result['total_paiement'], 0, ",", " "), number_format($result['reste_paiement'], 0, ",", " "), date("d-m-Y", strtotime($result['date'])),utf8_decode($paymentStatus));
    $koffi->Row($data);
}

//changer I en D a la fin
$koffi->Output('I', 'comptabilite_fournisseurs.pdf');
