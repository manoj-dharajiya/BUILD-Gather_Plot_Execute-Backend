<?php

require_once dirname(__FILE__).'/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class PDF_Generator {

    function create($product,$fields) {
        
        // ob_start();
        $content = $this->getContent($product,$fields);
        // $content = ob_get_clean();
        
        
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content);
        if(file_exists(ROOT_PATH.'/PDFs/product_1.pdf')){            
            unlink(ROOT_PATH.'/PDFs/product_1.pdf');            
        }

        $html2pdf->output(ROOT_PATH.'/PDFs/product_'.$product['id'].'.pdf','F');

    }

    private function getContent($product,$fields) {

        $content = '
        <style type="text/css">
        <!--
        *{
            font-family:"Arial";
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;            
            width: 100%;
        }
        table td, table th {
            border: 1px solid #ccc;
            color: #000;
            padding: 10px;
            transition: all 0.5s ease-in 0s;
        }
        table tr th {
            background-color: transparent;
            font-weight: bold;
            color: #000;
        }
        .product-wrapper h2 {
            font-size: 18px;
        }
        .product-wrapper .product-name {
            margin-bottom: 20px;
        }
        
        .product-section {
            border-top: 1px solid #000;
            padding-top: 5px;
            margin: 0 0 30px;
        }
        .product-section h3 {
            
            font-size: 15px;
            color: gray;            
            margin: 0 0 10px;
        }
        .product-section h4 {
            font-size: 15px;
        }
        .product-section p {
            font-size: 15px;
            line-height: 1.5em;
            margin: 0 0 0px;
        }
        .product-section p a {
            color: #3b556b;
            text-decoration: underline;
            font-weight: bold;
        }
        .product-section p b {
            color: #000;
        }
        .product-section ul li {
            margin-bottom: 20px;
            line-height: 1.5em;            
        }
        
        table.no-border {
            border: none;
        }
        table.no-border tr td {
            border: none;
        }
        table.border-inside {
            border: none;
        }
        table tr th {
            background-color: transparent;
            font-weight: bold;
            color: #000;
        }
        -->
        </style>
        <div class="product-wrapper">
        <h2>
            Stadler Form Produktebeschrieb für Händler-Websites
        </h2>
        <table class="product-name">
            <colgroup>                
                <col style="width: 33.33%">
                <col style="width: 33.33%">
                <col style="width: 33.33%">
            </colgroup>
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Datum</th>
                    <th>Veröffentlichung</th>
                </tr>
            </thead>
            <tr>
                <td>'.$product['product_name'].'</td>
                <td>27.08.2018</td>
                <td>Ist online</td>
            </tr>
        </table>';
        
        if(isset($fields['slogan_de']) && $fields['slogan_de'] !="") {
        $content .= '<div class="product-section">
            <h3>Slogan</h3>            
            <p>
                <b>'.$fields['slogan_de'].'</b>
            </p>            
        </div>';
        }
    
        if(isset($fields['feature_1_de']) || isset($fields['feature_2_de']) || isset($fields['feature_3_de'])) {
            $content .='<div class="product-section">
            <h3>3 wichtigste Features</h3>
            <p>
                <ul>';                    
                    if(isset($fields['feature_1_de']) || isset($fields['feature_2_de']) || isset($fields['feature_3_de'])) {
                        $content .='<li>'.$fields['feature_1_de'].'</li>';
                    }
                    if(isset($fields['feature_1_de']) || isset($fields['feature_2_de']) || isset($fields['feature_3_de'])) {
                        $content .='<li>'.$fields['feature_2_de'].'</li>';                        
                    }
                    if(isset($fields['feature_1_de']) || isset($fields['feature_2_de']) || isset($fields['feature_3_de'])) {
                        $content .='<li>'.$fields['feature_3_de'].'</li>';
                    }

                $content .='</ul>
            </p>
        </div>';
        }

        if(isset($fields['beschreibungstext']) && $fields['beschreibungstext']!="") {
            $content .='<div class="product-section">
            <h3>Beschreibungstext</h3>
            <p>'.$fields['beschreibungstext'].'</p>
        </div>';
        }
        
        $content .='<div class="product-section product-details-section">
            <h3>Technische Daten</h3>
            <table class="no-border">
                <colgroup>                
                    <col style="width: 30%">
                    <col style="width: 70%">                    
                </colgroup>
                <tr>
                    <td width="150px">System: </td>
                    <td>Verdunster</td>
                </tr>
                <tr>
                    <td>Kapazität (bis): </td>
                    <td>370 g/h</td>
                </tr>
                <tr>
                    <td>Raumgrösse (bis): </td>
                    <td>50 m² / 133 m³</td>
                </tr>
                <tr>
                    <td>Leistungsstufen: </td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>Leistungsaufnahme: </td>
                    <td>6 – 18 W</td>
                </tr>
                <tr>
                    <td>Abmessungen: </td>
                    <td>246 x 290 x 246 mm</td>
                </tr>
                <tr>
                    <td>Gewicht: </td>
                    <td>3.1 kg</td>
                </tr>
                <tr>
                    <td>Wassertank Kapazität: </td>
                    <td>3.5 Liter</td>
                </tr>
                <tr>
                    <td>Geräuschpegel: </td>
                    <td>26 – 39 dB(A)</td>
                </tr>
                <tr>
                    <td>Zubehör inklusive: </td>
                    <td>Water Cube, 2 Verdunsterkassetten</td>
                </tr>
                <tr>
                    <td>Zubehör optional: </td>
                    <td>
                        Ätherische Duftöle, Reiniger & Entkalker
                    </td>
                </tr>
                <tr>
                    <td>UVP: </td>
                    <td>179 CHF / 149 € / 169 USD</td>
                </tr>
            </table>
            <h4>Artikelnummer und EAN-Code:</h4>
            <table class="border-inside">
                <colgroup>                
                    <col style="width: 33.33%">
                    <col style="width: 33.33%">
                    <col style="width: 33.33%">                                        
                </colgroup>
                <tr>
                    <th>Weiss </th>
                    <th>Schwarz</th>
                    <th>Titanium</th>
                </tr>
                <tr>
                    <td>O-020 / 0802322002003 </td>
                    <td>O-021 / 0802322002010</td>
                    <td>O-032 / 0802322008722</td>
                </tr>
            </table>
        </div>';
        
        if((isset($fields['yt_link_produktvideo_de']) && $fields['yt_link_produktvideo_de'] != "")  || (isset($fields['yt_link_unboxing_features_de']) && $fields['yt_link_unboxing_features_de'] !="")  || (isset($fields['yt_link_reinigung_de']) && $fields['yt_link_reinigung_de'] !="")) {
            $content .='<div class="product-section">
                <h3>Weitere Angaben (Fotos, YouTube Video, Bedienungsanleitung, Datenblatt)</h3>';
                
                if(isset($fields['yt_link_produktvideo_de']) && $fields['yt_link_produktvideo_de']!="") {
                    $content .='<p>
                        YouTube Video Deutsch:
                        <a
                            href="'.$fields['yt_link_produktvideo_de'].'"
                            target="_blank"
                        >'.$fields['yt_link_produktvideo_de'].'
                        </a>
                    </p>';
                }
                    
                if(isset($fields['yt_link_unboxing_features_de']) && $fields['yt_link_unboxing_features_de']!=""){
                    $content .='<p>
                        YouTube Video Unboxing:
                        <a
                            href="'.$fields['yt_link_unboxing_features_de'].'"
                            target="_blank"
                        >'.$fields['yt_link_unboxing_features_de'].'
                        </a>
                    </p>';
                }
                    
                if(isset($fields['yt_link_reinigung_de']) && $fields['yt_link_reinigung_de']!=""){                
                    $content .='<p>
                        YouTube Video “How to” Reinigung
                        Oskar:
                        <a
                            href="'.$fields['yt_link_reinigung_de'].'"
                            target="_blank"
                        >'.$fields['yt_link_reinigung_de'].'
                        </a>
                    </p>';
                }
                    
                $content .='</div>';
        }
            
        $content .='</div>';

        return $content;

    }
}