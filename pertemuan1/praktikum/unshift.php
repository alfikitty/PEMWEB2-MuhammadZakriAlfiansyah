<?php
$laptop = ["asus", "lenovo", "dell", "realme"];

array_unshift($laptop, "HP", "Acer");
echo "array setelah di tambah :";
foreach($laptop as $p) {
    echo"<br> . $p;";
}
?>