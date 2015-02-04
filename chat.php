<?php
 session_start(); 
 $uid=$_SESSION['UID'];
 $msg=$_REQUEST['msg'];
 
 $conn = new COM("ADODB.Connection") or die("ADODB Oops!");
 $conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=path/..//");
  $time = date('m/d/Y h:i:s a', time());
  $sql="select count(*) as max from tbl";
  $rs=$conn->Execute($sql);
   $max=$rs->Fields['max']->Value;
   $max=$max+1;
  
  $sql="insert into tbl values (".$max.",'".$uid."','".$msg."','".$time."')";
  $conn->Execute($sql);
  $sql="select count(*) as count from tbl";
  $rs=$conn->Execute($sql);
  $count=$rs->Fields['count']->Value;

  $sql="select uname,chat,time from tbl ORDER BY sno DESC";
  $rs=$conn->Execute($sql);
  $x=0;
  echo "<center><table><tr><td>Name</td><td>Message</td><td>Time</td></tr>";

  while(!$rs->EOF)
  {
   $x=$x+1;
   $uname=$rs->Fields['uname']->Value;
   $chat=$rs->Fields['chat']->Value;
   $time=$rs->Fields['time']->Value;
   $rs->MoveNext();
   //echo $uname.",".$chat.",".$time.":";
    echo "<tr><td>".$uname."</td><td>".$chat."</td><td>".$time."</td><tr>";   
  }
   echo "</table></center>";
 
?>
