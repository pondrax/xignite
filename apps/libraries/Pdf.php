<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once("./vendor/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
  
class Pdf {
  public static function generate($html, $filename='', $stream=TRUE, $paper = 'folio', $orientation = "portrait"){  
    // $dompdf = new DOMPDF(array(
        // 'debugLayout' => true,
    // ));
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename, array("Attachment" => 0));
    } else {
        $dompdf->stream($filename);
        // return $dompdf->output();
    }
  }
}