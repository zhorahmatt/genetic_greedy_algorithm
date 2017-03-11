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
      <h1 class="header center orange-text">Greedy Vs Genetic Algortihm</h1>
      <div class="row center">
          <div class="row">
              <?php
              $nama=$_POST ['name'];
              echo "<form class='cols12' action='proses_genetic2.php' method='post'>";
              $i=0;
              do {
                //   echo "<input type='text' name='nama$i' placeholder='namabarang $i'><br><br>";
                //   echo "<input type='text' name='berat$i' placeholder='berat(kubik) $i'><br><br>";
                //   echo "<input type='text' name='harga$i' placeholder='harga(kubik) $i'>";
                  echo "<div class='input-field col s12'>";
                    echo "<input type='text' name='nama$i' class='validate' required>";
                    echo "<label for='name'>Nama Barang $i</label>";
                  echo "</div>";
                  echo "<div class='input-field col s12'>";
                    echo "<input type='text' name='berat$i' class='validate' required>";
                    echo "<label for='name'>Berat Barang $i</label>";
                  echo "</div>";
                  echo "<div class='input-field col s12'>";
                    echo "<input type='text' name='harga$i' class='validate' required>";
                    echo "<label for='name'>Harga Barang $i</label>";
                  echo "</div>";
                $i++;
              } while ($i<$nama);
              echo "<div class='input-field col s12'>";
                echo "<input type='text' name='kapasitas'> <br><br>";
                echo "<input type='hidden'name='counter' value='$nama'><br><br>";
                //echo "<input type='text' name='harga$i' class='validate'>";
                echo "<label for='name'>Kapasitas</label>";
              echo "</div>";
              echo "<br>";
              echo "Proses : ";
              echo "<input type='submit' name='submit' value='Greedy'>";
              echo "</form>";
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
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  </body>
</html>
