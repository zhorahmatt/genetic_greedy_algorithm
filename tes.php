<?php 
/**
* 
*/
class A
{
	private static $counter = 0;
	public function increase_counter()
	{
		self::$counter++;
	}
	public function get_magic_number($n = 2)
	{
		return self::$counter + $n;
	}
}

$a1 = new A();
$a2 = new A();

$a1->increase_counter();
$y = $a1->get_magic_number(10);

$a2->increase_counter();
$x = $y + $a2->get_magic_number();

var_dump($x);