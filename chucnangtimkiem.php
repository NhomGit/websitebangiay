 <?php
	if(isset($_GET["proname"]))
	{	
		$v=$_GET["proname"];
		$tk=$shoes->search($v);
		//$sql="select * from tbproduct where PRONAME like '%$v%'";
		//$tk=$db->selectQuery($sql);
		
		//if($n>0)
	
		if(count($tk)>0)
		{
			foreach($tk as $value)

			{							
			$id=$value["PRODUCTID"];
	?>
			<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="<?php echo $value["IMAGE"] ?>" alt="" width="70" height="230" />
							<h2><?php echo number_format($value["PRICE"]) ?></h2>
							<p><?php echo $value["PRONAME"] ?></p>
							<a href="index.php?mod=cart&id=<?php echo $id;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> <a href="index.php?proname=<?php echo $name;?>&id=<?php echo $id;?>" class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Chi tiết</a>
						</div>
					</div>	
				</div>
			</div>
<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="<?php echo $value["IMAGE"] ?>" alt="" width="70" height="230" />
							<h2><?php echo number_format($value["PRICE"]) ?></h2>
							<p><?php echo $value["PRONAME"] ?></p>
							<a href="index.php?mod=cart&id=<?php echo $id;?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> <a href="index.php?proname=<?php echo $name;?>&id=<?php echo $id;?>" class="btn btn-default add-to-cart"><i class="fa fa-info"></i>Chi tiết</a>
						</div>
					</div>	
				</div>
			</div>
		<?php }
		}
	}?>