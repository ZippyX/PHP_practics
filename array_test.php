<?php
$data = [
    'category' => [
        'one' => [
            'priority' => '3',
            'views' => [
                'user_count' => 345,
                'bot_count' => 9392
            ]
        ],
        'two' => [
            'priority' => '1',
            'views' => [
                'user_count' => 123222,
                'bot_count' => 99
            ]
        ],
        'three' => [
            'priority' => '2',
            'views' => [
                'user_count' => 23,
                'bot_count' => 1
            ]
        ],
        "four" =>[
            'priority' => '4',
            'views' => [
                'user_count' => 24,
                'bot_count' => 1
            ]
        ]

    ]
];

$result = get_bot_and_users($data);
$sorted_data = get_group_all_information($data);
get_group_all_information($data);
echo "<br>";
$max = find_max($result);
$min = find_min($result);
echo "Максимальное значение bot_count : ";
echo  "$max";
echo "</br>";
echo "Минимальное значение bot_count : ";
echo "$min";
echo "</br>";

echo "</br>";
information($sorted_data);

function information($data)
{
    $all_priorets = [];
    foreach($data as $key => $value)
    {
        $all_priorets[] = $key;
    }
    sort($all_priorets);
    
    foreach($all_priorets as $prioritet_number)
    {
        $minimum = min($data[$prioritet_number]);
        echo "<br>";
        $maximum = max($data[$prioritet_number]);
        echo "<br>";
        echo "приоритет: $prioritet_number";
        echo "<br>";
        echo "$minimum $maximum";
        echo "<br>";
    }
}

function get_group_all_information($data)
{
    $user_and_bot_counts = [];
    foreach($data["category"] as $category_name => $category_data)
    {
        $prioritet = $category_data["priority"];
        $usercount = $category_data["views"]["user_count"];
        $botcount = $category_data["views"]["bot_count"];
        $user_and_bot_counts[$prioritet] =[$usercount,$botcount];
    }
    return $user_and_bot_counts;
    
}

function get_bot_and_users($data) 
{
    $user_adn_bot_counts = [];
    foreach($data as $category_number)
    {
        foreach($category_number as $key =>$number_value)
        {
            foreach($number_value as $key => $value)
            {
                
                if($key == "views")
                { 
                    $num_1 = $value["bot_count"]; 
                    array_push($user_adn_bot_counts,$num_1);
                    key($data);
                  
                }
            }
        }
    }
    return $user_adn_bot_counts;
}
function find_max($array)
{
    $max = 0;
    foreach($array as $number)
    {
        if($number > $max)
        {
            $max = $number;
        }
    }
    return $max;
}
function find_min($array)
{
    $min = 1000;
    foreach($array as $number)
    {
        if($number < $min)
        {
            $min = $number;
        }
    }
    return $min;
}
?>
