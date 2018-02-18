
<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">

            <?php
            if ($msg = get_msg()) :
                echo '<div class="alert alert-danger">' . $msg . '</div>';
            endif;
            echo form_open('', array('class' => 'form-signin'));

            echo form_label('Login', 'login');
            echo form_input('login', set_value('login'), array('class' => 'form-control','autofocus'=> 'autofocus'));

            echo form_label('Senha', 'senha');
            echo form_password('senha', set_value('senha'), array('class' => 'form-control'));

            echo form_submit('ACESSAR SISTEMA', 'Salvar Dados', array('class' => 'btn btn-primary'));

            echo form_close();
            ?>
        </div>
      </div>
	</div>
</div>