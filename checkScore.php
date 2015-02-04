<?php

try{
 session_start(); 
 //echo "hello";
 $uid=$_SESSION['UID'];
 //echo "uid=".$uid."<br>";
 
 $conn = new COM("ADODB.Connection") or die("ADODB Oops!");
 $conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=path/..//");
 

 // echo $uid;
  
  $sql="select lvl from tbl where FName='$uid'";
  $rs = $conn->Execute($sql);
  $level=$rs->Fields['lvl']->Value;
  echo "level=". $level;
  
 
   
  $ans=$_REQUEST['ans1']; 
  $levelans=$level+1;
  $sql="select Answer1 from tbl where levelno='$levelans'";
  $rs = $conn->Execute($sql);
    $ans1=$rs->Fields['Answer1']->Value;

	
	
	
$ans = str_replace(' ','',$ans);
//$ans1 = preg_replace('/( *)/', '', $ans1);
$ans=strtolower($ans);
	
	
	
	
	
	if($ans==$ans1)
	{	echo "true";
		$level=$level+1;
		$time = date('m/d/Y h:i:s a', time());
		echo $time;
		$sql="update tblScore set lvl='".$level."',tm='".$time."' where Fname='".$_SESSION['UID']."'";
		$rs = $conn->Execute($sql);
		$level=$level+1;		
		$sql="select l_name from Levelname where l_no=".$level."";
        $rs = $conn->Execute($sql);

        $lname=$rs->Fields['l_name']->Value;
  //echo $lname;

        $leveln=$lname.".html";
 		 echo $leveln;
    header("Location: ".$leveln."");		
	}
	else
	{	
	
	
	$sql="select lvl from tbl where FName='$uid'";
  $rs = $conn->Execute($sql);
  $level=$rs->Fields['lvl']->Value;
  echo $level;
  $level=$level+1;
  $sql="select l_name from Level where l_no=".$level."";
        $rs = $conn->Execute($sql);


        $lname=$rs->Fields['l_name']->Value;
  //echo $lname;


        $lnamenew=$lname.".html";
 		 echo $lnamenew;
		  header("Location: ".$lnamenew."");
  //  header("Location: ".$leveln."");
  
  		
	
	
		
	  /* $level=$level+1;
		$sql="select l_name from Levelname where l_no=".$level."";
        $rs = $conn->Execute($sql);

        $lname=$rs->Fields['l_name']->Value;
  //echo $lname;

        $level=$lname.".htm";
  //echo $level;
        header("Location: ".$level."");
		*/
		
	}
}
	catch(Exception $e)
{
	header("Location: invalid.html");
}

?>
