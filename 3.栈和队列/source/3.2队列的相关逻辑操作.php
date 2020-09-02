<?php

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
    // 队列为空
    if($queue->front == $queue->rear){
        return false;
    }
    $e = $queue->data[$queue->front];
    $queue->front++;
    return $e;
}

$q = InitSqQueue();
EnSqQueue($q, 'A');
EnSqQueue($q, 'B');
print_r($q);
// SqQueue Object
// (
//     [data] => Array
//         (
//             [0] => A
//             [1] => B
//         )

//     [front] => 0
//     [rear] => 2
// )

EnSqQueue($q, 'C');
EnSqQueue($q, 'D');
EnSqQueue($q, 'E');
print_r($q);
// SqQueue Object
// (
//     [data] => Array
//         (
//             [0] => A
//             [1] => B
//             [2] => C
//             [3] => D
//             [4] => E
//         )

//     [front] => 0
//     [rear] => 5
// )

echo DeSqQueue($q), PHP_EOL; // A
echo DeSqQueue($q), PHP_EOL; // B
echo DeSqQueue($q), PHP_EOL; // C
echo DeSqQueue($q), PHP_EOL; // D
echo DeSqQueue($q), PHP_EOL; // E

echo DeSqQueue($q), PHP_EOL; // 

print_r($q);
// SqQueue Object
// (
//     [data] => Array
//         (
//             [0] => A
//             [1] => B
//             [2] => C
//             [3] => D
//             [4] => E 
//         )

//     [front] => 5
//     [rear] => 5
// )


define('MAX_QUEUE_LENGTH', 6);

function EnSqQueueLoop(SqQueue &$queue, $e){
    // 判断队列是否满了
    if(($queue->rear + 1) % MAX_QUEUE_LENGTH == $queue->front){
        return false;
    }
    $queue->data[$queue->rear] = $e;
    $queue->rear = ($queue->rear + 1) % MAX_QUEUE_LENGTH; // 改成循环下标
}

function DeSqQueueLoop(SqQueue &$queue){
    // 队列为空
    if($queue->front == $queue->rear){
        return false;
    }
    $e = $queue->data[$queue->front];
    $queue->front = ($queue->front + 1) % MAX_QUEUE_LENGTH; // 改成循环下标
    return $e;
}

$q = InitSqQueue();
EnSqQueueLoop($q, 'A');
EnSqQueueLoop($q, 'B');
EnSqQueueLoop($q, 'C');
EnSqQueueLoop($q, 'D');
EnSqQueueLoop($q, 'E');

EnSqQueueLoop($q, 'F');

print_r($q);
// SqQueue Object
// (
//     [data] => Array
//         (
//             [0] => A
//             [1] => B
//             [2] => C
//             [3] => D
//             [4] => E
//             [5] =>   // 尾
//         )

//     [front] => 0
//     [rear] => 5
// )

echo DeSqQueueLoop($q), PHP_EOL;
echo DeSqQueueLoop($q), PHP_EOL;
print_r($q);
// SqQueue Object
// (
//     [data] => Array
//         (
//             [0] => A
//             [1] => B
//             [2] => C // 头
//             [3] => D
//             [4] => E
//             [5] =>   // 尾
//         )

//     [front] => 2
//     [rear] => 5
// )

EnSqQueueLoop($q, 'F');
EnSqQueueLoop($q, 'G');

EnSqQueueLoop($q, 'H');
print_r($q);
// SqQueue Object
// (
//     [data] => Array
//         (
//             [0] => G
//             [1] => B // 尾
//             [2] => C // 头
//             [3] => D
//             [4] => E
//             [5] => F
//         )

//     [front] => 2
//     [rear] => 1
// )


class LinkQueueNode{
    public $data;
    public $next;
}

class LinkQueue{
    public $first; // 队头指针
    public $rear; // 队尾指针
}

function InitLinkQueue(){
    $node = new LinkQueueNode();
    $node->next = NULL;
    $queue = new LinkQueue();
    $queue->first = $node;
    $queue->rear = $node;
    return $queue;
}

function EnLinkQueue(LinkQueue &$queue, $e){
    $node = new LinkQueueNode();
    $node->data = $e;
    $node->next = NULL;

    $queue->rear->next = $node;
    $queue->rear = $node;
}

function DeLinkQueue(LinkQueue &$queue){
    if($queue->front == $queue->rear){
        return false;
    }

    $node = $queue->first->next;
    $v = $node->data;

    $queue->first->next = $node->next;
    if($queue->rear == $node){
        $queue->rear = $queue->first;
    }

    return $v;
}

$q = InitLinkQueue();
EnLinkQueue($q, 'A');
EnLinkQueue($q, 'B');
EnLinkQueue($q, 'C');
EnLinkQueue($q, 'D');
EnLinkQueue($q, 'E');

print_r($q);
// LinkQueue Object
// (
//     [first] => LinkQueueNode Object
//         (
//             [data] => 
//             [next] => LinkQueueNode Object
//                 (
//                     [data] => A
//                     [next] => LinkQueueNode Object
//                         (
//                             [data] => B
//                             [next] => LinkQueueNode Object
//                                 (
//                                     [data] => C
//                                     [next] => LinkQueueNode Object
//                                         (
//                                             [data] => D
//                                             [next] => LinkQueueNode Object
//                                                 (
//                                                     [data] => E
//                                                     [next] => 
//                                                 )

//                                         )

//                                 )

//                         )

//                 )

//         )

//     [rear] => LinkQueueNode Object
//         (
//             [data] => E
//             [next] => 
//         )

// )

echo DeLinkQueue($q), PHP_EOL; // A
echo DeLinkQueue($q), PHP_EOL; // B

EnLinkQueue($q, 'F');
print_r($q);
// LinkQueue Object
// (
//     [first] => LinkQueueNode Object
//         (
//             [data] => 
//             [next] => LinkQueueNode Object
//                 (
//                     [data] => C
//                     [next] => LinkQueueNode Object
//                         (
//                             [data] => D
//                             [next] => LinkQueueNode Object
//                                 (
//                                     [data] => E
//                                     [next] => LinkQueueNode Object
//                                         (
//                                             [data] => F
//                                             [next] => 
//                                         )

//                                 )

//                         )

//                 )

//         )

//     [rear] => LinkQueueNode Object
//         (
//             [data] => F
//             [next] => 
//         )

// )

$sqQueueList = [];

array_push($sqQueueList, 'a');
array_push($sqQueueList, 'b');
array_push($sqQueueList, 'c');

print_r($sqQueueList);
// Array
// (
//     [0] => a
//     [1] => b
//     [2] => c
// )

array_shift($sqQueueList);
print_r($sqQueueList);
// Array
// (
//     [0] => b
//     [1] => c
// )

unset($sqQueueList[0]);
print_r($sqQueueList);
// Array
// (
//     [1] => c
// )