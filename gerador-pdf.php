<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

ob_start();
require "conteudo-pdf.php";
$html = ob_get_clean();


$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("cardapio.pdf");