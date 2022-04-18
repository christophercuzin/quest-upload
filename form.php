<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $data = array_map('trim', $_POST);
    $uniqName = uniqid() . basename($_FILES['avatar']['name']);
    $uploadDir = 'upload-images/';
    $uploadFile = $uploadDir . $uniqName;
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg','jpeg','png'];
    $maxFileSize = 1000000;
    
    if(empty($data['birth-date']) || 
    empty($data['firstname']) || 
    empty($data['lastname']) || 
    empty($data['address']) || 
    empty($data['signature'])){
        echo 'Tous les champs sont obligatoire';
        die;
    }

    if( (!in_array($extension, $authorizedExtensions))){
        echo 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
        die;
    }

    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
        echo "Votre fichier doit faire moins de 1M !";
        die;
    } 
    
    if( move_uploaded_file($_FILES['avatar']['tmp_name'],$uploadFile)){

?>

    <main class="container-fluid mt-5">          
        <div class="card col-3 rounded">
            <div class="card-body bg-info">
            <h1 class="card-title text-center text-light rounded">SPRINGFIELD, IL</h1>
            </div>
            <div class="row">
                <p class="col-3">LICENSE # 64209</p>
                <p class="col-3">BIRTH DATE <br><?= $data['birth-date'] ?></p>
                <p class="col-3">EXPIRES 4-24-2015</p>
                <p class="col-3">CLASS <br> NONE</p>
            </div>
            <div class="row">
                <div class="col-6">
                <img src="<?php echo $uploadFile?>" alt="Homer simpson"/>
                </div>
                <div class="card-body col-6">
                    <h4 class="bg-info text-light">DRIVERS LICENSE</h4>
                    <p class="fw-bold"><?= $data['firstname'] . ' ' . $data['lastname']?><br><?= $data['address']?></p>
                    <p class="fw-bold"></p>
                    <p class="text-decoration-underline"><?= $data['signature']?></p>
                </div>
            </div>
        </div>
    </main>
<?php

    }

}

?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>File upload</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" id="image_upload" required>

        <label for="birth-date">Birth date</label>
        <input type="date" name="birth-date" id="birth-date" required>

        <label for="firstname">firstname</label>
        <input type="text" name="firstname" id="firstname" required>

        <label for="lastname">lastname</label>
        <input type="text" name="lastname" id="lastname" required>

        <label for="adress">address</label>
        <input type="text" name="address" id="address" required>

        <label for="signature">signature</label>
        <input type="text" name="signature" id="signature" required>
         <button type="submit">Send</button>
    </form>
</body>
</html>