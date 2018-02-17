<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">

        <?php 
          if($formerror){
            echo '<h4>' . $formerror .'</h4>';
          }
          echo form_open('pagina/contato',array('class'=> 'form-horizontal'));
          echo "<fieldset><legend class='text - center'>Contact us</legend>";
            echo form_label('seu nome', 'nome');
            echo form_input('nome', set_value('nome'), array('class' => 'form-control'));
            echo form_label('seu email', 'email');
            echo form_input('email', set_value('email'), array('class' => 'form-control'));
            echo form_label('Mensagem', 'mensagem');
            echo form_textarea('mensagem', set_value('mensagem'), array('class' => 'form-control'));
            echo form_submit('enviar', 'Enviar Mensagem', array('class'=> 'btn btn-primary'));
          echo "</fieldset>";
          echo form_close();
        
        ?>
        </div>
      </div>
	</div>
</div>