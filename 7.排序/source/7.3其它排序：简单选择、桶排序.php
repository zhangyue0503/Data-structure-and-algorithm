<?php

$numbers = [49, 38, 65, 97, 76, 13, 27, 49];

echo implode(', ', $numbers), PHP_EOL;

// 简单选择

function SelectSort($numbers){
    $n = count($numbers);
    for( $i = 0 ; $i < $n ; $i++){
        $k = $i;
        for( $j = $i+1 ; $j < $n ; $j++){
            if($numbers[$j] < $numbers[$k]){
                $k = $j;
            }
        }
        if($k != $i){
            list($numbers[$i], $numbers[$k]) = [$numbers[$k], $numbers[$i]];
        }
        echo implode(', ', $numbers), PHP_EOL;
    }
    echo implode(', ', $numbers), PHP_EOL;
}
SelectSort($numbers);
// 13, 27, 38, 49, 49, 65, 76, 97


// 简单桶排序

function BucketSort($numbers){
    $bucketList = [];
    $maxValue = max($numbers);
    for($i=0;$i <= $maxValue;$i++){
        $bucketList[$i] = 0;
    }
    foreach($numbers as $n){
        $bucketList[$n]++;
    }
    $sortList = [];
    foreach($bucketList as $k => $v){
        if($v > 0){
            for( ; $v > 0 ; $v--){
                $sortList[] = $k;
            }
        }
    }
    echo implode(', ', $sortList), PHP_EOL;
}
BucketSort($numbers);
// 13, 27, 38, 49, 49, 65, 76, 97

function BucketSort2($numbers){
    $bucketList = [];
    foreach($numbers as $n){
        $bucketList[$n]++;
    }
    ksort($bucketList);
    $sortList = [];
    foreach($bucketList as $k => $v){
        for( ; $v > 0 ; $v--){
            $sortList[] = $k;
        }
    }
    echo implode(', ', $sortList), PHP_EOL;
}
BucketSort2($numbers);
// 13, 27, 38, 49, 49, 65, 76, 97