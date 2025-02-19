<?php
$siswa = ["pake", "asta", "maget", "gope"];

//menampilkan array awal
echo "array awal :\n";
    print_r($siswa);

//menghapus elemen terakhir dari array
$orang_terakhir = array_pop($siswa);

//menampilkan elemen yang dihapus
echo "Elemen yang akan dihapus" .$orang_terakhir. "\n";

//menampilkan elemen yang dihapus
echo "<br>Elemen yang akan dihapus" .$orang_terakhir;

//menampilkan array setelah penghapusan
echo "<br> Array setelah penghapusan : <br>";
print_r($siswa);

?>