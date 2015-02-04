<?php
 session_start(); 
 $uid=$_SESSION['UID'];
 $conn = new COM("ADODB.Connection") or die("ADODB Oops!");
 $conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=path/..//");
 $sql="select uname,chat,time from tbl ORDER BY sno DESC";
  $rs=$conn->Execute($sql);
  $x=0;
  echo "<center><table border=1><tr><td>Name</td><td>Message</td><td>Time</td></tr>";

  while(!$rs->EOF)
  {
   $uname=$rs->Fields['uname']->Value;
   $chat=$rs->Fields['chat']->Value;
   $time=$rs->Fields['time']->Value;
   $rs->MoveNext();
   //echo $uname.",".$chat.",".$time.":";
    echo "<tr><td>".$uname."</td><td>".$chat."</td><td>".$time."</td><tr>";   
  }
   echo "</table></center>";
   
   ?>
