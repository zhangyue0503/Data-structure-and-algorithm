<?php

$numbers = [49, 38, 65, 97, 76, 13, 27, 49];

echo implode(', ', $numbers), PHP_EOL;

function BubbleSort($numbers)
{
    $n = count($numbers);

    for ($i = 0; $i < $n - 1; $i++) { // 外层循环 n - 1
        for ($j = 0; $j < $n - $i - 1; $j++) { // 内层循环 n - 1 - i
            if ($numbers[$j] > $numbers[$j + 1]) { // 两两相比来交换
                $temp = $numbers[$j + 1];
                $numbers[$j + 1] = $numbers[$j];
                $numbers[$j] = $temp;

                // list($numbers[$j + 1], $numbers[$j]) = [$numbers[$j], $numbers[$j + 1]];
            }
        }
    }

    print_r($numbers);
}

BubbleSort($numbers);
// Array
// (
//     [0] => 13
//     [1] => 27
//     [2] => 38
//     [3] => 49
//     [4] => 49
//     [5] => 65
//     [6] => 76
//     [7] => 97
// )



$a = 1;
$b = 2;
$a += $b; // a = 3
$b = $a - $b; // b = 3 - 2 = 1 
$a = $a - $b; // a = 3 - 1 = 2
echo $a, PHP_EOL; // 2
echo $b, PHP_EOL; // 1

$a = "a";
$b = "b";
$a .= $b; // a = "ab"
$b = str_replace($b, "", $a); // b = str_replace("b", "", "ab") = a
$a = str_replace($b, "", $a);// a = str_replace("a", "", "ab") = b
echo $a, PHP_EOL; // b
echo $b, PHP_EOL; // a

$a = 1;
$b = 2;
list($a, $b) = [$b, $a];
echo $a, PHP_EOL; // 2
echo $b, PHP_EOL; // 1




function QSort(&$arr, $start, $end)
{
    if ($start > $end) {
        return;
    }
    $key = $arr[$start];
    $left = $start;
    $right = $end;
    
    while ($left < $right) {
        // 右边下标确定
        while ($left < $right && $arr[$right] >= $key) {
            $right--;
        }
        // 左边下标确定
        while ($left < $right && $arr[$left] <= $key) {
            $left++;
        }
        if ($left < $right) { // 交换步骤
            $tmp = $arr[$left];
            $arr[$left] = $arr[$right];
            $arr[$right] = $tmp;
        }
        echo $left, ',', $right, PHP_EOL;
    }

    $arr[$start] = $arr[$left];
    $arr[$left] = $key;

    // 递归左右两边继续
    QSort($arr, $start, $right - 1);
    QSort($arr, $right + 1, $end);
}

function QuickSort($numbers)
{
    QSort($numbers, 0, count($numbers) - 1);
    print_r($numbers);
}

QuickSort($numbers);
// Array
// (
//     [0] => 13
//     [1] => 27
//     [2] => 38
//     [3] => 49
//     [4] => 49
//     [5] => 65
//     [6] => 76
//     [7] => 97
// )