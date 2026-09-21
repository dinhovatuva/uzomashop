<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class ProductFeature extends Model{
	protected $fields = array('num', 'product', 'type','feature');
	
	public static function listAll($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_product_feature WHERE product=:product ORDER BY num ASC",array('product'=>$num));
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_product_feature WHERE num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_product_feature (product,type,feature) VALUES (:product, :type, :feature)",
			array(':product'=>$this->getValue('product'),':type'=>$this->getValue('type'),':feature'=>$this->getValue('feature')));
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
			$db->query("DELETE FROM tb_product_feature WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
}

 ?>