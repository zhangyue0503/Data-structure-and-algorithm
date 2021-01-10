<?php



function SearchSeq($sk, $arr)
{
    for ($i = 0; $i < count($arr); $i++) {
        if ($sk == $arr[$i]) {
            echo $i, PHP_EOL;
            break;
        }
    }
    echo "线性查找次数：" . $i, PHP_EOL;
}

function SearchBin($sk, $arr){
    $left = 0;
    $right = count($arr) - 1;
    $i = 0;
    while ($left <= $right) {
        $i++;
        $mid = (int) (($left + $right) / 2);
        if ($arr[$mid] > $sk) {
            $right = $mid - 1;
        } else if ($arr[$mid] < $sk) {
            $left = $mid + 1;
        } else {
            echo $mid, PHP_EOL;
            break;
        }
    }
    echo "折半查找次数：" . $i, PHP_EOL;
}

$arr = [5, 6, 19, 25, 4, 33, 56, 77, 82, 81, 64, 37, 91, 23];

fscanf(STDIN, "%d", $searchKey);

SearchSeq($searchKey, $arr);
// 6
// 线性查找次数：6

sort($arr);
print_r($arr);

SearchBin($searchKey, $arr);
// 8
// 3


$arr = range(1, 100000);
$searchKey = 100000;

SearchSeq($searchKey, $arr);
SearchBin($searchKey, $arr);
