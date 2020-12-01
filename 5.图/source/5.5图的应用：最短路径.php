<?php

define('INFINITY', 9999999);

function CreateGraph($Nv, &$graphArr)
{
    $graphArr = [];
    for ($i = 1; $i <= $Nv; $i++) {
        for ($j = 1; $j <= $Nv; $j++) {
            if ($i == $j) {$graphArr[$i][$j] = 0;} else { $graphArr[$i][$j] = INFINITY;}
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
                // // 如果是无向图，还需要插入逆向的边
                // $graphArr[$v2][$v1] = $weight;
            }
        }
    }
}

function Floyd($graphArr)
{
    $n = count($graphArr);

    for ($k = 1; $k <= $n; $k++) { // 设 k 为经过的结点
        for ($i = 1; $i <= $n; $i++) {
            for ($j = 1; $j <= $n; $j++) {
                // 如果经过 k 结点 能使 i 到 j 的路径变短，那么将 i 到 j 之间的更新为通过 k 中转之后的结果
                if ($graphArr[$i][$j] > $graphArr[$i][$k] + $graphArr[$k][$j]) {
                    $graphArr[$i][$j] = $graphArr[$i][$k] + $graphArr[$k][$j];
                }
            }
        }
    }

    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $n; $j++) {
            echo $graphArr[$i][$j], ' ';
        }
        echo PHP_EOL;
    }
}

// 请输入结点数：4
// 请输入边数：8
// 请输入边，格式为 出 入 权：1 2 2
// 请输入边，格式为 出 入 权：1 3 6
// 请输入边，格式为 出 入 权：1 4 4
// 请输入边，格式为 出 入 权：2 3 3
// 请输入边，格式为 出 入 权：3 1 7
// 请输入边，格式为 出 入 权：3 4 1
// 请输入边，格式为 出 入 权：4 1 5
// 请输入边，格式为 出 入 权：4 3 12
// 0 2 5 4
// 9 0 3 4
// 6 8 0 1
// 5 7 10 0

// origin 表示源点，也就是我们要看哪个结点到其它结点的最短路径
function Dijkstra($graphArr, $origin)
{
    $n = count($graphArr);
    $dis = []; // 记录最小值
    $book = []; // 记录结点是否访问过
    // 初始化源点到每个点的权值，
    for ($i = 1; $i <= $n; $i++) {
        $dis[$i] = $graphArr[$origin][$i]; // 源点到其它点的默认权值
        $book[$i] = 0; // 所有结点都没访问过
    }

    $book[$origin] = 1; // 源点自身标记为已访问
    print_r($dis);
    for ($i = 1; $i <= $n - 1; $i++) {
        $min = INFINITY;
        // 找到离目标结点最近的结点
        for ($j = 1; $j <= $n; $j++) {
            // 如果结点没有被访问过，并且当前结点的权值小于 min 值
            if ($book[$j] == 0 && $dis[$j] < $min) {
                $min = $dis[$j]; // min 修改为当前这个节点的路径值
                $u = $j; // 变量 u 变为当前这个结点
            }
            // 遍历完所有结点，u 就是最近的那个顶点
        }
        $book[$u] = 1; // 标记 u 为已访问
        for ($v = 1; $v <= $n; $v++) {
            // 如果 [u][v] 顶点小于无穷
            if ($graphArr[$u][$v] < INFINITY) {
                // 如果当前 dis[v] 中的权值大于 dis[u]+g[u][v]
                if ($dis[$v] > $dis[$u] + $graphArr[$u][$v]) {
                    // 将当前的 dis[v] 赋值为 dis[u]+g[u][v]
                    $dis[$v] = $dis[$u] + $graphArr[$u][$v];
                }
            }
        }
        print_r($dis);
        print_r($book);
        // 最近的结点完成，继续下一个最近的结点
    }

    for ($i = 1; $i <= $n; $i++) {
        echo $dis[$i], PHP_EOL;
    }
}
// 5
// 7
// 10
// 0

$graphArr = [];
BuildGraph($graphArr);

Floyd($graphArr);

Dijkstra($graphArr, 4);
