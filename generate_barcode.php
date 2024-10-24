<?php
require_once 'vendor/autoload.php'; // Include the Composer autoload file

use Picqer\Barcode\BarcodeGeneratorPNG;

if (isset($_GET['text'])) {
    $barcodeText = $_GET['text'];

    // Create a new barcode generator instance
    $generator = new BarcodeGeneratorPNG();

    // Generate the barcode
    header('Content-Type: image/png');
    echo $generator->getBarcode($barcodeText, $generator::TYPE_CODE_128);
} else {
    echo 'No barcode text provided.';
}
