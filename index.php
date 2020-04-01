<?php include_once 'server.php' ?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <form action="index.php" method="post" enctype="multipart/form-data">
          Select Image File to Upload:
          <input type="file" name="file">
          <select name="filter">
            <option value="0">Bianco e nero</option>
            <option value="1">Negativo</option>
          </select>
          <input type="submit" name="submit" value="Upload">
        </form>
        <?php 
          if(isset($fileName)) echo('<img src="uploads/' . $fileName . '" class="img-fluid">')
        ?>
      </div>
    </div>
  </div>
</body>
</html>