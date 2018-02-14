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
