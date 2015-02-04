<?php
  if(isset($_REQUEST['submitted']))
  {
  session_start(); 
   $_SESSION['expiretime'] = time() + 600;
 
  $uname=$_REQUEST['txtuname'];
  $_SESSION['UID']=$uname;
  $pwd=$_REQUEST['txtpwd'];
	//database connection
  $conn = new COM("ADODB.Connection") or die("ADODB Oops!");
  $conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=path/..//");
  
  $sql="select count(*) as max from tbl where uname='$uname' and   pwd='$pwd'";
  $rs = $conn->Execute($sql);

  if($rs->Fields['max']->Value >0)
  {
	  $sql="select lvl from tbl where Fname='$uname'";
	  $rs = $conn->Execute($sql);
   	  $level=$rs->Fields['lvl']->Value;
	  $_SESSION['lvl']=$level;
	  if($level==0)
	  {
		  header("Location: wq.htm");
	  }
	  else
	  {	  $level=$level+1;
		  $sql="select l_name from Levelname where l_no=".$level."";
          $rs = $conn->Execute($sql);

          $lname=$rs->Fields['l_name']->Value;
  //echo $lname;
          $level=$lname.".htm";
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
