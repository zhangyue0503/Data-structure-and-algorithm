<?php

class BiTree
{
    public $data;
    public $lChild;
    public $rChild;
}

// 建立二叉树
function CreateBiTree($arr, $i)
{
    if (!isset($arr[$i])) {
        return null;
    }
    $t = new BiTree();
    $t->data = $arr[$i];
    $t->lChild = CreateBiTree($arr, $i * 2);
    $t->rChild = CreateBiTree($arr, $i * 2 + 1);
    return $t;
}

$treeList = ['', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];

$tree = CreateBiTree($treeList, 1);
print_r($tree);

// BiTree Object
// (
//     [data] => A
//     [lChild] => BiTree Object
//         (
//             [data] => B
//             [lChild] => BiTree Object
//                 (
//                     [data] => D
//                     [lChild] => BiTree Object
//                         (
//                             [data] => H
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                     [rChild] => BiTree Object
//                         (
//                             [data] => I
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                 )

//             [rChild] => BiTree Object
//                 (
//                     [data] => E
//                     [lChild] => BiTree Object
//                         (
//                             [data] => J
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                     [rChild] => BiTree Object
//                         (
//                             [data] => K
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                 )

//         )

//     [rChild] => BiTree Object
//         (
//             [data] => C
//             [lChild] => BiTree Object
//                 (
//                     [data] => F
//                     [lChild] => BiTree Object
//                         (
//                             [data] => L
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                     [rChild] => BiTree Object
//                         (
//                             [data] => M
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                 )

//             [rChild] => BiTree Object
//                 (
//                     [data] => G
//                     [lChild] => BiTree Object
//                         (
//                             [data] => N
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                     [rChild] => BiTree Object
//                         (
//                             [data] => O
//                             [lChild] =>
//                             [rChild] =>
//                         )

//                 )

//         )

// )

echo '==========================', PHP_EOL;

/**
 * 前序遍历
 */
function PreOrderTraverse(?BiTree $t)
{
    if ($t) {
        echo $t->data, ',';
        PreOrderTraverse($t->lChild);
        PreOrderTraverse($t->rChild);
    }
}

PreOrderTraverse($tree);

// A,B,D,H,I,E,J,K,C,F,L,M,G,N,O,

echo PHP_EOL, '==========================', PHP_EOL;

/**
 * 中序遍历
 */
function InOrderTraverse(?BiTree $t)
{
    if ($t) {
        InOrderTraverse($t->lChild);
        echo $t->data, ',';
        InOrderTraverse($t->rChild);
    }
}

InOrderTraverse($tree);

// H,D,I,B,J,E,K,A,L,F,M,C,N,G,O,

echo PHP_EOL, '==========================', PHP_EOL;

/**
 * 后序遍历
 */
function PostOrderTraverse(?BiTree $t)
{
    if ($t) {
        PostOrderTraverse($t->lChild);
        PostOrderTraverse($t->rChild);
        echo $t->data, ',';
    }
}

PostOrderTraverse($tree);

// H,I,D,J,K,E,B,L,M,F,N,O,G,C,A,

echo PHP_EOL, '==========================', PHP_EOL;

/**
 * 层序遍历
 */
$q = InitLinkQueue();
function LevelOrderTraverse(?BiTree $t)
{
    global $q;
    if (!$t) {
        return;
    }

    EnLinkQueue($q, $t);
    $node = $q;
    while ($node) {
        $node = DeLinkQueue($q);
        if ($node->lChild) {
            EnLinkQueue($q, $node->lChild);
        }
        if ($node->rChild) {
            EnLinkQueue($q, $node->rChild);
        }
        echo $node->data, ',';
    }
}

LevelOrderTraverse($tree);

// A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,

echo PHP_EOL, '==========================', PHP_EOL;

// ==================
// 链式队列相关测试代码

class LinkQueueNode
{
    public $data;
    public $next;
}

class LinkQueue
{
    public $first; // 队头指针
    public $rear; // 队尾指针
}
function InitLinkQueue()
{
    $node = new LinkQueueNode();
    $node->next = null;
    $queue = new LinkQueue();
    $queue->first = $node;
    $queue->rear = $node;
    return $queue;
}

function EnLinkQueue(LinkQueue &$queue, $e)
{
    $node = new LinkQueueNode();
    $node->data = $e;
    $node->next = null;

    $queue->rear->next = $node;
    $queue->rear = $node;
}

function DeLinkQueue(LinkQueue &$queue)
{
    if ($queue->front == $queue->rear) {
        return false;
    }

    $node = $queue->first->next;
    $v = $node->data;

    $queue->first->next = $node->next;
    if ($queue->rear == $node) {
        $queue->rear = $queue->first;
    }

    return $v;
}
