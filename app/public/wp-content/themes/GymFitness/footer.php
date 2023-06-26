        <footer class="site-footer contenedor">
            <hr>

            <div class="contenido-footer">
            <?php
                $args = array (
                    'theme_location' => 'menu-principal',
                    'container' => 'nav', // funcion de wp que genera el nav en html
                    'container_class' => 'menu-principal'//define las clases para css
                );
                wp_nav_menu($args); //funcion de wp  
            ?>
                <p class="copyright">Todos los derechos reservados. <?php echo get_bloginfo('name') ." " . date('Y'); ?></p>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>
</html> 