<?php require_once 'controlador/unidad.php' ?>
<div class="content-wrapper">
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Unidades de medida</h1>
        </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Unidades de medida</li>
                </ol>
            </div>
        </div>
    </div>
    </section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
            <!-- Botón para ventana modal -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalregistrarUnidad">Registrar Unidad de medida</button>
            </div>
            <div class="card-body">
                <!-- MOSTRAR EL REGISTRO DE UNIDADES DE MEDIDA -->
            <div class="table-responsive">
            <table id="unidad" class="table table-bordered table-striped">
                <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo de medida</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($datos as $dato){
                    ?>
                    <tr>
                        <td><?php echo $dato['cod_unidad']?></td>
                        <td><?php echo $dato['tipo_medida']?></td>
                        <td>
                            <?php if ($dato['status']==1): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button name="ajustar" class="btn btn-primary btn-sm editar" title="Editar" data-toggle="modal" data-target="#modalmodificarunidad"
                                data-cod="<?php echo $dato['cod_unidad']; ?>" 
                                data-tipo="<?php echo $dato['tipo_medida']; ?>" 
                                data-status="<?php echo $dato['status']; ?>"> 
                                    <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button name="confirmar" class="btn btn-danger btn-sm eliminar" title="Eliminar" data-toggle="modal" id="modificar" data-target="#modaleliminar" data-cod="<?php echo $dato['cod_unidad'];?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </div>
            </table>
        </div>
    </div>

<!-- =======================
MODAL REGISTRAR Unidades de medida 
============================= -->

        <div class="modal fade" id="modalregistrarUnidad" tabindex="-1" aria-labelledby="modalregistrarUnidadLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #db6a00 ;color: #ffffff; ">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Unidad de medida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="formregistrarUnidad" method="post">
                            <!--   TIPO DE MEDIDA      -->
                            <div class="form-group">
                                <label for="tipo_medida">Tipo de medida</label>
                                <input type="text" class="form-control" name="tipo_medida" placeholder="Ingrese Tipo de Medida" id="tipo_medida1">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="guardar" onclick="return validacion();">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL EDITAR -->
        <div class="modal fade" id="modalmodificarunidad">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background: #db6a00; color: #ffffff;">
                                    <h4 class="modal-title">Editar Unidad</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="form" method="post" id="form-editar-unidad">
                                    <div class="modal-body">
                                        <input type="hidden" name="cod_unidad" id="cod_unidad_oculto" value="<?php echo $dato['cod_unidad'] ?>">
                                        <div class="form-group">
                                            <label for="cod_unidad">Código</label>
                                            <input type="text" class="form-control" name="cod_unidad" id="cod_unidad" value="<?php echo $dato['cod_unidad'] ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo_medida">Tipo de medida</label>
                                            <input type="text" class="form-control" name="tipo_medida" id="tipo_medida" value="<?php echo $dato['tipo_medida'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status">
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary" name="editar">Editar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Confirmar Eliminar Modal -->
        <div class="modal fade" id="modaleliminar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: #db6a00 ;color: #ffffff; ">
                        <h4 class="modal-title">Confirmar Eliminar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de eliminar la unidad medida?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <form method="post">
                        <input type="hidden" name="eliminar" id="cod_eliminar" value="">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="vista/dist/js/modulos-js/unidad.js"></script>