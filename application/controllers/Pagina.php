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
