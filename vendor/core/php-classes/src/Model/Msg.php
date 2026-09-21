<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class Msg extends Model{
	protected $fields = array('num','name','nickname','email','tel', 'subject','note','state','date');
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_msg WHERE state='1' ORDER BY num DESC");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_msg WHERE state='1' AND num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_msg (name,subject,email,tel,note) VALUES (:name,:subject,:email,:tel,:note)",
			array(
			':name'=>$this->getValue('name'),
			':subject'=>$this->getValue('subject'),
			':email'=>$this->getValue('email'),
			':note'=>$this->getValue('note'),
			':tel'=>$this->getValue('tel')
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
			$results = $db->query("UPDATE tb_msg SET name= :name, nickname= :nickname, subject=:subject email= :email, tel=:tel, note=:note WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':name'=>$this->getValue('name'),
			':nickname'=>$this->getValue('nickname'),
			':subject'=>$this->getValue('subject'),
			':email'=>$this->getValue('email'),
			':note'=>$this->getValue('note'),
			':tel'=>$this->getValue('tel')
                ));
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function delete(){
		try
		{
			$db = new Sql();
			$db->query("DELETE FROM tb_msg WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
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
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_msg WHERE state=1 LIMIT $start, $itemsPerPage");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_msg WHERE (name LIKE :search OR msg LIKE :search)  AND state=1 LIMIT $start, $itemsPerPage", array(':search'=>'%'.$search.'%'));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage));
	}
}

 ?>