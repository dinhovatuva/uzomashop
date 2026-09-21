<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class Company extends Model{
	protected $fields = array('num','name','address','img','mission','vision','state');
	protected $values = array();
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_company WHERE num=1");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_company WHERE num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_company (name,address,img,mission,vision) VALUES (:name,:address,:img,:mission,:vision)",
			array(
			':name'=>$this->getValue('name'),
			':address'=>$this->getValue('address'),
			':img'=>$this->getValue('img'),
			':mission'=>$this->getValue('mission'),
			':vision'=>$this->getValue('vision')
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
			$results = $db->query("UPDATE tb_company SET name= :name, address= :address, img= :img, mission= :mission, vision= :vision WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':name'=>$this->getValue('name'),
			':address'=>$this->getValue('address'),
			':img'=>$this->getValue('img'),
			':mission'=>$this->getValue('mission'),
			':vision'=>$this->getValue('vision')
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
			$db->query("UPDATE tb_company SET img=:img WHERE num=:num",
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
			$db->query("DELETE FROM tb_company WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}

}

 ?>