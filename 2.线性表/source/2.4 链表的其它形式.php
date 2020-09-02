<?php

// 双向链表
class LinkedList
{
    public $data;

    public $prev;
    public $next;
}

/**
 * 生成链表
 */
function createLinkedList()
{
    $list = new LinkedList();
    $list->data = null;
    $list->next = null;
    $list->prev = null; // ** 全部都初始化为 null **
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
        $link->prev = $r; // ** 增加上级指向 **
        $r = $link;
    }
    return $list;
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

    // ** 增加当前新创建的节点的上级指向 **
    $s->prev = $item;

    // 将 i-1 节点的下一跳节点指向 s ，完成将 s 插入指定的 i 位置，并让原来的 i 位置元素变成 i+1 位置
    $item->next = $s;

    // ** 将下级节点的 prev 指向新创建的这个节点 **
    $s->next->prev = $s;

    return true;
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

    // ** 让目标下一个节点的上级指针指向当前这个节点 **
    $temp->next->prev = $item;

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

var_dump($link);
var_dump($link->next->next->next->next);
// object(LinkedList)#5 (3) {
//     ["data"]=>
//     int(4)
//     ["prev"]=>
//     object(LinkedList)#4 (3) {
//       ["data"]=>
//       int(3)
//       ["prev"]=>
//       object(LinkedList)#3 (3) {
//         ["data"]=>
//         int(2)
//         ["prev"]=>
//         object(LinkedList)#2 (3) {
//           ["data"]=>
//           int(1)
//           ["prev"]=>
//           object(LinkedList)#1 (3) {
//             ["data"]=>
//             NULL
//             ["prev"]=>
//             NULL
//             ["next"]=>
//             *RECURSION*
//           }
//           ["next"]=>
//           *RECURSION*
//         }
//         ["next"]=>
//         *RECURSION*
//       }
//       ["next"]=>
//       *RECURSION*
//     }
//     ["next"]=>
//     object(LinkedList)#6 (3) {
//       ["data"]=>
//       int(5)
//       ["prev"]=>
//       *RECURSION*
//       ["next"]=>
//       object(LinkedList)#7 (3) {
//         ["data"]=>
//         int(6)
//         ["prev"]=>
//         *RECURSION*
//         ["next"]=>
//         object(LinkedList)#8 (3) {
//           ["data"]=>
//           int(7)
//           ["prev"]=>
//           *RECURSION*
//           ["next"]=>
//           object(LinkedList)#9 (3) {
//             ["data"]=>
//             int(8)
//             ["prev"]=>
//             *RECURSION*
//             ["next"]=>
//             object(LinkedList)#10 (3) {
//               ["data"]=>
//               int(9)
//               ["prev"]=>
//               *RECURSION*
//               ["next"]=>
//               object(LinkedList)#11 (3) {
//                 ["data"]=>
//                 int(10)
//                 ["prev"]=>
//                 *RECURSION*
//                 ["next"]=>
//                 NULL
//               }
//             }
//           }
//         }
//       }
//     }
//   }

echo $link->next->next->next->next->data, PHP_EOL; // 4
echo $link->next->next->next->next->prev->data, PHP_EOL; // 3


// 插入
Insert($link, 5, 55);
// 遍历链表
IteratorLinkedList($link); // 1,2,3,4,55,5,6,7,8,9,10,


// 删除
Delete($link, 7);
// 遍历链表
IteratorLinkedList($link); // 1,2,3,4,55,5,7,8,9,10,

echo $link->next->next->next->next->next->next->next->data, PHP_EOL; // 7

echo $link->next->next->prev->next->next->prev->next->data, PHP_EOL; // 3

