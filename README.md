# Curso da RbTech de CodeIgniter

http://dev.rbtech.info/codeigniter-essencial-introducao-instalacao

REPOSITÓRIO ANTERIOR: https://github.com/josemalcher/rbtech-CodeIgniter-Essencial

---

## <a name="indice">Índice</a>

- [CodeIgniter Essencial - Introdução e instalação](#parte1)   
- [CodeIgniter Essencial - MVC e a estrutura de diretórios](#parte2)   
- [CodeIgniter Essencial - MVC na prática](#parte3)   
- [CodeIgniter Essencial - Download do curso](#parte4)   
- [CodeIgniter Essencial - Criando um site parte 1](#parte5)   
- [CodeIgniter Essencial - Criando um site parte 2](#parte6)   
- [CodeIgniter Essencial - Criando um site parte 3](#parte7)   
- [CodeIgniter Essencial - Criando um painel parte 1](#parte8)   
- [CodeIgniter Essencial - Criando um painel parte 2](#parte9)   
- [CodeIgniter Essencial - Criando um painel parte 3](#parte10)   
- [CodeIgniter Essencial - Criando um painel parte 4](#parte11)   
- [CodeIgniter Essencial - Criando um painel parte 5](#parte12)   
- [CodeIgniter Essencial - Criando um painel parte 6](#parte13)   



---

## <a name="parte1">CodeIgniter Essencial - Introdução e instalação</a>

http://dev.rbtech.info/codeigniter-essencial-introducao-instalacao

https://codeigniter.com/

[Voltar ao Índice](#indice)

---

## <a name="parte2">CodeIgniter Essencial - MVC e a estrutura de diretórios</a>

http://dev.rbtech.info/codeigniter-essencial-mvc-estrutura-diretorios

[Voltar ao Índice](#indice)

---

## <a name="parte3">CodeIgniter Essencial - MVC na prática</a>

#### htdocs\rbtech_ci\application\controllers\Base.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Base extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }
  
    public function index()
    {
        
    }
}

```
#### htdocs\rbtech_ci\application\controllers\Exemplo1.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exemplo1 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Exemplo1_model','apelido_model');
    }

    public function index()
    {
        //echo "teste";
        $dados['titulo'] = 'Texto de Título';
        $dados['conteudo'] = 'The page you are looking at is being generated dynamically by CodeIgniter.';
        $this->load->view('Exemplo1',$dados);
    }
    public function login(){
        //echo "login - Recupednado o segmento";
        //echo $this->uri->segment(3);
        $this->apelido_model->salvar();
    }
}

```

#### htdocs\rbtech_ci\application\models\Exemplo1_model.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exemplo1_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function salvar(){
        echo "Executando do MODEL - salvar";
    }


}
```

#### htdocs\rbtech_ci\application\views\exemplo1.php
```html
<div id="container">
	<h1><?php echo $titulo ?></h1>
	<div id="body">
		<p><?php echo $conteudo ?></p>
	</div>

</div>
```



[Voltar ao Índice](#indice)

---

## <a name="parte4">CodeIgniter Essencial - Download do curso</a>



[Voltar ao Índice](#indice)

---

## <a name="parte5">CodeIgniter Essencial - Criando um site parte 1</a>



[Voltar ao Índice](#indice)

---

## <a name="parte6">CodeIgniter Essencial - Criando um site parte 2</a>



[Voltar ao Índice](#indice)

---

## <a name="parte7">CodeIgniter Essencial - Criando um site parte 3</a>

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagina extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $dados['titulo'] = 'Titulo do Site';

        $this->load->view('header',$dados);
        $this->load->view('home');
        $this->load->view('noticias');
        $this->load->view('footer');
    }

    public function sobre(){
        $dados['titulo'] = 'Sobre - Titulo do Site';

        $this->load->view('header', $dados);
        $this->load->view('sobre');
        $this->load->view('noticias');
        $this->load->view('footer');
    }

    public function contato()
    {
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'email'));
        
        //Regras de validação do formulario
        $this->form_validation->set_rules('nome','Nome', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mensagem','Mensagem', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $dados['formerror'] = validation_errors();
        }else{
            $dados_form = $this->input->post();
            $this->email->from($dados_form['email'],$dados_form['nome']);
            $this->email->to('email@email.com.br');
            //$this->email->subject($dados_form['assunto']);
            $this->email->message($dados_form['mensagem']);
            if($this->email->send()){
                $dados['formerror'] = 'ENVIADO COM SUCESSO';
            }else{
                $dados['formerror'] = 'ERRO AO ENVIARR';
            }
            // OBS.: É necessário configurar o servidor para envio de email
        }

        
        $dados['titulo'] = 'contato - Titulo do Site';
        $this->load->view('header', $dados);
        $this->load->view('contato',$dados);
        //$this->load->view('noticias');
        $this->load->view('footer');
    }
}

```

```html
<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">

        <?php 
          if($formerror){
            echo '<h4>' . $formerror .'</h4>';
          }
          echo form_open('pagina/contato',array('class'=> 'form-horizontal'));
          echo "<fieldset><legend class='text - center'>Contact us</legend>";
            echo form_label('seu nome', 'nome');
            echo form_input('nome', set_value('nome'), array('class' => 'form-control'));
            echo form_label('seu email', 'email');
            echo form_input('email', set_value('email'), array('class' => 'form-control'));
            echo form_label('Mensagem', 'mensagem');
            echo form_textarea('mensagem', set_value('mensagem'), array('class' => 'form-control'));
            echo form_submit('enviar', 'Enviar Mensagem', array('class'=> 'btn btn-primary'));
          echo "</fieldset>";
          echo form_close();
        
        ?>
        </div>
      </div>
	</div>
</div>
```


[Voltar ao Índice](#indice)

---

## <a name="parte8">CodeIgniter Essencial - Criando um painel parte 1</a>



[Voltar ao Índice](#indice)

---

## <a name="parte9">CodeIgniter Essencial - Criando um painel parte 2</a>

igual ao : 

https://github.com/josemalcher/rbtech-CodeIgniter-Essencial#parte9

#### Ajuste em login

```php
public function login(){
        if ($this->option->get_option('setup_executado') != 1) :
            //SETUP NÃO OK, mostrar tela para instalar o sistema
        redirect('setup/instalar', 'refresh');
        endif;
        //regras de validação
        $this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');

        // verifica a validação
        if ($this->form_validation->run() == false) :
            if (validation_errors()) :
                set_msg(validation_errors());
            endif;
        else :
            $dados_form = $this->input->post();
            if ($this->option->get_option('user_login') == $dados_form['login']) :
                //usuário existe
                if (password_verify($dados_form['senha'], $this->option->get_option('user_pass'))) :
                        //senha ok, fazer login
                    $this->session->set_userdata('logged', true);
                    $this->session->set_userdata('user_login', $dados_form['login']);
                    $this->session->set_userdata('user_email', $this->option->get_option('user_email'));
                        // Fazer redirect para a HOME do PAINEL
                    var_dump($_SESSION); //teste
                else :
                    // SENHA incorreta
                set_msg('<p>Senha Incorreta</p>');
                endif;
            else :
                // usuário não existe
                set_msg('<p>USUÀRIO não existe!!</p>');
            endif;

        endif;
```


[Voltar ao Índice](#indice)

---

## <a name="parte10">CodeIgniter Essencial - Criando um painel parte 3</a>

#### rbtech_ci\application\controllers\Pagina.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagina extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('option_model','option');
    }

    public function index()
    {
        $dados['titulo'] = 'Titulo do Site';

        $this->load->view('header',$dados);
        $this->load->view('home');
        $this->load->view('noticias');
        $this->load->view('footer');
    }

    public function sobre(){
        $dados['titulo'] = 'Sobre - Titulo do Site';

        $this->load->view('header', $dados);
        $this->load->view('sobre');
        $this->load->view('noticias');
        $this->load->view('footer');
    }

    public function contato()
    {
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'email'));
        
        //Regras de validação do formulario
        $this->form_validation->set_rules('nome','Nome', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mensagem','Mensagem', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $dados['formerror'] = validation_errors();
        }else{
            $dados_form = $this->input->post();
            $this->email->from($dados_form['email'],$dados_form['nome']);
            $this->email->to('email@email.com.br');
            //$this->email->subject($dados_form['assunto']);
            $this->email->message($dados_form['mensagem']);
            if($this->email->send()){
                $dados['formerror'] = 'ENVIADO COM SUCESSO';
            }else{
                $dados['formerror'] = 'ERRO AO ENVIARR';
            }
            // OBS.: É necessário configurar o servidor para envio de email
        }

        
        $dados['titulo'] = 'contato - Titulo do Site';
        $this->load->view('header', $dados);
        $this->load->view('contato',$dados);
        //$this->load->view('noticias');
        $this->load->view('footer');
    }
}


```

#### rbtech_ci\application\controllers\Setup.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
    }

    public function index(){
        if($this->option->get_option('setup_executado')){
            //SETUP ok, mostrar tela para editr dados de setup
            redirect('setup/alterar', 'refresh');
        }else{
            //Não instalado, Mostrar tela de setup
            redirect('setup/instalar','refresh');
        }
    }

    public function instalar(){
        if ($this->option->get_option('setup_executado') == 1 ):
            //SETUP ok, mostrar tela para editr dados de setup
            redirect('setup/alterar', 'refresh');
        endif;

        //regras de validação
        $this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('senha2', 'REPITA SENHA', 'trim|required|min_length[6]|matches[senha]');

        //VErifica a validação
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            }
        }else{
            //set_msg('<p>validação ok</p>');
            $dados_form = $this->input->post();
            $this->option->update_option('user_login',$dados_form['login']);
            $this->option->update_option('user_email',$dados_form['email']);
            $this->option->update_option('user_pass',password_hash($dados_form['senha'],PASSWORD_DEFAULT));
            
            $inserido = $this->option->update_option('setup_executado',1);
            if($inserido){
                set_msg('<p>Sistema INSTALADO</p>');
                redirect('setup/login','refresh');
            }

        }

        //Carrega a view
        $dados['titulo'] = 'PAINEL DE INSTALAÇÃO';
        
        $this->load->view('header', $dados);
        $this->load->view('painel/setup', $dados);
        $this->load->view('footer');
    }

    public function login(){
        if ($this->option->get_option('setup_executado') != 1) :
            //SETUP NÃO OK, mostrar tela para instalar o sistema
        redirect('setup/instalar', 'refresh');
        endif;
        //regras de validação
        $this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[6]');

        // verifica a validação
        if ($this->form_validation->run() == false) :
            if (validation_errors()) :
                set_msg(validation_errors());
            endif;
        else :
            $dados_form = $this->input->post();
            if ($this->option->get_option('user_login') == $dados_form['login']) :
                //usuário existe
                if (password_verify($dados_form['senha'], $this->option->get_option('user_pass'))) :
                        //senha ok, fazer login
                    $this->session->set_userdata('logged', true);
                    $this->session->set_userdata('user_login', $dados_form['login']);
                    $this->session->set_userdata('user_email', $this->option->get_option('user_email'));
                        // Fazer redirect para a HOME do PAINEL
                    //var_dump($_SESSION); //teste
                    redirect('setup/alterar','refresh');
                else :
                    // SENHA incorreta
                set_msg('<p>Senha Incorreta</p>');
                endif;
            else :
                // usuário não existe
                set_msg('<p>USUÀRIO não existe!!</p>');
            endif;

        endif;


         //Carrega a view
        $dados['titulo'] = 'PAINEL DE LOGIN DO USUÁRIO';

        $this->load->view('header', $dados);
        $this->load->view('painel/login', $dados);
        $this->load->view('footer');
    }

    public function alterar(){
        //verificar o login do usuário
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules('login', 'NOME', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
        $this->form_validation->set_rules('nome_site', 'NOME DO SITE', 'trim|required');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|min_length[6]'); //required removido
        if(isset($_POST['senha']) && $_POST['senha'] != ''){
            $this->form_validation->set_rules('senha2', 'REPITA SENHA', 'trim|required|min_length[6]|matches[senha]');
        }

        //VERIFICA A VALIDAÇÃO
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            }
        }else{
            $dados_form = $this->input->post();
            $this->option->update_option('user_login',$dados_form['login']);
            $this->option->update_option('user_email',$dados_form['email']);
            $this->option->update_option('nome_site',$dados_form['nome_site']);
            if(isset($dados_form['senha']) && $dados_form['senha'] != ''){
                $this->option->update_option('user_pass', password_hash($dados_form['senha'], PASSWORD_DEFAULT));
            }
            set_msg('<p>Dados alterado com sucesso!</p>');
        }



         //Carrega a view
        $dados['titulo'] = 'CONFIGURAÇÔES DO SISTEMA';
        
        $_POST['login'] = $this->option->get_option('user_login');
        $_POST['email'] = $this->option->get_option('user_email');
        $_POST['nome_site'] = $this->option->get_option('nome_site');

        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/config', $dados);
        $this->load->view('painel/footer');
    }

    public function logout(){
        //destroi os dados da sessão
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('user_login');
        $this->session->unset_userdata('user_email');
        set_msg('<p>VOCE SAIU DO SISTEMA</p>');
        redirect('setup/login','refresh');
    }


    
}

```

#### rbtech_ci\application\models\Option_model.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Option_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_option($option_name, $default_value=NULL) //$default_value=NULL Vai ser a opção de quando não há no BD
    {
        $this->db->where('option_name', $option_name);
        $query = $this->db->get('options', 1); //LIMIT 1
        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->option_value;
        } else {
            return $default_value;
        }
    }

    public function update_option($option_name, $option_value){
        $this->db->where('option_name',$option_name);
        $query = $this->db->get('options',1);
        if($query->num_rows() == 1){
            //opção já existe, devo ATUALIZAR
            $this->db->set('option_value',$option_value);
            $this->db->where('option_name',$option_name);
            $this->db->update('options');
            return $this->db->affected_rows();
        }else{
            //opção não existe, devo INSERIR
            $dados = array('option_name' => $option_name,
                           'option_value' => $option_value);
            $this->db->insert('options',$dados);
            return $this->db->insert_id();
        }
    }


}
```

#### rbtech_ci\application\views\painel\config.php

```php

<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">

            <?php
            if ($msg = get_msg()) :
                echo '<div class="alert alert-danger">' . $msg . '</div>';
            endif;
            echo form_open('', array('class' => 'form-signin'));

            echo form_label('Nome de Login', 'login');
            echo form_input('login', set_value('login'), array('class' => 'form-control'));

            echo form_label('Email Administrador', 'email');
            echo form_input('email', set_value('email'), array('class' => 'form-control'));

            echo form_label('Senha(deixe em branco para não ', 'senha');
            echo form_password('senha', set_value('senha'), array('class' => 'form-control'));

            echo form_label('Repita a Senha', 'senha2');
            echo form_password('senha2', set_value('senha2'), array('class' => 'form-control'));

            echo form_label('Nome Do Site', 'nome_site');
            echo form_input('nome_site', set_value('nome_site'), array('class' => 'form-control'));

            echo form_submit('enviar', 'Salvar Dados', array('class' => 'btn btn-primary'));

            echo form_close();
            ?>
        </div>
      </div>
	</div>
</div>
```

#### rbtech_ci\application\views\header.php

```php
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="José Malcher Junior">

    <title><?php echo $titulo;?> </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?> " rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/small-business.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/blog-post.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><h2><?php 
                                    echo $this->option->get_option('nome_site2','FALTA CONFIGURAR');

                        ?></h2>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo base_url('sobre'); ?>">Sobre</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('contato'); ?>">Contato</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

```
#### rbtech_ci\application\views\painel\header_admin.php

```php
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="José Malcher Junior">

    <title><?php echo $titulo; ?> </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?> " rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/small-business.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/blog-post.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>" target='_blank'> VER SITE </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <?php echo $titulo; ?>
                    </li>
                    <li>
                        <a href="<?php echo base_url('noticia'); ?>">Noticias</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('setup'); ?>">CONDIGURAÇÕES</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('setup/logout'); ?>">SAIR</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

```

[Voltar ao Índice](#indice)

---

## <a name="parte11">CodeIgniter Essencial - Criando um painel parte 4</a>

#### htdocs\rbtech_ci\application\controllers\Noticia.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noticia extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model','option');
        $this->load->model('noticia_model','noticia');
    }

    public function index()
    {
        redirect('noticia/listar','refresh');
    }

    public function listar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //carrega a View

        $dados['titulo'] = 'LISTAGEM DE NOTÍCIAS';
        $dados['tela'] = 'listar';

        $dados['noticias'] = $this->noticia->get(); 

        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }
    public function cadastrar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //Regras de validação
        $this->form_validation->set_rules('titulo','TÍTULO', 'trim|required');
        $this->form_validation->set_rules('conteudo','CONTEÚDO', 'trim|required');

        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            }
        }else{
            $this->load->library('upload',config_upload()); /* Foi criada uma função para configurações de UPload */
            if($this->upload->do_upload('imagem')){
                //upload foi efetuado
                $dados_upload = $this->upload->data();
                $dados_form = $this->input->post();
                //var_dump($dados_upload);
                $dados_insert['titulo'] = $dados_form['titulo'];
                $dados_insert['conteudo'] = $dados_form['conteudo'];
                $dados_insert['imagem'] = $dados_upload['file_name'];
                // SALvAR NO BD
                if($id = $this->noticia->salvar($dados_insert)){
                    set_msg('<p>Notícia cadastrada com sucesso!!</p>');
                    redirect('noticia/listar', 'refresh');
                }else{
                    set_msg('<p>ERRO - NOTICIA NÃO CADASTRADA</p>');
                }
            }else{
                // ERRO no upload
                $msg = $this->upload->display_errors();
                $msg.= '<p>São permitidos JPG e PNG até 512 KB</p>';
                set_msg($msg);
            }
        }

        //carrega a View

        $dados['titulo'] = 'CADASTRO DE NOTÍCIAS';
        $dados['tela'] = 'cadastrar';
        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }

    
}

```

#### htdocs\rbtech_ci\application\models\Noticia_model.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noticia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados)
    {
        if(isset($dados['id']) && $dados['id'] > 0 ){
            // noticia já existe, devo EDITAR
        }else{
            // Noticia NÃO existe, devo inserir
            $this->db->insert('noticias', $dados);
            return $this->db->insert_id();
        }
    }

    public function get($limit=0, $offset=0){
        if($limit == 0 ){
            $this->db->order_by('id','desc');
            $query = $this->db->get('noticias');
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return NULL;
            }
        }else{
            $this->db->order_by('id','desc');
            $query = $this->db->get('noticias', $limit);
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return NULL;
            }
        }
    }


}
```

#### htdocs\rbtech_ci\application\helpers\funcoes_helper.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(!function_exists('set_msg')):
    //seta a mensagem via session para ser alida posteriomente
    function set_msg($msg=NULL){
        $ci = & get_instance();
        $ci->session->set_userdata('aviso',$msg);
    }
endif;

if(!function_exists('get_msg')):
    //retorna ma mensage definida pela função set_msg
    function get_msg($destroy=TRUE){
        $ci = & get_instance();
        $retorno = $ci->session->userdata('aviso');
        if($destroy){
            $ci->session->unset_userdata('aviso');
        }
        return $retorno;
    }
endif;

if(!function_exists('verifica_login')){
    //verifica se o usuário será logado, caso negativa redireciona para outra página
    function verifica_login($redirect='setup/login'){
        $ci = &get_instance();
        if($ci->session->userdata('logged') != TRUE){
            set_msg('<p>Acesso Restrito! Faça login para continuar</p>');
            redirect($redirect, 'refresh');
        }
    }
}

if(!function_exists('config_upload')){
    //define as condigurações para upload de imagens/arquivos
    function config_upload($path='./uploads/', $types='jpg|png', $size=512){
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;
    }
}
```

#### htdocs\rbtech_ci\application\views\painel\noticias.php
```php

<div class="container">
	<div class="row" >
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/cadastrar'); ?>">INSERIR</a>
                </li>
            </div>
        </div>
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/listar'); ?>">LISTAR</a>
                </li>
            </div>
        </div>
        <div class="col-md-12">
            <div class="well well-sm">

                <?php
                if ($msg = get_msg()) :
                    echo '<div class="alert alert-danger">' . $msg . '</div>';
                endif;

                switch($tela):
                    case 'listar':
                        if(isset($noticias) && sizeof($noticias) > 0){
                            ?>
                            <table  class='table table-hover'>
                                <thead>
                                    <th>Título</th>
                                    <th align="right" style="text-align: right;">Ações</th>
                                </thead>
                                <tbody>
                                    <?php foreach($noticias as $linha): ?>
                                        <tr>
                                            <td class="titulo-noticia"><?php echo $linha->titulo; ?></td>
                                            <td align="right"><?php echo anchor('noticia/editar/'.$linha->id, 'Editar'); ?> | <?php echo anchor('noticia/excluir/'.$linha->id, 'Excluir'); ?> | <?php echo anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php
                        }else{
                            echo '<div class="msg-box"><p>Nenhuma notícia cadastrada</p></div>';
                        }
                    break;
                    case 'cadastrar':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo'), array('class' => 'form-control'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', set_value('conteudo'), array('class' => 'form-control'));
                            echo form_label('Imagem da notícia(thumbnail)', 'imagem');
                            echo form_upload('imagem');
                            echo form_submit('enviar', 'Salvar Notícia', array('class'=> 'btn btn-primary'));
                        echo form_close();
                    break;
                    case 'excluir':
                        echo 'Tela de Exclusão';
                    break;
                
                endswitch;

                ?>
            </div>
        </div>
	</div>
</div>
```

[Voltar ao Índice](#indice)

---

## <a name="parte12">CodeIgniter Essencial - Criando um painel parte 5</a>

http://jqueryte.com/

#### htdocs\rbtech_ci\application\models\Noticia_model.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noticia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados)
    {
        if(isset($dados['id']) && $dados['id'] > 0 ){
            // noticia já existe, devo EDITAR
        }else{
            // Noticia NÃO existe, devo inserir
            $this->db->insert('noticias', $dados);
            return $this->db->insert_id();
        }
    }

    public function get($limit=0, $offset=0){
        if($limit == 0 ){
            $this->db->order_by('id','desc');
            $query = $this->db->get('noticias');
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return NULL;
            }
        }else{
            $this->db->order_by('id','desc');
            $query = $this->db->get('noticias', $limit);
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return NULL;
            }
        }
    }

    public function get_single($id=0){
        $this->db->where('id', $id);
        $query = $this->db->get('noticias',1);
        if($query->num_rows() == 1){
            $row = $query->row();
            return $row;
        }else{
            return NULL;
        }
    }

    public function excluir($id=0){
        $this->db->where('id', $id);
        $this->db->delete('noticias');
        return $this->db->affected_rows();
    }


}
```

#### htdocs\rbtech_ci\application\views\painel\noticias.php

```php

<div class="container">
	<div class="row" >
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/cadastrar'); ?>">INSERIR</a>
                </li>
            </div>
        </div>
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/listar'); ?>">LISTAR</a>
                </li>
            </div>
        </div>
        <div class="col-md-12">
            <div class="well well-sm">

                <?php
                if ($msg = get_msg()) :
                    echo '<div class="alert alert-danger">' . $msg . '</div>';
                endif;

                switch($tela):
                    case 'listar':
                        if(isset($noticias) && sizeof($noticias) > 0){
                            ?>
                            <table  class='table table-hover'>
                                <thead>
                                    <th>Título</th>
                                    <th align="right" style="text-align: right;">Ações</th>
                                </thead>
                                <tbody>
                                    <?php foreach($noticias as $linha): ?>
                                        <tr>
                                            <td class="titulo-noticia"><?php echo $linha->titulo; ?></td>
                                            <td align="right"><?php echo anchor('noticia/editar/'.$linha->id, 'Editar'); ?> | <?php echo anchor('noticia/excluir/'.$linha->id, 'Excluir'); ?> | <?php echo anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php
                        }else{
                            echo '<div class="msg-box"><p>Nenhuma notícia cadastrada</p></div>';
                        }
                    break;
                    case 'cadastrar':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo'), array('class' => 'form-control'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class' => 'editorhtml'));
                            echo form_label('Imagem da notícia(thumbnail)', 'imagem');
                            echo form_upload('imagem');
                            echo form_submit('enviar', 'Salvar Notícia', array('class'=> 'btn btn-primary'));
                        echo form_close();
                    break;
                    case 'Editar':
                        echo 'Tela de Edição';
                    break;
                    case 'excluir':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo',to_html($noticia->titulo)), array('class' => 'form-control', 'disabled'=> 'disabled'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', to_html(set_value('conteudo',to_html($noticia->conteudo))), array('class' => 'editorhtml desabled', 'disabled' => 'disabled'));
                            echo '<p> <small>Imagem: <img src="'.base_url('uploads/'.$noticia->imagem) . '" class="img-responsive img-rounded" /> </small><br></p>';

                            echo form_submit('enviar', 'Excluir Notícia', array('class' => 'btn btn-primary'));
                        echo form_close();
                        


                        break;
                
                endswitch;

                ?>
            </div>
        </div>
	</div>
</div>
```

#### htdocs\rbtech_ci\application\helpers\funcoes_helper.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(!function_exists('set_msg')):
    //seta a mensagem via session para ser alida posteriomente
    function set_msg($msg=NULL){
        $ci = & get_instance();
        $ci->session->set_userdata('aviso',$msg);
    }
endif;

if(!function_exists('get_msg')):
    //retorna ma mensage definida pela função set_msg
    function get_msg($destroy=TRUE){
        $ci = & get_instance();
        $retorno = $ci->session->userdata('aviso');
        if($destroy){
            $ci->session->unset_userdata('aviso');
        }
        return $retorno;
    }
endif;

if(!function_exists('verifica_login')){
    //verifica se o usuário será logado, caso negativa redireciona para outra página
    function verifica_login($redirect='setup/login'){
        $ci = &get_instance();
        if($ci->session->userdata('logged') != TRUE){
            set_msg('<p>Acesso Restrito! Faça login para continuar</p>');
            redirect($redirect, 'refresh');
        }
    }
}

if(!function_exists('config_upload')){
    //define as condigurações para upload de imagens/arquivos
    function config_upload($path='./uploads/', $types='jpg|png', $size=512){
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;
    }
}

if (!function_exists('to_bd')) {
   // codifica o html para salvar no banco de dados
   function to_bd($string=NULL){
        return htmlentities($string);
   }
}

if (!function_exists('to_html')) {
    // decodifica o html e remove barras investidas do conteúdo
    function to_html($string=NULL){
        return html_entity_decode($string);
    }
}
```
#### htdocs\rbtech_ci\application\controllers\Noticia.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noticia extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model','option');
        $this->load->model('noticia_model','noticia');
    }

    public function index()
    {
        redirect('noticia/listar','refresh');
    }

    public function listar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //carrega a View

        $dados['titulo'] = 'LISTAGEM DE NOTÍCIAS';
        $dados['tela'] = 'listar';

        $dados['noticias'] = $this->noticia->get(); 

        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }
    public function cadastrar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //Regras de validação
        $this->form_validation->set_rules('titulo','TÍTULO', 'trim|required');
        $this->form_validation->set_rules('conteudo','CONTEÚDO', 'trim|required');

        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            }
        }else{
            $this->load->library('upload',config_upload()); /* Foi criada uma função para configurações de UPload */
            if($this->upload->do_upload('imagem')){
                //upload foi efetuado
                $dados_upload = $this->upload->data();
                $dados_form = $this->input->post();
                //var_dump($dados_upload);
                $dados_insert['titulo'] = to_bd($dados_form['titulo']);
                $dados_insert['conteudo'] = to_bd($dados_form['conteudo']);
                $dados_insert['imagem'] = $dados_upload['file_name'];
                // SALvAR NO BD
                if($id = $this->noticia->salvar($dados_insert)){
                    set_msg('<p>Notícia cadastrada com sucesso!!</p>');
                    redirect('noticia/listar', 'refresh');
                }else{
                    set_msg('<p>ERRO - NOTICIA NÃO CADASTRADA</p>');
                }
            }else{
                // ERRO no upload
                $msg = $this->upload->display_errors();
                $msg.= '<p>São permitidos JPG e PNG até 512 KB</p>';
                set_msg($msg);
            }
        }

        //carrega a View

        $dados['titulo'] = 'CADASTRO DE NOTÍCIAS';
        $dados['tela'] = 'cadastrar';
        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }

    public function excluir(){
        //verifica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id da notícia
        $id = $this->uri->segment(3);
        if($id > 0){
            //id informado, proceder com a exclusão
            if($noticia = $this->noticia->get_single($id)){
                $dados['noticia'] = $noticia;
            }else{
                set_msg('<p>Noticía (id) INEXISTENTE - Escolha uma noticia para excluir</p>');
                redirect('noticia/listar', 'refresh');
            }
        }else{
            set_msg('<p>Noticía (id) inexistente</p>');
            redirect('noticia/listar','refresh');
        }

        //REGRAS DE VALIDAÇÃO
        $this->form_validation->set_rules('enviar', 'ENVIAR', 'trim|required');
        
        // Verifica a validação
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors);
            }
        }else{
            $imagem = 'uploads/'.$noticia->imagem;
            if($this->noticia->excluir($id)){
                unlink($imagem);
                set_msg('<p>Notícia excluida com sucesso</p>');
                redirect('noticia/listar','refresh');
            }else{
                set_msg('<p>ERRO AO GRAVAR NO BANCO</p>');
            }
        }



        //carrega a view
        $dados['titulo'] = 'Exclusão DE NOTÍCIAS';
        $dados['tela'] = 'excluir';
        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }


    
}

```


[Voltar ao Índice](#indice)

---

## <a name="parte13">CodeIgniter Essencial - Criando um painel parte 6</a>

#### htdocs\rbtech_ci\application\controllers\Noticia.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noticia extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model','option');
        $this->load->model('noticia_model','noticia');
    }

    public function index()
    {
        redirect('noticia/listar','refresh');
    }

    public function listar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //carrega a View

        $dados['titulo'] = 'LISTAGEM DE NOTÍCIAS';
        $dados['tela'] = 'listar';

        $dados['noticias'] = $this->noticia->get(); 

        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }
    /* ****************** CADASTRAR ************************************************ */
    public function cadastrar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //Regras de validação
        $this->form_validation->set_rules('titulo','TÍTULO', 'trim|required');
        $this->form_validation->set_rules('conteudo','CONTEÚDO', 'trim|required');

        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors());
            }
        }else{
            $this->load->library('upload',config_upload()); /* Foi criada uma função para configurações de UPload */
            if($this->upload->do_upload('imagem')){
                //upload foi efetuado
                $dados_upload = $this->upload->data();
                $dados_form = $this->input->post();
                //var_dump($dados_upload);
                $dados_insert['titulo'] = to_bd($dados_form['titulo']);
                $dados_insert['conteudo'] = to_bd($dados_form['conteudo']);
                $dados_insert['imagem'] = $dados_upload['file_name'];
                // SALvAR NO BD
                if($id = $this->noticia->salvar($dados_insert)){
                    set_msg('<p>Notícia cadastrada com sucesso!!</p>');
                    redirect('noticia/editar/'.$id, 'refresh'); // Redirecionar direto para tela de Editar após o cadastro!
                }else{
                    set_msg('<p>ERRO - NOTICIA NÃO CADASTRADA</p>');
                }
            }else{
                // ERRO no upload
                $msg = $this->upload->display_errors();
                $msg.= '<p>São permitidos JPG e PNG até 512 KB</p>';
                set_msg($msg);
            }
        }

        //carrega a View

        $dados['titulo'] = 'CADASTRO DE NOTÍCIAS';
        $dados['tela'] = 'cadastrar';
        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }

    public function excluir(){
        //verifica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id da notícia
        $id = $this->uri->segment(3);
        if($id > 0){
            //id informado, proceder com a exclusão
            if($noticia = $this->noticia->get_single($id)){
                $dados['noticia'] = $noticia;
            }else{
                set_msg('<p>Noticía (id) INEXISTENTE - Escolha uma noticia para excluir</p>');
                redirect('noticia/listar', 'refresh');
            }
        }else{
            set_msg('<p>Noticía (id) inexistente</p>');
            redirect('noticia/listar','refresh');
        }

        //REGRAS DE VALIDAÇÃO
        $this->form_validation->set_rules('enviar', 'ENVIAR', 'trim|required');
        
        // Verifica a validação
        if($this->form_validation->run() == FALSE){
            if(validation_errors()){
                set_msg(validation_errors);
            }
        }else{
            $imagem = 'uploads/'.$noticia->imagem;
            if($this->noticia->excluir($id)){
                unlink($imagem);
                set_msg('<p>Notícia excluida com sucesso</p>');
                redirect('noticia/listar','refresh');
            }else{
                set_msg('<p>ERRO AO GRAVAR NO BANCO</p>');
            }
        }



        //carrega a view
        $dados['titulo'] = 'Exclusão DE NOTÍCIAS';
        $dados['tela'] = 'excluir';
        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }

    public function editar()
    {
        //verifica se o usuário está logado
        verifica_login();

        //verifica se foi passado o id da notícia
        $id = $this->uri->segment(3);
        if ($id > 0) {
            //id informado, proceder com a EDIÇÃO
            if ($noticia = $this->noticia->get_single($id)) {
                $dados['noticia'] = $noticia;
                $dados_update['id'] = $noticia->id;
            } else {
                set_msg('<p>Noticía (id) INEXISTENTE - Escolha uma noticia para EDITAR</p>');
                redirect('noticia/listar', 'refresh');
            }
        } else {
            set_msg('<p>Noticía (id) inexistente</p>');
            redirect('noticia/listar', 'refresh');
        }

        //REGRAS DE VALIDAÇÃO
        $this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required');
        $this->form_validation->set_rules('conteudo', 'CONTEÚDO', 'trim|required');
        
        // Verifica a validação
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(validation_errors);
            }
        } else {
            //Rotina de Edição
            $this->load->library('upload',config_upload());
            if(isset($_FILES['imagem']) && $_FILES['imagem']['name'] != ''){
                //foi enviada uma imagem, deco fazer o upload
                if($this->upload->do_upload('imagem')){
                    $imagem_antiga = 'uploads/'.$noticia->imagem;
                    $dados_upload = $this->upload->data();
                    $dados_form = $this->input->post();
                    $dados_update['titulo'] = to_bd($dados_form['titulo']);
                    $dados_update['conteudo'] = to_bd($dados_form['conteudo']);
                    $dados_update['imagem'] = $dados_upload['file_name'];
                    if($this->noticia->salvar($dados_update)){
                        unlink($imagem_antiga);
                        set_msg('<p>Noticia ALTERADA COM SUCESSO</p>');
                        $dados['noticia']->imagem = $dados_update['imagem'];
                    }else{
                        set_msg('<p>ERRO!! Nenhuma alteração foi realizada</p>');
                    }
                }else{
                    $msg = $this->upload->display_errors();
                    set_msg('<p>São permitidos apenas arquivo JPG e PNG de até 521kb</p>');
                    set_msg();
                }   
            }else{
                // não foi enviada uma imagem pelo form
                $dados_form = $this->input->post();
                $dados_update['titulo'] = to_bd($dados_form['titulo']);
                $dados_update['conteudo'] = to_bd($dados_form['conteudo']);
               
                if ($this->noticia->salvar($dados_update)) {   
                    set_msg('<p>Noticia ALTERADA COM SUCESSO</p>');
                } else {
                    set_msg('<p>ERRO!! Nenhuma alteração foi realizada</p>');
                }
            }
        }



        //carrega a view
        $dados['titulo'] = 'ALTERAÇÃO DE NOTÍCIAS';
        $dados['tela'] = 'editar';
        $this->load->view('painel/header_admin', $dados);
        $this->load->view('painel/noticias', $dados);
        $this->load->view('painel/footer');
    }

    
}

```

#### htdocs\rbtech_ci\application\controllers\Pagina.php

```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagina extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('option_model','option');
        $this->load->model('noticia_model', 'noticia');
    }

    public function index()
    {
        $dados['titulo'] = 'Titulo do Site';

        $this->load->view('header',$dados);
        $this->load->view('home');
        $this->load->view('noticias');
        $this->load->view('footer');
    }

    public function sobre(){
        $dados['titulo'] = 'Sobre - Titulo do Site';

        $this->load->view('header', $dados);
        $this->load->view('sobre');
        $this->load->view('noticias');
        $this->load->view('footer');
    }

    public function contato()
    {
        $this->load->helper('form');
        $this->load->library(array('form_validation', 'email'));
        
        //Regras de validação do formulario
        $this->form_validation->set_rules('nome','Nome', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('mensagem','Mensagem', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $dados['formerror'] = validation_errors();
        }else{
            $dados_form = $this->input->post();
            $this->email->from($dados_form['email'],$dados_form['nome']);
            $this->email->to('email@email.com.br');
            //$this->email->subject($dados_form['assunto']);
            $this->email->message($dados_form['mensagem']);
            if($this->email->send()){
                $dados['formerror'] = 'ENVIADO COM SUCESSO';
            }else{
                $dados['formerror'] = 'ERRO AO ENVIARR';
            }
            // OBS.: É necessário configurar o servidor para envio de email
        }

        
        $dados['titulo'] = 'contato - Titulo do Site';
        $this->load->view('header', $dados);
        $this->load->view('contato',$dados);
        //$this->load->view('noticias');
        $this->load->view('footer');
    }

    
    /* -------------------------- ABRINDO UM POST ------------------------ */
    public function post()
    {

        if (($id = $this->uri->segment(2)) > 0) {
            if ($noticia = $this->noticia->get_single($id)) {
                $dados['titulo'] = to_html($noticia->titulo) . ' - José Malcher jr.';
                $dados['not_titulo'] = to_html($noticia->titulo);
                $dados['not_conteudo'] = to_html($noticia->conteudo);
                $dados['not_imagem'] = $noticia->imagem;
            } else {
                $dados['titulo'] = 'Página não encontrada';
                $dados['not_titulo'] = 'Noticia não encontrada';
                $dados['not_conteudo'] = '<p>Nenhuma noticia doi encontrada com base nos parametros fornecidos</p>';
                $dados['imagem'] = '';
            }
        } else {
            redirect(base_url(), 'refresh');
        }


        $this->load->view('header', $dados);
        $this->load->view('post', $dados);
        $this->load->view('noticias');
        $this->load->view('footer');
    }
}

```

#### htdocs\rbtech_ci\application\views\post.php

```php
 <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $not_titulo; ?></h1>

                <hr>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo base_url('uploads/'.$not_imagem); ?>" alt="<?php echo $not_titulo; ?>">

                <hr>

                <!-- Post Content -->
                <?php echo $not_conteudo; ?>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>
```

#### htdocs\rbtech_ci\application\helpers\funcoes_helper.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

if(!function_exists('set_msg')):
    //seta a mensagem via session para ser alida posteriomente
    function set_msg($msg=NULL){
        $ci = & get_instance();
        $ci->session->set_userdata('aviso',$msg);
    }
endif;

if(!function_exists('get_msg')):
    //retorna ma mensage definida pela função set_msg
    function get_msg($destroy=TRUE){
        $ci = & get_instance();
        $retorno = $ci->session->userdata('aviso');
        if($destroy){
            $ci->session->unset_userdata('aviso');
        }
        return $retorno;
    }
endif;

if(!function_exists('verifica_login')){
    //verifica se o usuário será logado, caso negativa redireciona para outra página
    function verifica_login($redirect='setup/login'){
        $ci = &get_instance();
        if($ci->session->userdata('logged') != TRUE){
            set_msg('<p>Acesso Restrito! Faça login para continuar</p>');
            redirect($redirect, 'refresh');
        }
    }
}

if(!function_exists('config_upload')){
    //define as condigurações para upload de imagens/arquivos
    function config_upload($path='./uploads/', $types='jpg|png', $size=512){
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;
    }
}

if (!function_exists('to_bd')) {
   // codifica o html para salvar no banco de dados
   function to_bd($string=NULL){
        return htmlentities($string);
   }
}

if (!function_exists('to_html')) {
    // decodifica o html e remove barras investidas do conteúdo
    function to_html($string=NULL){
        return html_entity_decode($string);
    }
}

/* ---- GERA um texto parcial  a partir de um post */
if(!function_exists('resumo_post')){
    function resumo_post($string=NULL, $tamanho=100){
        $string = to_html($string);
        $string = strip_tags($string);
        $string = substr($string, 0, $tamanho);
        return $string; 
    }
}
```

#### htdocs\rbtech_ci\application\models\Noticia_model.php
```php
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Noticia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados)
    {
        if(isset($dados['id']) && $dados['id'] > 0 ){
            // noticia já existe, devo EDITAR
            $this->db->where('id', $dados['id']);
            unset($dados['id']); // id não deve ser atualizado!
            $this->db->update('noticias',$dados);
            return $this->db->affected_rows();

        }else{
            // Noticia NÃO existe, devo inserir
            $this->db->insert('noticias', $dados);
            return $this->db->insert_id();
        }
    }

    public function get($limit=0, $offset=0){
        if($limit == 0 ){
            $this->db->order_by('id','desc');
            $query = $this->db->get('noticias');
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return NULL;
            }
        }else{
            $this->db->order_by('id','desc');
            $query = $this->db->get('noticias', $limit);
            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return NULL;
            }
        }
    }

    public function get_single($id=0){
        $this->db->where('id', $id);
        $query = $this->db->get('noticias',1);
        if($query->num_rows() == 1){
            $row = $query->row();
            return $row;
        }else{
            return NULL;
        }
    }

    public function excluir($id=0){
        $this->db->where('id', $id);
        $this->db->delete('noticias');
        return $this->db->affected_rows();
    }


}
```

#### views\painel\noticias.php
```php

<div class="container">
	<div class="row" >
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/cadastrar'); ?>">INSERIR</a>
                </li>
            </div>
        </div>
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/listar'); ?>">LISTAR</a>
                </li>
            </div>
        </div>
        <div class="col-md-12">
            <div class="well well-sm">

                <?php
                if ($msg = get_msg()) :
                    echo '<div class="alert alert-danger">' . $msg . '</div>';
                endif;

                switch($tela):
                    case 'listar':
                        if(isset($noticias) && sizeof($noticias) > 0){
                            ?>
                            <table  class='table table-hover'>
                                <thead>
                                    <th>Título</th>
                                    <th align="right" style="text-align: right;">Ações</th>
                                </thead>
                                <tbody>
                                    <?php foreach($noticias as $linha): ?>
                                        <tr>
                                            <td class="titulo-noticia"><?php echo $linha->titulo; ?></td>
                                            <td align="right"><?php echo anchor('noticia/editar/'.$linha->id, 'Editar'); ?> | <?php echo anchor('noticia/excluir/'.$linha->id, 'Excluir'); ?> | <?php echo anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php
                        }else{
                            echo '<div class="msg-box"><p>Nenhuma notícia cadastrada</p></div>';
                        }
                    break;
                    case 'cadastrar':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo'), array('class' => 'form-control'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class' => 'editorhtml'));
                            echo form_label('Imagem da notícia(thumbnail)', 'imagem');
                            echo form_upload('imagem');
                            echo form_submit('enviar', 'Salvar Notícia', array('class'=> 'btn btn-primary'));
                        echo form_close();
                    break;
                    case 'editar':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                        echo form_label('Titulo:', 'titulo');
                        echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)), array('class' => 'form-control'));
                        echo form_label('Conteúdo:', 'conteudo');
                        echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($noticia->conteudo))), array('class' => 'editorhtml desabled'));
                        echo form_label('Imagem da notícia(thumbnail)', 'imagem');
                        echo form_upload('imagem');
                        echo '<p> <small>Imagem ATUAL: <img src="' . base_url('uploads/' . $noticia->imagem) . '" class="img-responsive img-rounded" /> </small><br></p>';

                        echo form_submit('enviar', 'ATUALIZAR Notícia', array('class' => 'btn btn-primary'));
                        echo form_close();    
                    
                    break;
                    case 'excluir':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo',to_html($noticia->titulo)), array('class' => 'form-control', 'disabled'=> 'disabled'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', to_html(set_value('conteudo',to_html($noticia->conteudo))), array('class' => 'editorhtml desabled', 'disabled' => 'disabled'));
                            echo '<p> <small>Imagem: <img src="'.base_url('uploads/'.$noticia->imagem) . '" class="img-responsive img-rounded" /> </small><br></p>';

                            echo form_submit('enviar', 'Excluir Notícia', array('class' => 'btn btn-primary'));
                        echo form_close();
                        


                        break;
                
                endswitch;

                ?>
            </div>
        </div>
	</div>
</div>
```


[Voltar ao Índice](#indice)

---

