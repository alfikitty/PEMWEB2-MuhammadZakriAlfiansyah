<?php
$rokok = ["samsu", "esse", "kretek", "marlong", "garpit"];

//menghapus elemen pertama
$awal = array_shift($rokok);

//hasil
echo "rokok yang dihapus : $awal <br>";
echo "Array setelah shift <br>";
foreach ($rokok as $r) {
    echo "$r <br>";
}
?>