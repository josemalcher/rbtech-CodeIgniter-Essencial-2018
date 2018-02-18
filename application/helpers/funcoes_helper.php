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