<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>selamat ulang tahun!</h1>
    <?php
        $_nama = "Alfian Ganteng";
        $_umur = 19;
        $_prodi = "Teknok Informatika";
        $_ipk = 3.9;
    ?>

    <p>Nama : <?php echo $_nama; ?></p>
    <p>umur : <?=$_umur?></p>
    <p>Prodi : <?=$_prodi; ?></p>
    <p>ipk : <?=$_ipk?></p>
    
</body>
</html>