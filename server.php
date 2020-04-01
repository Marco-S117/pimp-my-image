<?php

  $targetDir = "uploads/"; 
  $watermarkImagePath = 'watermark.png';
  $fileName = $_FILES["file"]["name"]; // nome file passato con estensione


  $targetFilePath = $targetDir . $fileName; // percorso di salvataggio

  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); // salvo formato file

  move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath); // salva il file caricato nella destinazione $targeFilePath

  $watermarkImg = imagecreatefrompng($watermarkImagePath); // crea una nuova immagine dal path del watermark
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
      default: 
        $dist = imagecreatefromjpeg($targetFilePath); 
  } 
  // crea una nuova immagine presa dal percorso di salvataggio

  // aggiungo il filtro
  if($_POST['filter'] == 0) {
    imagefilter($dist, IMG_FILTER_GRAYSCALE);
  }
  if($_POST['filter'] == 1){
    imagefilter($dist, IMG_FILTER_NEGATE);
  }

  // Set the margins for the watermark 
  $marge_right = 50; 
  $marge_bottom = 50; 
    
  // Get the height/width of the watermark image 
  $lunghezza = imagesx($watermarkImg); 
  $altezza = imagesy($watermarkImg); 
    
  // Copy the watermark image onto our photo using the margin offsets and  
  // the photo width to calculate the positioning of the watermark. 
  imagecopy($dist, $watermarkImg, (imagesx($dist) - $lunghezza - $marge_right), (imagesy($dist) - $altezza - $marge_bottom), 0, 0, imagesx($watermarkImg), imagesy($watermarkImg)); 

  // Save image and free memory 
  imagepng($dist, $targetFilePath); 
  imagedestroy($dist);
?>