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

<style>
</style>

<body class="bg-secondary">
  <div class="container bg-light">

    <!-- navigation -->
    <div class="row bg-info">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand text-uppercase" href="#">PmI</a>

          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Credits</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          </ul>
          
        </nav>
      </div>
    </div>
    
    <!-- main -->
    <div class="row bg-light">
      <div class="col-12">
        <main class="p-4">
          <h4>Welcome to Pimp my Images</h4>
          <p>Upload your photos and aplly a filter!</p>

          <div class="my-5 d-flex justify-content-center alert alert-info">
            <form action="index.php" method="post" enctype="multipart/form-data">

              <label>Select files to upload</label>
              <div class="input-group mb-3">
                <div class="custom-file">
                  <input type="file" name="files[]" class="custom-file-input" id="inputGroupFile03" multiple>
                  <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                </div>
              </div>

              <label for="filter">Select an effect</label>
              <div class="input-group mb-3">
                <select name="filter" class="form-control">
                  <option value="0">Select a filter</option>
                  <option value="1">Bianco e nero</option>
                  <option value="2">Negativo</option>
                </select>
              </div>

              <label for="filter"></label>
              <div class="input-group mb-3">
                <input type="submit" name="submit" value="Upload" class="form-control">
              </div>

            </form>
          </div>

          <!-- show images with watermark and effect -->
          <div>
            <?php
              if(count($warnings) > 0){
                echo ('<ul class="alert alert-warning px-5">');
                foreach ($warnings as $warning) {
                  echo ("<li>File " . $warning . " not allowed</li>");
                }
                echo ('</ul>');
              } 
            ?>
          </div>
          <div>
            <?php echo $statusMsg ?>
          </div>
          <div class="mb-4 p-4 border rounded bg-white">
            <?php
              if(count($imgArray) > 0) {
                echo('<div class="row">');
                foreach ($imgArray as $img) {
                  echo('<div class="col-12 col-sm-6 col-md-3 align-self-center"><img src="uploads/' . $img . '" class="img-fluid"></div>');
                }
                echo('</div>');
              }
            ?>
          </div>
        </main>
      </div>
    </div>

    <!-- footer -->
    <div class="row bg-dark text-white text-center text-uppercase">
      <div class="col-12">
        <footer class="p-4">Copyright Marco Polino</footer>
      </div>
    </div>

  </div>
</body>
</html>