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
