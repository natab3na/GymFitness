<?php while( have_posts()): the_post(); ?>
                <h1 class="text-center texto-primario"><?php the_title();?></h1>
    
                <?php 
                    if(has_post_thumbnail()):
                        the_post_thumbnail('blog',array('class' => 'imagen-destacada'));
                    endif;    
                ?>
                <?php 
                        //revisar si elcustom post type es clases
                        if(get_post_type() === 'gymfitness_clases'){
                            $hora_inicio = get_field('hora_inicio');
                            $hora_termino = get_field('hora_termino');?>        
                        <p class="informacion-clase"><?php the_field('dias_clase'); ?>  - <?php echo $hora_inicio . " a "  . $hora_termino; ?> </p>
                <?php } ?>
            
                <?php the_content(); ?>

            <?php endwhile; ?>