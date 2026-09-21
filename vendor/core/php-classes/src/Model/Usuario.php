<?php 

namespace Core\Model;

use \Core\DB\Sql2;
use \Core\Model;
use \Core\Sms;

class Usuario extends Model{
	protected $fields = array('num','usuario','senha','perfil','img','data','state','nome','email','tel','tel2','pais','provincia','cidade','endereco','email','status','categoria','num2','status_email');
	protected $values = array();
	
	public static function login($login,$password,$perfil,$page='login')
	{
		$db = new Sql2();
		if($perfil=='Cliente'){
		$results = $db->select("SELECT *,b.num as num2,a.num as num FROM tbusuario a INNER JOIN tbcliente b ON a.usuario=b.usuario WHERE a.usuario = :LOGIN AND a.state=1", array(':LOGIN'=>$login));
		} if($perfil=='Vendedor'){
		$results = $db->select("SELECT *,b.num as num2,a.num as num FROM tbusuario a INNER JOIN tbvendedor b ON a.usuario=b.usuario WHERE a.usuario = :LOGIN AND a.state=1", array(':LOGIN'=>$login));
		}
		if (!empty($results)){  
			$data = $results[0];
        	if(password_verify($password, $data['senha'])){
				 $user = new Usuario();
				 $user->setValues($data);

				if($user->getValue('perfil')=='Vendedor'){
				  $db->query("UPDATE tbvendedor SET state=1 WHERE usuario= :usuario",
					array(':usuario'=>$login));
				  $_SESSION['Vendedor'] = $user->getvalues();
				  header('Location:/vendedor');
				  exit;
				}elseif($user->getValue('perfil')=='Cliente'){
				  $db->query("UPDATE tbcliente SET state=1 WHERE usuario= :usuario",
					array(':usuario'=>$login));
				  $_SESSION['Cliente'] = $user->getvalues();
                  if($page == 'login'){
				  	header('Location:/login');
				  	exit;
				  }
				  if($page == 'encomenda'){
				  	header('Location:/carrinho');
				  	exit;
				  }
				}
			}else{
				 $_SESSION['retorno'] = "Usuário ou senha errada!";
				if($perfil=='Cliente') header('Location:/login?errors');
				if($perfil=='Vendedor') header('Location:/vendedor?error');
	            exit;
			}
			}else{
				$_SESSION['retorno'] = "Usuário ou senha errada!";
				if($perfil=='Cliente') header('Location:/login?erroru');
				if($perfil=='Vendedor') header('Location:/vendedor?error');
	            exit;
			}	
	}
	public static function logout($perfil)
	{
		unset($_SESSION['Cliente']);
		unset($_SESSION['Vendedor']);
		
		if($perfil=='Cliente'){	
			header('Location: /login');
			exit;
		}else if($perfil=='Vendedor'){	
			header('Location: /vendedor/login');
			exit;
		}
	}
	public static function verifyLogin($perfil,$accao='0')
	{
	  
	   if($perfil=='Cliente'){
		   if(empty($_SESSION['Cliente']) && empty($_SESSION['Vendedor'])){
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
		}else if($perfil=='Vendedor'){	
		    if(empty($_SESSION['Vendedor'])){
			header('Location: /vendedor/login');
			exit;
			}
		}
	
	}
	public static function listAll($perfil)
	{
		$db = new Sql2();
		if($perfil=='Cliente'){
		    $results = $db->select("SELECT SQL_CALC_FOUND_ROWS *,b.num as num2,a.num as num, a.state as state FROM tbusuario a INNER JOIN tbcliente b ON a.usuario=b.usuario");
		    $numrows = $db->select("SELECT FOUND_ROWS() AS nrtotal;");
		    return array($results,$numrows);
		} 
		if($perfil=='Vendedor'){
			$results = $db->select("SELECT SQL_CALC_FOUND_ROWS *,b.num as num2,a.num as num, a.state as state FROM tbusuario a INNER JOIN tbvendedor b ON a.usuario=b.usuario");
			$numrows = $db->select("SELECT FOUND_ROWS() AS nrtotal;");
			return array($results,$numrows);
		}

	}
	public function searchById($id,$perfil)
	{
		$db = new Sql2();
		if($perfil=='Cliente'){
		$results = $db->select("SELECT *,b.num as num2,a.num as num FROM tbusuario a INNER JOIN tbcliente b ON a.usuario=b.usuario WHERE a.num = :num", array(':num'=>$id));
		} if($perfil=='Vendedor'){
		$results = $db->select("SELECT *,b.num as num2,a.num as num FROM tbusuario a INNER JOIN tbvendedor b ON a.usuario=b.usuario WHERE a.num = :num", array(':num'=>$id));
		}
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function searchByIdsimple($id)
	{
		$db = new Sql2();
		$results = $db->select("SELECT * FROM tbusuario WHERE usuario = :num AND state <> 0", array(':num'=>$id));
		if (!empty($results)){
			$data = $results[0];
			$this->setValues($data);
		}
	}
	public function save(){
		try
		{
			//verifica se o usuario já foi registado e não terminou o cadastro
			$db = new Sql2;
			$result = $db->select("SELECT usuario FROM tbusuario WHERE usuario= :usuario AND state = 0",array(':usuario'=>$this->getValue('usuario')));
			if(empty($result)){
     
			$db1 = new Sql2();
			$db1->query("INSERT INTO tbusuario (usuario,email,senha,perfil) values(:usuario,:email,:senha,:perfil)",
			array(
			':usuario'=>$this->getValue('usuario'),
			':senha'=>$this->getValue('senha'),
			':perfil'=>$this->getValue('perfil'),
			':email'=>$this->getValue('email')	));	
			if($this->getValue('perfil') == 'Cliente'){
				$db2 = new Sql2();
			    $db2->query("INSERT INTO tbcliente (usuario,nome,tel) values(:usuario,:nome,:tel)",
			array(
				':usuario'=>$this->getValue('usuario'),
				':tel'=>$this->getValue('usuario'),
				':nome'=>$this->getValue('nome')));
			}
		    if($this->getValue('perfil') == 'Vendedor'){
				
				$objcon = new \PDO("mysql:dbname=".Sql2::DBNAME.";host=".Sql2::HOSTNAME,Sql2::USERNAME,Sql2::PASSWORD);
			    $comando = $objcon->prepare("INSERT INTO tbvendedor (usuario,nome,tel) values(?,?,?)");
			    $comando->execute(array($this->getValue('usuario'),$this->getValue('nome'),$this->getValue('usuario')));

		
                $db3 = new Sql2();
			    $db3->query("INSERT INTO tbconfig_notificacao (vendedor,telefone,email) values(:vendedor,:telefone,:email)",
				array(
				':vendedor'=>$objcon->lastInsertId(),
				':telefone'=>$this->getValue('usuario'),
				':email'=>$this->getValue('email')));
			}
			}
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function update(){
		try
		{

			if($this->getValue('perfil') == 'Cliente')
			{
			$db = new Sql2();
			$db->query("UPDATE tbcliente SET nome=:nome,tel=:tel,pais=:pais,provincia=:provincia,cidade=:cidade,endereco=:endereco WHERE num=:num2",
			array(
			':num2'=>$this->getValue('num2'),
			':nome'=>$this->getValue('nome'),
			':tel'=>$this->getValue('tel'),
			':pais'=>$this->getValue('pais'),
			':provincia'=>$this->getValue('provincia'),
			':cidade'=>$this->getValue('cidade'),
			':endereco'=>$this->getValue('endereco')
			));	
			$db->query("UPDATE tbusuario SET email=:email, status_email=:status_email WHERE num=:num",
				array(':num'=>$this->getValue('num'),':email'=>$this->getValue('email'),
			          ':status_email'=>$this->getValue('status_email')
			));
			$_SESSION[$this->getValue('perfil')]= $this->getValues();
           
		   }
		   if($this->getValue('perfil') == 'Vendedor')
			{

			$db = new Sql2();
			$db->query("UPDATE tbvendedor SET nome= :nome, categoria= :categoria, pais= :pais, provincia= :provincia, cidade= :cidade , endereco= :endereco, tel= :tel, tel2= :tel2 WHERE num=:num2",
			array(
			':num2'=>$this->getValue('num2'),
			':nome'=>$this->getValue('nome'),
			':tel'=>$this->getValue('tel'),
			':tel2'=>$this->getValue('tel2'),
			':pais'=>$this->getValue('pais'),
			':provincia'=>$this->getValue('provincia'),
			':cidade'=>$this->getValue('cidade'),
			':endereco'=>$this->getValue('endereco'),
			':categoria'=>$this->getValue('categoria')
			));
			$db->query("UPDATE tbusuario SET email=:email WHERE num=:num",
				array(':num'=>$this->getValue('num'),':email'=>$this->getValue('email')));	
			$_SESSION[$this->getValue('perfil')]= $this->getValues();

		   }
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function updateImg($img){
		try
		{
			$db = new Sql2();	
			$db->query("UPDATE tbusuario SET img=:img WHERE num=:num",
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

			if($this->getValue('perfil') == 'Cliente')
			{
			$db = new Sql2();
				
			$db->query("UPDATE tbcliente SET state=:state WHERE num=:num2",
				array(':num2'=>$this->getValue('num2'),':state'=>0));
		   }
		   if($this->getValue('perfil') == 'Vendedor')
			{
			$db = new Sql2();
			$db->query("UPDATE tbvendedor SET state=:state WHERE num=:num2",
				array(':num2'=>$this->getValue('num2'),':state'=>0));	
		   }
		}
		catch(Exception $e)
		{
			$_SESSION['retorno'] = "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
		}
	}
	public function changePassword($user, $oldpassword, $newpassword,$perfil)
	{
		$db = new Sql2();
		$results = $db->select("SELECT * FROM tbusuario WHERE usuario = :LOGIN", array(':LOGIN'=>$user));
		if (!empty($results)){
		  
			$data = $results[0];
        	if(password_verify($oldpassword, $data['senha'])){
				$this->setValues($data);
				$newpassword = password_hash($newpassword, PASSWORD_DEFAULT, array("cost"=>12));
				$this->setValue('senha',$newpassword);
				try
				{
					$results = $db->query("UPDATE tbusuario SET senha=:password WHERE num= :num", 
					array(':num'=>$this->getValue('num'),':password'=>$this->getValue('senha')));
					if($perfil=='Cliente') header('Location:/login');
					if($perfil=='Vendedor') header('Location:/vendedor');
	                exit;
				}catch(Exception $e){
					echo "Ocorreu um erro! Tente novamente e se o erro persistir contacte o administrador.";
					if($perfil=='Cliente') header('Location:/login?error');
					if($perfil=='Vendedor') header('Location:/vendedor?error');
	                exit;
				}
			}else{
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
	public static function recoverPasswordStep2($user, $password,$perfil)
	{
		
		$db = new Sql2();
		$results = $db->select("SELECT * FROM tbrecuperacao_senha WHERE usuario = :LOGIN ORDER BY num DESC LIMIT 1", array(':LOGIN'=>$user));
		if (!empty($results))
		{
		  
			$data = $results[0];
        	if(password_verify($password, $data['senha'])){
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
		$db = new Sql2();
		$results = $db->select("SELECT * FROM tbconfirmar_telefone WHERE usuario = :LOGIN ORDER BY num DESC LIMIT 1", array(':LOGIN'=>$user));
		if (!empty($results))
		{
		  
			$data = $results[0];
        	if(password_verify($password, $data['senha'])){
				try
				{
					$db->query("UPDATE tbusuario SET state=1 WHERE usuario= :usuario", 
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
                $db = new Sql2();
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
			$db->query("DELETE FROM tbusuario WHERE num= :num",array(':num'=>$this->getValue('num')));	
		
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
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *,b.num as num2,a.num as num FROM tbusuario WHERE state=1 LIMIT $start, $itemsPerPage");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		);
	}
	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{
		$start = ($page - 1) * $itemsPerPage;
		$sql = new Sql();
		$results = $sql->select("SELECT SQL_CALC_FOUND_ROWS *,b.num as num2,a.num as num FROM tbusuario WHERE a.nome LIKE :search AND state=1 LIMIT $start, $itemsPerPage", array(':search'=>'%'.$search.'%'));
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
		return array('data'=>$results,'total'=>(int)$resultTotal[0]["nrtotal"],'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage));
	} 
}

 ?>