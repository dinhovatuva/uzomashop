<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class User extends Model{
	protected $fields = array('num','name','user','password','email','tel','state');
	protected $values = array();
	
	public static function login($login, $password)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_user WHERE user = :LOGIN", array(':LOGIN'=>$login));
		
		if (!empty($results)){
		  
			$data = $results[0];
			$user = new User();
        	if(password_verify($password, $data['password'])){
				$user->setValues($data);
				$_SESSION['user'] = $user->values;
				header('Location:/config');
			}else{
			header('Location: ?error_login=credenciais erradas');
			}
			}else{
				header('Location: ?error_login=credenciais erradas'); 
			}	
	}
	public static function logout()
	{
		unset($_SESSION['user']);
		header('Location:/config/login');
		exit;
	}
	public static function verifyLogin()
	{
		if (!isset($_SESSION['user']) ){	
			header('Location:/config/login');
			exit;
		}
	}
	public static function listAll()
	{
		$db = new Sql();
		return $results = $db->select("SELECT * FROM tb_user ORDER BY num ASC");
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_user WHERE num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_user (name,user,password,email,tel) VALUES (:name,:user,:password,:email,:tel)",
			array(
			':name'=>$this->getValue('name'),
			':user'=>$this->getValue('user'),
			':password'=>$this->getValue('password'),
			':email'=>$this->getValue('email'),
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
			$results = $db->query("UPDATE tb_user SET name= :name, user= :user, password= :password,email= :email, tel= :tel WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':name'=>$this->getValue('name'),
			':user'=>$this->getValue('user'),
			':password'=>$this->getValue('password'),
			':email'=>$this->getValue('email'),
			':tel'=>$this->getValue('tel')
			));
		}
		catch(Exception $e)
		{
			echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function changePassword($user, $oldpassword, $newpassword)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_user WHERE user = :LOGIN", array(':LOGIN'=>$user));
		if (!empty($results)){
		  
			$data = $results[0];
        	if(password_verify($oldpassword, $data['password'])){
				$this->setValues($data);
				$newpassword = password_hash($newpassword, PASSWORD_DEFAULT, array("cost"=>12));
				$this->setValue('password',$newpassword);
				try
				{
						$results = $db->query("UPDATE tb_user SET password= :password WHERE num= :num", 
						array(
						':num'=>$this->getValue('num'),
						':password'=>$this->getValue('password'),
						));
						header('Location:/config/users/change-password');
	                    exit;
				}catch(Exception $e){
					echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
					header('Location:/config/users/change-password?error');
	                exit;
				}
			}else{
			      header('Location:/config/users/change-password?errors');
	              exit;    
			}
			}else{
				  header('Location:/config/users/change-password?erroru');
	              exit; 
			}	
	}
	public function delete(){
		try
		{
			$db = new Sql();
			$db->query("DELETE FROM tb_user WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
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
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_user WHERE state=1 LIMIT $start, $itemsPerPage");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS * FROM tb_user WHERE name LIKE :search AND state=1 LIMIT $start, $itemsPerPage", array(':search'=>'%'.$search.'%'));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage));
	} 
}

 ?>