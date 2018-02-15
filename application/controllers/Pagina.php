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
        
        
        $dados['titulo'] = 'contato - Titulo do Site';

        $this->load->view('header', $dados);
        $this->load->view('contato');
        //$this->load->view('noticias');
        $this->load->view('footer');
    }
}
