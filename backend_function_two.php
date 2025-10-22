<?php
$data = [
'email' => "string",
'password' => "string",
'repit_password' => "string",
'phone_number' => "int",
'name' => "string",
'came_from' => "string",
'date_birth' => "date",
];

$data1 = [
'email' => "Zippy1336@gmail.com",
'password' => "string123",
'repit_password' => "string123",
'phone_number' => "79113565212",
'name' => "string",
'came_from' => "tv",
'date_birth' => "12.07.2096",
];


$answer_from_validation = validation($data1);

if($answer_from_validation != null)
{
    echo $answer_from_validation["message"];
    echo "<br>";
    $status = $answer_from_validation["status"];
    if($status == 0)
    {
        echo 'FALSE';
    }
    if($status == 1)
    {
        echo "TRUE";
    }
}


function validation($data)
{
    global $answer;
    // валидация почты
    { 
        $error_messager = "Проверьте наличие значка @ и длина Вашей почты должна быть больше 5";
        $true_condition = str_contains($data["email"],"@") && mb_strlen($data["email"]) >5;
        $local_answer = create_validation($data,"email",$true_condition,$error_messager);
        if($local_answer != null)
        {
            return $local_answer;
        }
    }
    // валидация пароля
    {
        
        $error_messager = "Проверьте, одинаковый ли введён пароль, а также длину пароля, которая должна быть больше 8 символов.";
        $error_message_cont = " Пароль должен содержать буквы и цифры";
        $concurrence_condition = ($data["password"] == $data["repit_password"]);
        $letters_and_digit_condition = preg_match('/^(?=.*[a-zA-Z])(?=.*\d).*$/',$data["password"]);
        $len_condition = mb_strlen($data["password"]) > 8;
        $local_answer = create_validation($data,"password",($concurrence_condition && $letters_and_digit_condition && $len_condition),$error_messager . $error_message_cont);
        if($local_answer != null)
        {
            return $local_answer;
        }
        
    }
    // валидация rep_pas
    {
        $error_message = "введённые пароли не совпадают";
        $local_answer = create_validation($data,"repit_password",$concurrence_condition,$error_message);
        if ($local_answer != null)
        {
            return $local_answer;
        }

    }
    // валидация phone_number
    {
        $error_message = "Длина телефонного номера менее чем 5 символов";
        $len_condition_for_phone = mb_strlen($data["phone_number"]) >5;
        $local_answer = create_validation($data,"phone_number",$len_condition_for_phone,$error_message);
        if ($local_answer != null)
        {
            return $local_answer;
        }
        
        
    }
    // валидация name
    {
        $error_message = "Имя должно состоять только из букв";
        $letter_condition = ctype_alpha($data["name"]);
        $local_answer = create_validation($data,"name",$letter_condition,$error_message);
        if($local_answer != null)
        {
            return $local_answer;
        }
    }
    // валидация_прибытия
    {
        $city_array = ["site","city","tv","others"];
        $error_message = "Город не совпадает ни с одним элементом массива ";
        $city_condition = in_array($data["came_from"],$city_array);
        $local_answer = create_validation($data,"came_from",$city_condition,$error_message);
        if($local_answer != null)
        {
            return $local_answer;
        }
        
    }
    // валидация возраста
    {
        $error_message = "Ваш возраст не находится в диапазоне от 16 и 66 лет";
        $date_birth = $data['date_birth'];
        $age = decompose_date_birth($date_birth);
        $age_condition = $age > 15 && $age<67;
        $local_answer = create_validation($data,"date_birth",$age_condition,$error_message);
         if($local_answer != null)
        {
            return $local_answer;
        }
    

    }
    return create_answer(true,"SUCCESS");
    
}   

function decompose_date_birth($date_birth)
{
    $date = explode(".",$date_birth);
    $year_of_birth = $date[2];
    $curr_date = date("Y");
    return (int) $curr_date - (int) $year_of_birth;
    // не учитывается др


}


function create_validation($data,string $key_name,bool $condition,string $error_message)
{
    if(array_key_exists($key_name,$data))
        {
            
            if ($condition)
            {
                return;
            }
            else
            {
                return create_answer(false,$error_message);
            }
        }
        else
        {
            if($key_name == "email");
                return create_answer(false,"Вы не ввели почту");
            if($key_name == "repit_password" || $key_name == "password")
                return create_answer(false,"Вы не ввели пароль");
            if($key_name == "date_birth")
                return create_answer(false,"Вы не ввели дату рождения");
        }
}

function create_answer(bool $status, string $message)
{
    $answer =[
    "status" => $status,
    "message" => $message
    ];
    return $answer;
}
?>