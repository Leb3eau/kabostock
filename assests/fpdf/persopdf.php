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
$koffi->Cell(150, 10, utf8_decode("PERSONNELS DU $start_date_affic AU $end_date_aff"), 0, 1, "C");

$koffi->setFont("times", "B", 9);

$koffi->Cell(45, 10, utf8_decode("Nom & Prénoms"), 1, 0, "C");
$koffi->Cell(30, 10, utf8_decode("CNI"), 1, 0, "C");
$koffi->Cell(25, 10, utf8_decode("Contact"), 1, 0, "C");
$koffi->Cell(30, 10, utf8_decode("Fonction"), 1, 0, "C");
$koffi->Cell(20, 10, utf8_decode("Date fonction"), 1, 0, "C");
$koffi->Cell(25, 10, utf8_decode("Salaire"), 1, 1, "C");
$koffi->setFont("times", "", 9);
$koffi->SetWidths(array(45, 30, 25, 30, 20, 25));

while ($result = $query->fetch_assoc()) {
    
    $data = array(utf8_decode($result['nom_prenom']), utf8_decode($result['cni']),utf8_decode($result['contact']), utf8_decode($result['fonction']), date("d-m-Y", strtotime($result['date_fonction'])), number_format($result['salaire'], 0, ",", " "));
    $koffi->Row($data);
}

//changer I en D a la fin
$koffi->Output('I', 'personnels-' .$start_date_affic. '_'.$end_date_aff.'.pdf');
