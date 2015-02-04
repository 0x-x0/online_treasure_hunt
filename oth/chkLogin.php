<?php
  if(isset($_REQUEST['submitted']))
  {
  session_start(); 
   $_SESSION['expiretime'] = time() + 600000000000;
 
  $uname=$_REQUEST['txtuname'];
  $_SESSION['UID']=$uname;
  $pwd=$_REQUEST['txtpwd'];
	//database connection
  $conn = new COM("ADODB.Connection") or die("ADODB Oops!");
  $conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=path/../");
  
  $sql="select count(*) as max from tbl where uname='$uname' and   pwd='$pwd'";
  $rs = $conn->Execute($sql);

  if($rs->Fields['max']->Value >0)
  {
	  $sql="select lvl from tbl where Fname='$uname'";
	  $rs = $conn->Execute($sql);
   	  $level=$rs->Fields['lvl']->Value;
	  if($level==0)
	  {
		  header("Location: ab.html");
	  }
	  else
	  {	  $level=$level+1;
		  $sql="select l_name from Level where l_no=".$level."";
          $rs = $conn->Execute($sql);

          $lname=$rs->Fields['l_name']->Value;
  //echo $lname;
          $level=$lname.".html";
  //echo $level;
    header("Location: ".$level."");
	
    	  
	  }
  }
else
  {
	header("Location: invaliduid.html");
  }
$rs->Close();
$conn->Close();

$rs = null;
$conn = null;
	}
?>
