<?php
// 邻接表
// 头结点
class AdjList
{
    public $adjList = []; // 顶点列表
    public $Nv = 0; // 结点数
    public $Ne = 0; // 边数
}
// 边结点
class ArcNode
{
    public $adjVex = 0; // 结点
    public $nextArc = null; // 链接指向
    public $weight = 0; // 权重
}

function BuildLinkGraph()
{
    fscanf(STDIN, "请输入 结点数 边数：%d %d", $Nv, $Ne);
    if ($Nv > 1) {
        // 初始化头结点
        $adj = new AdjList();
        $adj->Nv = $Nv; // 保存下来方便使用
        $adj->Ne = $Ne; // 保存下来方便使用
        // 头结点列表
        for ($i = 1; $i <= $Nv; $i++) {
            $adj->adjList[$i] = null; // 全部置为 NULL ，一个无边空图
        }
        
        if ($Ne > 0) {
//
            for ($i = 1; $i <= $Ne; $i++) {
                echo '请输入边，格式为 出 入 权：';
                fscanf(STDIN, "%d %d %d", $v1, $v2, $weight);
                // 建立一个结点
                $p1 = new ArcNode;
                $p1->adjVex = $v2; // 结点名称为 入结点
                $p1->nextArc = $adj->adjList[$v1]; // 下一跳指向 出结点 的头结点
                $p1->weight = $weight; // 设置权重
                $adj->adjList[$v1] = $p1; // 让头结点的值等于当前新创建的这个结点

                // 无向图需要下面的操作，也就是反向的链表也要建立
                $p2 = new ArcNode;

                // 注意下面两行与上面代码的区别
                $p2->adjVex = $v1; // 这里是入结点
                $p2->nextArc = $adj->adjList[$v2]; // 这里是出结点
                
                $p2->weight = $weight;
                $adj->adjList[$v2] = $p2;
            }

            return $adj;
        }

    }

    return null;
}

print_r(BuildLinkGraph());
// AdjList Object
// (
//     [adjList] => Array
//         (
//             [1] => ArcNode Object
//                 (
//                     [adjVex] => 4
//                     [nextArc] => ArcNode Object
//                         (
//                             [adjVex] => 3
//                             [nextArc] => ArcNode Object
//                                 (
//                                     [adjVex] => 2
//                                     [nextArc] => 
//                                     [weight] => 1
//                                 )

//                             [weight] => 1
//                         )

//                     [weight] => 1
//                 )

//             [2] => ArcNode Object
//                 (
//                     [adjVex] => 1
//                     [nextArc] => 
//                     [weight] => 1
//                 )

//             [3] => ArcNode Object
//                 (
//                     [adjVex] => 4
//                     [nextArc] => ArcNode Object
//                         (
//                             [adjVex] => 1
//                             [nextArc] => 
//                             [weight] => 1
//                         )

//                     [weight] => 1
//                 )

//             [4] => ArcNode Object
//                 (
//                     [adjVex] => 3
//                     [nextArc] => ArcNode Object
//                         (
//                             [adjVex] => 1
//                             [nextArc] => 
//                             [weight] => 1
//                         )

//                     [weight] => 1
//                 )

//         )

//     [Nv] => 4
//     [Ne] => 4
// )



// 邻接矩阵
$graphArr = [];
function CreateGraph($Nv, &$graphArr)
{
    $graphArr = [];
    for ($i = 1; $i <= $Nv; $i++) {
        for ($j = 1; $j <= $Nv; $j++) {
            $graphArr[$i][$j] = 0;
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

BuildGraph($graphArr);
// 请输入结点数：4
// 请输入边数：4
// 请输入边，格式为 出 入 权：1 2 1
// 请输入边，格式为 出 入 权：1 3 1
// 请输入边，格式为 出 入 权：1 4 1
// 请输入边，格式为 出 入 权：3 4 1

print_r($graphArr);
// Array
// (
//     [1] => Array
//         (
//             [1] => 0
//             [2] => 1
//             [3] => 1
//             [4] => 1
//         )

//     [2] => Array
//         (
//             [1] => 1
//             [2] => 0
//             [3] => 0
//             [4] => 0
//         )

//     [3] => Array
//         (
//             [1] => 1
//             [2] => 0
//             [3] => 0
//             [4] => 1
//         )

//     [4] => Array
//         (
//             [1] => 1
//             [2] => 0
//             [3] => 1
//             [4] => 0
//         )

// )
//  x
//y 0 1 1 1
//  1 0 0 0
//  1 0 0 1
//  1 0 1 0
