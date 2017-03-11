<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once('Meta.php'); ?>
  <title>Starter Template - Materialize</title>

  <?php require_once('Css.php'); ?>
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
            <form class="col s12" method="post" action="/genetic_algorithm/php/proses_genetic.php" >
              <div class="row">
                <div class="input-field col s12">
                  <input id="name" name="name" type="number" class="validate">
                  <label for="last_name">Jumlah barang</label>
                </div>
              </div>
              <div class="row center">
                  <input type="submit" name="submit" class="btn-large waves-light orange" value="PROSES">
              </div>
              </div>
              <br><br>

          </form>
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
  <?php require_once('Script.php'); ?>
  </body>
</html>
