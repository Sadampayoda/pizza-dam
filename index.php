<?php

use LDAP\Result;

class json {
    protected 
        $file,
        $result,
        $Cari,
        $Total
    ;


    public function __construct($LinkJson)
    {
        return $this->file = file_get_contents($LinkJson);
    }

    public function decode(){
        return $this->result = json_decode($this->file,true);
    }

    public function search($data){
        $this->Cari = $data['cari'];
        $DataMenu = $this->result['menu'];
        $Tampung = [];
        foreach($DataMenu as $CheckMenu){
            if($CheckMenu['nama'] === $this->Cari){
                $Tampung[] = $CheckMenu;
            }    
        }
        return $Tampung;
    }

    public function TotalMenu(){
        $this->Total = 0;
        foreach($this->result['menu'] as $total){
            $this->Total++;
        }
        return $this->Total;
    }

    public function __destruct(){}

}

$data = new json('api-pizza/pizza.json');

 

$result = $data->decode()['menu'];

if(isset($_POST['search'])){
    $result = $data->search($_POST);
    
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger  ">
    <div class="container">
        <a class="navbar-brand" href="#">Pizza Dam</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" method="POST">
                <select name="cari" class="form-select" aria-label="Default select example">
                    <option selected>Choose your favorite menu!</option>
                    <?php foreach($data->decode()['menu'] as $select): ?>
                        <option value="<?= $select['nama'] ?>"><?= $select['nama'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-outline-dark" name="search" type="submit">Search</button>
            </form>
        </div>
    </div>
    </nav>
    <?php  ?>

    <div class="container" style="margin-top: 100px;" >
        <div class="row">
            <?php if(isset($_POST['search'])) :?>
                <?php foreach($result as $resultss) :?>
                    <img src="image/<?= $resultss['gambar'] ?>" class="img-fluid p-auto" alt="<?= $resultss['gambar'] ?>">
                    <h2 class="border-bottom pt-3 pb-3"><?= $resultss['nama'] ?></h2>
                    <p class="border-bottom pb-3">Rp<?= $resultss['harga'] ?></p>
                    <p><?= $resultss['deskripsi'] ?></p>
                <?php endforeach ;?>
            <?php else :?>
                <?php foreach($result as $results) :?>
                    <div class="col-sm-4  text-center border">
                        <img src="image/<?= $results['gambar'] ?>" class="img-thumbnail" alt="<?= $results['gambar'] ?>">
                        <h2 class="border-bottom pt-3 pb-3"><?= $results['nama'] ?></h2>
                        <p class="border-bottom pb-3">Rp<?= $results['harga'] ?></p>
                        <p><?= $results['deskripsi'] ?></p>
                    </div>
                <?php endforeach ;?>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-dark">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <p class="text-center text-light">Copyright © 2019 Sadam Payoda. All Rights Reserved</p>
                </div>
            </div>
            <div class="d-flex justify-content-center text-center pb-3">
                <div class="col-1">
                    <i class="bi bi-instagram text-light text-center"></i>
                </div>
                <div class="col-1">
                    <i class="bi bi-facebook text-light text-center" ></i>
                </div>
                <div class="col-1">
                    <i class="bi bi-github text-light text-center"></i>
                </div>
            </div>
        </div>
    </div>


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>