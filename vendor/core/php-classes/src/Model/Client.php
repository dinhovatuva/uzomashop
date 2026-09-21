<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class Client extends Model{
	protected $fields = array('num', 'name','img','note','state', 'date', 'user');
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_partner WHERE state='1' ORDER BY name ASC");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_partner WHERE state='1' AND num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_partner (name,note,user) VALUES (:name,:note,:user)",
			array(
			':name'=>$this->getValue('name'),
			':note'=>$this->getValue('note'),
			':user'=>$this->getValue('user')
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
			$results = $db->query("UPDATE tb_partner SET name= :name, user= :user, img=:img, note= :note WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':name'=>$this->getValue('name'),
			':note'=>$this->getValue('note'),
			':img'=>$this->getValue('img'),
			':user'=>$this->getValue('user')
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
			$db->query("UPDATE tb_partner SET img=:img WHERE num=:num",
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
			$db->query("DELETE FROM tb_partner WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
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
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_partner WHERE state=1 LIMIT $start, $itemsPerPage");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_partner WHERE name LIKE :search AND state=1 LIMIT $start, $itemsPerPage", array(':search'=>'%'.$search.'%'));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage));
	}
}

 ?>