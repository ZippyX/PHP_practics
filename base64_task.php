<?php

$filepath = "C:/Users/Andrey/OneDrive/Desktop/temp/щпа/products.json";
$jsonstring = file_get_contents($filepath);
$data_from_json = json_decode($jsonstring,true);// true для создания ассоциативное массива
$data = [];
$data["image_name"] = $data_from_json["call"]["image_name"];
$data["link"] = $data_from_json["call"]["image"]["link"];
if($data_from_json["call"]["product_name"]["tradeble"] === "true")
{
    $data["file_path"] = save_from_decode_base64(convert_from_base64($data_from_json),$data["image_name"]);
}
$data["name"] = $data_from_json["call"]["product_name"]["name"];
foreach($data as $key => $value)
{
    echo "$key : $value";
    echo "<br>";
}

function convert_from_base64($json)
{
    $base64str = $json["call"]["image"]["base64"];
    preg_match('/^data:image\/(png|jpeg);base64,/', $base64str, $type);
    $base64str = substr($base64str,strpos($base64str,",")+1);
    $type = strtolower($type[1]);
    $data = base64_decode($base64str);
    if($data === false)
        throw new Exception("Ошибка декодирования");
    return $data;
}

function save_from_decode_base64($data,$file_name)
{
    //$filePath = "/home/kippyt/Desktop/for_base64/$file_name.jpg";
    $filePath = "C:/Users/Andrey/OneDrive/Desktop/for_base64/$file_name.jpg";
    if(file_put_contents($filePath,$data) === false)
    {
        throw new Exception("Не удалось сохранить файл");
    }
    else
    {
        echo "File success saved";
        echo "<br>";
        echo "<br>";
    }                
    return $filePath;
}
?>

<!--

Апи возвращает json массив вида {“call”:{“product_name1”:
{},“product_name2”:{}, …}.
Необходимо обработать его, чтобы на выходе получить массив
$data, где file_path путь к преобразованной и сохраненной под
именем = ‘image_name ’ картинке. Условием для преобразования
является значение tradeble = true.

$data = [
‘iamge_name’ = > ‘image_name’,
‘link’ => ‘link’,
‘file_path’ => ‘/image_folder/image_name.jpeg’,
‘name’ => ‘name’
]
Пример json массива с одним продуктом:
{"call": 
{"product_name": 
{"tradeble": "true",
"name": "main_window"},
"image_name": "sun1",
"image": 
{ 
"link":"https://product_web", 
 "base64": ...
}}}


незачем делать web.api с возвращаемым JSON, лучше просто создать файл типа json с одним продуктом и написать обработчик
-->