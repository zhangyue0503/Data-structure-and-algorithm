<?php

for($i=0;$i<100;$i++){
    $arr[] = $i+1;
}

$hashKey = 7;
$hashTable = [];
for($i=0;$i<100;$i++){
    $hashTable[$arr[$i]%$hashKey][] = $arr[$i];
}

print_r($hashTable);

$arr = [];
$hashTable = [];
for($i=0;$i<$hashKey;$i++){
    $r = rand(1,20);
    if(!in_array($r, $arr)){
        $arr[] = $r;
    }else{
        $i--;
    }
}

print_r($arr);
for($i=0;$i<$hashKey;$i++){
    if(!$hashTable[$arr[$i]%$hashKey]){
        $hashTable[$arr[$i]%$hashKey] = $arr[$i];
    }else{
        $c = 0;
        echo '冲突位置：', $arr[$i]%$hashKey, '，值：',$arr[$i], PHP_EOL;
        $j=$arr[$i]%$hashKey+1;
        while(1){
            if($j>=$hashKey){
                $j = 0;
            }
            if(!$hashTable[$j]){
                $hashTable[$j] = $arr[$i];
                break;
            }
            $c++;
            $j++;
            
            if($c >= $hashKey){
                break;
            }
            
        }
    }
}
print_r($hashTable);


// Array
// (
//     [0] => 17     // 3
//     [1] => 13     // 6
//     [2] => 9      // 2
//     [3] => 19     // 5
//     [4] => 2      // 2 -> 3 -> 4
//     [5] => 20     // 6 -> 0
//     [6] => 12     // 5 -> 6 -> 0 -> 1
// )
// 冲突位置：2，值：2
// 冲突位置：6，值：20
// 冲突位置：5，值：12
// Array
// (
//     [3] => 17
//     [6] => 13
//     [2] => 9
//     [5] => 19
//     [4] => 2
//     [0] => 20
//     [1] => 12
// )
