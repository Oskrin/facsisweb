$(document).on("ready", inicio);

var formatoFecha = {
    // showButtonPanel: true,
    // changeMonth: true,
    // changeYear: true,
    dateFormat: "yy-mm-dd" + "  " + getCurrentTime(),
    showAnim: 'slide'
};

var formatoFecha1 = {
    // showButtonPanel: true,
    // changeMonth: true,
    // changeYear: true,
    dateFormat: "yy-mm-dd",
    showAnim: 'slide'
};

var dialogos =
{
    autoOpen: false,
    resizable: false,
    width: 760,
    height: 400,
    modal: true
};

var dialogo_categoria =
{
    autoOpen: false,
    resizable: false,
    width: 250,
    height: 180,
    modal: true
};

var dialogo_marca =
{
    autoOpen: false,
    resizable: false,
    width: 230,
    height: 180,
    modal: true
};

var dialogo_color =
{
    autoOpen: false,
    resizable: false,
    width: 230,
    height: 180,
    modal: true
};

function abrirCategoria() {
    $("#categorias").dialog("open");
}

function abrirMarca() {
    $("#marcas").dialog("open");
}

function abrirColor() {
    $("#color").dialog("open");
}

function agregar_categoria() {
    if ($("#nombre_categoria").val() === "") {
        $("#nombre_categoria").focus();
        alertify.error("Nombre de la Categoria");
    }else{
        $.ajax({
            type: "POST",
            url: "guardar_categoria.php",
            data: "nombre_categoria=" + $("#nombre_categoria").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#nombre_categoria").val("");
                    $("#categoria").load("categorias_combos.php");
                    $("#categorias").dialog("close");
                }else{
                    $("#nombre_categoria").val("");
                    alertify.error("Error.... La categoria ya existe");
                }
            }
        });
    }
}

function agregar_marca() {
    if ($("#nombre_marca").val() === "") {
        $("#nombre_marca").focus();
        alertify.error("Nombre de la Marca");
    }else{
        $.ajax({
            type: "POST",
            url: "guardar_marca.php",
            data: "nombre_marca=" + $("#nombre_marca").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#nombre_marca").val("");
                    $("#marca").load("marcas_combos.php");
                    $("#marcas").dialog("close");
                } else {
                    $("#nombre_marca").val("");
                    alertify.error("Error.... La marca ya existe");
                }
            }
        });
    }
}

function agregar_color() {
    if ($("#nombre_color").val() === "") {
        $("#nombre_color").focus();
        alertify.error("Nombre del Color");
    }else{
        $.ajax({
            type: "POST",
            url: "guardar_color.php",
            data: "nombre_color=" + $("#nombre_color").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#nombre_color").val("");
                    $("#colores").load("colores_combos.php");
                    $("#color").dialog("close");
                }else{
                    $("#nombre_color").val("");
                    alertify.error("Error.... El color ya existe");
                }
            }
        });
    }
}

function getCurrentTime() {
    var CurrentTime = "";
    try {
        var CurrentDate = new Date();
        var CurrentHours = CurrentDate.getHours();
        var CurrentMinutes = CurrentDate.getMinutes();
        var CurrentAmPm = "A'M'";
        if (CurrentMinutes < 10) {
            CurrentMinutes = "0" + CurrentMinutes;
        }

        if (CurrentHours === 12) {
            CurrentHours = 12;
            CurrentAmPm = " P'M'";
        }
        else if (CurrentHours === 0) {
            CurrentHours = 12;
            CurrentAmPm = " A'M'";
        }
        else if (CurrentHours > 12) {
            CurrentHours = CurrentHours - 12;
            CurrentAmPm = " P'M'";
        }
        else {
            CurrentAmPm = " A'M'";
        }
        CurrentTime = "" + CurrentHours + ":" + CurrentMinutes + CurrentAmPm + "";
    }
    catch (ex) {
    }
    return CurrentTime;
}

function guardarRegistro() {
    if($("#txtClienteId").val() === "") {
        $("#txtCliente").focus(); 
        alertify.error("Ingrese un cliente");
    }else{
        if($("#categoria").val() === "") {
             $("#categoria").focus();
            alertify.error("Ingrese el tipo de equipo");
        }else{
            if($("#txtModelo").val() === "") {
                $("#txtModelo").focus(); 
                alertify.error("Ingrese un modelo");
            }else{
                if($("#txtSerie").val() === "") {
                    $("#txtSerie").focus();
                    alertify.error("Ingrese la serie");
                }else{
                    if($("#marca").val() === "") {
                        $("#marca").focus(); 
                        alertify.error("Ingrese un marca");
                    }else{
                        if($("#colores").val() === "") {
                            $("#colores").focus();
                            alertify.error("Ingrese una color");
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "procesosRegistroEquipo.php",
                                data: $("#registro_form").serialize() + "&tipo=" + "g",
                                success: function(data) {
                                    var val = data;
                                    if (val == 0) {
                                        alertify.alert("Datos Agregados Correctamente", function(){
                                        id = $("#txtRegistro").val();
                                        window.open("../../reportes/reporteRegistro.php?id=" + id);
                                        limpiarDatos();
                                        $("#txtRegistro").val(parseInt(id) + 1);   
                                        });
                                    } 
                                    if (val == 1) {
                                        alertify.alert("Error.. durante el proceso");
                                    }
                                }
                            });
                        }
                    }
                }
            }
        }
    }
}

function modificarRegistro(e){
    if($("#txtClienteId").val() === ""){
        $("#txtCliente").focus(); 
        alertify.error("Ingrese un registro");
    }else{
        if($("#categoria").val() === ""){
            $("#categoria").focus(); 
            alertify.error("Ingrese el tipo de equipo");
        }else{
            if($("#txtModelo").val() === ""){
                $("#txtModelo").focus(); 
                alertify.error("Ingrese un modelo");
            }else{
                if($("#txtSerie").val() === ""){
                    $("#txtSerie").focus();
                    alertify.error("Ingrese la serie");
                }else{
                    if($("#marca").val() === ""){
                        $("#marca").focus(); 
                        alertify.error("Ingrese un marca");
                    }else{
                        if($("#colores").val() === ""){
                            $("#colores").focus();
                            alertify.error("Ingrese una color");
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "procesosRegistroEquipo.php",
                                data: $("#registro_form").serialize() + "&tipo=" + "m",
                                success: function(data) {
                                    var val = data; 
                                    if (val == 0) {
                                        alertify.alert("Datos Modificados", function(){
                                        $("#txtRegistro").val("");
                                        location.reload();   
                                        });
                                    }
                                    if (val == 1) {
                                        alertify.alert("Error.. durante el proceso");
                                    }
                                }
                            });
                        }
                    }
                }
            }
        }
    }
}

function flecha_atras(){
$.ajax({
   type: "POST",
   url: "../../procesos/flechas.php",
   data: "comprobante=" + $("#txtRegistro").val() + "&tabla=" + "registro_equipo" + "&id_tabla=" + "id_registro" + "&tipo=" + 1,
   success: function(data) {
       var val = data;
       if(val != ""){
            $("#txtRegistro").val(val);
            var valor = $("#txtRegistro").val();
            
              ///////////////////llamar proforma flechas primera parte/////
            $("#btnGuardar").attr("disabled", true);

            $.getJSON('retornar_registro_equipo.php?com=' + valor, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 14) {
                        $("#txtClienteId").val(data[i]);
                        $("#txtCliente").val(data[i + 1]);
                        $("#categoria").val(data[i + 2]);
                        $("#txtIngreso").val(data[i + 4]);
                        $("#txtSalida").val(data[i + 5]);
                        $("#txtModelo").val(data[i + 6]);
                        $("#txtSerie").val(data[i + 7]);
                        $("#marca").val(data[i + 8]);
                        $("#colores").val(data[i + 10]);
                        $("#txtObservaciones").val(data[i + 12]);
                        $("#txtAccesorios").val(data[i + 13]);
                    }
                }
            }); 
       }else{
           alertify.alert("No hay mas registros posteriores!!");
       }
   }
}); 
} 

function flecha_siguiente(){
    $.ajax({
       type: "POST",
       url: "../../procesos/flechas.php",
       data: "comprobante=" + $("#txtRegistro").val() + "&tabla=" + "registro_equipo" + "&id_tabla=" + "id_registro" + "&tipo=" + 2,
       success: function(data) {
           var val = data;
           if(val != ""){
                $("#txtRegistro").val(val);
                var valor = $("#txtRegistro").val();
                
                  ///////////////////llamar proforma flechas primera parte/////
                $("#btnGuardar").attr("disabled", true);

                $.getJSON('retornar_registro_equipo.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 14) {
                            $("#txtClienteId").val(data[i]);
                            $("#txtCliente").val(data[i + 1]);
                            $("#categoria").val(data[i + 2]);
                            $("#txtIngreso").val(data[i + 4]);
                            $("#txtSalida").val(data[i + 5]);
                            $("#txtModelo").val(data[i + 6]);
                            $("#txtSerie").val(data[i + 7]);
                            $("#marca").val(data[i + 8]);
                            $("#colores").val(data[i + 10]);
                            $("#txtObservaciones").val(data[i + 12]);
                            $("#txtAccesorios").val(data[i + 13]);
                        }
                    }
                }); 
           }else{
               alertify.alert("No hay mas registros superiores!!");
           }
       }
    }); 
} 

function limpiarDatos() {
    $("input").val("");
    $("textarea").val("");
}

function abrirDialogo(e) {
    $("#bRegistros").dialog("open");
    $("#list").trigger("reloadGrid");
}

function limpiar_campo() {
    if($("#txtCliente").val() === "") {
        $("#txtClienteId").val("");
    }
}

function inicio() {
    /////////////cambiar idioma///////
     $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    //////////////////////////////////////
    alertify.set({ delay: 1000 });
    $("#txtCliente").focus();

    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });

    $("#btnBuscar").click(function(e) {
        e.preventDefault();
    });

    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });

    $("#btnNuevo").click(function(e) {
        location.reload();
    });
    
    $("#btnAtras").click(function(e) {
        e.preventDefault();
    });
    $("#btnAdelante").click(function(e) {
        e.preventDefault();
    });

    $("#btnImprimir").click(function (){
       $.ajax({
        type: "POST",
        url: "../../procesos/validacion.php",
        data: "comprobante=" + $("#txtRegistro").val() + "&tabla=" + "registro_equipo" + "&id_tabla=" + "id_registro" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != "") {
                window.open("../../reportes/reporteRegistro.php?id=" + $("#txtRegistro").val());  
            } else {
              alertify.alert("Ingreso no creado!!");
            }   
        }
        });        
    });

    $("#bRegistros").dialog(dialogos);
    $("#btnBuscar").on("click", abrirDialogo);
    $("#btnGuardar").on("click", guardarRegistro);
    $("#btnModificar").on('click', modificarRegistro);
    $("#btnAtras").on("click", flecha_atras);
    $("#btnAdelante").on("click", flecha_siguiente);
    $("#btnNuevo").on('click', limpiarDatos);
    $("#txtIngreso").datepicker(formatoFecha);
    $("#txtSalida").datepicker(formatoFecha1);
    $("#btnCategoria").on("click", abrirCategoria);
    $("#btnGuardarCategoria").on("click", agregar_categoria);
    $("#btnMarcas").on("click", abrirMarca);
    $("#btnGuardarMarca").on("click", agregar_marca);
    $("#btnColores").on("click", abrirColor);
    $("#btnGuardarColor").on("click", agregar_color);
    
    $("#txtCliente").on("keyup", limpiar_campo);

    $("#categorias").dialog(dialogo_categoria);
    $("#marcas").dialog(dialogo_marca);
    $("#color").dialog(dialogo_color);

    //////////////////BUSCADORES////////////////////
    $("#txtCliente").autocomplete({
        source: "busquedaCliente.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#txtCliente").val(ui.item.value);
        $("#txtClienteId").val(ui.item.label);
        return false;
        },
        select: function(event, ui) {
        $("#txtCliente").val(ui.item.value);
        $("#txtClienteId").val(ui.item.label);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };

    // $("#txtTipoEquipo").autocomplete({
    //     source: "busquedaEquipo.php",
    //     minLength: 1,
    //     focus: function(event, ui) {
    //     $("#txtTipoEquipo").val(ui.item.value);
    //     $("#txtTipoEquipoId").val(ui.item.label);
    //     return false;
    //     },
    //     select: function(event, ui) {
    //     $("#txtTipoEquipo").val(ui.item.value);
    //     $("#txtTipoEquipoId").val(ui.item.label);
    //     return false;
    //     }
    //     }).data("ui-autocomplete")._renderItem = function(ul, item) {
    //     return $("<li>")
    //     .append("<a>" + item.value + "</a>")
    //     .appendTo(ul);
    // };

    // $("#txtColor").autocomplete({
    //     source: "busquedaColor.php",
    //     minLength: 1,
    //     focus: function(event, ui) {
    //     $("#txtColor").val(ui.item.value);
    //     $("#txtColorId").val(ui.item.label);
    //     return false;
    //     },
    //     select: function(event, ui) {
    //     $("#txtColor").val(ui.item.value);
    //     $("#txtColorId").val(ui.item.label);
    //     return false;
    //     }
    //     }).data("ui-autocomplete")._renderItem = function(ul, item) {
    //     return $("<li>")
    //     .append("<a>" + item.value + "</a>")
    //     .appendTo(ul);
    // };

    // $("#txtMarca").autocomplete({
    //     source: "busquedaMarca.php",
    //     minLength: 1,
    //     focus: function(event, ui) {
    //     $("#txtMarca").val(ui.item.value);
    //     $("#txtMarcaId").val(ui.item.label);
    //     return false;
    //     },
    //     select: function(event, ui) {
    //     $("#txtMarca").val(ui.item.value);
    //     $("#txtMarcaId").val(ui.item.label);
    //     return false;
    //     }
    //     }).data("ui-autocomplete")._renderItem = function(ul, item) {
    //     return $("<li>")
    //     .append("<a>" + item.value + "</a>")
    //     .appendTo(ul);
    // };

    ////////
    $.ajax({
        type: "POST",
        url: "contadorRegistro.php",
        success: function(data) {
            var val = data;
            $("#txtRegistro").val(val);
        }
    });

    //cargar fechas/////
    $("#txtIngreso").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    $("#txtSalida").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');


    
        jQuery("#list").jqGrid({
        url: 'xmlRegistroEquipo.php',
        datatype: 'xml',
        colNames: ['Nro Registro', 'Id Cliente', 'Nombres Cliente', 'Id categoria', 'Tipo de Equipo', 'Fecha Ingreso', 'Fecha Salida', 'Modelo', 'Nro. de Serie', 'Id Marca', 'Marca', 'Id color', 'Nombre Color', 'Accesosios', 'Observaciones', 'Estado'],
        colModel: [
            {name: 'txtRegistro', index: 'txtRegistro', editable: true, align: 'center', width: '100', search: false, frozen: true},
            {name: 'txtClienteId', index: 'txtClienteId', search: false, editable: false, hidden: true, editrules: {edithidden: false}, align: 'center', frozen: true, width: 80},
            {name: 'txtCliente', index: 'txtCliente', editable: true, align: 'center', width: '150', search: true, frozen: true},
            {name: 'categoria', index: 'categoria', search: false, editable: false, hidden: true, editrules: {edithidden: false}, align: 'center', frozen: true, width: 80},
            {name: 'txtTipoEquipo', index: 'txtTipoEquipo', editable: true, align: 'center', width: '150', search: true, frozen: true},
            {name: 'txtIngreso', index: 'txtIngreso', editable: true, align: 'center', width: '150', search: false, frozen: true},
            {name: 'txtSalida', index: 'txtSalida', editable: true, align: 'center', width: '120', search: false, frozen: true},
            {name: 'txtModelo', index: 'txtModelo', editable: true, align: 'center', width: '150', search: false, frozen: true},
            {name: 'txtSerie', index: 'txtSerie', editable: true, align: 'center', width: '150', search: true, frozen: true},
            {name: 'marca', index: 'marca', search: false, editable: false, hidden: true, editrules: {edithidden: false}, align: 'center', frozen: true, width: 80},
            {name: 'txtMarca', index: 'txtMarca', editable: true, align: 'center', width: '150', search: true, frozen: true},
            {name: 'colores', index: 'colores', search: false, editable: false, hidden: true, editrules: {edithidden: false}, align: 'center', frozen: true, width: 80},
            {name: 'txtColor', index: 'txtColor', editable: true, align: 'center', width: '150', search: true, frozen: true},
            {name: 'txtAccesorios', index: 'txtAccesorios', editable: true, align: 'center', width: '150', search: false, frozen: true},
            {name: 'txtObservaciones', index: 'txtObservaciones', editable: true, align: 'center', width: '150', search: false, frozen: true},
            {name: 'estado', index: 'estado', editable: true, align: 'center', width: '150', search: true, frozen: true}
        ],
        rowNum: 10,
        rowList: [10, 20, 30],
        width: 720,
        height: 250,
        pager: jQuery('#pager'),
        sortname: 'id_registro',
        shrinkToFit: false,
        sortorder: 'asc',
        caption: 'Lista Registro',
        viewrecords: true,
        gridview: true,
        ondblClickRow: function() {
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            if (id) {
                var ret = jQuery("#list").jqGrid('getRowData', id);
                jQuery("#list").jqGrid('GridToForm', id, "#registro_form");
                $("#bRegistros").dialog('close');
                $("#btnGuardar").attr("disabled", true);
            } else {
              alertify.alert("Seleccione un fila");
            }
        }
    }).jqGrid('navGrid', '#pager',
            {
                add: false,
                edit: false,
                del: false,
                refresh: true,
                search: true,
                view: true
            },
    {
        recreateForm: true, closeAfterEdit: true, checkOnUpdate: true, reloadAfterSubmit: true, closeOnEscape: true
    },
    {
        reloadAfterSubmit: true, closeAfterAdd: true, checkOnUpdate: true, closeOnEscape: true,
        bottominfo: "Todos los campos son obligatorios son obligatorios"
    },
    {
        width: 300, closeOnEscape: true
    },
    {
        sopt: ['eq', 'bw'],
        multipleSearch: false, overlay: false
    },
    {
        closeOnEscape: true,
        width: 400
    },
    {
        closeOnEscape: true
    });
    jQuery("#list").jqGrid('navButtonAdd', '#pager', {caption: "Modificar",
        onClickButton: function() {
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            if (id) {
                var ret = jQuery("#list").jqGrid('getRowData', id);
                jQuery("#list").jqGrid('GridToForm', id, "#registro_form");
                $("#bRegistros").dialog('close');
                $("#btnGuardar").attr("disabled", true);
            } else {
              alertify.alert("Seleccione un fila");
            }
        }
    });

    jQuery("#list").jqGrid('navButtonAdd', '#pager', {caption: "PDF",
        onClickButton: function() {
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            if (id) {
                var ret = jQuery("#list").jqGrid('getRowData', id);
                window.open("../reportes/reportes/reporteRegistro.php?id=" + ret.txtRegistro);
            } else {
              alertify.alert("Seleccione un fila");
            }
        }
    });
/////////////////////
    
 
}

