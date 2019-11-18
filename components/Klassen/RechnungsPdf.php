<?php
class RechnungsPdf
{
   private $rechnungs_nummer;
   private $rechnungs_datum;
   private $pdfAuthor;
   private $rechnungs_posten;
   private $umsatzsteuer;
   private $pdfName;
   private $gesamtpreis;
   private $rechnungsHeader ="<img src=\"./logo_ohneText.png\">
                                Fly-Cinema
                                www.Fly-Cinema.de";
   private $rechnungs_empfaenger;
   private $rechnungsFooter ="Mit Liebe erstellt von Fly-Cinema";

public function __construct($rechnungs_nummer,$rechnungs_datum,$pdfAuthor,$rechnungs_posten,$umsatzsteuer,$pdfName,$gesamtPreis,$rechnungs_empfaenger){

        $this->rechnungs_nummer= $rechnungs_nummer;
        $this->rechnungs_datum = $rechnungs_datum;
        $this->pdfAuthor = $pdfAuthor;
        $this->rechnungs_posten = $rechnungs_posten;
        $this->umsatzsteuer= $umsatzsteuer;
        $this->pdfName = $pdfName;
        $this->gesamtpreis =$gesamtPreis;
        $this->rechnungs_empfaenger = $rechnungs_empfaenger;
}

public function erstellePdf(){
 require_once($_SERVER['DOCUMENT_ROOT'].'/tcpdf/tcpdf.php');
    $Html='
<b>Empfänger:</b> Fly-Cinema
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
 <tr>

    <td style="text-align: right">
Rechnungsnummer '.$this->rechnungs_nummer.'<br>
Rechnungsdatum: '.$this->rechnungs_datum.'<br>
 </td>
 </tr>
 
 <tr>
 <td style="font-size:1.3em; font-weight: bold;">
<br><br>
Rechnung für
<br>
 </td>
 </tr>
 
 
 <tr>
 <td colspan="2">'.nl2br(trim($this->rechnungs_empfaenger)).'</td>
 </tr>
</table>
<br><br><br>
 
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
 <tr style="background-color: #cccccc; padding:5px;">
 <td style="padding:5px;"><b>Bezeichnung</b></td>
 <td style="text-align: center;"><b>Menge</b></td>
 <td style="text-align: center;"><b>Einzelpreis</b></td>
 <td style="text-align: center;"><b>Reihe</b></td>
 <td style="text-align: center;"><b>SitzNr</b></td>
 <td style="text-align: center;"><b>Preis</b></td>
 </tr>';


    $gesamtpreis = 0;

    foreach($this->rechnungs_posten as $posten) {
        $menge = $posten[1];
        $einzelpreis = $posten[2];
        $preis = $menge*$einzelpreis;
        $gesamtpreis += $preis;
        $Html .= '<tr>
                <td>'.$posten[0].'</td>
 <td style="text-align: center;">'.$posten[1].'</td> 
 <td style="text-align: center;">'.number_format($posten[2], 2, ',', '').' Euro</td>	
 <td style="text-align: center;">'.$posten[3].'</td>
 <td style="text-align: center;">'.$posten[4].'</td>
     <td style="text-align: center;">'.number_format($preis, 2, ',', '').' Euro</td>
              </tr>';
    }
    $Html .="</table>";



    $Html .= '
<hr>
<table cellpadding="5" cellspacing="0" left="10px" style="width: 100%;" border="0">';
    if($this->umsatzsteuer > 0) {
        $netto = $this->gesamtpreis / (1+$this->umsatzsteuer);
        $umsatzsteuer_betrag = $this->gesamtpreis - $netto;

        $Html .= '
 <tr>
 <td colspan="3">Zwischensumme (Netto)</td>
 <td style="text-align: center;">'.number_format($netto , 2, ',', '').' Euro</td>
 </tr>
 <tr>
 <td colspan="3">Umsatzsteuer ('.intval($this->umsatzsteuer*100).'%)</td>
 <td style="text-align: center;">'.number_format($umsatzsteuer_betrag, 2, ',', '').' Euro</td>
 </tr>';
    }

    $Html .='
            <tr>
                <td colspan="3"><b>Gesamtsumme: </b></td>
                <td style="text-align: center;"><b>'.number_format($this->gesamtpreis, 2, ',', '').' Euro</b></td>
            </tr> 
        </table>
<br><br><br>';

    if($this->umsatzsteuer == 0) {
        $Html .= 'Nach § 19 Abs. 1 UStG wird keine Umsatzsteuer berechnet.<br><br>';
    }

    $Html .= nl2br($this->rechnungsFooter);
//Pdf erstellen
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Dokumenteninformationen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($this->pdfAuthor);
    $pdf->SetTitle('Rechnung '.$this->rechnungs_nummer);
    $pdf->SetSubject('Rechnung '.$this->rechnungs_nummer);


// Header und Footer Informationen
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Auswahl des Font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Auswahl der MArgins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Automatisches Autobreak der Seiten
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Image Scale
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Schriftart
    $pdf->SetFont('dejavusans', '', 10);

// Neue Seite
    $pdf->AddPage();
    $pdf->writeHTML($Html, true, false, true, false, '');
//Variante 2: PDF im Verzeichnis abspeichern:
$String = $_SERVER['DOCUMENT_ROOT'].'Bestellungen/'.$this->pdfName;
    $pdf->Output($String, 'F');
    echo 'Bitte bringen Sie diese PDF mit zu ihrem Kinobesuch: <a href="./Bestellungen/'.$this->pdfName.'">'.$this->pdfName.'</a>';


}


}