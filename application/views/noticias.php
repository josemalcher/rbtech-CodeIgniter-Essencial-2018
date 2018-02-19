
        <!-- Content Row -->
        <div class="row">
            <?php 
                if($noticias = $this->noticia->get(3)){
                    foreach($noticias as $linha){
                        ?>
                            <div class="col-md-4">
                                <h2><?php echo to_html($linha->titulo);  ?></h2>
                                <p> <?php echo resumo_post($linha->conteudo); ?></p>
                                <a class="btn btn-default" href="<?php echo base_url('post/'.$linha->id); ?>">LEIA MAIS</a>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>        
            <!-- <div class="col-md-4">
                <h2>Heading 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <a class="btn btn-default" href="#">More Info</a>
            </div>
            <!-- /.col-md-4 -->
            <!-- <div class="col-md-4">
                <h2>Heading 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <a class="btn btn-default" href="#">More Info</a>
            </div> -->
            <!-- /.col-md-4 -->
            <!-- <div class="col-md-4">
                <h2>Heading 3</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem nisi accusamus error velit animi non ipsa placeat. Recusandae, suscipit, soluta quibusdam accusamus a veniam quaerat eveniet eligendi dolor consectetur.</p>
                <a class="btn btn-default" href="#">More Info</a>
            </div> -->
            
        
        