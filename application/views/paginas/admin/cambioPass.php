<div class="row">
    <div class="col-4">
<?php 
        $this->load->view('templates/menuAdmin')
?>
    </div>
    <div class="col-8">
        <h1 class="text-center">CAMBIO CONTRASE&Ntilde;A</h1>
        <form role="form" id="cambio_pass" method="post" action="cambioPass/mensaje">
            <table class="table">
                <tr class="d-flex">
                    <td class="col-4 text-right">Contrase&ntilde;a actual:</td>
                    <td class="col-8 text-center"><input class="form-control" type="password" name="pass_actual" id="pass_actual" required="required"></td>
                </tr>
                
                <tr class="d-flex">
                    <td class="col-4 text-right">Nueva contrase&ntilde;a:</td>
                    <td class="col-8 text-center"><input class="form-control" type="password" name="pass_nueva" id="pass_nueva" required="required"></td>
                </tr>
                
                <tr class="d-flex">
                    <td class="col-4 text-right">Repita contrase&ntilde;a:</td>
                    <td class="col-8 text-center"><input class="form-control" type="password" name="pass_nueva_r" id="pass_nueva_r" required="required"></td>
                </tr>
            
                <tr class="d-flex">
                    <td class="col-12 text-center">
                        <button type="submit" class="btn btn-default">Enviar</button>
                    </td>
                </tr>
            </table>
            
<?php
    
    if ($mensajeError != null)
    {
        print($mensajeError);
    }
?>
        </form>	
    </div>
</div>