<?php
//array push
$komponen = ["mobo", "processor", "RAM", "SSD", "GPU"];
//menambahkan elemen di akhir array
array_push($komponen, "PSU", "cassing");

echo"Setelah Push<br>";
foreach ($komponen as $k) {
    echo $k. "<br>";
}
?>