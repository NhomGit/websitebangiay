<?php
class Donhang extends db
{
	public function add_dh($iduser,$orderdate,$name,$address)
	{
		$sql=("insert into tborder(USERID,ORDERDATE,NAME,ADDRESSDELIVERY) values (:user,:date,:name,:address)");
		$arr=array(":user"=>$iduser,":date"=>$orderdate,":name"=>$name,":address"=>$address);
		return $this->selectQuery($sql,$arr);
	}
	public function get_id()
	{
		$sql=("select orderid from tborder order by orderid ");
		
		return $this->selectQuery($sql);
		
	}
	public function add_ctdh($idsp,$idorder,$quantity,$price,$amout)
	{
		$sql=("insert into tborderdetail(PRODUCTID,ORDERID,QUANTITY,PRICE,AMOUNT) values (:idsp,:idorder,:quantity,:price,:amout) ");
		$arr=array(":idsp"=>$idsp,":idorder"=>$idorder,":quantity"=>$quantity,":price"=>$price,":amout"=>$amout);
		$data= $this->selectQuery($sql,$arr);
	}
	public function sapxep()
	{
		 $sql="select * from tborderdetail order by orderid ASC";
		 return $this->selectQuery($sql);
	}	
}
?>