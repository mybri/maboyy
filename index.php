<?php
    if (isset($_POST['resi'])) {

        function cekResi($resi)
        {
            $date = floor(time());
            $url = 'https://spx.co.id/api/v2/fleet_order/tracking/search?sls_tracking_number='.$resi.'|'.$date.''.hash('sha256', $resi.''.$date.'MGViZmZmZTYzZDJhNDgxY2Y1N2ZlN2Q1ZWJkYzlmZDY=');
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
            $resp = curl_exec($curl);
            curl_close($curl);
    
            return json_decode($resp, true);
        }
    
        $data = cekResi($_POST['resi']);
    }
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cek Resi Shopee Express" />
    <meta name="author" content="hanary.adn" />
    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- fonts -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@100;300;400&display=swap" rel="stylesheet"> -->
    <!-- My CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- FA -->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <title>Cek Resi - Shopee Express</title>
  </head>
  <body>

    <!-- Header -->
    <div class="container custom-header">
        <div class="custom-header-title">
            <h1 class="display-4">Cek Resi</h1>
            <h4>~ Shopee Express ~</h4>
        </div>
    </div>

    <!-- mulai -->
    <form method="post">
    <div class="container custom-mulai">
        <div class="col-md-12 col-sm-12 col-12">
            <div class="kanan">
                <p>Input Resi</p>
            </div>
            <div class="card">    
                <input type="text" class="card-body" id="inputText" name="resi" value="<?php if (isset($_POST['resi'])) { echo $_POST['resi']; } ?>" required></input>
            </div>
            <br>
            <div class="buttonCek">
                <a href="#hasil"><button class="btn btn-cek" type="submit">Cek Resi</button></a>
                <!-- <button class="btn btn-hapus" onClick="window.location.href=window.location.href">Reset</button> -->
            </div>
        </div>
    </div>
    </form>

    <?php 
        if (isset($_POST['resi'])) : ?>
        <?php print_r(cekResi($_POST['resi'])); ?>
        <!-- hasil -->
        <div class="container custom-hasil" id="hasil">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="kanan">
                    <p>Hasil Cek</p>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">
                            <div class="info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Resi :</strong> <?php echo $data["data"]["sls_tracking_number"]; ?></p>
                                        <p><strong>Penerima :</strong> <?php echo $data["data"]["recipient_name"]; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Telepon :</strong> <?php echo $data["data"]["phone"]; ?></p>
                                        <p><strong>Status:</strong> <strong><?php echo $data["data"]["current_status"]; ?></strong></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="tracking-details">
                                <?php foreach ($data["data"]["tracking_list"] as $tracking): ?>
                                    <div class="tracking-item">
                                        <p><strong>[<?php echo date("Y-m-d H:i:s", $tracking["timestamp"]); ?>] <?php echo $tracking["message"]; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- footer -->
    <div class="container custom-footer">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-6">
                <div class="card kiri">
                    <p class="card-text">&nbsp;</p>
                    <p class="card-text">&nbsp;</p>
                </div>
            </div>
            
            <div class="col-md-6 col-sm-6 col-6">
                <div class="card kanan">
                    <p class="card-text">Syarat dan kententuan</p>
                    <p class="card-text">FAQ</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <script src="script.js"></script> -->
  </body>
</html>
