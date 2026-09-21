<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;
use \Core\Model\Cart;
class CartProduct extends Model{
	
	protected $fields = array('num','cart','product','description','price','amount','discount','date_begin','date_end','state');
	protected $values = array();
	
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tbcart_product WHERE state=1 AND cart=:cart ORDER BY num ASC");
		return $results;
	}
	public static function listAllByCart($cart)
	{
		$db = new Sql();
		$results1 = $db->select("SELECT *, (a.amount * a.price) as subtotal, a.num as num, b.description as description_product, a.description as description  FROM tbcart_product a INNER JOIN tb_product b ON a.product = b.num WHERE a.state=1 AND a.cart = :cart ORDER BY a.description ASC",array(':cart'=>$cart));
		
		$results2 = $db->select("SELECT SUM(price*amount) as vtotal FROM tbcart_product WHERE state=1 AND cart=:cart ORDER BY description ASC",array(':cart'=>$cart));
		
		return array($results1,$results2[0]);
	}
	public static function listAllByCartSimple($cart)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tbcart_product WHERE a.state=1 AND a.cart = :cart ORDER BY a.description ASC",array(':cart'=>$cart));
		
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tbcart_product WHERE state=1 AND num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function searchProduct($num)
	{   //Verifica se o produto já está no Carrinho
		$db = new Sql();
		$results = $db->select("SELECT * FROM tbcart_product WHERE state=1 AND product =:num AND cart=:cart",array(':num'=>$num,':cart'=>$_SESSION['Cart']['num']));
		if (empty($results)){
			return 0;
		}else{ return $results[0];}
	}
	public function add(){
		
		if(!isset($_SESSION['Cart']['num'])){
			$encomenda = new Cart();
			$encomenda->add();
		}
		
		try
		{
			$produto = $this->searchProduct($this->getValue('product'));
			if($produto!==0){
				$this->setValue('amount',($produto['amount']+1));
				$this->update();
			}else{
				
			$db = new Sql();
			$db->select("INSERT INTO tbcart_product (cart,product,description,price,amount)VALUES (:cart,:product,:description,:price,:amount)",
			array(
			':cart'=>$_SESSION['Cart']['num'],
			':product'=>$this->getValue('product'),
			':description'=>$this->getValue('description'),
			':price'=>$this->getValue('price'),
			':amount'=>$this->getValue('amount')
                ));
			}
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
			$results = $db->query("UPDATE tbcart_product SET amount=:amount WHERE product=:product AND cart=:cart", 
			array(
			':product'=>$this->getValue('product'),
			':amount'=>$this->getValue('amount'),
			':cart'=>$_SESSION['Cart']['num']
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
			$db->query("UPDATE tbcart_product set state=0 WHERE product= :product AND cart=:cart",array(':product'=>$this->getValue('product'),':cart'=>$_SESSION['Cart']['num']));	
		
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
}

 ?>