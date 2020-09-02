<?php

class SqStack
{
    public $data;
    public $top;
}

function InitSqStack()
{
    $stack = new SqStack();
    $stack->data = [];
    $stack->top = -1;
    return $stack;
}

function PushSqStack(SqStack &$stack, $x){
    $stack->top ++;
    $stack->data[$stack->top] = $x;
}

function PopSqStack(SqStack &$stack){
    // 栈空
    if($stack->top == -1){
        return false;
    }

    $v = $stack->data[$stack->top];
    $stack->top--;
    return $v;
}

$stack = InitSqStack();

PushSqStack($stack, 'a');
PushSqStack($stack, 'b');
PushSqStack($stack, 'c');

var_dump($stack);
// object(SqStack)#1 (2) {
//     ["data"]=>
//     array(3) {
//       [0]=>
//       string(1) "a"
//       [1]=>
//       string(1) "b"
//       [2]=>
//       string(1) "c"
//     }
//     ["top"]=>
//     int(2)
//   }

echo PopSqStack($stack), PHP_EOL; // c
echo PopSqStack($stack), PHP_EOL; // b
echo PopSqStack($stack), PHP_EOL; // a

var_dump($stack);
// object(SqStack)#1 (2) {
//     ["data"]=>
//     array(3) {
//       [0]=>
//       string(1) "a"
//       [1]=>
//       string(1) "b"
//       [2]=>
//       string(1) "c"
//     }
//     ["top"]=>
//     int(-1)
//   }

class LinkStack{
    public $data;
    public $next;
}

function InitLinkStack(){
    return null;
}

function PushLinkStack(?LinkStack &$stack, $x){
    $s = new LinkStack();
    $s->data = $x;
    $s->next = $stack;
    $stack = $s;
}

function PopLinkStack(?LinkStack &$stack){
    if($stack == NULL){
        return false;
    }
    $v = $stack->data;
    $stack = $stack->next;
    return $v;
}

$stack = InitLinkStack();

PushLinkStack($stack, 'a');
PushLinkStack($stack, 'b');
PushLinkStack($stack, 'c');

var_dump($stack);
// object(LinkStack)#3 (2) {
//     ["data"]=>
//     string(1) "c"
//     ["next"]=>
//     object(LinkStack)#2 (2) {
//       ["data"]=>
//       string(1) "b"
//       ["next"]=>
//       object(LinkStack)#1 (2) {
//         ["data"]=>
//         string(1) "a"
//         ["next"]=>
//         NULL
//       }
//     }
//   }

echo PopLinkStack($stack), PHP_EOL; // c
echo PopLinkStack($stack), PHP_EOL; // b
echo PopLinkStack($stack), PHP_EOL; // a

var_dump($stack);
// NULL


$sqStackList = [];

array_push($sqStackList, 'a');
array_push($sqStackList, 'b');
array_push($sqStackList, 'c');

print_r($sqStackList);
// Array
// (
//     [0] => a
//     [1] => b
//     [2] => c
// )

array_pop($sqStackList);
print_r($sqStackList);
// Array
// (
//     [0] => a
//     [1] => b
// )

echo count($sqStackList) > 0 ? $sqStackList[count($sqStackList) - 1] : false, PHP_EOL;
// b

array_pop($sqStackList);

echo count($sqStackList) > 0 ? $sqStackList[count($sqStackList) - 1] : false, PHP_EOL;
// c

array_pop($sqStackList);

print_r($sqStackList);
// Array
// (
// )