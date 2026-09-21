<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class Product extends Model{
	protected $fields = array('num','description', 'price', 'img', 'note','state','category','date','user','obs','descategory','un','discount','clik','views','stars');
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_product WHERE state='1' ORDER BY description ASC");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT *, a.num as num, a.category as category, a.user as user, b.category as descategory,a.img as img FROM tb_product a INNER JOIN tb_product_category b ON a.category=b.num WHERE a.state=1 AND a.num=:num ORDER BY a.description ASC",
		array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_product (description,price,un,discount,note,category,user,stars) VALUES (:description,:price,:un,:discount,:note,:category,:user,:stars)",
			array(
			':description'=>$this->getValue('description'),
			':price'=>$this->getValue('price'),
			':un'=>$this->getValue('un'),
			':discount'=>$this->getValue('discount'),
			':note'=>$this->getValue('note'),
			':user'=>$this->getValue('user'),
			':category'=>$this->getValue('category'),
			':stars'=>$this->getValue('stars')
			//':obs'=>$this->getValue('obs')
                ));
		
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function update(){
		try
		{
			$db = new Sql();
			$results = $db->query("UPDATE tb_product SET description= :description, price= :price,un=:un, discount=:discount, note= :note, user= :user, category= :category,stars=:stars WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':description'=>$this->getValue('description'),
			':price'=>$this->getValue('price'),
			':un'=>$this->getValue('un'),
			':discount'=>$this->getValue('discount'),
			':note'=>$this->getValue('note'),
			':user'=>$this->getValue('user'),
			':category'=>$this->getValue('category'),
			':stars'=>$this->getValue('stars')
		  //':obs'=>$this->getValue('obs')
                ));
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function updateImg($img){
		try
		{
			$db = new Sql();	
			$db->query("UPDATE tb_product SET img=:img WHERE num=:num",
				array(':num'=>$this->getValue('num'),':img'=>$img));
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function delete(){
		try
		{
			$db = new Sql();
			$db->query("UPDATE tb_product SET state=0 WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	 public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *, a.num as num, a.user as user,a.img as img, b.category as descategory FROM tb_product a INNER JOIN tb_product_category b ON a.category=b.num WHERE a.state=1 ORDER BY a.stars DESC LIMIT $start, $itemsPerPage");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *, a.num as num, a.user as user,a.img as img, b.category as descategory FROM tb_product a INNER JOIN tb_product_category b ON a.category=b.num WHERE (lower(a.description) LIKE lower(:search) OR lower(a.category) LIKE lower(:search)) AND a.state=1 ORDER BY a.stars DESC LIMIT $start, $itemsPerPage", array(':search'=>'%'.$search.'%'));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage));
	}
	public static function getPageSearchCategory($category,$page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT *, a.num as num,a.category as category, a.user as user,a.img as img, b.category as descategory FROM tb_product a INNER JOIN tb_product_category b ON a.category=b.num WHERE a.state=1 AND a.category=:CATEGORY ORDER BY a.stars DESC LIMIT $start, $itemsPerPage",
		array(':CATEGORY'=>$category));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	} 
}

 ?>