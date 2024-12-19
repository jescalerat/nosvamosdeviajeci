<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center"><?= devolverFecha($titulo) ?></h1>
        <form class="form-horizontal" role="form" method="post" action="<?= site_url('admin/rutasAdmin') ?>/subirComentariosDia">
            <div class="form-group">
                <label for="comentarioES">Español</label>
                <textarea id="comentarioES" name="comentarioES" class="form-control" rows="3" cols="80"><?= $comentarioES ?></textarea>
            </div>
            <div class="form-group">
                <label for="comentarioCA">Catalan</label>
                <textarea id="comentarioCA" name="comentarioCA" class="form-control" rows="3" cols="80"><?= $comentarioCA ?></textarea>
            </div>
            <div class="form-group">
                <label for="comentarioEN">Ingles</label>
                <textarea id="comentarioEN" name="comentarioEN" class="form-control" rows="3" cols="80"><?= $comentarioEN ?></textarea>
            </div>

            <div class="form-group">
                <div class="col">
                    <p class="text-center"><button type="submit" class="btn btn-default">Enviar Mensaje</button></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col" id="volverDias">
                    <a href="<?= site_url('admin/rutasAdmin') ?>/ponerDias/<?= $idRuta ?>">Volver</a>
                </div>
            </div>
            
            <input type="hidden" id="idRutaDia" name="idRutaDia" value="<?= $idRutaDia ?>"/>
            <input type="hidden" id="idRutaComentario" name="idRutaComentario" value="<?= $idRutaComentario ?>"/>
        </form>

        <h2 class="text-center">Comentarios realizados</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Comentario</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
<?php
            foreach ($listaComentariosDia as $row){
?>                   
                <tr>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/ponerComentarioDia/<?= $row["IdRutaComentario"] ?>/<?= $row["IdRutaDia"] ?>"><?= $row["ComentarioES"] ?></a></td>
                    <td><a href="<?= site_url('admin/rutasAdmin') ?>/borrarComentarioDia/<?= $row["IdRutaComentario"] ?>/<?= $row["IdRutaDia"] ?>">Eliminar</a></td>
                </tr>
<?php			
            }
?>
        </table>  
    </div>
</div>
