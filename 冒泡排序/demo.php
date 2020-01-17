<?php
for ($i = 0; $i < 15; $i++) {
    $arr[] = rand(1, 10);
}
shuffle($arr);

print_r($arr);

// 冒泡排序
$length = count($arr);
for ($i = 0; $i < $length; $i++) {
    for ($j = 0; $j < $i; $j++) {
        if($arr[$i] < $arr[$j]){
            $temp = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $temp;
        }
    }
}
print_r($arr);

echo '// 1 ===== ', PHP_EOL;

$arr = [];
for ($i = 0; $i < 15; $i++) {
    $arr[] = rand(1, 10);
}
shuffle($arr);


print_r($arr);

for($i = 0;$i<$length; $i ++){
    for($j = 0;$j < $length -$i;$j++){
        if($arr[$j] < $arr[$j+1]){
            $temp = $arr[$j];
            $arr[$j] = $arr[$j+1];
            $arr[$j+1] = $temp;
        }
    }
}

print_r($arr);




