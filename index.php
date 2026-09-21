<<<<<<< HEAD
<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Core\Email;
use \Core\Page;
use \Core\PageAdmin;
use \Core\UploadImg;
use \Core\Recaptcha;
use \Core\Model\Slide;
use \Core\Model\Product;
use \Core\Model\ProductFeature;
use \Core\Model\ProductImg;
use \Core\Model\Client;
use \Core\Model\News;
use \Core\Model\User;
use \Core\Model\Category;
use \Core\Model\Newsletter;
use \Core\Model\Blog;
use \Core\Model\PostBlog;
use \Core\Model\Msg;
use \Core\Model\ContactCompany;
use \Core\Model\ValueCompany;
use \Core\Model\Company;
use \Core\Model\Cart;
use \Core\Model\CartProduct;
use \Core\Model\Customer;

//var_dump($_SESSION); die;

$app = new Slim();
$app->config('debug', true);

$app->get('/', function(){
	$product = Product::getPage(1,50);
	if(count($product['data']) > 0){
		
			for ($i=0;$i<count($product['data']);$i++){
			$product['data'][$i]['description'] = (strlen($product['data'][$i]['description'])>17)?
			substr($product['data'][$i]['description'],0,17).'...':$product['data'][$i]['description'];

			$product['data'][$i]['num'] = base64_encode($product['data'][$i]['num']);
			}
    }
	$slide = Slide::listAll();
	$slide2 = array();
	 if(count($slide) > 0){
                $slide1 = $slide[0];
             if(count($slide) > 1){
                for ($i=1;$i<count($slide);$i++){
                array_push($slide2, $slide[$i]);
                  $qtslide[$i]= $i; 
                }
            }
       }
    //novidades
    $news =  News::getPage(1,10);
    $blog =  Blog::getPage(1,10);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('home',array('slide1'=>$slide1,'slide2'=>$slide2,'qtslide'=>$qtslide,'product'=>$product['data'],'news'=>$news['data'],'blog'=>$blog['data']));
});
$app->get('/home', function(){
	$product = Product::getPage(1,50);
	if(count($product['data']) > 0){
		
			for ($i=0;$i<count($product['data']);$i++){
			$product['data'][$i]['description'] = (strlen($product['data'][$i]['description'])>17)?
			substr($product['data'][$i]['description'],0,17).'...':$product['data'][$i]['description'];

			$product['data'][$i]['num'] = base64_encode($product['data'][$i]['num']);
			}
    }
	$slide = Slide::listAll();
	$slide2 = array();
	 if(count($slide) > 0){
                $slide1 = $slide[0];
             if(count($slide) > 1){
                for ($i=1;$i<count($slide);$i++){
                array_push($slide2, $slide[$i]);
                  $qtslide[$i]= $i; 
                }
            }
       }
    //novidades
    $news =  News::getPage(1,10);
    $blog =  Blog::getPage(1,10);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('home',array('slide1'=>$slide1,'slide2'=>$slide2,'qtslide'=>$qtslide,'product'=>$product['data'],'news'=>$news['data'],'blog'=>$blog['data']));
});
$app->get('/blog', function(){
	$blog = Blog::listAll();
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('blog',array('blog'=>$blog));
});
$app->get('/blog/detalhe-:num', function($num){
	$blog = new Blog();
	$blog->searchById($num);
	$posts = PostBlog::listAll($num);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('blog-detail',array('blog'=>$blog->getValues(),'posts'=>$posts));
});
$app->get('/novidades/detalhe-:num', function($num){
	$novidade = new News();
	$novidade->searchById($num);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
   
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('novidade-detail',array('novidade'=>$novidade->getValues()));
});
$app->get('/produtos', function(){
	
	$retorno = isset($_SESSION['retorno'])?$_SESSION['retorno']:'';
	unset($_SESSION['retorno']);
	$cliente = Client::listAll();
	$categoria = Category::listAll();
	if(count($categoria) > 0){
			for ($i=0;$i<count($categoria);$i++){
			$categoria[$i]['num'] = base64_encode($categoria[$i]['num']);
			}
    }
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
    $category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('products',array('categoria'=>$categoria,'retorno'=>array('retorno'=>$retorno)));
});
$app->get('/produtos/search', function(){

	
	$search = isset($_GET['search'])? filter_var($_GET['search'], FILTER_SANITIZE_STRING)  : "";
	$page = isset($_GET['page'])? (int)$_GET['page'] : 1;
	$categoria = (isset($_GET['categoria']))? filter_var($_GET['categoria'], FILTER_SANITIZE_STRING) : "";
	
	if($categoria != '') {
		$categoria = base64_decode($categoria);
		$pagination = Product::getPageSearchCategory($categoria, $page,'50');
	} 
	else if ($search != '') {
		$pagination = Product::getPageSearch($search, $page,'20');
	} 
	else {
		$pagination = Product::getPage($page,'20');
	}
	if(count($pagination['data']) > 0){
		
			for ($i=0;$i<count($pagination['data']);$i++){
			$pagination['data'][$i]['description'] = (strlen($pagination['data'][$i]['description'])>17)?
			substr($pagination['data'][$i]['description'],0,17).'...':$pagination['data'][$i]['description'];

			$pagination['data'][$i]['num'] = base64_encode($pagination['data'][$i]['num']);
			}
    }
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{
		array_push($pages, array(
			'href'=>'/produtos?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));
	}
	$page = new Page(array('header'=>false,'footer'=>false));
	$page->setTpl('products-datas',array('product'=>$pagination['data'],'pages'=>$pages));
	
});
$app->get('/produtos/sugest', function(){
	if (isset($_GET['search']) && !empty($_GET['search'])) 
	{
		$search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
		$produtos = ProdutoVendedor::getPageSearchAll($search,1,'5');
		if(count($produtos['data'])>0){
		echo "<ul class='panel panel-default' >";
		foreach ($produtos['data'] as $key => $value) {
			echo "<li><a href='' class='link-sugest'>".substr($value['descricao'],0,40).'</a></li>';
		}
		echo "</ul>";
	    }
	}
});
$app->get('/produto/:num', function($num){
	$num = base64_decode($num);
	$retorno = isset($_SESSION['retorno'])?$_SESSION['retorno']:'';
	$product = new Product();
	$product->searchById($num);
	$product = $product->getValues();
	$product['num'] = base64_encode($product['num']);
    $productimg = ProductImg::listAll($num);
    $feature = ProductFeature::listAll($num);
	/*
	if(count($pagination) > 0){
		
			for ($i=0;$i<count($pagination);$i++){
				$pagination[$i]['num'] = base64_encode($pagination[$i]['num']);
				$pagination[$i]['description'] = (strlen($pagination[$i]['description'])>17)?
			substr($pagination[$i]['description'],0,17).'...':$pagination[$i]['description'];
				
			}
    }*/
    //mudança de menu quando o usuario loga
    
	//total de produtos no  carrinho
   
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('product-detail',array('product'=>$product,'productimg'=>$productimg,'feature'=>$feature,'retorno'=>array('retorno'=>$retorno)));
});
$app->get('/carrinho', function(){

	if(isset($_SESSION['Cart']['num'])){
    $carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
	
	//total de produtos no  carrinho
  	$numrowcarrinho = array('total'=>count($carrinho[0]));
    $category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('cart',array('products'=>$carrinho[0],'vtotal'=>array('vtotal'=>$carrinho[1]['vtotal'])));
	}else{ 
	 $_SESSION['retorno'] = "Selecione produtos antes de abrir o carrinho!";
	 header('Location:/produtos');
     exit;
    }
});
$app->get('/carrinho/add/:num/', function($num){
	 
	 $num = base64_decode($num);
	 $produto = new Product();
	 $produto->searchById($num); 
	 $tamanho = isset($_GET['tamanho'])?$_GET['tamanho']:'';
	 $cor = isset($_GET['cor'])?$_GET['cor']:'';
     $carrinho = new CartProduct();
	 $carrinho->setValue('description',$produto->getValue('description')." | $tamanho $cor");
	 $carrinho->setValue('price',$produto->getValue('price'));
	 $carrinho->setValue('product',$produto->getValue('num'));
	 $carrinho->setValue('amount',1);
	 $carrinho->add();
	 header('Location:/produtos');
     exit;
	 
});
$app->get('/carrinho/remove/:num', function($num){
	 //$num = base64_decode($num);
     $carrinho = new CartProduct();
	 $carrinho->setValue('product',$num);
     $carrinho->delete();
	 header('Location:/carrinho');
     exit;
	 
});
$app->get('/carrinho/cancel', function(){
	 
     unset($_SESSION['Cart']);
	 header('Location:/produtos');
     exit;
	 
});
$app->post('/carrinho/update', function(){
     foreach($_POST as $k => $v){
	 $carrinho = new CartProduct();
	 $carrinho->setValue('product',$k);
	 $carrinho->setValue('amount',$v);
     $carrinho->update();
	 } 
	 header('Location:/carrinho');
     exit;
});
$app->get('/carrinho/finalizar', function(){
     if(isset($_SESSION['Cart']['num'])){
	     Customer::verifyLogin('finalizar');
	     $email = new Email();
	     $numcliente = $_SESSION['Customer']['num']; 
		 $nomecliente = $_SESSION['Customer']['name'];
		 $carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
		 $carrinhosimple = CartProduct::listAllByCartSimple($_SESSION['Cart']['num']);

		 $hash = base64_encode($_SESSION['Cart']['num'].' '.$carrinho['1']['vtotal'].' '.date('Y-m-d h:i:s'));
		 //Salva na base de dados
		 $encomenda = new Cart();
		 $encomenda->searchById($_SESSION['Cart']['num']); 
		 $encomenda->setValue('global_value',$carrinho['1']['vtotal']);
		 $encomenda->setValue('customer',$_SESSION['Customer']['num']);
		 $encomenda->setValue('date_end',date('Y-m-d h:i:s')); 
		 $encomenda->setValue('hash',$hash);
		 $encomenda->update(); 

		 // Envia o Email e a msg (alerta)
		 $produtosemail = '';
         $produtosmsg = '';
         $carrinho2 = $carrinho[0];
		for ( $i = 0; $i < count($carrinho2); $i++){

				$produtosmsg .= 'Produto: '.$carrinho2[$i]['num'].' - '.$carrinho2[$i]['description_product'].' - Qtd: '. $carrinho2[$i]['amount'].' Preço: '.$carrinho2[$i]['price'].'AKZ </td></tr>';		
		 }
		 $msg = new Msg();
		 $msg->setValue('name',$_SESSION['Customer']['name'].' - '.$_SESSION['Customer']['tel']);
         $msg->setValue('subject','Encomenda de Produtos');
         $msg->setValue('note',$produtosmsg);
         $msg->setValue('email',$_SESSION['Customer']['email']);
         $msg->setValue('tel',$_SESSION['Customer']['tel']);
		 $msg->save();
         	/*if(($_SESSION['Customer']['status_email'] =='sim') && !empty($_SESSION['Customer']['email']))
		 	{
         		$email->send('Encomenda de produto', 
         			"<a href='https://www.uzomashop.com/'>
				 	       <img src='https://www.uzomashop.com/img/logo.png' width='40'>
				 	</a>
				 	<h2 style='color:#28a745'> Uzoma Shop | Encomenda de Produto </h2>
         			<p>Caro cliente, eis a nota da sua encomenda feita no Kikolo Online 
         			<table style='border-color:#aaaaaa;' border='1px' width='600px' cellspacing='0'>
         			<tr align='center' style='background-color:#aaa'><td> nome do produto </td><td> quantidade </td><td> preço </td></tr>
         			".$produtosemail.'</table>
         			<p><strong> Valor Total:</strong> '.$carrinho[1]['vtotal'].' AKZ </p>
         			<small>data: ('.$encomenda->getValue('date_end').')</small>','',$_SESSION['Customer']['email']);
         	}*/
        unset($_SESSION['Cart']);
		//mudança de menu quando o usuario loga

		//total de produtos no  carrinho 
         
		//$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowscarrinho = array('total'=>0);
    
		$category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
	    }else{
	  		$numrowcart = array('total' => 0 );
	    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	    $page->setTpl('cartend',array('produtos'=>$carrinho[0],'vtotal'=>array('vtotal'=>$carrinho[1]['vtotal'])));
	 	
	 }else{
	  $_SESSION['retorno'] = "Selecione produtos antes de abrir o carrinho!";
      header('Location:/produtos');
      exit;
	  }
	
});
$app->get('/vendedor', function(){
	
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('vendedor',array());
});
$app->get('/pagamentos-e-entregas', function(){
	
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('pagamento-entrega',array());
});
$app->get('/login', function(){
	$retorno = isset($_SESSION['retorno'])?$_SESSION['retorno']:' ';
	unset($_SESSION['retorno']);
	//Cliente logado
	if(isset($_SESSION['Customer'])){
	
	$customer = new customer;
	$customer->searchById($_SESSION['Customer']['num']);
	//mudança de menu quando o usuario loga
	
	
	//total de produtos no  carrinho
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$carrinho = array('total'=>count($carrinho[0]));
    }else{
  		$carrinho = array('total' => 0 );
    }
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('perfil-cliente',array('customer'=>$customer->getValues(),'retorno'=>array('retorno'=>$retorno)));
	}else{
	//Cliente não logado
		if(isset($_SESSION['Cart']['num'])){
	  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
	  		$carrinho = array('total'=>count($carrinho[0]));
	    }else{
	  		$carrinho = array('total' => 0 );
	    } 
	    //Menu
	    $category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
		$page->setTpl('login',array('retorno'=>array('retorno'=>$retorno)));
		}
});
$app->post('/login', function(){ 
	$page = isset($_GET['page'])?$_GET['page']:'login';
	Customer::login($_POST['user'],$_POST['pass'],$page);
	exit;
});
$app->get('/verifyuser', function(){
	$usuario = new Customer();
	$usuario->searchByIdsimple($_GET['num']);
	if(!empty($usuario->getValues())){
		echo "Este número já foi cadastrado!";
	}
});
$app->get('/logout/:perfil', function($perfil){
   Customer::logout($perfil);
});
$app->get('/cliente/desativar', function(){
    Customer::verifyLogin();
	$usuario = new Customer();
	$usuario->searchById($_SESSION['Cliente']['num'],'Cliente');
	$usuario->disableAccount();
	$_SESSION['retorno']='A sua conta foi desactivada com sucesso. Para voltar a reativa-la inicie a sessão novamente.';
	header('Location:/logout/Cliente'); 
	exit;
});
$app->post('/usuario/novo', function(){
	$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{
		//criptografa a senha
		$senha = $_POST['pass'];
		$_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT, array('cost'=>12));
		//validação dos campos
		$_POST['email'] = isset($_POST['email'])?(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)):'';
		$_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

		$_POST['tel'] = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
		//verifica se o usuario já foi cadastrado
		$verifyuser = new Customer();
		$verifyuser->searchByIdsimple($_POST['tel']);
		if(!empty($verifyuser->getValues())){
			$_SESSION['retorno']='Este número já está registado no Uzoma.';
			header('Location:/login');
		   
            exit;
		}

		$usuario = new Customer();
		$usuario->setValues($_POST);
		$usuario->save();
		Customer::login($_POST['tel'],$senha,'login');
	}
	else
	{
		$_SESSION['retorno'] = "Não permitimos que Rôbos usem a nossa plataforma!";
		header('Location:/login');
   	    exit;
	}
});
$app->get('/usuario/novo/reenviar',function(){
	if(isset($_SESSION['Cadastro'])){
	   Customer::confirmTelephoneStep1($_SESSION['Cadastro']['usuario']);
	   header('Location:/usuario/novo/confirmar');
       exit;
    }
});
$app->get('/usuario/novo/confirmar',function(){
			
    		//Menu
		

		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	 	$page->setTpl('confirmtelephone');
	
});
$app->post('/usuario/novo/confirmar', function(){
	if(isset($_SESSION['Cadastro'])){
		$usuario = $_SESSION['Cadastro']['usuario'];
		$senha = $_SESSION['Cadastro']['senha'];
		$perfil = $_SESSION['Cadastro']['perfil'];
    	Customer::confirmTelephoneStep2($usuario,$_POST['senha'],$perfil);
    	unset($_SESSION['Cadastro']);
    	Customer::login($usuario,$senha,$perfil,'login');
   }
});
$app->post('/usuario/atualizar', function(){
	Customer::verifyLogin();
	$usuario = new Customer();
	$usuario->searchById($_SESSION['Customer']['num']);
	$usuario->setValues($_POST);
	$usuario->update();
	header('Location:/login');
	exit;
});
$app->get('/fotoperfil/cliente', function(){
	Customer::verifyLogin();

    $page = new Page(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimage');	 
});
$app->post('/fotoperfil/cliente', function(){
	Customer::verifyLogin();
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/usuarios/'.rand().date('YmdHis').'.png'; 
		$usuario = new Usuario();
		$usuario->searchById($_SESSION['Cliente']['num'],'Cliente');
		$usuario->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($usuario->getValue('img'))){
                   if($usuario->getValue('img') != 'img/sem imagem.jpg')unlink($usuario->getValue('img'));
				}
				$usuario->setValue('img',$imageName);
				$_SESSION['Cliente'] = $usuario->getValues();
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/usuario/senha', function(){
	Customer::verifyLogin('Cliente');
    $sessao = isset($_SESSION['Cliente'])?$_SESSION['Cliente']:NULL;
	if(isset($_SESSION['Encomenda']['num'])){
  		$carrinho = Carrinho::listAllByCart($_SESSION['Encomenda']['num']);
  		$carrinho = array('total'=>count($carrinho[0]));
    }else{
  		$carrinho = array('total' => 0 );
    }
    $category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('change-password',array('cliente'=>$sessao));	 
});
$app->post('/usuario/senha', function(){
	Customer::verifyLogin('Cliente');
    $user = new Customer();
	$user->changePassword($_SESSION['Customer']['tel'],$_POST['oldpassword'],$_POST['newpassword']);
	header('Location:/login');
	exit; 
});
//recuperar senha
$app->post('/usuario/confirmarsenha-:perfil', function($perfil){
	Customer::recoverPasswordStep2($_POST['usuario'],$_POST['senha'],$perfil);
});
$app->get('/usuario/recuperarsenha-:perfil', function($perfil){
	

	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('recover',array('perfil'=>array('perfil'=>$perfil)));	 
});
$app->post('/usuario/recuperarsenha-:perfil', function($perfil){
	$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{
		$usuario = $_POST["usuario"];
		
        $dados= new Customer();
        $dados->searchByIdsimple($usuario);
        if(!empty($dados->getValues())){
        	$senharecuperacao = random_int(10000, 1000000);
        	$senharecuperacaocifrada = password_hash($senharecuperacao, PASSWORD_DEFAULT, array("cost"=>12));;
        	$msg = "
        	<a href='https://www.uzomashop.com/'>
				 	       <img src='https://www.uzomashop.com/img/logo.png' width='40'>
				 	</a>
			<h2 style='color:#28a745'> uzomashop | Redefinir senha </h2>
        	<p> A sua conta do uzomashop solicitou uma recuperação de senha. 
        o código para confirmar a recuperação é $senharecuperacao. Se não solicitou recuperação da sua senha apague por favor este email.</p>  
            <p>Observe que o link é válido por 24 horas. Depois que o limite de tempo expirar, você precisará reenviar a solicitação de redefinição de senha.</p>";
			//gravar dados da recuperação
        	Usuario::recoverPasswordStep1($dados->getValue('usuario'),$senharecuperacaocifrada);

			//envio do email
        	$email = new Email();
        	$email->send('Redefinir da Senha',$msg,' ',$dados->getValue('email'));

        	
    		//Menu

			if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
			$page->setTpl('recoverconfirm',array('usuario'=>array('usuario'=>$usuario),'perfil'=>array('perfil'=>$perfil)));
        } else {
        $_SESSION['retorno'] = " Este número de telefone é inválido!";
        header('Location:/login');
        }
   		exit;
	}
	else
	{
		$_SESSION['retorno'] = "Não permitimos que Rôbos usem a nossa plataforma!";
		header('Location:/usuario/recuperarsenha');
   		exit;
	} 
});
$app->get('/sobre', function(){
		$category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
		$page->setTpl('about');
});
$app->get('/faq', function(){
	//mudança de menu quando o usuario loga
    

	
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('faq');
});
$app->get('/contactos', function(){
		$category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
	    }else{
	  		$numrowcart = array('total' => 0 );
	    }
		$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
		$page->setTpl('contact');
});
$app->post('/contactos', function(){	
	$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{
		$msg = new Msg(); 
		$_POST['nickname'] = ' ';
		$msg->setValues($_POST);
		$msg->save();
		header('Location:/contactos');
		exit;
    }
	header('Location:/contactos');
	exit;

});
$app->get('/termos', function(){
    

	//total de produtos no  carrinho
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = Carrinho::listAllByCart($_SESSION['Cart']['num']);
  		$carrinho = array('total'=>count($carrinho[0]));
    }else{
  		$carrinho = array('total' => 0 );
    }
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
    $category = Category::listAll();
    $company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('terms');
});
$app->post('/newsletter/new', function(){
	/*$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{*/
		$newsletter = new Newsletter(); 
		$newsletter->setValues($_POST);
		$newsletter->save();
		header('Location:/home');
	exit; 
	
});
$app->get('/politica', function(){
    echo "Página indisponível!";
});


// Rotas administrativas
$app->get('/config/login', function(){
    $page = new PageAdmin(array("header"=>false,"footer"=>false));
	$page->setTpl('login');
});
$app->post('/config/login', function() {
	User::login($_POST['user'], $_POST['password']);
	exit;
});
$app->get('/config/', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('home');
});
$app->get('/config/logout', function(){
    User::logout();
});
//users
$app->get('/config/users', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = User::getPageSearch($search, $page);
	} else {
		$pagination = User::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/users?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('user',array('users'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/users/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('user-new');
});
$app->post('/config/user/new', function(){	
	User::verifyLogin();
	$user = new User();
	$senha = '12345';
 	$_POST['password'] = password_hash($senha, PASSWORD_DEFAULT, array("cost"=>12));
	$user->setValues($_POST);
	$user->save();
	header('Location:/config/users');
	exit; 
});
$app->get('/config/users/:num/delete', function($num){
	User::verifyLogin();
	$user = new User();
	$user->searchById($num);
    $user->delete();
	header('Location:/config/users');
	exit;
});
$app->get('/config/users/change-password', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('change-password');	 
});
$app->post('/config/users/change-password', function(){
	User::verifyLogin();
    $user = new User();
	$user->changePassword($_SESSION['user']['user'],$_POST['oldpassword'],$_POST['newpassword']);
	header('Location:/config/users');
	exit; 
});
$app->get('/config/users/:num', function($num){
	User::verifyLogin();
	$user = new User();
	$user->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('user-update',array('user'=>$user->getValues())); 
});
$app->post('/config/users/:num', function($num){
	User::verifyLogin();
	$user = new User();
	$user->searchById($num);
	$user->setValues($_POST);
	$user->update();
	header('Location:/config/users');
	exit; 
});

//slide
$app->get('/config/slide', function(){
	User::verifyLogin();
	$slide = Slide::listAll();
    $page = new PageAdmin();
	$page->setTpl('slide',array('slide'=>$slide));
});
$app->get('/config/slide/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('slide-new');
});
$app->post('/config/slide/new', function(){	
	User::verifyLogin();
	$slide = new Slide();
	$_POST['user'] = $_SESSION['user']['user'];
	$slide->setValues($_POST);
	$slide->save();
	header('Location:/config/slide');
	exit; 
});
$app->get('/config/slide/img-:num', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageslide',array('slide'=>$slide->getValues()));	 
});
$app->post('/config/slide/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/slide/'.rand().date('YmdHis').'.png'; 
		$slide = new Slide();
		$slide->searchById($num);
		$slide->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($slide->getValue('img'))){
                  if($slide->getValue('img') != 'img/sem imagem.jpg')unlink($slide->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/slide/:num/delete', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
    $slide->delete();
	if(file_exists($slide->getValue('img'))){
                  if($slide->getValue('img') != 'img/sem imagem.jpg')unlink($slide->getValue('img'));
				}
	header('Location:/config/slide');
	exit;
});
$app->get('/config/slide/:num', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('slide-update',array('slide'=>$slide->getValues()));
});
$app->post('/config/slide/:num', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		if(file_exists($slide->getValue('img'))){	
			unlink($slide->getValue('img'));
		}
		UploadImg::upload('img/slide/',$_FILES);
	}
	$_POST['user'] = $_SESSION['user']['user'];
	$slide->setValues($_POST);
	$slide->update();
	header('Location:/config/slide');
	exit; 
});
//product
$app->get('/config/product', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = Product::getPageSearch($search, $page);
	} else {
		$pagination = Product::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/product?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('product',array('product'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/product/new', function(){
	User::verifyLogin();
	$category = Category::listAll();
    $page = new PageAdmin();
	$page->setTpl('product-new',array('category'=>$category));
});
$app->post('/config/product/new', function(){	
	User::verifyLogin();
	$product = new Product();
	$_POST['user'] = $_SESSION['user']['user'];
	$product->setValues($_POST);
	$product->save();
	header('Location:/config/product');
	exit; 
});
$app->get('/config/product/img-:num', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageproduct',array('product'=>$product->getValues()));	 
});
$app->post('/config/product/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/produtos/'.rand().date('YmdHis').'.png'; 
		$product = new Product();
		$product->searchById($num);
		$product->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/product/verimagens-:num', function($num){
	User::verifyLogin();
	$product = ProductImg::listAll($num);
    $page = new PageAdmin(array());
	$page->setTpl('productimg',array('product'=>$product,'num'=>$num));	 
});
$app->get('/config/productimg/add-:num', function($num){
	User::verifyLogin();
	$productimg = new ProductImg();
	$productimg->setValue('product',$num);
	$productimg->save();
	header("Location:/config/product/verimagens-$num");
	exit; 
});
$app->get('/config/productimg/img-:num-:numproduct', function($num,$numproduct){
	User::verifyLogin();
	$product = new ProductImg();
	$product->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageproducts',array('product'=>$product->getValues(),'num'=>$numproduct));	 
});
$app->post('/config/productimg/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/produtos/'.rand().date('YmdHis').'.png'; 
		$product = new ProductImg();
		$product->searchById($num);
		$product->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/productimg/:num/delete', function($num){
	User::verifyLogin();
	$product = new ProductImg();
	$product->searchById($num);
    $product->delete();
	if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
	header("Location:/config/product/verimagens-".$product->getValue('product'));
	exit;
});
//features
$app->get('/config/productfeature/:num', function($num){
	User::verifyLogin();
	$product = ProductFeature::listAll($num);
    $page = new PageAdmin(array());
	$page->setTpl('productfeature',array('product'=>$product,'num'=>$num));	 
});
$app->post('/config/productfeature/add-:num', function($num){
	User::verifyLogin();
	$productimg = new ProductFeature();
	$productimg->setValue('product',$num);
	$productimg->setValues($_POST);
	$productimg->save();
	header("Location:/config/productfeature/$num");
	exit; 
});
$app->get('/config/productfeature/:num/delete', function($num){
	User::verifyLogin();
	$product = new ProductFeature();
	$product->searchById($num);
    $product->delete();
	header("Location:/config/productfeature/".$product->getValue('product'));
	exit;
});
//end feature
$app->get('/config/product/:num/delete', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);
    $product->delete();
	if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
	header('Location:/config/product');
	exit;
});
$app->get('/config/product/:num', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);
	$category = Category::listAll();
    $page = new PageAdmin();
	$page->setTpl('product-update',array('product'=>$product->getValues(),'category'=>$category));
});
$app->post('/config/product/:num', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);	
	$_POST['user'] = $_SESSION['user']['user'];
	$product->setValues($_POST);
	$product->update();

	header('Location:/config/product');
	exit; 
});
//Category
$app->get('/config/category', function(){
	User::verifyLogin();
	$category = Category::listAll();
    $page = new PageAdmin();
	$page->setTpl('category',array('category'=>$category));
});
$app->get('/config/category/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('category-new');
});
$app->post('/config/category/new', function(){
	
	User::verifyLogin();
	$category = new Category(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$category->setValues($_POST);
	$category->save();
	header('Location:/config/category');
	exit; 
	
});
$app->get('/config/category/:num/delete', function($num){
	
	User::verifyLogin();
	$category = new Category();
	$category->searchById($num);
    $category->delete();
	header('Location:/config/category');
	exit;
});
$app->get('/config/category/:num', function($num){
	
	User::verifyLogin();
	$category = new Category();
	$category->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('category-update',array('category'=>$category->getValues()));
	 
});
$app->post('/config/category/:num', function($num){
	User::verifyLogin();
	$category = new Category();
	$category->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$category->setValues($_POST);
	$category->update();
	header('Location:/config/category');
	exit; 
});
//Newsletter
$app->get('/config/newsletter', function(){
	User::verifyLogin();

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$pagination = Newsletter::getPage($page);
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{
		array_push($pages, array(
			'href'=>'/config/newsletter?'.http_build_query(array(
				'page'=>$x+1,
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('newsletter',array('newsletter'=>$pagination['data'],'pages'=>$pages));
});
$app->get('/config/newsletter/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('newsletter-new');
});
$app->post('/config/newsletter/new', function(){
	
	User::verifyLogin();
	$newsletter = new Newsletter(); 
	$newsletter->setValues($_POST);
	$newsletter->save();
	header('Location:/config/newsletter');
	exit; 
	
});
$app->get('/config/newsletter/compose', function(){
	
	User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl('newsletter-compose');
	
});
$app->post('/config/newsletter/compose', function(){
	User::verifyLogin();
	$newsletter = Newsletter::listAllEmail();
	$image = $_FILES['img']['name'];
	$email = new Email();
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		UploadImg::upload('img/newsletter/',$_FILES);
		$image = $_POST['img'];
	}else{
		$image = '';
	}
	foreach($newsletter as $value){
		$email->send($_POST['subject'],$_POST['msg'],$image,$value['email']);
	}
	if(file_exists($image)){
		unlink($image);
	}
	header('Location:/config/newsletter');
	exit;
});
$app->get('/config/newsletter/:num/delete', function($num){
	
	User::verifyLogin();
	$newsletter = new Newsletter();
	$newsletter->searchById($num);
    $newsletter->delete();
	header('Location:/config/newsletter');
	exit;
});
$app->get('/config/newsletter/:num', function($num){
	
	User::verifyLogin();
	$newsletter = new Newsletter();
	$newsletter->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('newsletter-update',array('newsletter'=>$newsletter->getValues()));
	 
});
$app->post('/config/newsletter/:num', function($num){
	User::verifyLogin();
	$newsletter = new Newsletter();
	$newsletter->searchById($num);
	$newsletter->setValues($_POST);
	$newsletter->update();
	header('Location:/config/newsletter');
	exit; 
});
//News
$app->get('/config/news', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = News::getPageSearch($search, $page);
	} else {
		$pagination = News::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/news?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('news',array('news'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/news/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('news-new');
});
$app->post('/config/news/new', function(){
	User::verifyLogin();
	$news = new News(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$news->setValues($_POST);
	$news->save();
	header('Location:/config/news');
	exit; 	
});
$app->get('/config/news/img-:num', function($num){
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimagenews',array('news'=>$news->getValues()));	 
});
$app->post('/config/news/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/novidades/'.rand().date('YmdHis').'.png'; 
		$news = new News();
		$news->searchById($num);
		$news->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($news->getValue('img'))){
                  if($news->getValue('img') != 'img/sem imagem.jpg')unlink($news->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/news/:num/delete', function($num){
	
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
    $news->delete();
	if(file_exists($news->getValue('img'))){
                  if($news->getValue('img') != 'img/sem imagem.jpg')unlink($news->getValue('img'));
				}
	header('Location:/config/news');
	exit;
});
$app->get('/config/news/:num', function($num){
	
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('news-update',array('news'=>$news->getValues()));
	 
});
$app->post('/config/news/:num', function($num){
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$news->setValues($_POST);
	$news->update();
	header('Location:/config/news');
	exit; 
});
//Client
$app->get('/config/client', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = Client::getPageSearch($search, $page);
	} else {
		$pagination = Client::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/client?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('client',array('client'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/client/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('client-new');
});
$app->post('/config/client/new', function(){
	
	User::verifyLogin();
	$client = new Client(); 
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		UploadImg::upload('img/clientes/',$_FILES);
	}
	$_POST['user'] = $_SESSION['user']['user'];
	$client->setValues($_POST);
	$client->save();
	header('Location:/config/client');
	exit; 
	
});
$app->get('/config/client/img-:num', function($num){
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageclient',array('client'=>$client->getValues()));	 
});
$app->post('/config/client/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/clientes/'.rand().date('YmdHis').'.png'; 
		$client = new Client();
		$client->searchById($num);
		$client->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($client->getValue('img'))){
                  if($client->getValue('img') != 'img/sem imagem.jpg')unlink($client->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/client/:num/delete', function($num){
	
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
    $client->delete();
	if(file_exists($client->getValue('img'))){
                  if($client->getValue('img') != 'img/sem imagem.jpg')unlink($client->getValue('img'));
				}
	header('Location:/config/client');
	exit;
});
$app->get('/config/client/:num', function($num){
	
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('client-update',array('client'=>$client->getValues()));
	 
});
$app->post('/config/client/:num', function($num){
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		if(file_exists($client->getValue('img'))){	
			unlink($client->getValue('img'));
		}
		UploadImg::upload('img/clientes/',$_FILES);
	} 
	$_POST['user'] = $_SESSION['user']['user'];
	$client->setValues($_POST);
	$client->update();
	header('Location:/config/client');
	exit; 
});
//blog
$app->get('/config/blog', function(){
	User::verifyLogin();
	$blog = Blog::listAll();
    $page = new PageAdmin();
	$page->setTpl('blog',array('blog'=>$blog));
});
$app->get('/config/blog/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('blog-new');
});
$app->post('/config/blog/new', function(){
	
	User::verifyLogin();
	$blog = new Blog(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$blog->setValues($_POST);
	$blog->save();
	header('Location:/config/blog');
	exit; 
	
});
$app->get('/config/blog/img-:num', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageblog',array('blog'=>$blog->getValues()));	 
});
$app->post('/config/blog/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/clientes/'.rand().date('YmdHis').'.png'; 
		$blog = new Blog();
		$blog->searchById($num);
		$blog->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($blog->getValue('img'))){
                  if($blog->getValue('img') != 'img/sem imagem.jpg')unlink($blog->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/blog/:num/delete', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num);
    $blog->delete();
	if(file_exists($blog->getValue('img'))){
                  if($blog->getValue('img') != 'img/sem imagem.jpg')unlink($blog->getValue('img'));
				}
	header('Location:/config/blog');
	exit;
});
$app->get('/config/blog/:num', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num); 
    $page = new PageAdmin();
	$page->setTpl('blog-update',array('blog'=>$blog->getValues())); 
});
$app->post('/config/blog/:num', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$blog->setValues($_POST);
	$blog->update();
	header('Location:/config/blog');
	exit; 
});
//blog's post
$app->post('/config/blog-post/new', function(){
	
	User::verifyLogin();
	$post = new PostBlog(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$post->setValues($_POST);
	$post->save();
	header("Location:/config/blog-post/".$_POST['numblog']);
	exit; 
	
});
$app->get('/config/blog-post/new/:num', function($num){
	User::verifyLogin();
    $page = new PageAdmin();
	$numblog = array('numblog'=>$num);
	$page->setTpl('post-new',array('numblog'=>$numblog));
});
$app->get('/config/blog-post/:num-:numb/delete', function($num,$numb){
	
	User::verifyLogin();
	$post = new PostBlog();
	$post->searchById($num);
    $post->delete();
	if(file_exists($post->getValue('img'))){
                  if($post->getValue('img') != 'img/sem imagem.jpg')unlink($post->getValue('img'));
				}
	header("Location:/config/blog-post/$numb");
	exit;
});
$app->get('/config/blog-post/:num-:numb/edit', function($num,$numb){
	User::verifyLogin();
	$post = new PostBlog();
	$numblog = array('numblog'=>$numb);
	$post->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('post-update',array('post'=>$post->getValues(),'numblog'=>$numblog)); 
});
$app->post('/config/blog-post/:num/edit', function($num){
	User::verifyLogin();
	$post = new PostBlog();
	$post->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$post->setValues($_POST);
	$post->update();
	header("Location:/config/blog-post/".$_POST['numblog']);
	exit; 
});
$app->get('/config/blog-post/:num', function($num){
	User::verifyLogin();
	$post = PostBlog::listAll($num);
    $page = new PageAdmin();
	$numblog = array('numblog'=>$num);
	$page->setTpl('post',array('post'=>$post,'numblog'=>$numblog));
});
//Msg
$app->get('/config/msg', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = Msg::getPageSearch($search, $page,50);
	} else {
		$pagination = Msg::getPage($page,50);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/msg?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('msg',array('msg'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/msg/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('msg-new');
});
$app->post('/config/msg/new', function(){	
	User::verifyLogin();
	$msg = new Msg(); 
	$msg->setValues($_POST);
	$msg->save();
	header('Location:/config/msg');
	exit; 	
});
$app->get('/config/msg/:num/delete', function($num){
	
	User::verifyLogin();
	$msg = new Msg();
	$msg->searchById($num);
    $msg->delete();
	header('Location:/config/msg');
	exit;
});
$app->get('/config/msg/:num', function($num){
	User::verifyLogin();
	$msg = new Msg();
	$msg->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('msg-ready',array('msg'=>$msg->getValues())); 
});
$app->post('/config/msg/:num', function($num){
	User::verifyLogin();
	$msg = new Msg();
	$msg->searchById($num); 
	$_POST['user'] = $_SESSION['user']['user'];
	$msg->setValues($_POST);
	$msg->update();
	header('Location:/config/msg');
	exit; 
});
//company
$app->get('/config/company', function(){
	User::verifyLogin();
	$contacts = ContactCompany::listAll();
	$values = ValueCompany::listAll();
    $company = new Company();
	$company->searchById(1);
    $page = new PageAdmin();
	$page->setTpl('company',array('company'=>$company->getValues(),'value'=>$values,'contact'=>$contacts));
});
$app->post('/config/company-contact/new', function(){
	User::verifyLogin();
	$company = new ContactCompany(); 
	$company->setValues($_POST);
	$company->save();
	header('Location:/config/company');
	exit; 	
});
$app->get('/config/company/img-:num', function($num){
	User::verifyLogin();
	$company = new Company();
	$company->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimagelogo',array('company'=>$company->getValues()));	 
});
$app->post('/config/company/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/'.rand().date('YmdHis').'.png'; 
		$company = new Company();
		$company->searchById($num);
		$company->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($company->getValue('img'))){
                  if($company->getValue('img') != 'img/sem imagem.jpg')unlink($company->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/company-contact/:num/delete', function($num){
	User::verifyLogin();
	$company = new ContactCompany(); 
    $company->searchById($num);
	$company->delete();
	header('Location:/config/company');
	exit; 	
});
$app->post('/config/company-value/new', function(){
	
	User::verifyLogin();
	$company = new ValueCompany(); 
	$company->setValues($_POST);
	$company->save();
	header('Location:/config/company');
	exit; 	
});
$app->get('/config/company-value/:num/delete', function($num){
	
	User::verifyLogin();
	$company = new ValueCompany(); 
	$company->searchById($num);
	$company->delete();
	header('Location:/config/company');
	exit; 	
});
$app->post('/config/company/:num', function($num){
	User::verifyLogin();
	$company = new Company();
	$company->searchById($num);
	$company->setValues($_POST);
	$company->update();
	header('Location:/config/company');
	exit; 
});
//fim Rotas administrativas


$app->run();

=======
<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Core\Email;
use \Core\Page;
use \Core\PageAdmin;
use \Core\UploadImg;
use \Core\Recaptcha;
use \Core\Model\Slide;
use \Core\Model\Product;
use \Core\Model\ProductFeature;
use \Core\Model\ProductImg;
use \Core\Model\Client;
use \Core\Model\News;
use \Core\Model\User;
use \Core\Model\Category;
use \Core\Model\Newsletter;
use \Core\Model\Blog;
use \Core\Model\PostBlog;
use \Core\Model\Msg;
use \Core\Model\ContactCompany;
use \Core\Model\ValueCompany;
use \Core\Model\Company;
use \Core\Model\Cart;
use \Core\Model\CartProduct;
use \Core\Model\Customer;

//var_dump($_SESSION); die;

$app = new Slim();
$app->config('debug', true);

$app->get('/', function(){
	$product = Product::getPage(1,50);
	if(count($product['data']) > 0){
		
			for ($i=0;$i<count($product['data']);$i++){
			$product['data'][$i]['description'] = (strlen($product['data'][$i]['description'])>17)?
			substr($product['data'][$i]['description'],0,17).'...':$product['data'][$i]['description'];

			$product['data'][$i]['num'] = base64_encode($product['data'][$i]['num']);
			}
    }
	$slide = Slide::listAll();
	$slide2 = array();
	 if(count($slide) > 0){
                $slide1 = $slide[0];
             if(count($slide) > 1){
                for ($i=1;$i<count($slide);$i++){
                array_push($slide2, $slide[$i]);
                  $qtslide[$i]= $i; 
                }
            }
       }
    //novidades
    $news =  News::getPage(1,10);
    $blog =  Blog::getPage(1,10);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('home',array('slide1'=>$slide1,'slide2'=>$slide2,'qtslide'=>$qtslide,'product'=>$product['data'],'news'=>$news['data'],'blog'=>$blog['data']));
});
$app->get('/home', function(){
	$product = Product::getPage(1,50);
	if(count($product['data']) > 0){
		
			for ($i=0;$i<count($product['data']);$i++){
			$product['data'][$i]['description'] = (strlen($product['data'][$i]['description'])>17)?
			substr($product['data'][$i]['description'],0,17).'...':$product['data'][$i]['description'];

			$product['data'][$i]['num'] = base64_encode($product['data'][$i]['num']);
			}
    }
	$slide = Slide::listAll();
	$slide2 = array();
	 if(count($slide) > 0){
                $slide1 = $slide[0];
             if(count($slide) > 1){
                for ($i=1;$i<count($slide);$i++){
                array_push($slide2, $slide[$i]);
                  $qtslide[$i]= $i; 
                }
            }
       }
    //novidades
    $news =  News::getPage(1,10);
    $blog =  Blog::getPage(1,10);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('home',array('slide1'=>$slide1,'slide2'=>$slide2,'qtslide'=>$qtslide,'product'=>$product['data'],'news'=>$news['data'],'blog'=>$blog['data']));
});
$app->get('/blog', function(){
	$blog = Blog::listAll();
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('blog',array('blog'=>$blog));
});
$app->get('/blog/detalhe-:num', function($num){
	$blog = new Blog();
	$blog->searchById($num);
	$posts = PostBlog::listAll($num);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('blog-detail',array('blog'=>$blog->getValues(),'posts'=>$posts));
});
$app->get('/novidades/detalhe-:num', function($num){
	$novidade = new News();
	$novidade->searchById($num);
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
   
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('novidade-detail',array('novidade'=>$novidade->getValues()));
});
$app->get('/produtos', function(){
	
	$retorno = isset($_SESSION['retorno'])?$_SESSION['retorno']:'';
	unset($_SESSION['retorno']);
	$cliente = Client::listAll();
	$categoria = Category::listAll();
	if(count($categoria) > 0){
			for ($i=0;$i<count($categoria);$i++){
			$categoria[$i]['num'] = base64_encode($categoria[$i]['num']);
			}
    }
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
    $category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('products',array('categoria'=>$categoria,'retorno'=>array('retorno'=>$retorno)));
});
$app->get('/produtos/search', function(){

	
	$search = isset($_GET['search'])? filter_var($_GET['search'], FILTER_SANITIZE_STRING)  : "";
	$page = isset($_GET['page'])? (int)$_GET['page'] : 1;
	$categoria = (isset($_GET['categoria']))? filter_var($_GET['categoria'], FILTER_SANITIZE_STRING) : "";
	
	if($categoria != '') {
		$categoria = base64_decode($categoria);
		$pagination = Product::getPageSearchCategory($categoria, $page,'50');
	} 
	else if ($search != '') {
		$pagination = Product::getPageSearch($search, $page,'20');
	} 
	else {
		$pagination = Product::getPage($page,'20');
	}
	if(count($pagination['data']) > 0){
		
			for ($i=0;$i<count($pagination['data']);$i++){
			$pagination['data'][$i]['description'] = (strlen($pagination['data'][$i]['description'])>17)?
			substr($pagination['data'][$i]['description'],0,17).'...':$pagination['data'][$i]['description'];

			$pagination['data'][$i]['num'] = base64_encode($pagination['data'][$i]['num']);
			}
    }
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{
		array_push($pages, array(
			'href'=>'/produtos?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));
	}
	$page = new Page(array('header'=>false,'footer'=>false));
	$page->setTpl('products-datas',array('product'=>$pagination['data'],'pages'=>$pages));
	
});
$app->get('/produtos/sugest', function(){
	if (isset($_GET['search']) && !empty($_GET['search'])) 
	{
		$search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
		$produtos = ProdutoVendedor::getPageSearchAll($search,1,'5');
		if(count($produtos['data'])>0){
		echo "<ul class='panel panel-default' >";
		foreach ($produtos['data'] as $key => $value) {
			echo "<li><a href='' class='link-sugest'>".substr($value['descricao'],0,40).'</a></li>';
		}
		echo "</ul>";
	    }
	}
});
$app->get('/produto/:num', function($num){
	$num = base64_decode($num);
	$retorno = isset($_SESSION['retorno'])?$_SESSION['retorno']:'';
	$product = new Product();
	$product->searchById($num);
	$product = $product->getValues();
	$product['num'] = base64_encode($product['num']);
    $productimg = ProductImg::listAll($num);
    $feature = ProductFeature::listAll($num);
	/*
	if(count($pagination) > 0){
		
			for ($i=0;$i<count($pagination);$i++){
				$pagination[$i]['num'] = base64_encode($pagination[$i]['num']);
				$pagination[$i]['description'] = (strlen($pagination[$i]['description'])>17)?
			substr($pagination[$i]['description'],0,17).'...':$pagination[$i]['description'];
				
			}
    }*/
    //mudança de menu quando o usuario loga
    
	//total de produtos no  carrinho
   
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('product-detail',array('product'=>$product,'productimg'=>$productimg,'feature'=>$feature,'retorno'=>array('retorno'=>$retorno)));
});
$app->get('/carrinho', function(){

	if(isset($_SESSION['Cart']['num'])){
    $carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
	
	//total de produtos no  carrinho
  	$numrowcarrinho = array('total'=>count($carrinho[0]));
    $category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('cart',array('products'=>$carrinho[0],'vtotal'=>array('vtotal'=>$carrinho[1]['vtotal'])));
	}else{ 
	 $_SESSION['retorno'] = "Selecione produtos antes de abrir o carrinho!";
	 header('Location:/produtos');
     exit;
    }
});
$app->get('/carrinho/add/:num/', function($num){
	 
	 $num = base64_decode($num);
	 $produto = new Product();
	 $produto->searchById($num); 
	 $tamanho = isset($_GET['tamanho'])?$_GET['tamanho']:'';
	 $cor = isset($_GET['cor'])?$_GET['cor']:'';
     $carrinho = new CartProduct();
	 $carrinho->setValue('description',$produto->getValue('description')." | $tamanho $cor");
	 $carrinho->setValue('price',$produto->getValue('price'));
	 $carrinho->setValue('product',$produto->getValue('num'));
	 $carrinho->setValue('amount',1);
	 $carrinho->add();
	 header('Location:/produtos');
     exit;
	 
});
$app->get('/carrinho/remove/:num', function($num){
	 //$num = base64_decode($num);
     $carrinho = new CartProduct();
	 $carrinho->setValue('product',$num);
     $carrinho->delete();
	 header('Location:/carrinho');
     exit;
	 
});
$app->get('/carrinho/cancel', function(){
	 
     unset($_SESSION['Cart']);
	 header('Location:/produtos');
     exit;
	 
});
$app->post('/carrinho/update', function(){
     foreach($_POST as $k => $v){
	 $carrinho = new CartProduct();
	 $carrinho->setValue('product',$k);
	 $carrinho->setValue('amount',$v);
     $carrinho->update();
	 } 
	 header('Location:/carrinho');
     exit;
});
$app->get('/carrinho/finalizar', function(){
     if(isset($_SESSION['Cart']['num'])){
	     Customer::verifyLogin('finalizar');
	     $email = new Email();
	     $numcliente = $_SESSION['Customer']['num']; 
		 $nomecliente = $_SESSION['Customer']['name'];
		 $carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
		 $carrinhosimple = CartProduct::listAllByCartSimple($_SESSION['Cart']['num']);

		 $hash = base64_encode($_SESSION['Cart']['num'].' '.$carrinho['1']['vtotal'].' '.date('Y-m-d h:i:s'));
		 //Salva na base de dados
		 $encomenda = new Cart();
		 $encomenda->searchById($_SESSION['Cart']['num']); 
		 $encomenda->setValue('global_value',$carrinho['1']['vtotal']);
		 $encomenda->setValue('customer',$_SESSION['Customer']['num']);
		 $encomenda->setValue('date_end',date('Y-m-d h:i:s')); 
		 $encomenda->setValue('hash',$hash);
		 $encomenda->update(); 

		 // Envia o Email e a msg (alerta)
		 $produtosemail = '';
         $produtosmsg = '';
         $carrinho2 = $carrinho[0];
		for ( $i = 0; $i < count($carrinho2); $i++){

				$produtosmsg .= 'Produto: '.$carrinho2[$i]['num'].' - '.$carrinho2[$i]['description_product'].' - Qtd: '. $carrinho2[$i]['amount'].' Preço: '.$carrinho2[$i]['price'].'AKZ </td></tr>';		
		 }
		 $msg = new Msg();
		 $msg->setValue('name',$_SESSION['Customer']['name'].' - '.$_SESSION['Customer']['tel']);
         $msg->setValue('subject','Encomenda de Produtos');
         $msg->setValue('note',$produtosmsg);
         $msg->setValue('email',$_SESSION['Customer']['email']);
         $msg->setValue('tel',$_SESSION['Customer']['tel']);
		 $msg->save();
         	/*if(($_SESSION['Customer']['status_email'] =='sim') && !empty($_SESSION['Customer']['email']))
		 	{
         		$email->send('Encomenda de produto', 
         			"<a href='https://www.uzomashop.com/'>
				 	       <img src='https://www.uzomashop.com/img/logo.png' width='40'>
				 	</a>
				 	<h2 style='color:#28a745'> Uzoma Shop | Encomenda de Produto </h2>
         			<p>Caro cliente, eis a nota da sua encomenda feita no Kikolo Online 
         			<table style='border-color:#aaaaaa;' border='1px' width='600px' cellspacing='0'>
         			<tr align='center' style='background-color:#aaa'><td> nome do produto </td><td> quantidade </td><td> preço </td></tr>
         			".$produtosemail.'</table>
         			<p><strong> Valor Total:</strong> '.$carrinho[1]['vtotal'].' AKZ </p>
         			<small>data: ('.$encomenda->getValue('date_end').')</small>','',$_SESSION['Customer']['email']);
         	}*/
        unset($_SESSION['Cart']);
		//mudança de menu quando o usuario loga

		//total de produtos no  carrinho 
         
		//$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowscarrinho = array('total'=>0);
    
		$category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
	    }else{
	  		$numrowcart = array('total' => 0 );
	    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	    $page->setTpl('cartend',array('produtos'=>$carrinho[0],'vtotal'=>array('vtotal'=>$carrinho[1]['vtotal'])));
	 	
	 }else{
	  $_SESSION['retorno'] = "Selecione produtos antes de abrir o carrinho!";
      header('Location:/produtos');
      exit;
	  }
	
});
$app->get('/vendedor', function(){
	
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('vendedor',array());
});
$app->get('/pagamentos-e-entregas', function(){
	
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('pagamento-entrega',array());
});
$app->get('/login', function(){
	$retorno = isset($_SESSION['retorno'])?$_SESSION['retorno']:' ';
	unset($_SESSION['retorno']);
	//Cliente logado
	if(isset($_SESSION['Customer'])){
	
	$customer = new customer;
	$customer->searchById($_SESSION['Customer']['num']);
	//mudança de menu quando o usuario loga
	
	
	//total de produtos no  carrinho
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$carrinho = array('total'=>count($carrinho[0]));
    }else{
  		$carrinho = array('total' => 0 );
    }
	$category = Category::listAll();
	if(count($category) > 0){
			for ($i=0;$i<count($category);$i++){
			$category[$i]['num'] = base64_encode($category[$i]['num']);
			}
    }
	$company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('perfil-cliente',array('customer'=>$customer->getValues(),'retorno'=>array('retorno'=>$retorno)));
	}else{
	//Cliente não logado
		if(isset($_SESSION['Cart']['num'])){
	  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
	  		$carrinho = array('total'=>count($carrinho[0]));
	    }else{
	  		$carrinho = array('total' => 0 );
	    } 
	    //Menu
	    $category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
		$page->setTpl('login',array('retorno'=>array('retorno'=>$retorno)));
		}
});
$app->post('/login', function(){ 
	$page = isset($_GET['page'])?$_GET['page']:'login';
	Customer::login($_POST['user'],$_POST['pass'],$page);
	exit;
});
$app->get('/verifyuser', function(){
	$usuario = new Customer();
	$usuario->searchByIdsimple($_GET['num']);
	if(!empty($usuario->getValues())){
		echo "Este número já foi cadastrado!";
	}
});
$app->get('/logout/:perfil', function($perfil){
   Customer::logout($perfil);
});
$app->get('/cliente/desativar', function(){
    Customer::verifyLogin();
	$usuario = new Customer();
	$usuario->searchById($_SESSION['Cliente']['num'],'Cliente');
	$usuario->disableAccount();
	$_SESSION['retorno']='A sua conta foi desactivada com sucesso. Para voltar a reativa-la inicie a sessão novamente.';
	header('Location:/logout/Cliente'); 
	exit;
});
$app->post('/usuario/novo', function(){
	$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{
		//criptografa a senha
		$senha = $_POST['pass'];
		$_POST['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT, array('cost'=>12));
		//validação dos campos
		$_POST['email'] = isset($_POST['email'])?(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)):'';
		$_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

		$_POST['tel'] = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
		//verifica se o usuario já foi cadastrado
		$verifyuser = new Customer();
		$verifyuser->searchByIdsimple($_POST['tel']);
		if(!empty($verifyuser->getValues())){
			$_SESSION['retorno']='Este número já está registado no Uzoma.';
			header('Location:/login');
		   
            exit;
		}

		$usuario = new Customer();
		$usuario->setValues($_POST);
		$usuario->save();
		Customer::login($_POST['tel'],$senha,'login');
	}
	else
	{
		$_SESSION['retorno'] = "Não permitimos que Rôbos usem a nossa plataforma!";
		header('Location:/login');
   	    exit;
	}
});
$app->get('/usuario/novo/reenviar',function(){
	if(isset($_SESSION['Cadastro'])){
	   Customer::confirmTelephoneStep1($_SESSION['Cadastro']['usuario']);
	   header('Location:/usuario/novo/confirmar');
       exit;
    }
});
$app->get('/usuario/novo/confirmar',function(){
			
    		//Menu
		

		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	 	$page->setTpl('confirmtelephone');
	
});
$app->post('/usuario/novo/confirmar', function(){
	if(isset($_SESSION['Cadastro'])){
		$usuario = $_SESSION['Cadastro']['usuario'];
		$senha = $_SESSION['Cadastro']['senha'];
		$perfil = $_SESSION['Cadastro']['perfil'];
    	Customer::confirmTelephoneStep2($usuario,$_POST['senha'],$perfil);
    	unset($_SESSION['Cadastro']);
    	Customer::login($usuario,$senha,$perfil,'login');
   }
});
$app->post('/usuario/atualizar', function(){
	Customer::verifyLogin();
	$usuario = new Customer();
	$usuario->searchById($_SESSION['Customer']['num']);
	$usuario->setValues($_POST);
	$usuario->update();
	header('Location:/login');
	exit;
});
$app->get('/fotoperfil/cliente', function(){
	Customer::verifyLogin();

    $page = new Page(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimage');	 
});
$app->post('/fotoperfil/cliente', function(){
	Customer::verifyLogin();
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/usuarios/'.rand().date('YmdHis').'.png'; 
		$usuario = new Usuario();
		$usuario->searchById($_SESSION['Cliente']['num'],'Cliente');
		$usuario->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($usuario->getValue('img'))){
                   if($usuario->getValue('img') != 'img/sem imagem.jpg')unlink($usuario->getValue('img'));
				}
				$usuario->setValue('img',$imageName);
				$_SESSION['Cliente'] = $usuario->getValues();
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/usuario/senha', function(){
	Customer::verifyLogin('Cliente');
    $sessao = isset($_SESSION['Cliente'])?$_SESSION['Cliente']:NULL;
	if(isset($_SESSION['Encomenda']['num'])){
  		$carrinho = Carrinho::listAllByCart($_SESSION['Encomenda']['num']);
  		$carrinho = array('total'=>count($carrinho[0]));
    }else{
  		$carrinho = array('total' => 0 );
    }
    $category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('change-password',array('cliente'=>$sessao));	 
});
$app->post('/usuario/senha', function(){
	Customer::verifyLogin('Cliente');
    $user = new Customer();
	$user->changePassword($_SESSION['Customer']['tel'],$_POST['oldpassword'],$_POST['newpassword']);
	header('Location:/login');
	exit; 
});
//recuperar senha
$app->post('/usuario/confirmarsenha-:perfil', function($perfil){
	Customer::recoverPasswordStep2($_POST['usuario'],$_POST['senha'],$perfil);
});
$app->get('/usuario/recuperarsenha-:perfil', function($perfil){
	

	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('recover',array('perfil'=>array('perfil'=>$perfil)));	 
});
$app->post('/usuario/recuperarsenha-:perfil', function($perfil){
	$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{
		$usuario = $_POST["usuario"];
		
        $dados= new Customer();
        $dados->searchByIdsimple($usuario);
        if(!empty($dados->getValues())){
        	$senharecuperacao = random_int(10000, 1000000);
        	$senharecuperacaocifrada = password_hash($senharecuperacao, PASSWORD_DEFAULT, array("cost"=>12));;
        	$msg = "
        	<a href='https://www.uzomashop.com/'>
				 	       <img src='https://www.uzomashop.com/img/logo.png' width='40'>
				 	</a>
			<h2 style='color:#28a745'> uzomashop | Redefinir senha </h2>
        	<p> A sua conta do uzomashop solicitou uma recuperação de senha. 
        o código para confirmar a recuperação é $senharecuperacao. Se não solicitou recuperação da sua senha apague por favor este email.</p>  
            <p>Observe que o link é válido por 24 horas. Depois que o limite de tempo expirar, você precisará reenviar a solicitação de redefinição de senha.</p>";
			//gravar dados da recuperação
        	Usuario::recoverPasswordStep1($dados->getValue('usuario'),$senharecuperacaocifrada);

			//envio do email
        	$email = new Email();
        	$email->send('Redefinir da Senha',$msg,' ',$dados->getValue('email'));

        	
    		//Menu

			if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
			$page->setTpl('recoverconfirm',array('usuario'=>array('usuario'=>$usuario),'perfil'=>array('perfil'=>$perfil)));
        } else {
        $_SESSION['retorno'] = " Este número de telefone é inválido!";
        header('Location:/login');
        }
   		exit;
	}
	else
	{
		$_SESSION['retorno'] = "Não permitimos que Rôbos usem a nossa plataforma!";
		header('Location:/usuario/recuperarsenha');
   		exit;
	} 
});
$app->get('/sobre', function(){
		$category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
		$page->setTpl('about');
});
$app->get('/faq', function(){
	//mudança de menu quando o usuario loga
    

	
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('faq');
});
$app->get('/contactos', function(){
		$category = Category::listAll();
		if(count($category) > 0){
				for ($i=0;$i<count($category);$i++){
				$category[$i]['num'] = base64_encode($category[$i]['num']);
				}
	    }
		$company = Company::listAll();
		$contact = ContactCompany::listAll();
		$value = ValueCompany::listAll();
		if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
	    }else{
	  		$numrowcart = array('total' => 0 );
	    }
		$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
		$page->setTpl('contact');
});
$app->post('/contactos', function(){	
	$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{
		$msg = new Msg(); 
		$_POST['nickname'] = ' ';
		$msg->setValues($_POST);
		$msg->save();
		header('Location:/contactos');
		exit;
    }
	header('Location:/contactos');
	exit;

});
$app->get('/termos', function(){
    

	//total de produtos no  carrinho
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = Carrinho::listAllByCart($_SESSION['Cart']['num']);
  		$carrinho = array('total'=>count($carrinho[0]));
    }else{
  		$carrinho = array('total' => 0 );
    }
	if(isset($_SESSION['Cart']['num'])){
  		$carrinho = CartProduct::listAllByCart($_SESSION['Cart']['num']);
  		$numrowcart = array('total'=>count($carrinho[0]));
    }else{
  		$numrowcart = array('total' => 0 );
    }
    $category = Category::listAll();
    $company = Company::listAll();
	$contact = ContactCompany::listAll();
	$value = ValueCompany::listAll();
	$page = new Page(array('data'=>array('company'=>$company[0],'contact'=>$contact,'value'=>$value,'category'=>$category,'numrowcart'=>$numrowcart)));
	$page->setTpl('terms');
});
$app->post('/newsletter/new', function(){
	/*$recaptcha = Recaptcha::execute($_POST['g-recaptcha-response']);
	if($recaptcha===true)
	{*/
		$newsletter = new Newsletter(); 
		$newsletter->setValues($_POST);
		$newsletter->save();
		header('Location:/home');
	exit; 
	
});
$app->get('/politica', function(){
    echo "Página indisponível!";
});


// Rotas administrativas
$app->get('/config/login', function(){
    $page = new PageAdmin(array("header"=>false,"footer"=>false));
	$page->setTpl('login');
});
$app->post('/config/login', function() {
	User::login($_POST['user'], $_POST['password']);
	exit;
});
$app->get('/config/', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('home');
});
$app->get('/config/logout', function(){
    User::logout();
});
//users
$app->get('/config/users', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = User::getPageSearch($search, $page);
	} else {
		$pagination = User::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/users?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('user',array('users'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/users/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('user-new');
});
$app->post('/config/user/new', function(){	
	User::verifyLogin();
	$user = new User();
	$senha = '12345';
 	$_POST['password'] = password_hash($senha, PASSWORD_DEFAULT, array("cost"=>12));
	$user->setValues($_POST);
	$user->save();
	header('Location:/config/users');
	exit; 
});
$app->get('/config/users/:num/delete', function($num){
	User::verifyLogin();
	$user = new User();
	$user->searchById($num);
    $user->delete();
	header('Location:/config/users');
	exit;
});
$app->get('/config/users/change-password', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('change-password');	 
});
$app->post('/config/users/change-password', function(){
	User::verifyLogin();
    $user = new User();
	$user->changePassword($_SESSION['user']['user'],$_POST['oldpassword'],$_POST['newpassword']);
	header('Location:/config/users');
	exit; 
});
$app->get('/config/users/:num', function($num){
	User::verifyLogin();
	$user = new User();
	$user->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('user-update',array('user'=>$user->getValues())); 
});
$app->post('/config/users/:num', function($num){
	User::verifyLogin();
	$user = new User();
	$user->searchById($num);
	$user->setValues($_POST);
	$user->update();
	header('Location:/config/users');
	exit; 
});

//slide
$app->get('/config/slide', function(){
	User::verifyLogin();
	$slide = Slide::listAll();
    $page = new PageAdmin();
	$page->setTpl('slide',array('slide'=>$slide));
});
$app->get('/config/slide/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('slide-new');
});
$app->post('/config/slide/new', function(){	
	User::verifyLogin();
	$slide = new Slide();
	$_POST['user'] = $_SESSION['user']['user'];
	$slide->setValues($_POST);
	$slide->save();
	header('Location:/config/slide');
	exit; 
});
$app->get('/config/slide/img-:num', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageslide',array('slide'=>$slide->getValues()));	 
});
$app->post('/config/slide/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/slide/'.rand().date('YmdHis').'.png'; 
		$slide = new Slide();
		$slide->searchById($num);
		$slide->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($slide->getValue('img'))){
                  if($slide->getValue('img') != 'img/sem imagem.jpg')unlink($slide->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/slide/:num/delete', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
    $slide->delete();
	if(file_exists($slide->getValue('img'))){
                  if($slide->getValue('img') != 'img/sem imagem.jpg')unlink($slide->getValue('img'));
				}
	header('Location:/config/slide');
	exit;
});
$app->get('/config/slide/:num', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('slide-update',array('slide'=>$slide->getValues()));
});
$app->post('/config/slide/:num', function($num){
	User::verifyLogin();
	$slide = new Slide();
	$slide->searchById($num);
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		if(file_exists($slide->getValue('img'))){	
			unlink($slide->getValue('img'));
		}
		UploadImg::upload('img/slide/',$_FILES);
	}
	$_POST['user'] = $_SESSION['user']['user'];
	$slide->setValues($_POST);
	$slide->update();
	header('Location:/config/slide');
	exit; 
});
//product
$app->get('/config/product', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = Product::getPageSearch($search, $page);
	} else {
		$pagination = Product::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/product?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('product',array('product'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/product/new', function(){
	User::verifyLogin();
	$category = Category::listAll();
    $page = new PageAdmin();
	$page->setTpl('product-new',array('category'=>$category));
});
$app->post('/config/product/new', function(){	
	User::verifyLogin();
	$product = new Product();
	$_POST['user'] = $_SESSION['user']['user'];
	$product->setValues($_POST);
	$product->save();
	header('Location:/config/product');
	exit; 
});
$app->get('/config/product/img-:num', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageproduct',array('product'=>$product->getValues()));	 
});
$app->post('/config/product/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/produtos/'.rand().date('YmdHis').'.png'; 
		$product = new Product();
		$product->searchById($num);
		$product->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/product/verimagens-:num', function($num){
	User::verifyLogin();
	$product = ProductImg::listAll($num);
    $page = new PageAdmin(array());
	$page->setTpl('productimg',array('product'=>$product,'num'=>$num));	 
});
$app->get('/config/productimg/add-:num', function($num){
	User::verifyLogin();
	$productimg = new ProductImg();
	$productimg->setValue('product',$num);
	$productimg->save();
	header("Location:/config/product/verimagens-$num");
	exit; 
});
$app->get('/config/productimg/img-:num-:numproduct', function($num,$numproduct){
	User::verifyLogin();
	$product = new ProductImg();
	$product->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageproducts',array('product'=>$product->getValues(),'num'=>$numproduct));	 
});
$app->post('/config/productimg/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/produtos/'.rand().date('YmdHis').'.png'; 
		$product = new ProductImg();
		$product->searchById($num);
		$product->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/productimg/:num/delete', function($num){
	User::verifyLogin();
	$product = new ProductImg();
	$product->searchById($num);
    $product->delete();
	if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
	header("Location:/config/product/verimagens-".$product->getValue('product'));
	exit;
});
//features
$app->get('/config/productfeature/:num', function($num){
	User::verifyLogin();
	$product = ProductFeature::listAll($num);
    $page = new PageAdmin(array());
	$page->setTpl('productfeature',array('product'=>$product,'num'=>$num));	 
});
$app->post('/config/productfeature/add-:num', function($num){
	User::verifyLogin();
	$productimg = new ProductFeature();
	$productimg->setValue('product',$num);
	$productimg->setValues($_POST);
	$productimg->save();
	header("Location:/config/productfeature/$num");
	exit; 
});
$app->get('/config/productfeature/:num/delete', function($num){
	User::verifyLogin();
	$product = new ProductFeature();
	$product->searchById($num);
    $product->delete();
	header("Location:/config/productfeature/".$product->getValue('product'));
	exit;
});
//end feature
$app->get('/config/product/:num/delete', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);
    $product->delete();
	if(file_exists($product->getValue('img'))){
                  if($product->getValue('img') != 'img/sem imagem.jpg')unlink($product->getValue('img'));
				}
	header('Location:/config/product');
	exit;
});
$app->get('/config/product/:num', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);
	$category = Category::listAll();
    $page = new PageAdmin();
	$page->setTpl('product-update',array('product'=>$product->getValues(),'category'=>$category));
});
$app->post('/config/product/:num', function($num){
	User::verifyLogin();
	$product = new Product();
	$product->searchById($num);	
	$_POST['user'] = $_SESSION['user']['user'];
	$product->setValues($_POST);
	$product->update();

	header('Location:/config/product');
	exit; 
});
//Category
$app->get('/config/category', function(){
	User::verifyLogin();
	$category = Category::listAll();
    $page = new PageAdmin();
	$page->setTpl('category',array('category'=>$category));
});
$app->get('/config/category/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('category-new');
});
$app->post('/config/category/new', function(){
	
	User::verifyLogin();
	$category = new Category(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$category->setValues($_POST);
	$category->save();
	header('Location:/config/category');
	exit; 
	
});
$app->get('/config/category/:num/delete', function($num){
	
	User::verifyLogin();
	$category = new Category();
	$category->searchById($num);
    $category->delete();
	header('Location:/config/category');
	exit;
});
$app->get('/config/category/:num', function($num){
	
	User::verifyLogin();
	$category = new Category();
	$category->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('category-update',array('category'=>$category->getValues()));
	 
});
$app->post('/config/category/:num', function($num){
	User::verifyLogin();
	$category = new Category();
	$category->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$category->setValues($_POST);
	$category->update();
	header('Location:/config/category');
	exit; 
});
//Newsletter
$app->get('/config/newsletter', function(){
	User::verifyLogin();

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$pagination = Newsletter::getPage($page);
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{
		array_push($pages, array(
			'href'=>'/config/newsletter?'.http_build_query(array(
				'page'=>$x+1,
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('newsletter',array('newsletter'=>$pagination['data'],'pages'=>$pages));
});
$app->get('/config/newsletter/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('newsletter-new');
});
$app->post('/config/newsletter/new', function(){
	
	User::verifyLogin();
	$newsletter = new Newsletter(); 
	$newsletter->setValues($_POST);
	$newsletter->save();
	header('Location:/config/newsletter');
	exit; 
	
});
$app->get('/config/newsletter/compose', function(){
	
	User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl('newsletter-compose');
	
});
$app->post('/config/newsletter/compose', function(){
	User::verifyLogin();
	$newsletter = Newsletter::listAllEmail();
	$image = $_FILES['img']['name'];
	$email = new Email();
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		UploadImg::upload('img/newsletter/',$_FILES);
		$image = $_POST['img'];
	}else{
		$image = '';
	}
	foreach($newsletter as $value){
		$email->send($_POST['subject'],$_POST['msg'],$image,$value['email']);
	}
	if(file_exists($image)){
		unlink($image);
	}
	header('Location:/config/newsletter');
	exit;
});
$app->get('/config/newsletter/:num/delete', function($num){
	
	User::verifyLogin();
	$newsletter = new Newsletter();
	$newsletter->searchById($num);
    $newsletter->delete();
	header('Location:/config/newsletter');
	exit;
});
$app->get('/config/newsletter/:num', function($num){
	
	User::verifyLogin();
	$newsletter = new Newsletter();
	$newsletter->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('newsletter-update',array('newsletter'=>$newsletter->getValues()));
	 
});
$app->post('/config/newsletter/:num', function($num){
	User::verifyLogin();
	$newsletter = new Newsletter();
	$newsletter->searchById($num);
	$newsletter->setValues($_POST);
	$newsletter->update();
	header('Location:/config/newsletter');
	exit; 
});
//News
$app->get('/config/news', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = News::getPageSearch($search, $page);
	} else {
		$pagination = News::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/news?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('news',array('news'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/news/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('news-new');
});
$app->post('/config/news/new', function(){
	User::verifyLogin();
	$news = new News(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$news->setValues($_POST);
	$news->save();
	header('Location:/config/news');
	exit; 	
});
$app->get('/config/news/img-:num', function($num){
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimagenews',array('news'=>$news->getValues()));	 
});
$app->post('/config/news/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/novidades/'.rand().date('YmdHis').'.png'; 
		$news = new News();
		$news->searchById($num);
		$news->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($news->getValue('img'))){
                  if($news->getValue('img') != 'img/sem imagem.jpg')unlink($news->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/news/:num/delete', function($num){
	
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
    $news->delete();
	if(file_exists($news->getValue('img'))){
                  if($news->getValue('img') != 'img/sem imagem.jpg')unlink($news->getValue('img'));
				}
	header('Location:/config/news');
	exit;
});
$app->get('/config/news/:num', function($num){
	
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('news-update',array('news'=>$news->getValues()));
	 
});
$app->post('/config/news/:num', function($num){
	User::verifyLogin();
	$news = new News();
	$news->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$news->setValues($_POST);
	$news->update();
	header('Location:/config/news');
	exit; 
});
//Client
$app->get('/config/client', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = Client::getPageSearch($search, $page);
	} else {
		$pagination = Client::getPage($page);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/client?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('client',array('client'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/client/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('client-new');
});
$app->post('/config/client/new', function(){
	
	User::verifyLogin();
	$client = new Client(); 
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		UploadImg::upload('img/clientes/',$_FILES);
	}
	$_POST['user'] = $_SESSION['user']['user'];
	$client->setValues($_POST);
	$client->save();
	header('Location:/config/client');
	exit; 
	
});
$app->get('/config/client/img-:num', function($num){
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageclient',array('client'=>$client->getValues()));	 
});
$app->post('/config/client/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/clientes/'.rand().date('YmdHis').'.png'; 
		$client = new Client();
		$client->searchById($num);
		$client->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($client->getValue('img'))){
                  if($client->getValue('img') != 'img/sem imagem.jpg')unlink($client->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/client/:num/delete', function($num){
	
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
    $client->delete();
	if(file_exists($client->getValue('img'))){
                  if($client->getValue('img') != 'img/sem imagem.jpg')unlink($client->getValue('img'));
				}
	header('Location:/config/client');
	exit;
});
$app->get('/config/client/:num', function($num){
	
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('client-update',array('client'=>$client->getValues()));
	 
});
$app->post('/config/client/:num', function($num){
	User::verifyLogin();
	$client = new Client();
	$client->searchById($num);
	if(!empty($_FILES['img']['tmp_name']) && !empty($_FILES['img']['name'])){
		if(file_exists($client->getValue('img'))){	
			unlink($client->getValue('img'));
		}
		UploadImg::upload('img/clientes/',$_FILES);
	} 
	$_POST['user'] = $_SESSION['user']['user'];
	$client->setValues($_POST);
	$client->update();
	header('Location:/config/client');
	exit; 
});
//blog
$app->get('/config/blog', function(){
	User::verifyLogin();
	$blog = Blog::listAll();
    $page = new PageAdmin();
	$page->setTpl('blog',array('blog'=>$blog));
});
$app->get('/config/blog/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('blog-new');
});
$app->post('/config/blog/new', function(){
	
	User::verifyLogin();
	$blog = new Blog(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$blog->setValues($_POST);
	$blog->save();
	header('Location:/config/blog');
	exit; 
	
});
$app->get('/config/blog/img-:num', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimageblog',array('blog'=>$blog->getValues()));	 
});
$app->post('/config/blog/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/clientes/'.rand().date('YmdHis').'.png'; 
		$blog = new Blog();
		$blog->searchById($num);
		$blog->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($blog->getValue('img'))){
                  if($blog->getValue('img') != 'img/sem imagem.jpg')unlink($blog->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/blog/:num/delete', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num);
    $blog->delete();
	if(file_exists($blog->getValue('img'))){
                  if($blog->getValue('img') != 'img/sem imagem.jpg')unlink($blog->getValue('img'));
				}
	header('Location:/config/blog');
	exit;
});
$app->get('/config/blog/:num', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num); 
    $page = new PageAdmin();
	$page->setTpl('blog-update',array('blog'=>$blog->getValues())); 
});
$app->post('/config/blog/:num', function($num){
	User::verifyLogin();
	$blog = new Blog();
	$blog->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$blog->setValues($_POST);
	$blog->update();
	header('Location:/config/blog');
	exit; 
});
//blog's post
$app->post('/config/blog-post/new', function(){
	
	User::verifyLogin();
	$post = new PostBlog(); 
	$_POST['user'] = $_SESSION['user']['user'];
	$post->setValues($_POST);
	$post->save();
	header("Location:/config/blog-post/".$_POST['numblog']);
	exit; 
	
});
$app->get('/config/blog-post/new/:num', function($num){
	User::verifyLogin();
    $page = new PageAdmin();
	$numblog = array('numblog'=>$num);
	$page->setTpl('post-new',array('numblog'=>$numblog));
});
$app->get('/config/blog-post/:num-:numb/delete', function($num,$numb){
	
	User::verifyLogin();
	$post = new PostBlog();
	$post->searchById($num);
    $post->delete();
	if(file_exists($post->getValue('img'))){
                  if($post->getValue('img') != 'img/sem imagem.jpg')unlink($post->getValue('img'));
				}
	header("Location:/config/blog-post/$numb");
	exit;
});
$app->get('/config/blog-post/:num-:numb/edit', function($num,$numb){
	User::verifyLogin();
	$post = new PostBlog();
	$numblog = array('numblog'=>$numb);
	$post->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('post-update',array('post'=>$post->getValues(),'numblog'=>$numblog)); 
});
$app->post('/config/blog-post/:num/edit', function($num){
	User::verifyLogin();
	$post = new PostBlog();
	$post->searchById($num);
	$_POST['user'] = $_SESSION['user']['user'];
	$post->setValues($_POST);
	$post->update();
	header("Location:/config/blog-post/".$_POST['numblog']);
	exit; 
});
$app->get('/config/blog-post/:num', function($num){
	User::verifyLogin();
	$post = PostBlog::listAll($num);
    $page = new PageAdmin();
	$numblog = array('numblog'=>$num);
	$page->setTpl('post',array('post'=>$post,'numblog'=>$numblog));
});
//Msg
$app->get('/config/msg', function(){
	User::verifyLogin();
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {
		$pagination = Msg::getPageSearch($search, $page,50);
	} else {
		$pagination = Msg::getPage($page,50);
	}
	$pages = array();
	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, array(
			'href'=>'/config/msg?'.http_build_query(array(
				'page'=>$x+1,
				'search'=>$search
			)),
			'text'=>$x+1
		));

	}
    $page = new PageAdmin();
	$page->setTpl('msg',array('msg'=>$pagination['data'],'search'=>$search,'pages'=>$pages));
});
$app->get('/config/msg/new', function(){
	User::verifyLogin();
    $page = new PageAdmin();
	$page->setTpl('msg-new');
});
$app->post('/config/msg/new', function(){	
	User::verifyLogin();
	$msg = new Msg(); 
	$msg->setValues($_POST);
	$msg->save();
	header('Location:/config/msg');
	exit; 	
});
$app->get('/config/msg/:num/delete', function($num){
	
	User::verifyLogin();
	$msg = new Msg();
	$msg->searchById($num);
    $msg->delete();
	header('Location:/config/msg');
	exit;
});
$app->get('/config/msg/:num', function($num){
	User::verifyLogin();
	$msg = new Msg();
	$msg->searchById($num);
    $page = new PageAdmin();
	$page->setTpl('msg-ready',array('msg'=>$msg->getValues())); 
});
$app->post('/config/msg/:num', function($num){
	User::verifyLogin();
	$msg = new Msg();
	$msg->searchById($num); 
	$_POST['user'] = $_SESSION['user']['user'];
	$msg->setValues($_POST);
	$msg->update();
	header('Location:/config/msg');
	exit; 
});
//company
$app->get('/config/company', function(){
	User::verifyLogin();
	$contacts = ContactCompany::listAll();
	$values = ValueCompany::listAll();
    $company = new Company();
	$company->searchById(1);
    $page = new PageAdmin();
	$page->setTpl('company',array('company'=>$company->getValues(),'value'=>$values,'contact'=>$contacts));
});
$app->post('/config/company-contact/new', function(){
	User::verifyLogin();
	$company = new ContactCompany(); 
	$company->setValues($_POST);
	$company->save();
	header('Location:/config/company');
	exit; 	
});
$app->get('/config/company/img-:num', function($num){
	User::verifyLogin();
	$company = new Company();
	$company->searchById($num);
    $page = new PageAdmin(array('header'=>false,'footer'=>false));
	$page->setTpl('cropimagelogo',array('company'=>$company->getValues()));	 
});
$app->post('/config/company/img-:num', function($num){
	User::verifyLogin('Vendedor');
    	if(isset($_POST["image"]))
		{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$ext = substr($image_array_1[0],5);
		$image_array_2 = explode(",", $image_array_1[1]); 
		$data = base64_decode($image_array_2[1]); 
		$imageName = 'img/'.rand().date('YmdHis').'.png'; 
		$company = new Company();
		$company->searchById($num);
		$company->updateImg($imageName);
		if($ext == 'image/png'){
			if(file_put_contents($imageName, $data)){
				if(file_exists($company->getValue('img'))){
                  if($company->getValue('img') != 'img/sem imagem.jpg')unlink($company->getValue('img'));
				}
				echo "<div class='alert alert-success'> Imagem carregada com sucesso! </div>";
   			}
   		}else{
   			echo "<div class='alert alert-danger'> Erro ao carregar a Imagem! </div>";
   		}
	}	 
});
$app->get('/config/company-contact/:num/delete', function($num){
	User::verifyLogin();
	$company = new ContactCompany(); 
    $company->searchById($num);
	$company->delete();
	header('Location:/config/company');
	exit; 	
});
$app->post('/config/company-value/new', function(){
	
	User::verifyLogin();
	$company = new ValueCompany(); 
	$company->setValues($_POST);
	$company->save();
	header('Location:/config/company');
	exit; 	
});
$app->get('/config/company-value/:num/delete', function($num){
	
	User::verifyLogin();
	$company = new ValueCompany(); 
	$company->searchById($num);
	$company->delete();
	header('Location:/config/company');
	exit; 	
});
$app->post('/config/company/:num', function($num){
	User::verifyLogin();
	$company = new Company();
	$company->searchById($num);
	$company->setValues($_POST);
	$company->update();
	header('Location:/config/company');
	exit; 
});
//fim Rotas administrativas


$app->run();

>>>>>>> 05ec1e533cd2dfd8ee43ca06c5785ee5adae8e1c
 ?>