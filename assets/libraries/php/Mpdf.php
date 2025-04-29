<?php

require_once __DIR__ . '/Mpdf/autoload.php';


$mpdf = new \Mpdf\Mpdf();

$stylesheet = file_get_contents('style.css');

$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

if (isset($_GET['my-bill']) AND isset($_GET['transaction-id'])) {
	
}

$html = '<h1>Hello world!</h1>';

$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);



$mpdf->Output("mybill-$transationId.pdf");
