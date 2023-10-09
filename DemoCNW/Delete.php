<?php
	session_start() ;
	//print_r($_SESSION);
	include("lib_db.php");
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
	if ($id<  1) return ;
	//tao sql
	$sql = "select * from content 
	where id={$id}";
	//echo $sql;exit();
	//thuc thi cau lenh sql
	$result = select_one($sql);
	//print_r($result);exit();
	if (!$result) return ;
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
					 <form method="GET" action="Search.php">
						 <input name="q" value=""/>
						 <button>Search</button>
					 </form>
				</div> <!-- end header-menu-->
			</div><!--end header-->
			<div class="clear-both"></div>
			<div class="content">
				<h1>Xóa tin bài</h1>
					<br/>
					<form class="form" action="Delete_exec.php" method="post">
						<input type="hidden" name="id" value="<?php echo $result["ID"]?>"/>
						<label>Category:</label> 
						<div class="clear-both"></div>
						<?php echo $result["theloaiID"]?>
						<div class="clear-both"></div>
						<label>Image:</label>
						<div class="clear-both"></div>
						<?php echo $result["img"]?>
						<div class="clear-both"></div>
						<img src="<?php echo $result["img"]?>" width="50%"/>				
						<div class="clear-both"></div>
						<label>Title:</label>
						<div class="clear-both"></div>
						<?php echo $result["title"]?>
						<div class="clear-both"></div>
						<label>Description:</label>
						<div class="clear-both"></div>
						<?php echo $result["description"]?>
						<div class="clear-both"></div>
						<label>Body:</label>
						<div class="clear-both"></div>
						<?php echo $result["body"]?>
						<div class="clear-both"></div>
						<label>Trong nước:</label>
						<div class="clear-both"></div>
						<?php echo $result["Trongnuoc"]?>
						<div class="clear-both"></div>
						<label>Ngoài nước:</label>
						<div class="clear-both"></div>
						<?php echo $result["Ngoainuoc"]?>
						<div class="clear-both"></div>
						<button >OK</button>
					</form>
					<div class="clear-both"></div>
					<ul>
						<li><a href="Add.php">Add</a></li>
						<li><a href="Quantri.php">Quản trị</a></li>
					</ul>
					<br/>
					<br/>
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