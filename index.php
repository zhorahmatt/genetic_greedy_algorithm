<?php

    require_once('Item.php');
    //require_once('Gene.php');
    //berat maksimal container
    $limitWeight = 40;

    //define item / phenotype untuk Knapsack
    $items = [];
    //fill item with class Item
    $items[] = new Item("beras",30.0,20.0);
    $items[] = new Item("jagung",50.0,30.0);
    $items[] = new Item("kelapa",15.0,45.0);
    $items[] = new Item("ubi jalar",45.0,20.0);
    $items[] = new Item("durian",80.0,15.0);
    $items[] = new Item("rambutan",28.0,19.0);

    foreach ($items as $key => $value) {
        echo $value->name.' dengan berat : '.$value->weight.' Kg';
        echo "<br>";
    }
    $encode = new Gene();
    $a = [1,2,3,4,5,6];
    echo $encode->encode($a,$limitWeight);

    //selanjutnya buatkan saja sebuah function semua tidak usah buatkan class
    //yang tidak penting dan ribet sinkronasi
    /**
     *
     */
    class Gene
    {

        function __construct()
        {
            $this->genotype = 6;
            $this->fitness = 1;
            $this->generation = 0;
        }

        public function random()
        {
            return mt_rand() / (mt_getrandmax() + 1 );
        }

        public function encode($phenotype,$limitWeight)
        {
            $this->genotype = array_fill_keys($phenotype, 0);
            $totalWeight = 0;
            while($totalWeight < $limitWeight){
                $index = floor($this->random() * count($items));
                $index = $index == count($items) ? $index-1 : $index;
                $totalWeight += $items[$index]->weight;
                if ($totalWeight >= $limitWeight) {
                    break;
                }
                $this->genotype[$index] = 1;
            }
        }
    }
