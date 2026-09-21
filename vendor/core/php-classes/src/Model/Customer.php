<?php 

namespace Core\Model;

use \Core\DB\Sql;
use \Core\Model;

class Customer extends Model{
	protected $fields = array('num','name','email','pass','tel','country','province','city','address','date','status_email','state');
	protected $values = array();
	
    public static function login($login,$password,$page='login')
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_customershop WHERE (tel = :LOGIN OR email= :LOGIN) AND state=1", array(':LOGIN'=>$login));

		if (!empty($results)){  
			$data = $results[0];
			$user1 = new Customer();
        	if(password_verify($password, $data['pass'])){
        		  $user1->setValues($data);
				  $_SESSION['Customer'] = $user1->getvalues();

                  if($page == 'login'){
				  	header('Location:/login');
				  	exit;
				  }
				  if($page == 'cart'){
				  	header('Location:/carrinho');
				  	exit;
				  }
			}else{
				 $_SESSION['retorno'] = "Usuário ou senha errada!";
				 header('Location:/login?errors');
	             exit;
			}
			}else{
				$_SESSION['retorno'] = "Usuário ou senha errada!";
				header('Location:/login?erroru');
	            exit;
			}	
	}
	public static function logout($perfil)
	{
		unset($_SESSION['Customer']);
	    header('Location: /login');
		exit;
	}
	public static function verifyLogin($accao='0')
	{
		   if(empty($_SESSION['Customer'])){
			   	if($accao == 'finalizar'){
			   		$_SESSION['retorno'] = "Faça o login antes de finalizar a encomenda!";
					header('Location: /login?page=encomenda');
					exit;
				}else{
				$_SESSION['retorno'] = "Tentou aceder uma área restrita para usuários, faça o login antes por favor!";
				header('Location: /login');
				exit;
			}
		}
	
	}
    
	public static function listAll()
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_customershop WHERE num=1");
		return $results;
	}
	public function searchById($num)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_customershop WHERE num = :num",array(':num'=>$num));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function searchByIdsimple($id)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_customershop WHERE tel = :num AND state <> 0", array(':num'=>$id));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			$db = new Sql();
			$db->query("INSERT INTO tb_customershop (name,email,pass,tel) VALUES (:name,:email,:pass,:tel)",
			array(
			':name'=>$this->getValue('name'),
			':email'=>$this->getValue('email'),
			':pass'=>$this->getValue('pass'),
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
			$results = $db->query("UPDATE tb_customershop SET name=:name,email=:email,pass=:pass,tel=:tel,country=:country,province=:province,city=:city,address=:address, status_email=:status_email WHERE num= :num", 
			array(
			':num'=>$this->getValue('num'),
			':name'=>$this->getValue('name'),
			':email'=>$this->getValue('email'),
			':pass'=>$this->getValue('pass'),
			':tel'=>$this->getValue('tel'),
			':country'=>$this->getValue('country'),
			':province'=>$this->getValue('province'),
			':city'=>$this->getValue('city'),
			':address'=>$this->getValue('address'),
			':status_email'=>$this->getValue('status_email')
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
			$db = new Sql2();	
			$db->query("UPDATE tb_customershop SET img=:img WHERE num=:num",
				array(':num'=>$this->getValue('num'),':img'=>$img));
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function disableAccount(){
		try
		{
			$db = new Sql();
				
			$db->query("UPDATE tb_customershop SET state=:state WHERE num=:num2",
				array(':num2'=>$this->getValue('num2'),':state'=>0));
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function changePassword($user, $oldpassword, $newpassword)
	{
		$db = new Sql();
		$results = $db->select("SELECT * FROM tb_customershop WHERE tel = :LOGIN", array(':LOGIN'=>$user));
		if (!empty($results)){
		  
			$data = $results[0];
        	if(password_verify($oldpassword, $data['pass'])){
				$this->setValues($data);
				$newpassword = password_hash($newpassword, PASSWORD_DEFAULT, array("cost"=>12));
				$this->setValue('pass',$newpassword);
				try
				{
					$results = $db->query("UPDATE tb_customershop SET pass=:password WHERE num= :num", 
					array(':num'=>$this->getValue('num'),':password'=>$this->getValue('pass')));
					header('Location:/login');
	                exit;
				}catch(Exception $e){
					echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
					header('Location:/usuario/senha?error');
	                exit;
				}
			}else{
			      header('Location:/usuario/senha?error');
	              exit;   
			}
			}else{
				  header('Location:/usuario/senha?error');
	               exit; 
			}	
	}
	public static function recoverPasswordStep2($user, $password)
	{
		
		$db = new Sql();
		$results = $db->select("SELECT * FROM tbrecuperacao_senha WHERE usuario = :LOGIN ORDER BY num DESC LIMIT 1", array(':LOGIN'=>$user));
		if (!empty($results))
		{
		  
			$data = $results[0];
        	if(password_verify($password, $data['pass'])){
				$newpassword = password_hash('12345', PASSWORD_DEFAULT, array("cost"=>12));
				try
				{
					$db->query("UPDATE tbusuario SET senha=:password WHERE usuario= :usuario", 
					array(':usuario'=>$user,':password'=>$newpassword));
					$_SESSION['retorno'] = "A sua senha foi redefinida para 12345!";
					if($perfil=='Cliente'){
						$db->query("UPDATE tbcliente SET state=1 WHERE usuario= :usuario", 
					array(':usuario'=>$user));
						header('Location:/login');
					}
					if($perfil=='Vendedor'){
						$db->query("UPDATE tbvendedor SET state=1 WHERE usuario= :usuario", 
					array(':usuario'=>$user));
						header('Location:/vendedor');
					}
	                exit;
				}catch(Exception $e){
					$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
					if($perfil=='Cliente') header('Location:/login?error');
					if($perfil=='Vendedor') header('Location:/vendedor?error');
	                exit;
				}
			}else{
				  $_SESSION['retorno'] = "O código que inseriu está incorreto!";
			      if($perfil=='Cliente') header('Location:/login?error');
				  if($perfil=='Vendedor') header('Location:/vendedor?error');
	              exit;   
			}
			

		}else{
			if($perfil=='Cliente') header('Location:/login?error');
		    if($perfil=='Vendedor') header('Location:/vendedor?error');
	        exit; 
		}	
	}
	public static function recoverPasswordStep1($usuario,$senha){
		try
		{
                $db = new Sql2();
			    $db->query("INSERT INTO tbrecuperacao_senha (usuario,senha) values(:usuario,:senha)",
				array(':usuario'=>$usuario,':senha'=>$senha));
					}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public static function confirmTelephoneStep2($user, $password,$perfil){
		$db = new Sql();
		$results = $db->select("SELECT * FROM tbconfirmar_telefone WHERE usuario = :LOGIN ORDER BY num DESC LIMIT 1", array(':LOGIN'=>$user));
		if (!empty($results))
		{
		  
			$data = $results[0];
        	if(password_verify($password, $data['pass'])){
				try
				{
					$db->query("UPDATE tb_customershop SET state=1 WHERE usuario= :usuario", 
					array(':usuario'=>$user));
					$_SESSION['retorno'] = "Confirmação Concluída!";
				}catch(Exception $e){
					$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
					if($perfil=='Cliente') header('Location:/login?error');
					if($perfil=='Vendedor') header('Location:/vendedor?error');
	                exit;
				}
			}else{
				  $_SESSION['retorno'] = "O código que inseriu está incorreto!";
			      if($perfil=='Cliente') header('Location:/login?error');
				  if($perfil=='Vendedor') header('Location:/vendedor?error');
	              exit;   
			}
			

		}else{
			if($perfil=='Cliente') header('Location:/login?error');
		    if($perfil=='Vendedor') header('Location:/vendedor?error');
	        exit; 
		}
	}
	public static function confirmTelephoneStep1($user){
		try
		{
				$senharecuperacao = random_int(10000, 1000000);
                $senharecuperacaocifrada = password_hash($senharecuperacao, PASSWORD_DEFAULT, array("cost"=>12));
                $db = new Sql();
			    $db->query("INSERT INTO tbconfirmar_telefone (usuario,senha) values(:usuario,:senha)",
				array(':usuario'=>$user,':senha'=>$senharecuperacaocifrada));
				//envio da mensagem
				Sms::send($user,'Kikolo Online o código para confirmar o seu número de telefone é: '.$senharecuperacao);
                $retorno = $_SESSION['retorno']='Enviamos uma sms para confirmar o seu número de telefone.';
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
			$db->query("DELETE FROM tb_customershop WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
    public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *,b.num as num2,a.num as num FROM tb_customershop WHERE state=1 LIMIT $start, $itemsPerPage");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *,b.num as num2,a.num as num FROM tb_customershop WHERE a.nome LIKE :search AND state=1 LIMIT $start, $itemsPerPage", array(':search'=>'%'.$search.'%'));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage));
	} 

}