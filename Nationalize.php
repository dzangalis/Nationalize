<?php

function getApi(string $link, string $name): object
{
    $url = "https://api." . $link . ".io?name=" . $name;
    $contents = file_get_contents($url);
    return json_decode($contents);
}

while (true) {
    echo "1. Age" . PHP_EOL;
    echo "2. Gender" . PHP_EOL;
    echo "3. Nationality" . PHP_EOL;
    echo "4. Exit" . PHP_EOL;
    $input = ucfirst(strtolower(readline("Select ann action(1-4): ")));

    switch ($input) {
        case 1:
            $link = "agify";
            $name = ucfirst(strtolower(readline("Type your name: ")));
            $apiContents = getApi($link, $name);
            echo "Name " . $apiContents->name . " is estimated to be " . $apiContents->age . " years old." . PHP_EOL;
            break;
        case 2:
            $link = "genderize";
            $name = ucfirst(strtolower(readline("Type your name: ")));
            $apiContents = getApi($link, $name);
            echo "Name " . $apiContents->name . " is " . round((float)$apiContents->probability * 100) . "% " . $apiContents->gender . "." . PHP_EOL;
            break;
        case 3:
            $link = "nationalize";
            $name = ucfirst(strtolower(readline("Type your name: ")));
            $apiContents = getApi($link, $name);
            echo "Name $name has a likelihood og living in:" . PHP_EOL;
            foreach ($apiContents->country as $nationality) {
                echo "Country ID: " . $nationality->country_id . ", Probability: " . round((float)$nationality->probability * 100) . "%" . PHP_EOL;
            }
            break;
        case 4:
            echo "Have a nice day!" . PHP_EOL;
            exit;
        default:
            echo "Please enter the desired values!" . PHP_EOL;
            break;
    }
}