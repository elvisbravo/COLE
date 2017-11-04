<div id="page-wrapper" style="border-left: 0; min-height: 700px;padding: 82px 0px 10px 0px"> 
      <div class="col-md-12 graphs">
      <div class="xs" style="text-align: center;">
         <h2>Carga Academica</h2>

        <div class="bs-example4" data-example-id="contextual-table">
          
        <div class="panel-body no-padding" style="display: block;">
             

               <div class="row">
      <div class="col-md-2" > 
        <a id="nuevo" class="btn btn-info" data-toggle="modal" data-target="#Modal-registrar" style="display: block;width: 100px ; background-color: #0B7E72; border-color: #0B7E72; padding-top: 12px;    height: 45.5px; color:white;"> NUEVO</a>
      </div>

     <!--  <form id="form-buscar" action="<?php echo RUTA ?>admin/turnos/index.php" method="post">
        <div class="col-md-1 col-md-offset-2" >
          <input type="button" id="btn-buscar" value="Buscar"> 
        </div >
       
          </form> -->
        
  </div>   
   

            <br>  

            
           <table class="table table-bordered table-striped" id="example">  

              <!--thead class="thead-inverse" style="background-color: #548F81"> 
                <tr>
                    <th>Id</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
              </thead>

                                
              <tbody>
                
                                            

              </tbody-->
                <tr>
                  <th rowspan="2" colspan="2"></th>
                  <?php foreach ($nivel as $key => $n){ ?> 
                    <th colspan="<?php echo $n['grads'];?>"><?php echo $n['descripcion'];?></th>
                  <?php } ?> 
                </tr>
                <tr>    
                 <?php foreach ($grados as $key => $g){ ?> 
                    <th ><?php echo $g['descripciong'];?></th>
                  <?php } ?> 
                </tr>



              <?php foreach ($aulas as $key => $a){ ?> 
                <tr>    
                  <td rowspan="<?php echo count($turnos);?>" >Aula <?php echo $a['id'];?></td>

                 <?php for ($i=0; $i <count($turnos) ; $i++) {  ?> 

                  <?php if ($i > 1){ ?> 
                  </tr>
                  <?php } ?> 

                    <td><?php echo $turnos[$i]['descripcion'];?></td>

                    <?php for ($f=0; $f <count($grados) ; $f++) { ?> 

                        <?php $valid=false; ?>
                        
                        <?php foreach ($carga as $key => $c){ ?> 

                          <?php 
                              $v_aula = array_search($a['id'], array_column($c, 'aula_id'));
                              $v_turno = array_search($turnos[$i]['id'], array_column($c, 'turno_id'));
                              $v_grados = array_search($grados[$f]['id'], array_column($c, 'id_grado'));

                              if($a['id']==$c['aula_id'] && $turnos[$i]['id']==$c['turno_id'] && $grados[$f]['id']==$c['id_grado'] ){
                                $valid=true;
                              }
                          ?> 


                        <?php } ?>
                    

                        <?php if ( $valid  ){ ?> 
                            <th class='red'> </th>
                        <?php } else {?> 
                            <th > </th>

                        <?php } ?> 
                      
                    <?php } ?> 

                  </tr>

                <?php } ?>

              <?php } ?>

                
                <tr>
                  <td colspan="13">Total carga asignada 90%</td>
                </tr>

            </table>

  


          </div>
          </div>
  <!-- /.table-responsive -->
      </div>
      </div>
</div>

<!-- Metis Menu Plugin JavaScript -->


<footer>


    <script>
      $(document).ready(function() {
        //$('#example').DataTable();

        $('#buscador').keyup(function(){
          buscar = $(this).val();
            if(buscar.trim()!=''){
              $('#example tbody tr').hide();
              $("#example tbody tr:contains('" + buscar + "')").show();          
            }else{
              $('#example tbody tr').show();
            }
        });

        $('#nuevo').on( "click", function() {
           $('#Modal-registrar').find('input').val('');
        });

        $('#btn-buscar').on( "click", function() {
           $('#form-buscar').submit();
        });

        $('#guardar_nuevo').on( "click", function() {
          $('#Modal-registrar').modal('hide');
          $('#Modal-Confirmar').find(".modal-body").html('AGREGADO CORRECTAMENTE');
          $('#Modal-Confirmar').modal('show');

          setTimeout(function(){
            $('#form-nuevo').submit();
            }, 1700);
        }); 

        $('.aceptar_eliminacion').on( "click", function() {
          $('.modal-eliminar').modal('hide');
          $('#Modal-Confirmar').find(".modal-body").html('ELIMINADO CORRECTAMENTE');
          $('#Modal-Confirmar').modal('show');
          var item =$(this).attr('item');
          setTimeout(function(){
            $('#form-eliminar'+item).submit();
            }, 1700);
        });

        setTimeout(function(){
          var padre="Gestionar_horarios";
          var hijo="carga_academica";
          $('#'+padre).addClass('active');
          $('#'+padre).find('ul').css( "display", "block" );
          $('#'+hijo).addClass('principal');
            }, 100); 
  

      });
    </script>
    <script src="<?php echo RUTA ?>public/js/main.js"></script> 
    <script src="<?php echo RUTA ?>public/js/jquery.dataTables.js"></script>

    <div id="Modal-registrar" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registrar Carga Academica</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

           <div class="col-md-7">
             <input  id="buscador" name="search" type="text" class="form-control search" placeholder="Buscar">
         </div>

        <!--   <div class="modal-body">
          <form id="form-nuevo" action="<?php echo RUTA ?>admin/carga_academica/guardar.php" method="post">
        
            <div class="form-group">
              <label >Descripción</label>
              <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" name="descripcion" ng-model="model.name" onkeypress="return soloLetras(event)">
            </div> -->
                 
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="guardar_nuevo" type="button" class="btn btn-primary">Guardar</button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>

    <div id="Modal-Confirmar" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 75%;top: 130px;left: 27%;border-radius: 0px !important">


          <div class="modal-body" style=" margin-top: 35%;padding: 10% 20%;">
              ---
          </div>

        </div>
      </div>
    </div>

</footer>


</body>

</html>
