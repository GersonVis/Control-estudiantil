<?php
$contenido = null;
$url_redireccion = "";
$nombre_opcion = "";
?>



<div style="height: 10%;">
<nav class="navbar navbar-expand-lg navbar-light bg-white position-fixed w-100" style="z-index: 100; height: 75px;">
    <div class="container-fluid">
        <a class="navbar-brand border" style="
    overflow: hidden;
    width: 104px;
    border-radius: 12px;
    height: 50px;
" href="#"><img style="height: 100%;" src="public/imagenes/logo.png"></a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation" data-toggle="modal" data-target="#exampleModalLong">
            <span class="navbar-toggler-icon"></span>
        </button>




        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px; position: absolute; left: 50%; transform: translatex(-50%);">
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
        <div class="collapse navbar-collapse">
            <div class=" d-flex justify-content-end w-100">
                <a type="button" class="btn btn-secondary d-flex justify-content-center border bg-secondary text-white" style="
    overflow: hidden;
    width: 104px;
    border-radius: 12px;
" href="/cat/plantillas/principal.php">Salir</a>
            </div>
        </div>
        <!--  <button type="button" class="btn btn-secondary d-flex justify-content-center border bg-secondary text-white" style="
    overflow: hidden;
    width: 104px;
    border-radius: 12px;
" href="#">Salir</button>-->
    </div>
</nav>


<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Menú</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                foreach ($this->menu as $key => $contenido) {
                    $url_redireccion = $contenido[1];
                    $nombre_opcion = $contenido[0];
                    //  echo $key.$this->opcion;
                ?>
                    <a class="dropdown-item rounded" href="<?php echo $url_redireccion;?>" style><?php
                                                                echo $nombre_opcion;
                                                                ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>