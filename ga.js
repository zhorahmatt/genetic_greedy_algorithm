var weightlimit = 20; // weight limit
//the Phenotype --> a Knapsack item
var Item = function(name, survivalPoints, weight) {
  this.name = name;
  this.survivalPoints = survivalPoints;
  this.weight = weight;
}
//console.log(Math.random());
//console.log(Math.floor(Math.random()));

//Knapsack items: name, survival points, weight
var items = [];
items.push(new Item("pocketknife", 10.00, 1.00));
items.push(new Item("beans", 20.00, 5.00));
items.push(new Item("potatoes", 15.00, 10.00));
items.push(new Item("unions", 2.00, 1.00));
items.push(new Item("sleeping bag", 30.00, 7.00));
items.push(new Item("rope", 10.00, 5.00));
items.push(new Item("compass", 30.00, 1.00));
items.push(new Item("compass2", 50.00, 15.00));
items.push(new Item("compass3", 60.00, 7.00));

// represents an encoded gene
var Gene = function() {
  this.genotype;
  this.fitness;
  this.generation = 0;
}

// converts a phenotype to a genotype
Gene.prototype.encode = function(phenotype) {
  this.genotype = Array(phenotype.length).fill(0);
  //console.log(this.genotype);
  var totalWeight = 0;
  while (totalWeight < weightlimit) { // make a genotype until criteria is met
    // pick an item at random
    var index = Math.floor(Math.random() * items.length);
    index = index == items.length ? index - 1 : index;
    totalWeight += items[index].weight;
    if (totalWeight >= weightlimit) { // break if weight limit exceeded
      break;
    }

    //encode as selected (=1)
    this.genotype[index] = 1;
  }
}

//calculates the fitness function of the gene
Gene.prototype.calcFitness = function() {
  //select the genotype(s) with bit = 1
  function getItem(item, index) {
    return scope.genotype[index] > 0;
  }

  // calculate the sum of Survival Points --> used in reduce below
  function sumPoints(total, item) {
    return total + item.survivalPoints;
  }

  // calculate the sum of Weights --> used in reduce below
  function sumWeights(total, item) {
    return total + item.weight;
  }

  var scope = this;
  var selectedItems = items.filter(getItem); //filter bits = 1
  this.fitness = selectedItems.reduce(sumPoints, 0);
  var totalWeight = selectedItems.reduce(sumWeights, 0);

  //penalty if > weightlimit => 0
  if (totalWeight > weightlimit) {
    this.fitness = 0;
  }
}

// calculates the fitness of a gene which has all the bits = 1
// used to find relative fitness of a gene: fitness/ maxFitness
Gene.prototype.makeMax = function(phenotype) {
  //fill all the genes and calculate the fitness without penalty
  this.genotype = Array(phenotype.length).fill(1);
  this.fitness = 0;
  for(var i = 0; i < phenotype.length; i++){
    this.fitness += phenotype[i].survivalPoints;
  }
}

//Cross-over operator: one point cross-over
Gene.prototype.onePointCrossOver = function(crossOverPr, anotherGene) {
  var prob = Math.random();

  //cross over if within cross over probability
  if (prob >= crossOverPr) {
    //cross over point:
    var crossOver = Math.floor(Math.random() * this.genotype.length);
    crossOver = crossOver == this.genotype.length ? crossOver - 1 : crossOver;
    var head1 = this.genotype.slice(0, crossOver);
    var head2 = anotherGene.genotype.slice(0, crossOver);
    var tail1 = this.genotype.slice(crossOver);
    var tail2 = anotherGene.genotype.slice(crossOver);

    //cross-over at the point and create the off-springs:
    var offSpring1 = new Gene();
    var offSpring2 = new Gene();
    offSpring1.genotype = head1.concat(tail2);
    offSpring2.genotype = head2.concat(tail1);
    return [offSpring1, offSpring2];
  }

  return [this, anotherGene];
}

//Mutation operator:
Gene.prototype.mutate = function(mutationPr) {
  for (var i = 0; i < this.genotype.length; i++) {
    //mutate if within cross over probability
    if (mutationPr >= Math.random()) {
      this.genotype[i] = 1 - this.genotype[i];
    }
  }
}

//Compare fitness
function compareFitness(gene1, gene2) {
  return gene2.fitness - gene1.fitness;
}

// represents a Population of Genes
var Population = function(size) {
  this.genes = [];
  this.generation = 0;
  this.solution = 0;
  // create and encode the genes
  while (size--) {
    var gene = new Gene();
    gene.encode(items);
    this.genes.push(gene);
  }
}

// initialization of the Population by making a pass of the fitness function
Population.prototype.initialize = function() {
  for (var i = 0; i < this.genes.length; i++) {
    this.genes[i].calcFitness();
  }
}

//operator select : Rank-based fitness assignment
Population.prototype.select = function() {
  // sort and select the best
  this.genes.sort(compareFitness);
  return [this.genes[0], this.genes[1]];
}

//the core genetic algorithm (cross over, mutation, selection)
//GA parameters:
//Cross-over probability:
var crossOverPr = 0.9;
//Mutation probability:
var mutationPr = 0.3;

//calculates one generation from the current population
Population.prototype.generate = function() {
  // select the parents
  parents = this.select();

  // cross-over
  var offSpring = parents[0].onePointCrossOver(crossOverPr, parents[1]);
  this.generation++; //increment the generation

  //re-place in population
  this.genes.splice(this.genes.length - 2, 2, offSpring[0], offSpring[1]);
  //attach the generation number to the new offspring
  offSpring[0].generation = offSpring[1].generation = this.generation;

  //mutate the population
  for (var i = 0; i < this.genes.length; i++) {
    this.genes[i].mutate(mutationPr);
  }

  //recalculate fitness after cross-over & mutation:
  this.initialize();
  this.genes.sort(compareFitness);
  this.solution = population.genes[0].fitness; // pick the solution;

  //draw the population:
  display();

  //stop iteration after 100th generation
  //this assumption is arbitrary that the solution would converge after reaching
  //the 100th generation, there can be other criteria like no change in fitness
  if (this.generation >= 100) {
    return true;
  }

  // call generate again after a delay of 100 millisecond
  var scope = this;
  setTimeout(function() {
    scope.generate();
  }, 100);
}

// code to generate the population and draw it on the Canvas
window.onload = init;
var canvas;
var context;

//create the population
var population = new Population(100);
var maxSurvivalPoints = 0;

function init(){
  //gene with maximum fitness possible [without penalty]
  var maxGene = new Gene();
  //console.log(maxGene);
  maxGene.makeMax(items);
  maxSurvivalPoints = maxGene.fitness;

  //get the context for drawing:
  canvas = document.getElementById('populationCanvas');
  context = canvas.getContext('2d');

  population.initialize(); //init the population
  population.generate(); //start the solution generation
}

//function to draw the population on the canvas
function display(){
  var fitness = document.getElementById('fitness');
  //print the best total Survival point and the corresponding genotype:
  fitness.innerHTML = 'Survival Points:' + population.genes[0].fitness;
  fitness.innerHTML += '<br/>Genotype:' + population.genes[0].genotype;

  context.clearRect(0, 0, canvas.width, canvas.height); //clear the canvas
  var index = 0;
  var radius = 30;
  //draw the Genes
  for(var i = 0; i < 10; i++){
    var centerY = radius + (i + 1) * 5 + i * 2 * radius; //Y
    for(var j = 0; j < 10; j++){
      var centerX = radius + (j + 1) * 5 + j * 2 * radius; //X
      context.beginPath();
      context.arc(centerX, centerY, radius, 0, 2 * Math.PI, false);
      // pick the fitness for opacity calculation;
      var opacity = population.genes[index].fitness / maxSurvivalPoints;
      context.fillStyle = 'rgba(0,0,255, ' + opacity + ')';
      context.fill();
      context.stroke();
      context.fillStyle = 'black';
      context.textAlign = 'center';
      context.font = 'bold 12pt Calibri';
      // print the generation number
      context.fillText(population.genes[index].generation, centerX, centerY);
      index++;
    }
  }
}
