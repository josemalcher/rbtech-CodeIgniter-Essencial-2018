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