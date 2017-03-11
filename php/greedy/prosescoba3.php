<?php
$nama=$_POST ['name'];
echo "<form class='' action='tampil3.php' method='post'>";
$i=0;
do {
  echo "<input type='text' name='nama$i' placeholder='namabarang$i'><br><br>";
  echo "<input type='text' name='berat$i' placeholder='berat(kubik)$i'><br><br>";
  echo "<input type='text' name='harga$i' placeholder='harga(kubik)$i'>";
  echo "<hr>";
  $i++;
} while ($i<$nama);
echo "<input type='text' name='kapasitas' placeholder='kapasitas'> <br><br>";
echo "<input type='text'name='counter' value='$nama'><br><br>";
echo "<br>";
echo "Proses : ";
echo "<input type='submit' name='submit' value='Greedy'>";
echo "</form>";
?>
