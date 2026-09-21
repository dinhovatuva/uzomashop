<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class ContactCompany extends Model{
	protected $fields = array('num', 'description','contact','state');
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_company_contact WHERE state='1' ORDER BY num ASC");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_company_contact WHERE num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_company_contact (description,contact) VALUES (:description,:contact)",
			array(
			':description'=>$this->getValue('description'),
			':contact'=>$this->getValue('contact')
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
			$results = $db->query("UPDATE tb_company_contact SET description= :description, contact= :contact WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':description'=>$this->getValue('description'),
			':contact'=>$this->getValue('contact')
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
			$db->query("DELETE FROM tb_company_contact WHERE num= :num",array(':num'=>$this->getValue('num')));	
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
}

 ?>