<?php
$contenido = null;
$url_redireccion = "";
$nombre_opcion = "";
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" style="
    background: red;
    width: 104px;
    border-radius: 12px;
    height: 49px;
" href="#"><img src="public/imagenes/logo.png"></a>

    <div class="collapse d-flex justify-content-center w-100" id="navbarNav">
        <ul class="navbar-nav">
            <?php
            foreach ($this->menu as $key => $contenido) {
                $url_redireccion = $contenido[1];
                $nombre_opcion = $contenido[0];
                //  echo $key.$this->opcion;
            ?>
                <li class="nav-item <?php
                                    echo $key == $this->opcion ? "active" : "";
                                    ?>">
                    <a class="nav-link <?php
                                        echo $key == $this->opcion ? "font-weight-bold" : "";
                                        ?>" href="<?php echo $url_redireccion; ?>">
                        <?php
                        echo $nombre_opcion;
                        ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>
    <a class="navbar-brand" style="
    background: red;
    width: 104px;
    border-radius: 12px;
    height: 49px;
" href="#">Navbar</a>
</nav>