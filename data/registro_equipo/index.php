<?php 
session_start();
include '../../procesos/base.php';
include('../menu/app.php'); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>REGISTRO EQUIPO..</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="../../font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />        
    <link href="../../plugins/icon/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link href="../../dist/css/alertify.core.css" rel="stylesheet" />
    <link href="../../dist/css/alertify.default.css" id="toggleCSS" rel="stylesheet" />
    <link href="../../dist/css/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css"/>            
    <link href="../../dist/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/> 
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php banner_1(); ?>
      <?php menu_lateral_1(); ?>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Registro Equipos
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Mantenimiento</a></li>
            <li class="active">Registro Equipos</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="row">
                      <form id="registro_form" name="registro_form" method="post">
                        <div class="col-mx-12">                    
                          <div class="col-md-6">

                            <div class="form-group">
                              <label>Nombres Cliente: <font color="red">*</font></label>
                              <input type="text" name="txtCliente"  id="txtCliente" placeholder="Buscar....." class="form-control" />
                              <input type="hidden" id="txtClienteId" name="txtClienteId" class="form-control" />
                              <input type="hidden" id="txtRegistro" name="txtRegistro" class="form-control" />
                            </div>

                            <div class="form-group">
                              <label>Fecha Ingreso: <font color="red">*</font></label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="txtIngreso" id="txtIngreso" class="form-control"/>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Modelo: <font color="red">*</font></label>
                              <input type="text" name="txtModelo" id="txtModelo" placeholder="Indique el Modelo" class="form-control" />
                            </div>

                            <label>Marca: <font color="red">*</font></label>
                            <div class="input-group">
                              <select class="form-control" name="marca" id="marca">
                                <option value="">........Seleccione........</option>
                                <?php
                                $consulta = pg_query("select * from marcas ");
                                while ($row = pg_fetch_row($consulta)) {
                                    echo "<option id=$row[0] value=$row[0]>$row[1]</option>";
                                }
                                ?>     
                              </select>
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnMarcas">Agregar</button>
                              </span>
                            </div>
                            <br>

                            <div class="form-group" style="margin-top: -5px">
                              <label>Observaciones:</label>
                              <textarea class="form-control" name="txtObservaciones" id="txtObservaciones" rows="3"></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <label>Tipo Equipo: <font color="red">*</font></label>
                            <div class="input-group">
                              <select class="form-control" name="categoria" id="categoria">
                                <option value="">........Seleccione........</option>
                                <?php
                                $consulta = pg_query("select * from categoria ");
                                while ($row = pg_fetch_row($consulta)) {
                                    echo "<option id=$row[0] value=$row[0]>$row[1]</option>";
                                }
                                ?>     
                              </select>
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnCategoria">Agregar</button>
                              </span>
                            </div>
                            <br>

                            <div class="form-group" style="margin-top: -5px">
                              <label>Fecha Salida: <font color="red">*</font></label>
                              <div class="input-group">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="txtSalida" id="txtSalida" class="form-control" />
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Nro. Serie: <font color="red">*</font></label>
                              <input type="text" name="txtSerie" id="txtSerie" placeholder="Indique la Serie" class="form-control"/>
                            </div>

                            <label>Color: <font color="red">*</font></label>
                            <div class="input-group">
                              <select class="form-control" name="colores" id="colores">
                                <option value="">........Seleccione........</option>
                                <?php
                                $consulta = pg_query("select * from color ");
                                while ($row = pg_fetch_row($consulta)) {
                                    echo "<option id=$row[0] value=$row[0]>$row[1]</option>";
                                }
                                ?>     
                              </select>
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnColores">Agregar</button>
                              </span>
                            </div><!-- /input-group -->
                            <br>

                            <div class="form-group" style="margin-top: -5px">
                              <label>Accesorios:</label>
                              <textarea class="form-control" name="txtAccesorios" id="txtAccesorios" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>

                  <div class="row">
                    <div class="col-mx-12">
                      <p>
                        <button class="btn bg-olive margin" id='btnGuardar'><i class="fa fa-save"></i> Guardar</button>
                        <button class="btn bg-olive margin" id='btnModificar'><i class="fa fa-edit"></i> Modificar</button>
                        <button class="btn bg-olive margin" id='btnEliminar'><i class="fa fa-remove"></i> Eliminar</button>
                        <button class="btn bg-olive margin" id='btnBuscar'><i class="fa fa-search"></i> Buscar</button>
                        <button class="btn bg-olive margin" id='btnNuevo'><i class="fa fa-pencil"></i> Nuevo</button>
                        <button class="btn bg-olive margin" id='btnImprimir'><i class="fa fa-print"></i> Imprimir</button>
                        <button class="btn bg-olive margin" id='btnAtras'><i class="fa fa-backward"></i> Atras</button>
                        <button class="btn bg-olive margin" id='btnAdelante'>Adelante <i class="fa fa-forward"></i></button>
                      </p> 
                    </div> 

                    <div id="bRegistros" title="Búsqueda de Registros" class="">
                      <table id="list"><tr><td></td></tr></table>
                      <div id="pager"></div>
                    </div>

                    <div id="categorias" title="AGREGAR CATEGORIAS">
                      <div class="form-group">
                        <label>Nombre Categoria: <font color="red">*</font></label>
                        <input type="text" name="nombre_categoria" id="nombre_categoria" placeholder="Ingrese la Categoria" class="form-control"/>
                      </div>
                      <button class="btn btn-primary" id='btnGuardarCategoria'>Guardar</button>
                    </div>

                    <div id="marcas" title="AGREGAR MARCAS">
                      <div class="form-group">
                        <label>Nombre Marca: <font color="red">*</font></label>
                        <input type="text" name="nombre_marca" id="nombre_marca" placeholder="Ingrese una Marca" class="form-control"/>
                      </div>
                      <button class="btn btn-primary" id='btnGuardarMarca'>Guardar</button>
                    </div>

                    <div id="color" title="AGREGAR COLORES">
                      <div class="form-group">
                        <label>Nombre Color: <font color="red">*</font></label>
                        <input type="text" name="nombre_color" id="nombre_color" placeholder="Ingrese un Color" class="form-control"/>
                      </div>
                      <button class="btn btn-primary" id='btnGuardarColor'>Guardar</button>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php footer(); ?>
    </div>

    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <script src="registroEquipo.js" type="text/javascript"></script>
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <script src="../../dist/js/validCampoFranz.js" type="text/javascript" ></script>
    <script src="../../dist/js/alertify.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
    <script src="../../dist/js/jquery.jqGrid.src.js" type="text/javascript"></script>
    <script src="../../dist/js/grid.locale-es.js" type="text/javascript"></script>
    <link href="../../dist/css/style.css" rel="stylesheet" type="text/css"/>     
    <script src="../../dist/js/ventana_reporte.js" type="text/javascript"></script>

  </body>
</html>