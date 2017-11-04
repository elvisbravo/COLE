<?php 

	require '../config/conexion.php';
	require '../config/config.php';
	$conexion = conectar();
	$don = $_POST['palabra'];

     $consulta5=$conexion->prepare("SELECT vigencias.id,personales.nombre,vigencias.fecha_entrada,vigencias.fecha_salida,vigencias.personal_id FROM vigencias INNER JOIN personales on vigencias.personal_id=personales.id WHERE vigencias.fecha_entrada LIKE '%$don%' OR vigencias.fecha_salida LIKE '%$don%' OR personales.nombre LIKE '%$don%' ");
$consulta5->execute();
$vigencias=$consulta5->fetchAll();

$consulta=$conexion->prepare("SELECT * FROM personales");
$consulta->execute();
$personal=$consulta->fetchAll();
 ?>
<table class="table table-bordered table-striped" id="example">  

    <thead class="thead-inverse" style="background-color: #548F81"> 
      <tr>
          <th>Nº</th>
          <th>Personal</th>
          <th>Fecha Entrada</th>
           <th>Fecha Salida</th>
            <th>Acciones</th>
      </tr>
    </thead>

                      
    <tbody>
       <?php foreach ($vigencias as $key => $value):?>
      <tr>
          <td><?php echo $key+1; ?></td>
          <td><?php echo $value['nombre'] ?></td>
          <td><?php echo $value['fecha_entrada'] ?></td>
          <td><?php echo $value['fecha_salida'] ?></td>

              
          <td>

           <a href="#" class="btn" data-toggle="modal" data-target="#editar-<?php echo $value['id'] ?>"  style="background-color: #0B7E72; color:white;">Editar</a>
           <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#eliminar-<?php echo $value['id'] ?>" >Eliminar</a>
          
           <div class="modal fade modal-editar" id="editar-<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Vigencias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form  id="<?php echo 'form-editar'.$value['id'] ?>" action="<?php echo RUTA ?>admin/vigencias/editar.php" method="post">
                     <div class="modal-body">
                   <input type="hidden" name="id" value="<?php echo $value['id'] ?>">

                            <div class="form-group ">
                               <label >Personal</label>
                              <select class="form-control1 ng-invalid ng-invalid-required" ng-model="model.select" name="Personal" required="">
                                   
                                     <?php foreach ($personal as $key => $values): ?>
                                      <?php if ($values['id']==$value['personal_id']){   ?>
                                          <option selected value="<?php echo $values['id'] ?>"><?php echo $values['nombre'] ?></option>
                                      <?php }else { ?>
                                          <option value="<?php echo $values['id'] ?>"><?php echo $values['nombre'] ?></option>
      
                                      <?php } ?>
                                    <?php endforeach; ?>
                                    </select>
                                  </div>

                                    <div class="form-group">
                            <label >Fecha Entrada</label>
                            <input type="date" class="form-control1 ng-invalid ng-invalid-required ng-touched" name="Fecha_Entrada" ng-model="model.name" value="<?php echo $value['fecha_entrada'] ?>">
                          </div>

                          <div class="form-group">
                            <label >Fecha Salida</label>
                            <input type="date" class="form-control1 ng-invalid ng-invalid-required ng-touched" name="Fecha_Salida" ng-model="model.name" value="<?php echo $value['fecha_salida'] ?>">
                          </div>
                                   
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                               <button type="button" item="<?php echo $value['id'] ?>" class="btn btn-primary aceptar_edicion">Guardar</button>
                        </div>
                  </form>
                </div>
              </div>
            </div> 





            <!--Modal de eliminar-->


            <div class="modal fade modal-eliminar" id="eliminar-<?php echo $value['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Vigencias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="<?php echo 'form-eliminar'.$value['id'] ?>"" action="<?php echo RUTA ?>admin/vigencias/eliminar.php" method="post">
                     <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                           ¿Desea eliminar Vigencia?
                      
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                          <button type="button" item="<?php echo $value['id'] ?>" class="btn btn-primary aceptar_eliminacion">Si</button>
                        </div>
                        </div>
                  </form>
                </div>
              </div>
            </div> 

          </td>
          
      </tr>

    <?php endforeach; ?>
                                  

    </tbody>

  </table>
   <script>
 	$(document).ready(function() {
 	$('.aceptar_edicion').on( "click", function() {
          $('.modal-editar').modal('hide');
          $('#Modal-Confirmar').find(".modal-body").html('ACTUALIZADO CORRECTAMENTE');
          $('#Modal-Confirmar').modal('show');
          var item =$(this).attr('item');
          setTimeout(function(){
            $('#form-editar'+item).submit();
            }, 1700);
        });
 	});
 </script>