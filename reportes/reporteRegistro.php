<?php
  require('../fpdf/fpdf.php');
    include '../procesos/base.php';
    include '../procesos/funciones.php';
    conectarse();    
    date_default_timezone_set('America/Guayaquil'); 
    session_start()   ;
    class PDF extends FPDF{   
        var $widths;
        var $aligns;       
        function SetWidths($w){            
            $this->widths=$w;
        }                                   
    }
    $pdf = new PDF('P','mm','a4');
    $pdf->SetAutoPageBreak(false,0);  
    $fecha = date('Y-m-d', time());
    $pdf->AddPage();
    $pdf->SetMargins(0,0,0,0);
    $pdf->AliasNbPages();
    $pdf->AddFont('Amble-Regular','','Amble-Regular.php');
    $pdf->SetFont('Amble-Regular','',10);       
    $pdf->SetFont('Arial','B',9);   
    $pdf->SetX(5);    
    $pdf->SetFont('Amble-Regular','',9);     
    
    //////////////////////////////////////MITAD HOJA                
    $pdf->SetY(3);
    $pdf->SetX(3);
    $pdf->Cell(20, 4, $fecha, 0,0, 'C', 0);                         
    $pdf->Cell(180, 4, "RESPONSABLE", 0,1, 'R', 0);      
    $pdf->SetFont('Arial','B',14);                                                    
    $pdf->Cell(210, 6, $_SESSION['empresa'], 0,1, 'C',0);                                
    $pdf->Image('../images/logo_empresa.jpg',5,8,35,20);
    $pdf->SetFont('Amble-Regular','',10);            
    $pdf->Cell(210, 4, "PROPIETARIO: ".maxCaracter(utf8_decode($_SESSION['propietario']),55),0,1, 'C',0);
    $pdf->Cell(109, 4, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
    $pdf->Cell(50, 4, "CEL.: ".maxCaracter(utf8_decode($_SESSION['celular']),15),0,0, 'L',0);                                
    $pdf->Cell(45, 4, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'R',0);                                                                                                    
    $pdf->Cell(210, 4, "DIR.: ".maxCaracter(utf8_decode($_SESSION['direccion']),60),0,1, 'C',0);                                
    $pdf->Cell(210, 4, maxCaracter(utf8_decode($_SESSION['slogan']),60),0,1, 'C',0);                                    
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.4);            
    $pdf->Line(1,35,297,35);            
    $pdf->SetFont('Arial','B',12);                                                                            
    $pdf->Cell(210, 5, utf8_decode("FORMULARIO DE INGRESO"),0,1, 'C',0);                                                                                                                            
    $pdf->SetFont('Amble-Regular','',9);                

    $sql = "select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_registro='".$_GET['id']."'";
    $sql = pg_query($sql);           
    while ($row = pg_fetch_row($sql)) {
        $pdf->Ln(1);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "REGISTRO NRO.: ",0,0, 'L',0);
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[0]),10),0,0, 'L',0);
        $pdf->Cell(30, 5, "FECHA ENTRADA: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[9]),10),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "CLIENTE.: ",0,0, 'L',0);
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[24]),40),0,0, 'L',0);
        $pdf->Cell(30, 5, "FECHA SALIDA: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[12]),10),0,1, 'L',0);    

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "TEL.: ",0,0, 'L',0);    
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[27]),40),0,0, 'L',0);    
        $pdf->Cell(30, 5, "MARCA: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[19]),40),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "CEL.: ",0,0, 'L',0);        
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[28]),40),0,0, 'L',0);        
        $pdf->Cell(30, 5, "NRO SERIE: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[4]),40),0,1, 'L',0);
        
        $pdf->SetX(3);    
        $pdf->Cell(30, 5, "DIR..: ",0,0, 'L',0);        
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[26]),40),0,0, 'L',0);        
        $pdf->Cell(30, 5, "MODELO.: ",0,0, 'L',0);    
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[11]),40),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "TIPO EQUIPO.: ",0,0, 'L',0);
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[49]),40),0,0, 'L',0);
        $pdf->Cell(30, 5, "COLOR.: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[16]),40),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "REGISTRADO.: ",0,0, 'L',0);        
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[37])." ".utf8_decode($row[38]),40),0,0, 'L',0);        
        $pdf->Cell(30, 5, "TEL/CEL.: ",0,0, 'L',0);    
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[40]." - ".$row[41] ),22),0,1, 'L',0);

        $pdf->Ln(2);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "ACCESORIOS: ",0,0, 'L',0);    
        $pdf->SetX(33);
        $pdf->MultiCell(170, 4, maxCaracter(utf8_decode($row[6]),280),0,'L',0);

        $pdf->SetY(87);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "OBSERVACIONES: ",0,1, 'L',0);    
        $pdf->SetY(87);
        $pdf->SetX(33);
        $pdf->MultiCell(170, 4, maxCaracter(utf8_decode($row[5]),280),0,'L',0);
        
        $pdf->SetY(102);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "NOTAS: ",0,1, 'L',0);    
        $pdf->SetY(102);
        $pdf->SetX(33);
        $pdf->MultiCell(170, 4, maxCaracter(utf8_decode("El diagnóstico del equipo tiene un precio mínimo de $10.00 (Diez Dólares) \nToda máquina reparada y no retirada en tres meses será subastada \nFavor revisar que en su orden consten todos los componentes que usted deja. No se admitiran reclamos posteriores\nPyS Systems no se responsabiliza por la pérdida de la información"),400),0,'L',0);

        $pdf->SetY(130);
        $pdf->SetX(3);
        $pdf->Cell(100, 5, "__________________________________________",0,0, 'C',0);    
        $pdf->Cell(102, 5, "__________________________________________",0,1, 'C',0);    
        $pdf->SetX(3);
        $pdf->Cell(100, 5, "ENTREGE CONFORME",0,0, 'C',0);    
        $pdf->Cell(102, 5, "RECIBI CONFORME",0,1, 'C',0);    

    }
    $pdf->Line(1,70,297,70);            
    ///////////////////////////////////////MITAD HOJA
    
    $pdf->SetY(150);
    $pdf->SetX(3);
    $pdf->Cell(20, 4, $fecha, 0,0, 'C', 0);                         
    $pdf->Cell(185, 4, "CLIENTE", 0,1, 'R', 0);      
    $pdf->SetFont('Arial','B',14);                                                    
    $pdf->Cell(210, 6, $_SESSION['empresa'], 0,1, 'C',0);                                

    $pdf->Image('../images/logo_empresa.jpg',5,155,35,20);
    $pdf->SetFont('Amble-Regular','',10);            
    $pdf->Cell(210, 4, "PROPIETARIO: ".maxCaracter(utf8_decode($_SESSION['propietario']),55),0,1, 'C',0);
    $pdf->Cell(109, 4, "TEL.: ".utf8_decode($_SESSION['telefono']),0,0, 'R',0);                                
    $pdf->Cell(50, 4, "CEL.: ".maxCaracter(utf8_decode($_SESSION['celular']),15),0,0, 'L',0);                                
    $pdf->Cell(45, 4, utf8_decode( $_SESSION['pais_ciudad']),0,1, 'R',0);                                                                                                    
    $pdf->Cell(210, 4, "DIR.: ".maxCaracter(utf8_decode($_SESSION['direccion']),60),0,1, 'C',0);                                
    $pdf->Cell(210, 4, maxCaracter(utf8_decode($_SESSION['slogan']),60),0,1, 'C',0);                                    
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(0.4);            
    $pdf->Line(1,181,297,181);            
    $pdf->Line(1,217,297,217);       
    $pdf->SetFont('Arial','B',12);                                                                            
    $pdf->Cell(210, 5, utf8_decode("FORMULARIO DE INGRESO"),0,1, 'C',0);                                                                                                                            
    $pdf->SetFont('Amble-Regular','',9);                
    $sql = "select * from registro_equipo,color,marcas,clientes,usuario,categoria where registro_equipo.id_color=color.id_color and registro_equipo.id_marca=marcas.id_marca and registro_equipo.id_cliente=clientes.id_cliente and registro_equipo.id_usuario=usuario.id_usuario and registro_equipo.id_categoria=categoria.id_categoria and registro_equipo.id_registro='".$_GET['id']."'";
    $sql = pg_query($sql);           
     while ($row = pg_fetch_row($sql)) {
        $pdf->Ln(1);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "REGISTRO NRO.: ",0,0, 'L',0);
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[0]),10),0,0, 'L',0);
        $pdf->Cell(30, 5, "FECHA ENTRADA: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[9]),10),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "CLIENTE.: ",0,0, 'L',0);
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[24]),40),0,0, 'L',0);
        $pdf->Cell(30, 5, "FECHA SALIDA: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[12]),10),0,1, 'L',0);    

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "TEL.: ",0,0, 'L',0);    
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[27]),40),0,0, 'L',0);    
        $pdf->Cell(30, 5, "MARCA: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[19]),40),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "CEL.: ",0,0, 'L',0);        
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[28]),40),0,0, 'L',0);        
        $pdf->Cell(30, 5, "NRO SERIE: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[4]),40),0,1, 'L',0);
        
        $pdf->SetX(3);    
        $pdf->Cell(30, 5, "DIR..: ",0,0, 'L',0);        
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[26]),40),0,0, 'L',0);        
        $pdf->Cell(30, 5, "MODELO.: ",0,0, 'L',0);    
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[11]),40),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "TIPO EQUIPO.: ",0,0, 'L',0);
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[49]),40),0,0, 'L',0);
        $pdf->Cell(30, 5, "COLOR.: ",0,0, 'L',0);
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[16]),40),0,1, 'L',0);

        $pdf->SetX(3);
        $pdf->Cell(30, 5, "REGISTRADO.: ",0,0, 'L',0);        
        $pdf->Cell(90, 5, maxCaracter(utf8_decode($row[37])." ".utf8_decode($row[38]),40),0,0, 'L',0);        
        $pdf->Cell(30, 5, "TEL/CEL.: ",0,0, 'L',0);    
        $pdf->Cell(52, 5, maxCaracter(utf8_decode($row[40]." - ".$row[41] ),22),0,1, 'L',0);

        $pdf->Ln(2);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "ACCESORIOS: ",0,0, 'L',0);    
        $pdf->SetX(33);
        $pdf->MultiCell(170, 4, maxCaracter(utf8_decode($row[6]),280),0,'L',0);

        $pdf->SetY(236);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "OBSERVACIONES: ",0,1, 'L',0);    
        $pdf->SetY(236);
        $pdf->SetX(33);
        $pdf->MultiCell(170, 4, maxCaracter(utf8_decode($row[5]),280),0,'L',0);
        
        $pdf->SetY(255);
        $pdf->SetX(3);
        $pdf->Cell(30, 5, "NOTAS: ",0,1, 'L',0);    
        $pdf->SetY(255);
        $pdf->SetX(33);
        $pdf->MultiCell(170, 4, maxCaracter(utf8_decode("El diagnóstico del equipo tiene un precio mínimo de $10.00 (Diez Dólares) \nToda máquina reparada y no retirada en tres meses será subastada \nFavor revisar que en su orden consten todos los componentes que usted deja. No se admitiran reclamos posteriores\nPyS Systems no se responsabiliza por la pérdida de la información"),400),0,'L',0);

        $pdf->SetY(280);
        $pdf->SetX(3);
        $pdf->Cell(100, 5, "__________________________________________",0,0, 'C',0);    
        $pdf->Cell(102, 5, "__________________________________________",0,1, 'C',0);    
        $pdf->SetX(3);
        $pdf->Cell(100, 5, "ENTREGE CONFORME",0,0, 'C',0);    
        $pdf->Cell(102, 5, "RECIBI CONFORME",0,1, 'C',0);    

    }            

    $pdf->Output();

?>