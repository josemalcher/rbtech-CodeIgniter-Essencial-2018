# Curso da RbTech de CodeIgniter

http://dev.rbtech.info/codeigniter-essencial-introducao-instalacao

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

## <a name="parte4"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte5"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte6"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte7"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte8"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte9"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte10"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte11"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte12"></a>



[Voltar ao Índice](#indice)

---

## <a name="parte13"></a>



[Voltar ao Índice](#indice)

---

