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
      <h1 class="header center orange-text">Genetic Algortihm</h1>
      <div class="row center">
          <div class="row">
              <?php
                //pencacah
                $counter = $_POST ['counter'];
                //batas kontainer
                $BATASKONTAINER = $_POST ['kapasitas'];

                $POPULATION = [];
                $POPULATION_SIZE = 200; //pop size
                $MUTATION_RATE = 0.01; //peluang mutasi
                $CROSSOVER_RATE = 0.2; //peluang persilangan. bisa di definisakan sendiri. bisa by system
                $DNA_SIZE = '';
                $GEN_COUNT = 1;
                $TEST_COUNT = 0;
                $bestGen = [];
                $ITEMS = [];


                $i=0;
                do {
                  $ITEMS[] = item($_POST['nama'.$i],$_POST['harga'.$i],$_POST['berat'.$i]);
                  $i++;
                }while ($i<$counter);

                foreach ($ITEMS as $key => $value) {
                    echo $value->name." dengan berat : ";
                    echo $value->weight." Kg dengan harga ";
                    echo $value->survivalPoints;
                    echo "<br>";
                }

                echo "<br>";
                genInitPopulation();

                echo "<br>";
                // echo "KROMOSOM TERBAIK TIAP GENERASI";
                // echo "<br>";
                // echo "-----------------------------------";
                echo "<br>";
                $i = 0;
                while ($i < 200) {
                    naturalSelection();
                    recreatePopulation();
                    $i++;
                }
                echo "<br>";
                echo "Yang Terbaik";
                echo "<br>";
                echo "-----------------------------------";
                echo "<br>";
                $maxGene = $bestGen[0][1];
                $bestGenMax = $bestGen[0][0];
                for ($i=0; $i < count($bestGen) ; $i++) {
                    if($maxGene < $bestGen[$i][1]){
                        $maxGene = $bestGen[$i][1];
                        $bestGenMax = $bestGen[$i][0];
                    }
                }
                echo $bestGenMax;
                echo " dengan Fitness : ".$maxGene;


                //=========================================FUNCTIONS=======================
                function item($name,$survivalPoints,$weight){
                    $item = new stdClass();
                    $item->name = $name;
                    $item->survivalPoints = $survivalPoints;
                    $item->weight = $weight;

                    return $item;
                }

                function genInitPopulation(){
                    global $POPULATION,$POPULATION_SIZE;
                    //200
                    for ($i=0; $i < $POPULATION_SIZE ; $i++) {
                        $individual = randomIndividual();
                        array_push($POPULATION, array($individual,fitness($individual)));
                    }
                }

                function randomIndividual(){
                    global $ITEMS,$POPULATION,$BATASKONTAINER;
                    $gene = 0;
                    $kromosom = '';
                    for ($i=0; $i < count($ITEMS) ; $i++) {
                        if($ITEMS[$i]->weight >= $BATASKONTAINER){ //jika melebihi batas kontainer kasih 0 genotype
                            $gene = 0;
                        }else{
                            $gene = newBiner();
                        }
                        //bagian penggabungan
                        $kromosom .= $gene;
                    }
                    return $kromosom;
                }

                function newBiner(){
                    $random = random_int( 0,1);
                    return $random;
                }

                function fitness($individual){
                    global $ITEMS,$GEN_COUNT,$TEST_COUNT,$BATASKONTAINER;
                    $TEST_COUNT++;
                    $fitness = 0;
                    $total_fitness = 0;
                    $berat = 0;
                    $total_berat = 0;
                    for ($i=0; $i < count($ITEMS); $i++) {
                        $fitness = $ITEMS[$i]->survivalPoints * $individual[$i];
                        $total_fitness += $fitness;
                        $berat = $ITEMS[$i]->weight * $individual[$i];
                        $total_berat += $berat;
                    }

                    if($total_berat > $BATASKONTAINER){ //jika melebihi BATASKONTAINER
                        $total_fitness = 0;
                    }

                    return $total_fitness;
                }

                function urutkan($a, $b){
                    if($a[1] == $b[1]) return 0;
                    return ($a[1] > $b[1]) ? -1 : 1;
                }

                function naturalSelection(){
                    global $POPULATION,$POPULATION_SIZE,$GEN_COUNT,$bestGen;

                    usort($POPULATION, "urutkan");
                    array_splice($POPULATION, ceil($POPULATION_SIZE/2));
                    array_push($bestGen, array($POPULATION[0][0], $POPULATION[0][1]));
                    // echo 'Best fit gen '.$GEN_COUNT.': '.$POPULATION[0][0].' (Fitness : '.$POPULATION[0][1].')'."\n";
                    // echo '<br>';

                }

                function recreatePopulation(){
                    global $POPULATION, $POPULATION_SIZE, $GEN_COUNT;
                    //echo '* Recreating population by reproducing randomly...'."\n";
                    $GEN_COUNT++;
                    $c = count($POPULATION);
                    for ($i=$c; $i<$POPULATION_SIZE; $i++) {
                        $a = rand(0, $c-1);
                        $b = rand(0, $c-1);
                        array_push($POPULATION, reproduction($POPULATION[$a][0], $POPULATION[$b][0]));
                    }
                }

                function reproduction($ia, $ib){
                    global $DNA_SIZE, $ITEMS;
                    $jumlahItems = count($ITEMS);
                    $crosspoint   = rand(0, $jumlahItems-1);
                    $ia_before_cp = substr($ia, 0, $crosspoint);
                    //$ia_after_cp  = substr($ia[0], $crosspoint);
                    //$ib_before_cp = substr($ib[0], 0, $crosspoint);
                    $ib_after_cp  = substr($ib, $crosspoint);
                    $child = $ia_before_cp.$ib_after_cp;
                    $child = mutate($child);
                    return array($child, fitness($child));
                }

                function mutate($s) {
                    global $DNA_SIZE, $ITEMS, $MUTATION_RATE;
                    $sample = randomIndividual();
                    for ($i=0; $i<count($ITEMS); $i++) {
                        if (rand(0,100) == 100) {
                            // $s[$i] = $sample[$i];
                            if($s[$i] == 0){
                                $s[$i] = 0;
                            }else{
                                $s[$i] = 1;
                            }
                        }
                    }
                    return $s;
                }

                function averageFitness(){
                    global $POPULATION, $POPULATION_SIZE, $ITEMS;
                    $fitness = 0;

                    for ($i=0; $i < $POPULATION_SIZE ; $i++) {
                        $fitness += $POPULATION[$i][1];
                    }

                    $averageFitness = $fitness / count($POPULATION);

                    return $averageFitness;
                }

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
