<?php

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




// 邻接矩阵深度遍历

$visited = []; // 已访问结点

function DFS_AM($graphArr, $x)
{
    global $visited;
    echo "节点：{$x}", PHP_EOL;
    $visited[$x] = true; // 当前结点标记为已访问
     
    // y 就是邻接矩阵中的横行
    for ($y = 1; $y <= count($graphArr); $y++) {
        // 循环判断第 [x][y] 个数据是否为 1，也就是是否有边
        // 并且这个结点没有被访问过
        if ($graphArr[$x][$y] != 0 && !$visited[$y]) {
            // 进行栈递归，传递的参数是当前这个结点
            DFS_AM($graphArr, $y);
        }
    }
}

BuildGraph($graphArr); // 建立邻接矩阵图

echo '请输入开始遍历的结点（1-结点数）：'; 
fscanf(STDIN, "%d", $startNode); // 输入从第几个结点开始访问
DFS_AM($graphArr, $startNode); // 开始深度优先遍历






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
    echo "请输入 结点数 边数：", PHP_EOL;
    fscanf(STDIN, "%d %d", $Nv, $Ne);
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




$visited = [];  // 已访问结点

function DFS_AL($graph, $x){
    global $visited;

    $p = $graph->adjList[$x]; // 指定结点的第一个边结点
    echo "节点：{$x}", PHP_EOL; // 输出指定结点的信息
    $visited[$x] = true; // 设置该结点已被访问

    while($p != null){
        $y = $p->adjVex; // 获得边结点信息
        if(!$visited[$y]){ // 如果结点没有被访问过
            DFS_AL($graph, $y); // 进入这个边结点的深度遍历过程
        }
        $p = $p->nextArc; // 移动到下一个边结点
    }

}

$graph = BuildLinkGraph();
$graphBFS = $graph;
echo '请输入开始遍历的结点（1-结点数）：';
fscanf(STDIN, "%d", $startNode); // 输入从第几个结点开始访问
DFS_AL($graph, $startNode);// 开始深度优先遍历

class SqQueue{
    public $data;
    public $front;
    public $rear;
}

function InitSqQueue(){
    $queue = new SqQueue();
    $queue->data = [];
    $queue->front = 0;
    $queue->rear = 0;
    return $queue;
}

function EnSqQueue(SqQueue &$queue, $e){
    $queue->data[$queue->rear] = $e;
    $queue->rear ++;
}

function DeSqQueue(SqQueue &$queue){
    if($queue->front == $queue->rear){
        return false;
    }
    $e = $queue->data[$queue->front];
    $queue->front++;
    return $e;
}

function EmptySqQueue(SqQueue &$queue){
    if($queue->front == $queue->rear){
        return true;
    }
}


$visited = [];
function BFS_AM($graphArr, $x){
    global $visited;

    $queue = InitSqQueue(); // 初始化队列
    $graphCount = count($graphArr); // 获取矩阵结点数量
    $visited[$x] = true; // 结点标记为已访问
    EnSqQueue($queue, $x); // 结点入队
    while($x){ // 循环判断结点是否 fasle
        // 遍历所有结点是否与这个结点有边
        for ($y = 1; $y <= $graphCount; $y++) {
            // 如果有边并且未访问过
            if ($graphArr[$x][$y] != 0 && !$visited[$y]) {
                $visited[$y] = true; // 结点标记为已访问
                EnSqQueue($queue, $y); // 结点入队
            }
        }
        $x = DeSqQueue($queue); // 出队一个结点
        echo $x, PHP_EOL; // 输出结点
    }
}

echo '请输入开始广度遍历的结点（1-结点数）：';
fscanf(STDIN, "%d", $startNode);
BFS_AM($graphArr, $startNode); // 开始广度遍历

$graph = $graphBFS;

$visited = [];
function BFS_AL($graph, $x){
    global $visited;

    $visited[$x] = true; // 结点标记为已访问
    $queue = InitSqQueue();// 初始化队列
    EnSqQueue($queue, $x); // 结点入队
    
    // 如果一直有能出队的结点，就一直循环
    // 也就是说，如果队列空了，循环就结束
    while(($i = DeSqQueue($queue))!==false){
        echo $i, PHP_EOL; // 输出结点
        $p = $graph->adjList[$i]; // 结点的第一个边结点
        while($p != null){ // 如果不为空
            $y = $p->adjVex; // 边结点信息
            if(!$visited[$y]){ // 如果没有访问过
                $visited[$y] = true; // 标记结点为已访问
                EnSqQueue($queue, $y); // 入队结点
            }
            $p = $p->nextArc; // 结点指针指向下一个
        }
    }
}

echo '请输入开始遍历的结点（1-结点数）：';
fscanf(STDIN, "%d", $startNode);
BFS_AL($graph, $startNode); // 开始广度遍历


