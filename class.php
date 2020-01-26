<?php

class one {
    function __construct () {
        echo ""; //nop
		//private - может быть исп. только внутри
		//protected  + наследуемые
		//public по умолчанию
		//static можно вызвать напрямую (без создания объекта)   class::var

    }
	
   var $v1="1";  // pub

   function xx($x) {
       return $x-1;
   }

}

class two extends one {
	var $additional="additional";
}
$obj=new one();
$obj=new two();
echo "Значение из переменной в классе1:".($obj->v1)."<br>";;
echo "Знач возвр функцией из класса1:".($obj->xx(5))."<br>";;  // вызов функции
echo "Значение из переменной в классе2:".($obj->v1)."<br>";;
echo "Знач возвр функцией из класса2:".($obj->additional)."<br>";;





?>
