<?php

        function taka($number)
           {

$number1 = $number;
$no = floor($number);
$hundred = null;
$digits_1 = strlen($no); //to find lenght of the number
$i = 0;
// Numbers can stored in array format
$str = array();

$words = array('0' => '', '1' => 'One', '2' => 'Two',
'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
'13' => 'Thirteen', '14' => 'Fourteen',
'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
'60' => 'Sixty', '70' => 'Seventy',
'80' => 'Eighty', '90' => 'Ninety');

$digits = array('', 'Hundred', 'Thousand', 'lakh', 'Crore');
//Extract last digit of number and print corresponding number in words till num becomes 0
while ($i < $digits_1)
{
$divider = ($i == 2) ? 10 : 100;
//Round numbers down to the nearest integer
$number =floor($no % $divider);
$no = floor($no / $divider);
$i +=($divider == 10) ? 1 : 2;

if ($number)
{
$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
$str [] = ($number < 21) ? $words[$number] . " " .
$digits[$counter] .
$plural . " " .
$hundred: $words[floor($number / 10) * 10]. " " .
$words[$number % 10] . " ".
$digits[$counter] . $plural . " " .
$hundred;
}
else $str[] = null;
}

$str = array_reverse($str);
$result = implode('', $str); //Join array elements with a string
//echo "Given number is: ".$number1."</br>";
echo $result ;
// return 0;

}
       