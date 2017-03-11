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
        <h5 class="header col s12 light">This project is all about benchmarking between Greedy Algorithm and Genetic Algoritm in Solving Knapsack Problem</h5>
      </div>
      <div class="row center">
        <a href="/genetic_algorithm/php/form_greedy.php" id="download-button" class="btn-large waves-effect waves-light orange">Greedy</a>
        <a href="/genetic_algorithm/php/form_genetic.php" id="download-button" class="btn-large waves-effect waves-light orange">Genetic</a>
      </div>
      <br><br>

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
