<?php

// от 1 до 15; от 3 до 55; от 9 до
// 43;
echo "<br>";
echo("Диапазон от 1 до 15 ");
echo "<br>";
printer(count_func(1,15));
echo "<br>";
echo("Диапазон от 3 до 55");
echo "<br>";
printer(count_func(3,55));
echo"<br>";
echo("Диапазон от 9 до 43");
echo "<br>";
printer(count_func(9,43));


echo "<br>";
echo "Уникальные элементы ";
echo "<br>";
echo("Диапазон от 1 до 15 ");
echo "<br>";
printer(array_unique(count_func(1,15)));
echo "<br>";
echo("Диапазон от 3 до 55");
echo "<br>";
printer(array_unique(count_func(3,55)));
echo"<br>";
echo("Диапазон от 9 до 43");
echo "<br>";
printer(array_unique(count_func(9,43)));



function handler(int $data)
{

    if ($data <7)
    {
        $data = round(low_quantity($data));
    }
    if ($data > 40)
    {
        $data = round(high_quantity($data));
    }
    if($data == 10)
    {
        $data = round(medium_quantity($data));
    }

    return $data;
}

function low_quantity(int $data )
{
    return $data - ($data * 0.5);
}

function high_quantity(int $data )
{
    return $data * 0.5;
}
function medium_quantity()
{
    return 0;
}

function count_func(int $left_border, int $right_border)
{
    $unique_array=[];
    for($a = $left_border;$a<=$right_border;$a++)
    {
        array_push($unique_array,handler($a));
    }  
    return $unique_array;
    
}
function printer($unique_array)
{
    foreach($unique_array as $value )
    {
        echo $value;
        echo " ";
    }
    }
?>
