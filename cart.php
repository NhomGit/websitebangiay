<?php

class cart extends db{
	
	private $_cart;
	private $_num_item =0;
	public function  __construct()
	{
		if(!isset($_SESSION["cart"])) $this->_cart= array();
		else $this->_cart = $_SESSION["cart"];
		$this->_num_item = array_sum($this->_cart);		
	}
	public $amout=0;
	public function getNumItem()
	{
		return $this->_num_item;	
	}
	public function __destruct()
	{
		$_SESSION["cart"] = $this->_cart;	
	}
	
	/*
	Them san pham có mã $id và số lương $quantity vào giỏ hàng
	*/
	public function shoesExist($product_id)
	{
		$sql="select * from tbproduct where PRODUCTID = '$product_id' ";
		$temp = new db();
		$temp->exeQuery($sql);
		if ($temp->getRowCount()==0) return false;
		return true;
	}
	public function add($id, $quantity=1)
	{	
		if ($id=="" || $quantity<1) return;
		if (!$this->shoesExist($id)) return;
		print_r($this->_cart);		
		if (isset($this->_cart[$id]))
			$this->_cart[$id]+=	$quantity;
		else $this->_cart[$id]=	$quantity;	
		$_SESSION["cart"] = $this->_cart;	
		$this->_num_item = array_sum($this->_cart);
		echo "Da them $id - $quantity ";
		echo "<script language=javascript>window.location='index.php?mod=cart';</script>";//Chuyển trình duyệt web tới trang hiển thị cart
	}
	public function remove($id)
	{
		unset($this->_cart[$id]);
		$this->_num_item = array_sum($this->_cart);
		$_SESSION["cart"] = $this->_cart;	
	}
	public function edit1($id, $quantity)
	{
		$this->_cart[$id]	+= $quantity;
		$this->_num_item = array_sum($this->_cart);
		$_SESSION["cart"] = $this->_cart;	
	}
	public function edit2($id, $quantity)
	{
		$this->_cart[$id]	-= $quantity;
		$this->_num_item = array_sum($this->_cart);
		$_SESSION["cart"] = $this->_cart;	
	}
	public function show()
	{
		if(!isset($_SESSION["thongtindangnhap"]))
			echo"<div class='alert alert-warning'>Bạn cần phải <a href='index.php?mod=login'>đăng nhập</a> để vào được giỏ hàng</div>";
		else{
		if (Count($this->_cart)==0) 
		{	echo "Giỏ hàng rỗng";
			return;
		}
		else
		{?>
			<div class="table-responsive cart_info">
            <table class="table table-condensed">
            <thead>
						<tr class="cart_menu">
							<td class="image">Ảnh</td>
							<td class="description">Tên</td>
							<td class="price">Giá</td>
							<td class="quantity">Số Lượng</td>
							<td class="total">Tổng Tiền</td>
							<td></td>
                            <td></td>
                            <td></td>  
						</tr>	
		<?php }
		foreach($this->_cart as $id=>$quantity)
		{
			//truy van lay ten, hinh, gia sp
			$total;
			$amout;
			$giay=new shoes();
			$listpro=$giay->list_pro($id);
			foreach($listpro as $sp)
			{
				$idsp=$sp["PRODUCTID"];	
				$name=$sp["PRONAME"];
				$price=$sp["PRICE"];
				$img=$sp["IMAGE"];
			}?>	
            <?php
				$total=$quantity*$price;
				@$amout+=$total;
				?>		
				<tr>     
				<td><img width='100px' src='<?php echo $img;?>'/></td>
				<td><?php echo $name;?></td>
				<td><?php echo $price;?></td>
				<td><?php echo $quantity;?></td>
				<td><?php echo $total;?></td>
				<td><a href='index.php?mod=cart&id=<?php echo $id;?>&ac=tang' class='btn btn-default add-to-cart'>+</a></td>
				<td><a href='index.php?mod=cart&id=<?php echo $id;?>&ac=rev' class='btn btn-default add-to-cart'>xóa</a></td>
                <?php if($quantity>1)echo"<td><a href='index.php?mod=cart&id=$id&ac=giam' class='btn btn-default add-to-cart'>-</a></td></tr>";
				$listdh[]=array('productid'=>$idsp,'quantity'=>$quantity,'price'=>$price,'total'=>$total);	
		}
		?>	
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Tổng Cộng:</td>
            <td><?php echo $amout;?></td>
            <td></td>
        	<td ><form method="post"><button type="submit" name="dat">ĐẶT MUA</button></form></td>
        </tr>    	
		</thead>
        </table>
        </div>
		<?php
		if(isset($_POST['dat']))
		{?>
     	<form method="post">
        <table  >
        	<tr><td colspan="2" align="center"><h3>Vui lòng điền đầy đủ thông tin</h3></td></tr>
        	<tr><td><b>Họ tên:</b></td><td><input type="text" name="hoten"required pattern="(.){6,70}" title="Phải từ 6 đến 70 ký tự" /></td></tr>
            <tr><td><b>Địa chỉ giao hàng:</b></td><td><input type="text" name="diachi" required pattern="(.){10,70}" title="Phải từ 10 đến 70 ký tự"/></td></tr>
            <tr><td> <input type="hidden" name="userid" value="<?php echo $_SESSION["thongtindangnhap"]["id"];?>"/></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" name="gui" value="GỬI" ></td></tr>
        </table>
        </form>
      			<?php
		}
				$hoten=postIndex("hoten");
				$diachi=postIndex("diachi");
				$date=date(DATE_ATOM);
				$dh=new Donhang();
				
				if(isset($_POST['gui']))
				{
					$iduser=$_SESSION["thongtindangnhap"]["id"];
					$xulydh=$dh->add_dh($iduser,$date,$hoten,$diachi);
					$rows=$dh->get_id();
				
					$idorder=$rows[count($rows)-1]['orderid'];
					
					
					foreach ($listdh as $k=>$v)
					{
						
						$xuly_ctdh=$dh->add_ctdh($v['productid'],$idorder,$v['quantity'],$v['price'],$v['total']);
						
					}
					
				echo "<div align='center' class='alert alert-success alert-dismissable' role='alert'> ĐẶT HÀNG THÀNH CÔNG </div>";
				}
					
				?>
	<?php //}
		$this->setCartInfo($this->getNumItem());
		//Update số lượng item của cart trong header.php. Có thể không sử dụng method này nếu mỗi lần thêm xong, chuyển trang về mod=cart.
		}
	}
	
	function setCartInfo( $quantity=0, $id="cart_sumary")
	{
		echo "<script language=javascript> document.getElementById('$id').innerHTML =$quantity; </script>";
	}

}
	
?>
<?php

function getIndex($index, $value='')
{
	$data = isset($_GET[$index])? $_GET[$index]:$value;
	return $data;
}
$ac= getValue("ac");
$i=0;
$i=$i+1;
if ($ac=="add")
{
	$quantity = getIndex("quantity", 1);
	$id = getIndex("id");
	$cart->add($id, $quantity);
}
if ($ac=="rev")
{
	
	$id = getIndex("id");
	$cart->remove($id);
	echo "<script language='javascript'>window.location='index.php?mod=cart'</script>";
}
if($ac=="tang")
{
	$quantity=getIndex("quantity",1);
	$id=getIndex("id");
	$cart->edit1($id,$quantity);
	echo "<script language='javascript'>window.location='index.php?mod=cart'</script>";
	
}
if($ac=="giam")
{
	$quantity=getIndex("quantity",1);
	$id=getIndex("id");
	$cart->edit2($id,$quantity);
	echo "<script language='javascript'>window.location='index.php?mod=cart'</script>";

}

//Biến $cart được tạo từ trang chủ index.php
$cart->show();