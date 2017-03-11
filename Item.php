<?php

    class Item
    {
        function __construct($name, $survivalPoints, $weight)
        {
            $this->name = $name;
            $this->survivalPoints = $survivalPoints;
            $this->weight = $weight;
        }
    }
