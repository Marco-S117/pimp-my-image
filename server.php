<?php

  // check sul submit
  if( isset($_POST["submit"]) ){

    if($_FILES["files"]['name'] != [""]){

      $imgArray = [];
      $warnings = [];

      // array con i nomi dei file
      $images = $_FILES['files']['name'];

      // percorso di destinazione
      $targetDir = "uploads/";

      // percorso del watermark
      $watermarkImagePath = 'watermark.png';

      // ciclo tutte le immagini
      foreach ($images as $key => $image) {

        // prendo il nome del file + estensione
        $fileName = $image; 

        // percorso di salvataggio del file
        $targetFilePath = $targetDir . $fileName; 

        // prendo formato file
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 

        // salvo il file caricato nella destinazione $targeFilePath
        move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);

        // creo una nuova immagine dal path del watermark
        $watermarkImg = imagecreatefrompng($watermarkImagePath);

        // controllo il tipo del file
        switch($fileType){ 
          case 'jpg': 
            $dist = imagecreatefromjpeg($targetFilePath); 
            // Pusho il nome del file dentro l'array
            $imgArray[] = $image;
            break; 
          case 'jpeg': 
            $dist = imagecreatefromjpeg($targetFilePath); 
            // Pusho il nome del file dentro l'array
            $imgArray[] = $image;
            break; 
          case 'png': 
            $dist = imagecreatefrompng($targetFilePath); 
            // Pusho il nome del file dentro l'array
            $imgArray[] = $image;
            break; 
          default: 
            $warnings[] = $images[$key];
        } 
        // creo una nuova immagine presa dal percorso di salvataggio

        // controllo il valore del filtro selezionato
        if($_POST['filter'] != 0){
          if($_POST['filter'] == 1) {
            imagefilter($dist, IMG_FILTER_GRAYSCALE);
          }
          if($_POST['filter'] == 2){
            imagefilter($dist, IMG_FILTER_NEGATE);
          }
        }

        // Setto i margini per il watermark 
        $marge_right = 50; 
        $marge_bottom = 50; 

        // Ottengo altezza/larghezza del watermark
        $lunghezza = imagesx($watermarkImg); 
        $altezza = imagesy($watermarkImg); 

        // Copia l'immagine del watermark sulla nostra foto usando gli offset dei margini e la larghezza della foto per calcolare il posizionamento
        imagecopy($dist, $watermarkImg, (imagesx($dist) - $lunghezza - $marge_right), (imagesy($dist) - $altezza - $marge_bottom), 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));        

        // Salvo l'immagine e libero la memoria 
        imagepng($dist, $targetFilePath); 
        imagedestroy($dist);

        $statusMsg = "<h4 class='alert alert-success'>Enjoy your cool photos!</h4>";

      }

    } else {
      $statusMsg = "<h4 class='alert alert-danger'>No files to upload!</h4>";
    }
  }

?>