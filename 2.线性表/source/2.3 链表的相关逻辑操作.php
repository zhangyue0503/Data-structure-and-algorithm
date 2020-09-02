<?php

/**
 * 链表结构
 */
class LinkedList
{
    public $data;
    public $next;
}

/**
 * 根据位置查找元素位置
 * @param LinkedList $list 链表数据
 * @param int $i 位置
 */
function GetElem(LinkedList &$list, int $i)
{
    $item = $list;
    $j = 1; // 从第一个开始查找，0是头结点 
    while ($item && $j <= $i) {
        $item = $item->next;
        $j++;
    }

    if (!$item || $j > $i + 1) {
        return false;
    }
    return $item->data;

}

/**
 * 根据数据查找数据元素所在位置
 * @param LinkedList $list 链表数据
 * @param mixed $data 数据
 */
function LocateElem(LinkedList &$list, $data)
{
    $item = $list;
    $j = 1; // 从第一个开始查找，0是头结点 
    while (($item = $item->next)!=null) {
        if($item->data == $data){
            return $j;
        }
        $j++;
    }

    return false;
}



/**
 * 链表指定位置插入元素
 * @param LinkedList $list 链表数据
 * @param int $i 位置
 * @param mixed $data 数据
 */
function Insert(LinkedList &$list, int $i, $data)
{
    $j = 0;
    $item = $list;
    // 遍历链表，找指定位置的前一个位置
    while ($j < $i - 1) {
        $item = $item->next;
        $j++;
    }

    // 如果 item 不存在或者 $i > n+1 或者 $i < 0
    if ($item == null || $j > $i - 1) {
        return false;
    }

    // 创建一个新节点
    $s = new LinkedList();
    $s->data = $data;

    // 新创建节点的下一个节点指向原 i-1 节点的下一跳节点，也就是当前的 i 节点
    $s->next = $item->next;
    // 将 i-1 节点的下一跳节点指向 s ，完成将 s 插入指定的 i 位置，并让原来的 i 位置元素变成 i+1 位置
    $item->next = $s;

    return true;
}

/**
 * 生成链表
 */
function createLinkedList()
{
    $list = new LinkedList();
    $list->data = null;
    $list->next = null;
    return $list;
}

/**
 * 初始化链表
 * @param array $data 链表中要保存的数据，这里以数组为参考
 * @return LinkedList 链表数据
 */
function Init(array $data)
{
    // 初始化
    $list = createLinkedList();
    $r = $list;
    foreach ($data as $key => $value) {
        $link = new LinkedList();
        $link->data = $value;
        $link->next = null;
        $r->next = $link;
        $r = $link;
    }
    return $list;
}

/**
 * 删除链表指定位置元素
 * @param LinkedList $list 链表数据
 * @param int $i 位置
 */
function Delete(LinkedList &$list, int $i)
{
    $j = 0;
    $item = $list;
    // 遍历链表，找指定位置的前一个位置
    while ($j < $i - 1) {
        $item = $item->next;
        $j++;
    }
    // 如果 item 不存在或者 $i > n+1 或者 $i < 0
    if ($item == null || $j > $i - 1) {
        return false;
    }

    // 使用一个临时节点保存当前节点信息，$item 是第 i-1 个节点，所以 $item->next 就是我们要找到的当前这个 i 节点
    $temp = $item->next;
    // 让当前节点，也就是目标节点的上一个节点， i-1 的这个节点的下一跳（原来的 i 位置的节点）变成原来 i 位置节点的下一跳 next 节点，让i位置的节点脱离链条
    $item->next = $temp->next;

    return true;
}

function IteratorLinkedList(LinkedList $link)
{
    while (($link = $link->next) != null) {
        echo $link->data, ',';
    }
    echo PHP_EOL;
}

$link = Init(range(1, 10));

print_r($link);
// LinkedList Object
// (
//     [data] =>
//     [next] => LinkedList Object
//         (
//             [data] => 1
//             [next] => LinkedList Object
//                 (
//                     [data] => 2
//                     [next] => LinkedList Object
//                         (
//                             [data] => 3
//                             [next] => LinkedList Object
//                                 (
//                                     [data] => 4
//                                     [next] => LinkedList Object
//                                         (
//                                             [data] => 5
//                                             [next] => LinkedList Object
//                                                 (
//                                                     [data] => 6
//                                                     [next] => LinkedList Object
//                                                         (
//                                                             [data] => 7
//                                                             [next] => LinkedList Object
//                                                                 (
//                                                                     [data] => 8
//                                                                     [next] => LinkedList Object
//                                                                         (
//                                                                             [data] => 9
//                                                                             [next] => LinkedList Object
//                                                                                 (
//                                                                                     [data] => 10
//                                                                                     [next] =>
//                                                                                 )

//                                                                         )

//                                                                 )

//                                                         )

//                                                 )

//                                         )

//                                 )

//                         )

//                 )

//         )

// )

// 遍历链表
IteratorLinkedList($link); // 1,2,3,4,5,6,7,8,9,10,

// 插入
Insert($link, 5, 55);
// 遍历链表
IteratorLinkedList($link); // 1,2,3,4,55,5,6,7,8,9,10,

// 删除
Delete($link, 7);
// 遍历链表
IteratorLinkedList($link); // 1,2,3,4,55,5,7,8,9,10,

// 获取指定位置的元素内容
var_dump(GetElem($link, 5)); // int(55)

// 获取指定元素所在的位置
var_dump(LocateElem($link, 55)); // int(5)