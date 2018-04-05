<?php
class Order {
   
   //function __construct($_user,$_price){
      //$this->user = $_user;
	  //$this->price = $_price;
   //}
   
   function add_(){
	  $my_db = new MySql();
	  if(!$my_db->connect_()) return 0;
	  if(empty($_POST["user"]) || empty($_POST["price"])) return 0;
	  $order = '00'.rand(1000,10000);
      //$sql = "INSERT INTO ".$my_db->sql_base.".orders SET user='".$_POST["user"]."',order_name='".$order."',price='".$_POST["price"]."',buy_date=NOW(),create_date=NOW(),state=".$_POST["state"];
	  $sql = "CALL ".$my_db->sql_base.".add_order('".$_POST["user"]."','".$order."','".$_POST["price"]."',".$_POST["state"].")";
      //@file_put_contents("log.log",date("Y-m-d H:i:s")."\n".$sql."\n",FILE_APPEND);
	  if(!$query = $my_db->sql_query($sql)) return 0;
	  $my_db->sql_close();
	  return 1;
   }
   
   function delete_(){
	  $my_db = new MySql();
	  if(!$my_db->connect_()) return 0;
      //$sql = "DELETE FROM ".$my_db->sql_base.".orders WHERE id=".$_POST["id"];
	  $sql = "CALL ".$my_db->sql_base.".delete_order(".$_POST["id"].")";
	  if(!$query = $my_db->sql_query($sql)) return 0;
	  $my_db->sql_close();
	  return 1;
   }
   
   function payment_(){
	  $my_db = new MySql();
	  if(!$my_db->connect_()) return 0;
      //$sql = "UPDATE ".$my_db->sql_base.".orders SET state=2 WHERE id=".$_POST["id"];
	  $sql = "CALL ".$my_db->sql_base.".payment_order(".$_POST["id"].")";
	  if(!$query = $my_db->sql_query($sql)) return 0;
	  $my_db->sql_close();
	  return 1;
   }
   
   function get_orders(){
	  $my_db = new MySql();
	  if(!$my_db->connect_()) return -1;
	  $mass = array();
	  $sql = "SELECT * FROM ".$my_db->sql_base.".orders ORDER BY id";
	  if(!$query = $my_db->sql_query($sql)) return -1;
	  while($row = $my_db->sql_fetch_assoc($query)){
	     $mass[]=$row;
	  }
	  $my_db->sql_close();
	  return $mass;
   }
}

?>
