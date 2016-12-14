<?php
	/*
	* Написать функцию, которая в качестве параметров получает строку-шаблон и массив данных,
	* реализующую обработку строки-шаблона для замещения примитивов вида "{имя>функция>функция>...}" 
	* на результат обработки соответствующих элементов массива.
	* Например, чтобы вызов этой функции
	* > some_function("{a>rawurlencode>strtolower} != {a>strtolower>rawurlencode}", ['a' => 'A+B'])
	* возвращал результат
	* > a%2bb != a%2Bb
	*/
	echo templateProcessingLine("{a>rawurlencode>strtolower} != {a>strtolower>rawurlencode}", ['a' => 'A+B']);
	function templateProcessingLine($string, $array)
	{
  		preg_match_all('/\{[^\{\}]+\}/', $string, $matches);
		foreach ($matches[0] as $value) {
			$parsing[] = explode('>', substr($value, 1, strlen($value) - 2));	
		}
		$result = $string;
		for ($j = count($parsing) - 1; $j >= 0; $j--) {
			$current_str = $parsing[$j]; 
			$name = $current_str[0];
			if (array_key_exists($name, $array)) {
				$tmp = $array[$name];
				for($i = 1; $i < count($current_str); $i++) {
					$function = $current_str[$i]; 
					if (function_exists($function)) { 
					   $tmp = $function($tmp); 
					} else {
						return "Ошибка! Функции '$function' не существует!";
					}
				}
				$result = str_replace($matches[0][$j], $tmp, $result);
			} else {
				return "Ошибка! Имя '$name' не объявлено!";
			}
		}
		return $result;
	}
abstract class Foo_A
{
  public $var;
    
  public function __construct() {
    $this->var = 10;
    echo "A";
  }
}
class Foo_B extends Foo_A
{
  public function __construct() {
    echo "B";
    parent::__construct();
    $this->var = 20;
  }
}
class Foo_C extends Foo_B
{
  public function __construct() {
    echo "C";
    $this->var = 30;
    parent::__construct();
    
  }
}

$Foo = new Foo_C();
echo $Foo->var;
echo "<br>";


$arr = array(1, 3, 5, 7);
echo var_dump($arr)."<br>";
echo array_pop($arr)."<br>";
echo var_dump($arr)."<br>";
echo array_shift($arr)."<br>";
echo var_dump($arr)."<br>";
echo $arr[0]."<br>";

$i = 5;
echo −−$i+$i++;

