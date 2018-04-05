<?php
require_once dirname($_SERVER['SCRIPT_FILENAME']).'/config.php';
require_once dirname($_SERVER['SCRIPT_FILENAME']).'/base.php';
require_once dirname($_SERVER['SCRIPT_FILENAME']).'/mysql.php';

$method = $_GET['action'];
if(@function_exists($method)) $result = $method();
   else $result = array('status'=>'error','text'=>'error method');

//-------------------------------------------------------------
function add_(){
   $order = new Order();
   if(!$order->add_()) return array('status'=>'error','text'=>'error create new order');
   $result = array('status'=>'success','text'=>'ok');
   return $result;
}

function delete_(){
   $order = new Order();
   if(!$order->delete_()) return array('status'=>'error','text'=>'error delete order');
   $result = array('status'=>'success','text'=>'ok');
   return $result;
}

function payment_(){
   $order = new Order();
   if(!$order->payment_()) return array('status'=>'error','text'=>'error payment order');
   $result = array('status'=>'success','text'=>'ok');
   return $result;
}

function get_orders(){
   $order = new Order();
   if(($orders = $order->get_orders())==-1) return array('status'=>'error','text'=>'error show orders');
   $result = array('status'=>'success','text'=>'ok','orders'=>$orders);
   return $result;
}

exit(@json_encode($result));
?>