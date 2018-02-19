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
