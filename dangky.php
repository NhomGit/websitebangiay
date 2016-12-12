----Them chuc nnang xu ly -----
<?php xu ly dang nhap ?>
#codecodecode
#codecodecode
#codecodecode
#codecodecode
#codecodecode
#codecodecode
------------------------------
<?php
	$arrmailsql=$kh->get_email();
	$flag=true;
	$error2="";
	$success2="";
	$username=postIndex("txtUser");
	$email=postIndex("txtEmail");
	$pass=postIndex("txtPass");
	$pass2=postIndex("txtPass2");
	$phone=postIndex("txtPhone");
	$address=postIndex("txtAddress");
	$sm=postIndex("dk");
	if(isset($_POST["dk"]))
	{
		if($pass2!=$pass){
				$error2.="Mật khẩu nhập lại không khớp!";
				$flag=false;
			}
		foreach($arrmailsql as $k=>$v)
		{
			if($email==$v['EMAIL'])
			{
				$error2.="Mail đã tồn tại";
				$flag=false;
				break;
			}
		}
			if($flag){
				
				$stm=$kh->xuly_dk($username,$email,$phone,$address,$pass);
				$success2.="Đăng ký thành công";
				//header("Location:index.php");
				}
	}?>
	<?php if($error2!="")
  			echo "<div class='alert alert-danger alert-dismissable' role='alert'> $error2 </div>" 
    ?>
	 <?php if($success2!="")
  			echo "<div class='alert alert-success alert-dismissable' role='alert'> $success2 </div>" 
     ?>