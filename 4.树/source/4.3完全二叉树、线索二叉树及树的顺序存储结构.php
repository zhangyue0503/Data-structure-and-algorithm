<?php

// 线索二叉树结点
class TBTNode
{
    public $data;
    public $lTag = 0;
    public $rTag = 0;
    public $lChild;
    public $rChild;
}

// 建立二叉树
function CreateBiTree($arr, $i)
{
    if (!isset($arr[$i]) || !$arr[$i]) { // 这里增加了个判断，如果数组元素为空
        return null;
    }
    $t = new TBTNode();
    $t->data = $arr[$i];
    $t->lChild = CreateBiTree($arr, $i * 2);
    $t->rChild = CreateBiTree($arr, $i * 2 + 1);
    return $t;
}

$treeList = ['', 'A', 'B', 'C', 'D', 'E', 'I', '', '', '', '', 'H', '', 'J', '', ''];

$tree = CreateBiTree($treeList, 1);

// 线索化
function InThread(?TBTNode $p, ?TBTNode &$pre)
{
    if ($p) {
        // 递归，左子树线索化
        InThread($p->lChild, $pre);

        if (!$p->lChild) {
            // 建立当前结点的前驱线索
            $p->lChild = $pre;
            $p->lTag = 1;
        }
        if ($pre && !$pre->rChild) {
            // 建立当前结点的后继线索
            $pre->rChild = $p;
            $pre->rTag = 1;
        }
        $pre = $p; // $pre 指向当前的 $p ，作为 $p 将要指向的下一个结点的前驱结点指示指针
        $p = $p->rChild; // $p 指向一个新结点，此时 $pre 和 $p 分别指向的结点形成了一个前驱后继对，为下一次线索化做准备
        
        // 递归，右子树线索化
        InThread($p, $pre);
    }
}

// 创建线索二叉树
function createInThread(TBTNode $root)
{
    $pre = null; // 前驱结点指针
    if($root){
        InThread($root, $pre);
        $pre->rChild = null; // 非空二叉树，线索化
        $pre->rTag = 1; // 后处理中序最后一个结点
    }
}

createInThread($tree);

var_dump($tree);
// object(TBTNode)#1 (5) {
//     ["data"]=>
//     string(1) "A"
//     ["lTag"]=>
//     int(0)
//     ["rTag"]=>
//     int(0)
//     ["lChild"]=>
//     object(TBTNode)#2 (5) {
//       ["data"]=>
//       string(1) "B"
//       ["lTag"]=>
//       int(0)
//       ["rTag"]=>
//       int(0)
//       ["lChild"]=>
//       object(TBTNode)#3 (5) {
//         ["data"]=>
//         string(1) "D"
//         ["lTag"]=>
//         int(1)
//         ["rTag"]=>
//         int(1)
//         ["lChild"]=>
//         NULL
//         ["rChild"]=>
//         *RECURSION*
//       }
//       ……

// 以 $p 为根的中序线索二叉树中，中序序列下的第一个结点，也就是最左边那个结点
function First(?TBTNode $p){
    while($p->lTag == 0){
        $p = $p->lChild; // 最左下结点（不一定是叶子结点）
    }
    return $p;
}

// 在中序二叉树中，结点 $p 在中序下的后继结点
function NextNode(?TBTNode $p){
    if($p->rTag == 0){
        return First($p->rChild);
    }else{
        return $p->rChild; // 如果 rTag == 1 ，直接返回后继线索
    }
}

// 在中序线索二叉树上进行中序遍历
function Inorder(TBTNode $root){
    //     第一个结点      结点不为空    下一个结点
    for($p = First($root);$p;$p=NextNode($p)){
        echo $p->data, ',';
    }
}

Inorder($tree); // D,B,E,H,A,I,J,C, 