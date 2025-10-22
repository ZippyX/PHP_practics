<?php
$data = [
"category1" => [
    'price' => 1,
    'name' => "name1"
],
"category2" => [
    'price' => 2,
    'name' => "name2"
],
"category3" => [
    'price' => 3,
    'name' => "name3"
],
"category4" =>[
    "price" => 4,
    "name" => "name7"
],
"category5" =>[
    "price" => 4,
    "name" => "name1"
],
"category5" =>[
    "price" => 4,
    "name" => "name1"
]





];
$result = [];
$result = find(4,"name1");
echo ("Элементы из массива, в которых было найдено хотя бы одно совпадение");
echo "<br>";
foreach($result as $key => $value)
{  
    echo "<br>";
    echo "Название категории:";
    echo $key;
    echo "<br>";
    echo "Цена: "; 
    echo $value["price"];
    echo "<br>";
    echo "Название товара: ";
    echo $value["name"];
    echo "<br>";
}

function find($price,$name)
{
    global $data;   // делаем переменную data глобальной, чтобы не передавать её в функцию
    $arr_to_return = [];
    foreach($data as $key => $value)
    {
        if($value["name"] == $name || $value["price"] == $price )
        {
            $arr_to_return[$key] = $value;
        }
    }
    return $arr_to_return;
}
?>


