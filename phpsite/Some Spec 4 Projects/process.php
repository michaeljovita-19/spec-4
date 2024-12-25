<?php
$inputed = $_POST['input'];
$input = $inputed;
$temp = "";
$result = "";

if(empty($input)){
    echo"Invalid Input";
}else{
    while($input >= 1){
        $temp .= $input % 2;
        $input = intval($input / 2);
    }
    $size = strlen($temp);

    while($size-1 >= 0){
        $result .= $temp[$size-1];
        $size--;
    }
    echo"The binary of $inputed is $result<span style='vertical-align: sub; font-size: 0.6rem;'>2</span> <br>";
}

$input = $inputed;
$temp = "";
$result = "";

if(empty($input)){
    echo"Invalid Input";
}else{
    while($input >= 1){
        $temp .= $input % 8;
        $input = intval($input / 8);
    }

    $result = strrev($temp);
    echo"The Octal of $inputed is $result<span style='vertical-align: sub; font-size: 0.6rem;'>2</span> <br>";
}

//hexadecimal
$input = $inputed;
$temp;
$temp2 = "";
$result = "";
if(empty($input)){
    echo "Invalid Input";
}else{
    do{
        $temp = $input % 16;
        if($temp < 10){
            $temp2 .= $temp;
        }else{
            switch($temp){
                case 10: $temp2 .= 'A';
                    break;
                case 11: $temp2 .= 'B';
                    break;
                case 12: $temp2 .= 'C';
                    break;
                case 13: $temp2 .= 'D';
                    break;
                case 14: $temp2 .= 'E';
                    break;
                case 15: $temp2 .= 'F';
                    break;
                default:
                    break; 
            }
        }
        $input = intval($input / 16);
    }while($input != 0);

    $size = strlen($temp2);

    while($size-1 >= 0){
        $result .= $temp2[$size-1];
        $size--;
    }
    echo"The hexadecimal of $inputed is $result<span style='vertical-align: sub; font-size: 0.6rem;'>16</span>";
}

