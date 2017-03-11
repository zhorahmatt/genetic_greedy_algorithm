<?php
    /**
     *
     */
    class Gene
    {

        function __construct()
        {
            $this->genotype;
            $this->fitness;
            $this->generation;
        }

        public function encode($phenotype , $totalWeight)
        {
            $this->genotype = array_fill_keys($phenotype, 0);
            $totalWeight = 0;
        }
    }
