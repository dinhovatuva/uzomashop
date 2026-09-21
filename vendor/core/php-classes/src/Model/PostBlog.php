<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class PostBlog extends Model{
	protected $fields = array('num', 'numblog','content','img','state', 'date', 'user');
	
	public static function listAll($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_blog_post WHERE state=1 AND numblog=:numblog ORDER BY num ASC",array(':numblog'=>$num));
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_blog_post WHERE state='1' AND num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_blog_post (numblog,content,user) VALUES (:numblog,:content,:user)",
			array(
			':numblog'=>$this->getValue('numblog'),
			':content'=>$this->getValue('content'),
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
			$results = $db->query("UPDATE tb_blog_post SET numblog= :numblog, user= :user, img=:img, content= :content WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':numblog'=>$this->getValue('numblog'),
			':content'=>$this->getValue('content'),
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
			$db->query("UPDATE tb_blog_post SET img=:img WHERE num=:num",
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
			$db->query("DELETE FROM tb_blog_post WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
}

 ?>