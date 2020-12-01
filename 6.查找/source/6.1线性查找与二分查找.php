<?php

$arr = [5, 6, 19, 25, 4, 33, 56, 77, 82, 81, 64, 37, 91, 23];

fscanf(STDIN, "%d", $Se);
for ($i = 0; $i < count($arr); $i++) {
    if ($Se == $arr[$i]) {
        echo $i + 1, PHP_EOL;
    }
}

sort($arr);
print_r($arr);

$left = 0;
$right = count($arr) - 1;
while ($left <= $right) {
    $mid = (int)(($left + $right) / 2);
    if ($arr[$mid] > $Se) {
        $right = $mid - 1;
    } else if ($arr[$mid] < $Se) {
        $left = $mid + 1;
    } else {
        echo $mid + 1, PHP_EOL;
        break;
    }
    echo $left, ',', $right, PHP_EOL;
}
