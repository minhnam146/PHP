<?php
	include("lib_db.php");
	session_start();
	
	$tk = isset($_REQUEST["tk"]) ? $_REQUEST["tk"] : "";
	$mk = isset($_REQUEST["mk"]) ? $_REQUEST["mk"] : "";
	
	$sql = "select * from account where tk = '$tk'";
	//print_r($sql);exit();
	$account = select_one($sql);
	//print_r($account);
	
	$checkLogin = false;
	if(!$account){
		
	}else if($account["mk"] != $mk){
		
	}else{
		$checkLogin = true;
	}
	
	if($checkLogin){
		$_SESSION["id"] = $account["id"];
		header("Location:Quantri.php");
	}else{
		header("Location:Login.php");
	}

?>