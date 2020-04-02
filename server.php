<?php

  // check sul submit
  if( isset($_POST["submit"]) ){

    if($_FILES["files"]['name'] != [""]){
      
      $imgArray = [];
      $warnings = [];
      $allowedTypes = ['jpg', 'jpeg', 'png'];
  
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

        // controllo il tipo del file caricato
        if(in_array($fileType, $allowedTypes)){

          // salvo il file caricato nella destinazione $targeFilePath
          move_uploaded_file($_FILES["files"]["name"][$key], $targetFilePath);
    
          // creo una nuova immagine dal path del watermark
          $watermarkImg = imagecreatefrompng($watermarkImagePath);

          // creo una nuova immagine presa dal percorso di salvataggio
          switch($fileType){ 
            case 'jpg': 
              $dist = imagecreatefromjpeg($targetFilePath); 
            break; 
            case 'jpeg': 
              $dist = imagecreatefromjpeg($targetFilePath); 
            break; 
            case 'png': 
              $dist = imagecreatefrompng($targetFilePath); 
            break;              
          }

          // Pusho il nome del file dentro l'array delle immagini in caso di formato consentito
          $imgArray[] = $image;
          
        } else { 
          // Altrimenti pusho il file dentro i warnings per informare qual'è il file con estensione non consentita 
          $warnings[] = $images[$key];
        }
  
        // controllo il valore del filtro selezionato
        if($_POST['filter'] != 0){
          if($_POST['filter'] == 1) {
            imagefilter($dist, IMG_FILTER_GRAYSCALE);
          }
          if($_POST['filter'] == 2){
            imagefilter($dist, IMG_FILTER_NEGATE);
          }
          if($_POST['filter'] == 3){
            imagefilter($dist, IMG_FILTER_PIXELATE, 10);
          }
        }
        
        // Setto i margini per il watermark 
        $marge_right = 50; 
        $marge_bottom = 50; 
          
        // Ottengo altezza/larghezza del watermark
        $watermarkWidth = imagesx($watermarkImg); 
        $watermarkHeigth = imagesy($watermarkImg);
          
        // Copia l'immagine del watermark sulla nostra foto usando gli offset dei margini e la larghezza della foto per calcolare il posizionamento
        imagecopy($dist, $watermarkImg, (imagesx($dist) - $watermarkWidth - $marge_right), (imagesy($dist) - $watermarkHeigth - $marge_bottom), 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));        
  
        // Salvo l'immagine e libero la memoria 
        imagepng($dist, $targetFilePath); 
        imagedestroy($dist);
  
        $statusMsg = "<h4 class='alert alert-success'>Goditi le tue fantastiche foto!</h4>";
  
      }

    } else {
      $statusMsg = "<h4 class='alert alert-danger'>Nessun file caricato</h4>";
    }
  }

?>