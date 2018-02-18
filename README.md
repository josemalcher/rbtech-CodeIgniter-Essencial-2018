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



[Voltar ao Índice](#indice)

---

## <a name="parte12">CodeIgniter Essencial - Criando um painel parte 5</a>



[Voltar ao Índice](#indice)

---

## <a name="parte13">CodeIgniter Essencial - Criando um painel parte 6</a>



[Voltar ao Índice](#indice)

---

