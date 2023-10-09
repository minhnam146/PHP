<?php
	session_start() ;
	include("lib_db.php");
	$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : '';
	$qsessionname = "___Q___";
	if (!isset($_REQUEST["q"])){
		$q = isset($_SESSION[$qsessionname]) ? $_SESSION[$qsessionname] : '';
	}else{
		$_SESSION[$qsessionname] = $q;
	}
	$cond = "";
	$searchfields = array("","");
	if ($q){
		$sq = sql_str($q);
		$cond = "where ";
		$cond .= " title like '%{$sq}%' ";
		$cond .= " or description like '%{$sq}%' ";
	}
	
	$p = isset($_REQUEST["p"]) ? $_REQUEST["p"] * 1 : 0;
	if ($p < 1) $p = 1;
	$nop = 5;
	$offset = $nop * ($p -1);	
	$sqlcount = "select count(*) as c from content {$cond}";	
	$count = select_one($sqlcount);	
	$total = $count['c'];
	//print_r($count);exit();	
	$num = ceil($total / $nop);
		
	//print_r($_SESSION);
	$sql = "select * from content {$cond} order by id limit  {$nop} offset {$offset} ";
	//echo $sql;exit();
	//thuc thi cau lenh sql
	$result = select_list($sql);
    //print_r($result);exit();
	
	$sql = "select *from theloai";	
	$rs = select_list($sql);	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Sports News</title>
	<meta http-equiv="Content-Type" content="text/shtml; charset=utf-8" />
	<link rel="icon" href="images/logo1.png" type="image/png" />
	<link type="text/css" href="Demo.css" rel="stylesheet" media="screen"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<script>
		$(window).scroll(function () {
			if ($(window).scrollTop() >= 10) {
				$('.button_scroll2top').show();
			} else {
				$('.button_scroll2top').hide();
			}
		});

		function page_scroll2top() {
			$('html,body').animate({
				scrollTop: 0
			}, 'fast');
		}
	</script>
</head>	
<body>
	<div class ="wrapper1">
		 <div class="wrapper2">
			 <div class="header space-bottom">
				 <div class="header-menu">
					 <a class="header-menu-logo" href="Demo.php">
						 <img src="images/logo.jpg" />
					 </a>
					 <ul> 
					 <li>
						 <a href="Demo.php">Home</a>
					 </li>
					 
					 <?php
						foreach($rs as $cat){
					 ?>
					 <li>
						 <a href="Theloai.php?idcat=<?php echo $cat["ID"] ?>">
							 <?php echo $cat["Name"]; ?>
						 </a>
					 </li>
					 <?php
					 }
					 ?>
					 </ul>
					 <a class="login" href="Login.php">
					    <img src="images/login.jpg" />
					 </a>
					 <form method="GET" action="Search.php">
						 <input name="q" value="<?php echo $q ?>"/>
						 <button>Search</button>
					 </form>
				</div> <!-- end header-menu-->
			</div><!--end header-->
			<div class="clear-both"></div>
			<div class="content">
				<h1>Tìm kiếm:</h1>
				<div class="content5 space-bottom">
				    <div class="space-top"></div>
					<?php 
						 foreach($result as $news){
					 ?>
					<div class="content11 space-bottom1">
						 <div class="content111">
							 <a href="Cuthe.php?id=<?php echo $news["ID"] ?>" class="thumb">
								 <img src="<?php echo $news["img"];?>">
							 </a>
							 <div class="content111-description">
								 <a href="Cuthe.php?id=<?php echo $news["ID"] ?>">
									 <?php echo $news["title"];?>
								 </a>
								<p class="content111-de"> 
									<?php echo $news["description"];?> 
								</p>
								 <p>
									<?php echo $news["thoigiandang"];?>
								 </p>
							 </div>
						 </div>
					</div>
					 <?php
							}
					 ?>
				</div>
				 <div class="clear-both"></div>
				 <div class="pagination">
					 <ul>
						<?php for ($i=1;$i<=$num;$i++) { ?>
							<li>
								 <a href="Search.php?q=<?php echo $q ?>&p=<?php echo $i ?>"><?php echo $i ?></a>
							</li>
						<?php } ?>
					 </ul>	
				 </div>
			</div> <!--end content-->
			 <div class="footer">
				 <div class="footer1">
					 <div class="footer11">
						 <div class="footer111">
							 <a class="footer111-logo" href="Demo.php">
								 <img src="images/logo1.png" />
							 </a>
						 </div>
						 <div class="footer112">
							 <span class="sncpr">&copy; Sports News</span>
							 <div class="clear-both"></div>
							 <p> SPORTS NEWS</p>
						 </div>
					</div>	 
					<div class="footer12">
						 <div class="footer121">
							 <b>LIÊN HỆ:</b>
							 <p>Điện thoại: 02338536114</p>
							 <p>Email: info@sport24h.com.vn</p>
							 <p>Người chịu trách nhiệm nội dung: Nguyễn Minh Nam<p>
							 <p>Điện thoại: 0869612104</p>
							 <p>Email: nguyentim146@gmail.com</p>
						 </div>
						 <div class="footer122">					 					
							 <b>CƠ QUAN CHỦ QUẢN:
									 CÔNG TY CỔ PHẦN THỂ THAO 24H</b>
							 <p>79 Hàng Trống, Q. Hoàn Kiếm, TP. Hà Nội.</p>
							 <p>Văn phòng giao dịch: 269 Thụy Khuê, Q. Tây Hồ, Hà Nội </p>
							 <p>Giấy phép số: 236/GP-BTTTT do Bộ Thông tin và Truyền thông Hà Nội cấp ngày 10/05/2016.</p>
						 </div>
					</div>	 
				 </div>
			 </div> <!--end footer-->
		</div>
	</div>
</body>
</html>