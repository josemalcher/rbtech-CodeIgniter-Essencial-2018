
<div class="container">
	<div class="row" >
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/cadastrar'); ?>">INSERIR</a>
                </li>
            </div>
        </div>
        <div class="col-md-6" style="text-align:center">
            <div class="nav">
                <li>
                    <a href="<?php echo base_url('noticia/listar'); ?>">LISTAR</a>
                </li>
            </div>
        </div>
        <div class="col-md-12">
            <div class="well well-sm">

                <?php
                if ($msg = get_msg()) :
                    echo '<div class="alert alert-danger">' . $msg . '</div>';
                endif;

                switch($tela):
                    case 'listar':
                        if(isset($noticias) && sizeof($noticias) > 0){
                            ?>
                            <table  class='table table-hover'>
                                <thead>
                                    <th>Título</th>
                                    <th align="right" style="text-align: right;">Ações</th>
                                </thead>
                                <tbody>
                                    <?php foreach($noticias as $linha): ?>
                                        <tr>
                                            <td class="titulo-noticia"><?php echo $linha->titulo; ?></td>
                                            <td align="right"><?php echo anchor('noticia/editar/'.$linha->id, 'Editar'); ?> | <?php echo anchor('noticia/excluir/'.$linha->id, 'Excluir'); ?> | <?php echo anchor('post/'.$linha->id, 'Ver', array('target' => '_blank')); ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php
                        }else{
                            echo '<div class="msg-box"><p>Nenhuma notícia cadastrada</p></div>';
                        }
                    break;
                    case 'cadastrar':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo'), array('class' => 'form-control'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', to_html(set_value('conteudo')), array('class' => 'editorhtml'));
                            echo form_label('Imagem da notícia(thumbnail)', 'imagem');
                            echo form_upload('imagem');
                            echo form_submit('enviar', 'Salvar Notícia', array('class'=> 'btn btn-primary'));
                        echo form_close();
                    break;
                    case 'editar':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                        echo form_label('Titulo:', 'titulo');
                        echo form_input('titulo', set_value('titulo', to_html($noticia->titulo)), array('class' => 'form-control'));
                        echo form_label('Conteúdo:', 'conteudo');
                        echo form_textarea('conteudo', to_html(set_value('conteudo', to_html($noticia->conteudo))), array('class' => 'editorhtml desabled'));
                        echo form_label('Imagem da notícia(thumbnail)', 'imagem');
                        echo form_upload('imagem');
                        echo '<p> <small>Imagem ATUAL: <img src="' . base_url('uploads/' . $noticia->imagem) . '" class="img-responsive img-rounded" /> </small><br></p>';

                        echo form_submit('enviar', 'ATUALIZAR Notícia', array('class' => 'btn btn-primary'));
                        echo form_close();    
                    
                    break;
                    case 'excluir':
                        echo form_open_multipart('', array('class' => 'form-signin'));
                            echo form_label('Titulo:', 'titulo');
                            echo form_input('titulo', set_value('titulo',to_html($noticia->titulo)), array('class' => 'form-control', 'disabled'=> 'disabled'));
                            echo form_label('Conteúdo:', 'conteudo');
                            echo form_textarea('conteudo', to_html(set_value('conteudo',to_html($noticia->conteudo))), array('class' => 'editorhtml desabled', 'disabled' => 'disabled'));
                            echo '<p> <small>Imagem: <img src="'.base_url('uploads/'.$noticia->imagem) . '" class="img-responsive img-rounded" /> </small><br></p>';

                            echo form_submit('enviar', 'Excluir Notícia', array('class' => 'btn btn-primary'));
                        echo form_close();
                        


                        break;
                
                endswitch;

                ?>
            </div>
        </div>
	</div>
</div>