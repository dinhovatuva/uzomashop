<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class Cart extends Model{
	
	protected $fields = array('num','description','date_begin','date_end','customer','global_discount','global_value','hash','location','state');
	protected $values = array();
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_cart WHERE state=1 ORDER BY num ASC");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_cart WHERE state=1 AND num =:num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function add($customer=0){
		if(isset($_SESSION['Customer'])) $customer = $_SESSION['Customer']['num'];//usou-se o num usuario para comprar
		try
		{	
			

			$db = new Sql();
			$num = $db->query("INSERT INTO tb_cart (customer,description) VALUES (:customer,:description)",array(':customer'=>$customer,'description'=>'Encomenda de produto'));
			
		    $_SESSION['Cart']['num'] = $num;
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
			$results = $db->query("UPDATE tb_cart SET description=:description, date_begin=:date_begin, date_end=:date_end,hash=:hash, customer=:customer, global_value=:global_value,state='3' WHERE num=:num", 
			array(
			':num'=>$this->getValue('num'),
			':description'=>$this->getValue('description'),
			':date_begin'=>$this->getValue('date_begin'),
			':customer'=>$this->getValue('customer'),
			':date_end'=>$this->getValue('date_end'),
			':hash'=>$this->getValue('hash'),
			//':desconto_global'=>$this->getValue('desconto_global'),
			':global_value'=>$this->getValue('global_value')
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
			$db->query("DELETE FROM tbcart WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
}

 ?>