<?php
include "koneksi.php";

$data = mysqli_query($conn, "SELECT * FROM dataset");

$inputlineHeader = false;
if (($handle = fopen("Book1.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($inputlineHeader) {
            $data[2] = str_replace("['#", "\#", $data[2]);
            $data[2] = str_replace("']", "", $data[2]);
            $data[2] = str_replace("['", "", $data[2]);
			$data[2] = str_replace("']", "", $data[2]);
            $sqlInsert = "INSERT INTO dataset (tgl, tweet, hashtag, sentiment) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
            mysqli_query($conn, $sqlInsert);
        }
        $inputlineHeader = true; // Tidak membawa row pertama
    }
    fclose($handle);
}
