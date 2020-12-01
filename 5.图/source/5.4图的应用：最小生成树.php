<?php

define('INFINITY', 9999999);

function CreateGraph($Nv, &$graphArr)
{
    $graphArr = [];
    for ($i = 1; $i <= $Nv; $i++) {
        for ($j = 1; $j <= $Nv; $j++) {
            $graphArr[$i][$j] = INFINITY;
        }
    }
}

// 邻接矩阵
function BuildGraph(&$graphArr)
{
    echo '请输入结点数：';
    fscanf(STDIN, "%d", $Nv);
    CreateGraph($Nv, $graphArr);
    
    if ($graphArr) {
        echo '请输入边数：';
        fscanf(STDIN, "%d", $Ne);
        if ($Ne > 0) {
            for ($i = 1; $i <= $Ne; $i++) {
                echo '请输入边，格式为 出 入 权：';
                fscanf(STDIN, "%d %d %d", $v1, $v2, $weight);
                $graphArr[$v1][$v2] = $weight;
                // 如果是无向图，还需要插入逆向的边
                $graphArr[$v2][$v1] = $weight;
            }
        }
    }
}

// 普里姆算法
function Prim($graphArr)
{
    
    $n = count($graphArr);
    // 记录 1 号顶点到各个顶点的初始距离
    $dis = [];
    for ($i = 1; $i <= $n; $i++) {
        $dis[$i] = $graphArr[1][$i];
    }

    // 将 1 号顶点加入生成树
    $book[1] = 1; // 标记一个顶点是否已经加入到生成树
    $count = 1; // 记录生成树中的顶点的个数
    $sum = 0; // 存储路径之和
    // 循环条件 生成树中的顶点的个数 小于 总结点数
    while ($count < $n) {
        $min = INFINITY;
        for ($i = 1; $i <= $n; $i++) {
            // 如果当前顶点没有加入到生成树，并且记录中的权重比当前权重小
            if (!$book[$i] && $dis[$i] < $min) {
                // 将 $min 定义为当前权重的值
                $min = $dis[$i];
                $j = $i; // 用于准备将顶点加入到生成树记录中
            }
        }
        $book[$j] = 1; // 确认将最小权重加入到生成树记录中
        $count++; // 顶点个数增加
        $sum += $dis[$j]; // 累加路径和
        // 调整当前顶点 $j 的所有边，再以 $j 为中间点，更新生成树到每一个非树顶点的距离
        for ($k = 1; $k <= $n; $k++) {
            // 如果当前顶点没有加入到生成树，并且记录中的 $k 权重顶点大于 $j 顶点到 $k 顶点的权重
            if (!$book[$k] && $dis[$k] > $graphArr[$j][$k]) {
                // 将记录中的 $k 顶点的权重值改为 $j 顶点到 $k 顶点的值
                $dis[$k] = $graphArr[$j][$k];
            }
        }
    }
    print_r($dis);
    // Array
    // (
    //     [1] => 9999999
    //     [2] => 1
    //     [3] => 2
    //     [4] => 9
    //     [5] => 4
    //     [6] => 3
    // )
    return $sum;
}

$map = [];

// 快排
function quicksort($left, $right)
{
    global $map;
    if ($left > $right) {
        return;
    }

    $i = $left;
    $j = $right;
    while ($i != $j) {
        while ($map[$j]['w'] >= $map[$left]['w'] && $i < $j) {
            $j--;
        }
        while ($map[$i]['w'] <= $map[$left]['w'] && $i < $j) {
            $i++;
        }

        if ($i < $j) {
            $t = $map[$i];
            $map[$i] = $map[$j];
            $map[$j] = $t;
        }

    }

    $t = $map[$left];
    $map[$left] = $map[$i];
    $map[$i] = $t;

    quicksort($left, $i - 1);
    quicksort($i + 1, $right);
}

$f = [];

// 并查集寻找祖先的函数
function getf($v)
{
    global $f;
    if ($f[$v] == $v) {
        return $v;
    } else {
        // 路径压缩
        $f[$v] = getf($f[$v]);
        return $f[$v];
    }
}

// 并查集合并两子集合的函数
function merge($v, $u)
{
    global $f;
    $t1 = getf($v);
    $t2 = getf($u);
    // 判断两个点是否在同一个集合中
    if ($t1 != $t2) {
        $f[$t2] = $t1;
        return true;
    }
    return false;
}

// 克鲁斯卡尔算法
function Kruskal($graphArr)
{
    global $map, $f;
    $hasMap = [];
    $i = 1;
    // 转换为序列形式方便排序
    // O(mn)或O(n^2)，可以直接建图的时候使用单向图进行建立就不需要这一步了
    foreach ($graphArr as $x => $v) {
        foreach ($v as $y => $vv) {
            if ($vv == INFINITY) {
                continue;
            }
            if (!isset($hasMap[$x][$y]) && !isset($hasMap[$y][$x])) {
                $map[$i] = [
                    'x' => $x,
                    'y' => $y,
                    'w' => $vv,
                ];
                $hasMap[$x][$y] = 1;
                $hasMap[$y][$x] = 1;
                $i++;
            }
        }
    }
    // 使用快排按照权重排序
    quicksort(1, count($map));

    // 初始化并查集
    for ($i = 1; $i <= count($graphArr); $i++) {
        $f[$i] = $i;
    }

    $count = 0; // 已记录结点数量
    $sum = 0; // 存储路径之和
    for ($i = 1; $i <= count($map); $i++) {
        // 判断一条边的两个顶点是否已经连通，即判断是否已在同一个集合中
        if (merge($map[$i]['x'], $map[$i]['y'])) { // 如果目前已连通，则选用这条边
            $count++;
            $sum += $map[$i]['w'];
        }
        if ($count == count($map) - 1) { // 直到选了n-1条边后退出
            break;
        }
    }
    return $sum;
}

$graphArr = [];
BuildGraph($graphArr);

echo Prim($graphArr); // 19
echo PHP_EOL;

echo Kruskal($graphArr); // 19
