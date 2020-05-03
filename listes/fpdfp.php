<?php

require '../assests/fpdf/mc_table.php';

class LEB extends PDF_MC_Table {

    function Header() {
        $this->Image('../assests/images/background.png', 0, 0, 240, 340);
        $this->SetY(8);
        $this->SetFont("times", "", 8);
        $this->SetX(10);
        //$this->SetTextColor(0, 0, 0);
        $this->MultiCell(80, 4, utf8_decode("DIGITAL CORPORATION SARL \nAbidjan Cocody Rivera Bonoumin Ouest\n28 BP 529 Abidjan 28 Abidjan\nTéléphone: (+225) 22 00 84 93,  78 25 76 33/07 19 08 72\nadamakaboreida@gmail.com\nSiren: CI-ABJ-2019-B-06007\n"), 0, "L");
        $this->Image('../assests/images/logo1.png', 145, 7, 50, 30);
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
$koffi->Cell(150, 10, utf8_decode("LISTE DES PRODUITS"), 0, 1, "C");

$koffi->setFont("times", "B", 9);

$koffi->Cell(70, 10, utf8_decode("Désignation"), 1, 0, "C");
$koffi->Cell(27, 10, utf8_decode("Marque"), 1, 0, "C");
//$x = $koffi->GetX();
//$y = $koffi->GetY();
$koffi->Cell(27, 10, utf8_decode("Type"), 1, 0, "C");
//$koffi->SetXY($x+27, $y);
$koffi->Cell(70, 10, utf8_decode("Description"), 1, 1, "C");

$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(70, 27, 27, 70));

while ($result = $query->fetch_assoc()) {
    
    $data = array(utf8_decode($result['designation']), utf8_decode($result['marque']), utf8_decode($result['type']), utf8_decode($result['description']));
    $koffi->Row($data);
}

//changer I en D a la fin
$koffi->Output('I', 'liste_produits.pdf');
