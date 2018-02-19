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
