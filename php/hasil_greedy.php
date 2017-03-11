<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Aima's Final Project</a>
      <!-- <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul> -->

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Greedy Algortihm</h1>
      <div class="row center">
          <div class="row">
              <?php
                $counter = $_POST ['counter'];
                $kapasitas = $_POST ['kapasitas'];
                $profit = [];
                $nama = [];
                $harga = [];
                $berat = [];
                $urutprofit = [];
                rsort ($urutprofit);
                $urutberat = [];
                sort ($urutberat);

                $i=0;
                do {
                  $nama[] = $_POST['nama'.$i];
                  $berat[] = $_POST['berat'.$i];
                  $harga[] = $_POST['harga'.$i];
                  $i++;
                }while ($i<$counter);

                $b=0;
                do{
                  $profit[$b] = $berat[$b] * $harga[$b];
                  $b++;
                }while ($b <   $counter);

                $a=0;
                do {
                  echo "Nama = $nama[$a]";
                  echo "<br>";
                  echo "Berat = $berat[$a]";
                  echo "<br>";
                  echo "Harga = $harga[$a]";
                  echo "<br>";
                  echo "profit = $profit[$a]";
                  echo "<br><br>";
                  $a++;
                }while ($a<$counter);

                // echo "Kapasitas = $kapasitas";
                echo "<hr>";
                echo "Greedy by Density <br><br>";


                // greedy by density
                // $c=0;
                // do {
                //   $urutprofit[$c]=$profit[$c];
                //   rsort ($urutprofit);
                //   $c++;
                // } while ($c <$counter);
                //
                // $d=0;
                // do {
                //   echo "Densitas terbesar ke terkecil : $urutprofit[$d]<br>";
                //   $d++;
                // }while ($d<$counter);
                //
                // echo "<br>";

                // ksi tampil profit
                // for ($h=0; $h<$counter; $h++)
                // {
                //   echo "profit : $profit[$h]<br>";
                // }
                // echo "<br>";

                // for ($n=0; $n>$counter; $n++)
                //   {
                //     for ($o=$counter; $o<=$n; $o--)
                //     {
                //         if ($profit[$o] > $profit[$o+1])
                //           {
                //             $j=$profit[$o];
                //             $profit[$o]=$profit[$o+1];
                //             $profit[$o+1]=$j;
                //
                //             // $k=$nama[$n];
                //             // $nama[$n]=$nama[$n+1];
                //             // $nama[$n+1]=$k;
                //           }
                //
                //     }
                //   }
                $profit_temp = '';
                //sorting descending bubble sort
                for ($i=0; $i < $counter; $i++) {
                  for ($j=0; $j < $counter-$i-1 ; $j++) {
                    if($profit[$j] < $profit[$j+1])
                    {
                      //penukaran profit
                      $profit_temp=$profit[$j];
                      $profit[$j]=$profit[$j+1];
                      $profit[$j+1]=$profit_temp;

                      //penukaran nama barang
                      $k=$nama[$j];
                      $nama[$j]=$nama[$j+1];
                      $nama[$j+1]=$k;

                      //penukaran harga barang
                      $p=$harga[$j];
                      $harga[$j]=$harga[$j+1];
                      $harga[$j+1]=$p;

                      //penukaran berat barang
                      $q=$berat[$j];
                      $berat[$j]=$berat[$j+1];
                      $berat[$j+1]=$q;
                    }
                  }
                }
                for ($k=0; $k<$counter; $k++)
                {
                  echo "$nama[$k] : ";
                  echo "$berat[$k] : ";
                  echo "$harga[$k] : ";
                  echo "$profit[$k]";
                  echo "<br>";
                }


                $kapasitasskr1 = $kapasitas;
                echo "<br>";
                echo "Kapasitas : $kapasitasskr1 <br>";

                for ($r=0; $r<$counter; $r++)
                {
                  if ($berat[$r] > $kapasitasskr1)
                  {

                  }
                    else
                    {
                      echo "$nama[$r] : terpilih <br>";
                      $kapasitasskr1 = $kapasitasskr1 - $berat[$r];
                    }
              }
              echo "sisa kapasitas = $kapasitasskr1 <br>";
              echo "<br>";
              echo "<hr>";

              // greedy by weight

                // urut berat pke sort
                // $e=0;
                // do {
                //   $urutberat[$e]=$berat[$e];
                //   sort ($urutberat);
                //   $e++;
                // } while ($e <$counter);

                // ksi tampil berat
                // $f=0;
                // do {
                //   echo "Berat terkecil ke terbesar : $urutberat[$f]<br>";
                //   $f++;
                // }while ($f<$counter);


                echo "Greedy by Weight <br><br>";
                //sorting bubble sort
                $weight_temp = '';
                //sorting ascending berat
                for ($q=0; $q < $counter ; $q++) {
                  for ($r=0; $r < $counter-$q-1 ; $r++) {
                    if($berat[$r] > $berat[$r+1])
                    {
                      //penukaran berat
                      $weight_temp=$berat[$r];
                      $berat[$r]=$berat[$r+1];
                      $berat[$r+1]=$weight_temp;

                      //penukaran nama barang
                      $s=$nama[$r];
                      $nama[$r]=$nama[$r+1];
                      $nama[$r+1]=$s;

                      //penukaran harga barang
                      $t=$harga[$r];
                      $harga[$r]=$harga[$r+1];
                      $harga[$r+1]=$t;

                      //penukaran profit barang
                      $u=$profit[$r];
                      $profit[$r]=$profit[$r+1];
                      $profit[$r+1]=$u;
                    }
                  }
                }
                for ($v=0; $v<$counter; $v++)
                {
                  echo "$nama[$v] : ";
                  echo "$berat[$v] : ";
                  echo "$harga[$v] : ";
                  echo "$profit[$v]";
                  echo "<br>";
                }


                $kapasitasskr = $kapasitas;
                echo "<br>";
                echo "Kapasitas : $kapasitasskr <br>";

                for ($g=0; $g<$counter; $g++)
                {
                  if ($berat[$g] > $kapasitasskr)
                  {

                  }
                    else
                    {
                      echo "$nama[$g] : terpilih <br>";
                      $kapasitasskr = $kapasitasskr - $berat[$g];
                    }
              }
              echo "sisa kapasitas = $kapasitasskr <br>";


              //genetika sialan
              // function isi_array($jml_barang)
              // {
              //   $nilai_acak = '1010101000011101';
              //   $array = array();
              //   for ($i=0; $i < $jml_barang ; $i++) {
              //     $array[] = rand(0,strlen($nilai_acak));
              //   }
              //   return $array;
              // }
              //
              // var_dump(isi_array(4));

              echo "<hr>";
              // function acak($panjang)
              // {
              //   $nilai = array();
              //   for ($i=0; $i < $panjang ; $i++) {
              //     $nilai[$i] = substr(str_shuffle(str_repeat($x='1001011111',ceil($panjang/strlen($x)))),1,$panjang);
              //   }
              //   return $nilai;
              // }
              // $nilai = acak(2);
              //
              // var_dump($nilai);

              ?>
          </div>
    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>

  <footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="genetic_algorithm/js/materialize.js"></script>
  <script src="js/init.js"></script>
  </body>
</html>
