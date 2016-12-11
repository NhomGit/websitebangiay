//xu ly dang nhap
<?php
//require_once"classes/db.class.php";
//$db=new db();
?>
<?php
$email=postIndex("txtEmail");
$pass=postIndex("txtPass");
$error="";
$success="";
$flag2=true;
if(isset($_POST["dn"]))
{
	if($pass!="" && $email!="")
	{
		//$query="select * from tbuser where EMAIL= :E 
		//and PASSWORD = :P ";
		//$arr = array(":E"=> $email, ":P"=>$pass);
		//$rows=$db->selectQuery($query,$arr);
		$rows=$kh->xuly_dangnhap($email,$pass);
		//if($db->n>0)
		if(count($rows)>0)
		{
			$success.="Đăng nhập thành công";
			if (!isset($_SESSION)) session_start();
			$_SESSION["thongtindangnhap"]= $rows[0];
			$_SESSION["thongtindangnhap"]["id"]=$rows[0]["USERID"];
			$_SESSION["thongtindangnhap"]["email"]=$rows[0]["EMAIL"];
			$_SESSION["thongtindangnhap"]["name"]=$rows[0]["FULLNAME"];
			$_SESSION["thongtindangnhap"]["phone"]=$rows[0]["PHONE"];
			$_SESSION["thongtindangnhap"]["address"]=$rows[0]["ADDRESS"];
			$_SESSION["thongtindangnhap"]["pass"]=$rows[0]["PASSWORD"];
			$_SESSION["thongtindangnhap"]["role"]=$rows[0]["ROLE"];
		}
		else
		{
			$error.="Lỗi nhập tài khoản hoặc mật khẩu";
			$flag2=false;
		}
	}
}
?>
				<?php if(!$flag2)	
  						 echo "<div class='alert alert-danger alert-dismissable' role='alert'> $error </div>" ;
					 else
					  {
						  if($success!="")
						  {
							  if($_SESSION["thongtindangnhap"]["role"]==0)
							  {
  						 		echo "<div class='alert alert-success alert-dismissable' role='alert'> $success </div>";
								echo" <a href='index.php'>Click vào đây để về trang chủ </a>";
							  }
							  else
							  {
							  ?> <script language="javascript" >
							  window.location="index.php/admin";
                              </script>
                             <?php }
						   }
				 	 }
				  	?>


-----------------
<section>
	<div class="container">
			<div class="row">
            <div id="form">
            
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
                        <?php include"xulydangnhap.php";?>
					
					  <form action="index.php?mod=login" id="form1" name="form1" method="POST">
							<input name="txtEmail" type="text" placeholder="Địa chỉ email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Xin điền đầy đủ và đúng quy tắc:
abc@gmail.com">
							<input type="hidden" name="formLogin" value="ok"/>
							<input name="txtPass" type="password" placeholder="Mật khẩu" required pattern="(.){6,15}">
							<button type="submit" name="dn" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>     
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký!</h2>
                        <?php include"xulydangky.php";?>
					  <form action="index.php?mod=login" id="form2" name="form2" method="POST">
							<input name="txtUser" type="text" placeholder="Tên đầy đủ" required pattern="(.){6,70}" title="Phải từ 6 đến 70 ký tự" >
							<input name="txtEmail" type="email" placeholder="Địa chỉ email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Xin điền đầy đủ và đúng quy tắc:
abc@gmail.com">
							<input name="txtPass" type="password" placeholder="Mật khẩu" required pattern="(.){6,15}" title="Phải từ 6 đến 15 ký tự">
							<input name="txtPass2" type="password" placeholder="Nhập lại mật khẩu" required pattern="(.){6,15}" title="Phải từ 6 đến 15 ký tự">
							<input name="txtAddress" type="text" placeholder="Địa chỉ" required pattern="(.){20,100}" title="Phải từ 30 đến 200 ký tự">
							<input name="txtPhone" type="tel" placeholder="Số điện thoại" required pattern="(\d){8,11}" title="Phải từ 8 đến 11 số">
							<button type="submit" name="dk"class="btn btn-default">Đăng ký</button>
                        </form>
					</div><!--/sign up form-->
				</div>	
                </div>
            </div>
		</div>
	</section>	