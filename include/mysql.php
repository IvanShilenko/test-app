<?php
class MySql{
   var $db = NULL;
   var $sql_base;	
   var $error_mess;	
	 
   function connect_(){
      global $sql_host,$sql_user,$sql_pass,$sql_base;
      if(!$this->db=@mysql_connect($sql_host,$sql_user,$sql_pass,true)) { $this->error_mess='Error connect to MySql'; return 0;}
      $sql="set names utf8";
      if(!$this->sql_query($sql)) return 0;
	  $this->sql_base = $sql_base;
      return $this->db;
   }

   function sql_query($sql){
      if(!$query = @mysql_query($sql, $this->db)) {  $this->error_mess='Sql error: '.$sql.' ('.mysql_error().')'; return 0;}
      return $query;
   }   

   function sql_num_rows($query){
      return mysql_num_rows($query);
   }  
   
   function sql_fetch_row($query){
      return @mysql_fetch_row($query);
   }  
   
   function sql_fetch_assoc($query){
      return @mysql_fetch_assoc($query);
   }
   
   function sql_affected_rows(){
      return @mysql_affected_rows($this->db);
   }
   
   function sql_close(){
      @mysql_close($this->db);
   }  
   
   function error_log($msg){
	  //global $log_dir;
	  //@file_put_contents(dirname(__FILE__)."/../".$log_dir."error.log",$msg."\n",FILE_APPEND);
      return ;
   }
}
?>