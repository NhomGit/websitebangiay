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