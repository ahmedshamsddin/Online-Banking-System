<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    
    class Reciept {    
       public function generateReciept ($iban, $amount, $description, $date) {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML('<center><h1>turkish</h1></center>');
            $mpdf->WriteHTML('<center><h2>Transaction Reciept</h2></center>');

            $mpdf->WriteHTML('<p>To IBAN: ' . $iban . '</p>');
            $mpdf->WriteHTML('<p>Amount Transferred: ' . $amount . '</p>');
            $mpdf->WriteHTML('<p>Description: ' . $description . '</p>');
            $mpdf->WriteHTML('<p>Date: ' . $date . '</p>');
            
            $mpdf->Output();
       } 
    }
?>