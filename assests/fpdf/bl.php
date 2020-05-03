<?php

require 'mc_table.php';

class LEB extends PDF_MC_Table {

    function Header() {
        $this->SetFont("times", "", 16);
        $this->SetY(5);
        $y = $this->GetY();
        $this->MultiCell(280, 4, utf8_decode("BON DE LIVRAISON N° : BL00". mt_rand(1,10000)), 0, "C");
        $this->SetX(12);
        $this->Image('assests/images/logo1.png', 50, 25, 40, 30);
        $this->SetY($y + 60);
        $this->SetFont("times", "", 13);
        $this->MultiCell(260, 4, ucfirst(strftime('%A  le  %d %B  %Y')), 0, "R");
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont("times", "b", 10);
        $this->SetX(10);
        $this->MultiCell(280, 4, utf8_decode("Digital Corporation Sarl - L- RC N° : CI-ABJ-2019-8-06007 - RCC N°:1914989P - Compte Bancaire: ADVANS N° CI008 01111 0111598619-43 13"), 0, "C");
        $this->AliasNbPages();
    }

}

$koffi = new LEB();

//action
$koffi->AddPage("L", "A4", 0);

$koffi->SetFont('times', '', 13);
$koffi->Ln(15);
$koffi->SetX(40);
$koffi->Cell(150, 10, utf8_decode("Bon Commande N° :". initiales($_SESSION['userConn']). mt_rand(100, 9999)."/DGCS/ABJ". date('Y')), 0, 1, "L");
$koffi->Ln(10);
$koffi->setFont("times", "B", 13);

$koffi->Cell(20, 10, utf8_decode("Code"), 1, 0, "L");
$koffi->Cell(90, 10, utf8_decode("Désignation"), 1, 0, "C");
$koffi->MultiCell(45, 5, utf8_decode("Quantité Commandée"), 1, "C");
$x = $koffi->GetX();
$y = $koffi->GetY();
$koffi->SetXY($x+155, $y-10);
$koffi->Cell(40, 10, utf8_decode("Quantité Livrée"), 1,0, "C");
$koffi->SetXY($x+195, $y-10);
$koffi->MultiCell(40, 5, utf8_decode("Quantité restant à livrer"), 1, "C");
$koffi->SetXY($x+235, $y-10);
$koffi->Cell(40, 10, utf8_decode("Observation"), 1, 1, "C");

$koffi->setFont("times", "", 12);

//remplissage du tableau
   $koffi->SetWidths(array(20, 90, 45, 40, 40, 40));
   
while ($row = $orderItemResult->fetch_array()) {

$data = array("", utf8_decode($row['designation']), utf8_decode($row['quantity']), utf8_decode($row['quantity']), '0', '');
$koffi->Row($data);

}

$koffi->setFont("times", "b", 13);
$koffi->Cell(195, 10, utf8_decode("Visa du client et observations éventuelles"), 1, 0, "C");
$koffi->Cell(80, 10, utf8_decode("Visa du fournisseur"), 1, 1, "C");
$y = $koffi->GetY();
$koffi->setFont("times", "", 13);
$koffi->Cell(110, 20, utf8_decode("Reçu le : ". date('d / m / Y')), 1, 0, "C");
$koffi->SetXY(120, $y);
$koffi->setFont("times", "b", 12);
$koffi->MultiCell(85, 10, utf8_decode("Réserves sur la livraison"), 1, "C");
$koffi->SetXY(120, $y+10);
$koffi->MultiCell(85, 10, utf8_decode(""), 1, "C");
$koffi->SetXY(205, $y);
$koffi->setFont("times", "", 12);
$koffi->MultiCell(80, 10, utf8_decode("Livré le 03/12/2020\n \n"), 1, "C");


//changer I en D a la fin
$koffi->Output('I', 'BON DE LIVRAISON CONSOMMABLE.pdf');
