<?php

    session_start();

    if(!isset($_SESSION["email"])){
        
        header("Location: ../index.php");
        exit;
            
    }
    // output headers so that the file is downloaded rather than displayed
    date_timezone_set($fecha, timezone_open('America/Mexico_City'));
    $current = date_format($fecha, 'Y-m-d H:i:sP') . "\n";


    //date_timezone_set(new DateTimeZone('America/Mexico_City'));
    //$current = $fecha->format('d-m-Y_hia');
    $name='data_'.$current.'.csv';

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=exportCSV.csv');
    function array_2_csv($array) {
        $csv = array();
        foreach ($array as $item) {
            if (is_array($item)) {
                $csv[] = array_2_csv($item);
            } else {
                $csv[] = $item;
            }
        }
        return implode(',', $csv);
    }   

    //require_once('../phpTools/utilities.php');
    // mysql database connection details
    $host = "localhost";
    $username = "dbo600436593";
    $password = "20eligefacil15#";
    $dbname = "db600436593UTF8";

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
    mysqli_query("SET NAMES 'utf8'");
    if(!isset($_GET['estado'])){
        $_GET['estado']=0;
    }
    // fetch mysql table rows
    if($_GET['estado']==0){
        $sql = "SELECT 
                DISTINCT(P.id_plan),
                S.nombre as estado,
                P.nombre, 
                P.precio, 
                P.dato_principal_1,
                P.id_tipoDato_principal_1, 
                P.dato_principal_2, 
                P.id_tipoDato_principal_2, 
                P.dato_principal_3, 
                P.id_tipoDato_principal_3, 
                P.dato_principal_4,
                P.id_tipoDato_principal_4, 
                P.mas_datos, P.visible, 
                E.nombre as empresa, 
                E.codigo_color as empresa_color,
                TDS1.label as dato1,
                TDS1.tipo as tipoDato1,
                TDS2.label as dato2,
                TDS2.tipo as tipoDato2,
                TDS3.label as dato3,
                TDS3.tipo as tipoDato3,
                TDS4.label as dato4,
                TDS4.tipo as tipoDato4,
                P.fecha_actualizacion,
                PT.id_tipoServicio
                FROM planes P
                INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
                INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
                INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
                INNER JOIN estados S ON C.id_estado=S.id_estado
                LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
                WHERE PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (2,3,4) ) )
                AND visible=1
                GROUP BY PT.id_plan
                ";
        $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

        //$fp = fopen('ListaPlanes.csv', 'w');
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Id Plan', 'Estado', 'Play', 'Servicios', 'Producto', 'Operador', 'Precio de Lista', 'Canales HD', 'Canales Total', ' Mbps de velocidad', 'Llamadas Nacionales', 'Minutos a celular', 'LD EU/CAN', 'LD Internacional', 'Fecha de Actualizacion'));

        $export = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $sqlServicio="SELECT PT.id_tipoServicio, TS.nombre FROM planes_tipoServicios PT INNER JOIN tipoServicios TS ON TS.id_tipoServicio=PT.id_tipoServicio WHERE PT.id_plan=".$row['id_plan']." ORDER BY PT.id_tipoServicio";
            $resultTipoServicios = mysqli_query($connection, $sqlServicio) or die("Selection Error " . mysqli_error($connection));

            $play='';
            $countPlay=0;
            while ( $rowTipoServicio = mysqli_fetch_assoc($resultTipoServicios)) {
                # code...
                if($countPlay==0){
                    $play=$rowTipoServicio['nombre'];
                }else{
                    $play.=' + '.$rowTipoServicio['nombre'];
                }
                $countPlay+=1;
            }
            mysqli_free_result($resultTipoServicios);

            $sqlEstados="SELECT E.nombre as estado FROM estados E INNER JOIN cobertura C ON C.ID_ESTADO=E.ID_ESTADO WHERE C.ID_PLAN=".$row['id_plan'];
            $resulEstados =  mysqli_query($connection, $sqlEstados) or die("Selection Error " . mysqli_error($connection));

            while ( $rowEstado = mysqli_fetch_assoc($resulEstados)) {
                //id
                $export[]=$row['id_plan'];

                //Region
                $export[]=utf8_encode($rowEstado['estado']);
                //$export['region']['ciudad']

                //Servicio
                if($countPlay==1){
                    $export[]='SinglePlay';
                }
                if($countPlay==2){
                    $export[]='DoblePlay';
                }
                if($countPlay==3){
                    $export[]='TriplePlay';   
                }
                $export[]=utf8_encode($play);
                $export[]=utf8_encode($row['nombre']);
                $export[]=utf8_encode($row['empresa']);

                //Precio
                $export[]=utf8_encode($row['precio']);
                //$export['precio']['precio_oportuno']

                //Bullets
                //$export['Bullets']['canales_sd']
                $bulletCanalesHD=false;
                if($row['id_tipoDato_principal_1']==12){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletCanalesHD=true;
                }
                if($row['id_tipoDato_principal_2']==12){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletCanalesHD=true;
                }
                if($row['id_tipoDato_principal_3']==12){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletCanalesHD=true;
                }
                if($row['id_tipoDato_principal_4']==12){
                    $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletCanalesHD=true;
                }
                if($bulletCanalesHD==false){
                    $export[]="- -";
                }
                //$export['Bullets']['canales_musica']
                $bulletCanalesTotal=false;
                if($row['id_tipoDato_principal_1']==13){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletCanalesTotal=true;
                }
                if($row['id_tipoDato_principal_2']==13){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletCanalesTotal=true;
                }
                if($row['id_tipoDato_principal_3']==13){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletCanalesTotal=true;
                }
                if($row['id_tipoDato_principal_4']==13){
                   $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletCanalesTotal=true;
                }
                if($bulletCanalesTotal==false){
                    $export[]="- -";
                }
                $bulletMBPS=false;
                if($row['id_tipoDato_principal_1']==11){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletMBPS=true;
                }
                if($row['id_tipoDato_principal_2']==11){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletMBPS=true;
                }
                if($row['id_tipoDato_principal_3']==11){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletMBPS=true;
                }
                if($row['id_tipoDato_principal_4']==11){
                    $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletMBPS=true;
                }
                if($bulletMBPS==false){
                    $export[]="- -";
                }
                $bulletLlamadasNac=false;
                if($row['id_tipoDato_principal_1']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($row['id_tipoDato_principal_2']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($row['id_tipoDato_principal_3']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($row['id_tipoDato_principal_4']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($bulletLlamadasNac==false){
                    $export[]="No";
                }
                
                $bulletMinutosCelular=false;
                if($row['id_tipoDato_principal_1']==11){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletMinutosCelular=true;
                }
                if($row['id_tipoDato_principal_2']==11){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletMinutosCelular=true;
                }
                if($row['id_tipoDato_principal_3']==11){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletMinutosCelular=true;
                }
                if($row['id_tipoDato_principal_4']==11){
                    $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletMinutosCelular=true;
                }
                if($bulletMinutosCelular==false){
                    $export[]="- -";
                }
                
                $bulletLD_EU_CAN=false;
                if($row['id_tipoDato_principal_1']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($row['id_tipoDato_principal_2']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($row['id_tipoDato_principal_3']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($row['id_tipoDato_principal_4']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($bulletLD_EU_CAN==false){
                    $export[]="No";
                }
                
                $bulletLD_INT=false;
                if($row['id_tipoDato_principal_1']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($row['id_tipoDato_principal_2']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($row['id_tipoDato_principal_3']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($row['id_tipoDato_principal_4']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($bulletLD_INT==false){
                    $export[]="No";
                }

                //Fechas
                $export[]=utf8_encode($row['fecha_actualizacion']);

                fputcsv($output, $export);
                //$tojson[]=$export;
                //print_r($csv);
                //echo "<br>";
                //fputcsv($output, $csv);
                $export=array();
            }
            mysqli_free_result($resulEstados);
        }
    }else{ 
        $sql = "SELECT 
                DISTINCT(P.id_plan),
                S.nombre as estado,
                P.nombre, 
                P.precio, 
                P.dato_principal_1,
                P.id_tipoDato_principal_1, 
                P.dato_principal_2, 
                P.id_tipoDato_principal_2, 
                P.dato_principal_3, 
                P.id_tipoDato_principal_3, 
                P.dato_principal_4,
                P.id_tipoDato_principal_4, 
                P.mas_datos, P.visible, 
                E.nombre as empresa, 
                E.codigo_color as empresa_color,
                TDS1.label as dato1,
                TDS1.tipo as tipoDato1,
                TDS2.label as dato2,
                TDS2.tipo as tipoDato2,
                TDS3.label as dato3,
                TDS3.tipo as tipoDato3,
                TDS4.label as dato4,
                TDS4.tipo as tipoDato4,
                P.fecha_actualizacion,
                PT.id_tipoServicio
                FROM planes P
                INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
                INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
                INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
                INNER JOIN estados S ON C.id_estado=S.id_estado
                LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
                WHERE PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (2,3,4) ) )
                AND visible=1 AND C.ID_ESTADO=".$_GET['estado']." 
                GROUP BY PT.id_plan";
        $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

        //$fp = fopen('ListaPlanes.csv', 'w');
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Id Plan', 'Estado', 'Play', 'Servicios', 'Producto', 'Operador', 'Precio de Lista', 'Canales HD', 'Canales Total', ' Mbps de velocidad', 'Llamadas Nacionales', 'Minutos a celular', 'LD EU/CAN', 'LD Internacional', 'Fecha de Actualizacion'));

        $export = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $sqlServicio="SELECT PT.id_tipoServicio, TS.nombre FROM planes_tipoServicios PT INNER JOIN tipoServicios TS ON TS.id_tipoServicio=PT.id_tipoServicio WHERE PT.id_plan=".$row['id_plan']." ORDER BY PT.id_tipoServicio";
            $resultTipoServicios = mysqli_query($connection, $sqlServicio) or die("Selection Error " . mysqli_error($connection));

            $play='';
            $countPlay=0;
            while ( $rowTipoServicio = mysqli_fetch_assoc($resultTipoServicios)) {
                # code...
                if($countPlay==0){
                    $play=$rowTipoServicio['nombre'];
                }else{
                    $play.=' + '.$rowTipoServicio['nombre'];
                }
                $countPlay+=1;
            }
            mysqli_free_result($resultTipoServicios);

                //id
                $export[]=$row['id_plan'];

                //Region
                $export[]=utf8_encode($row['estado']);
                //$export['region']['ciudad']

                //Servicio
                if($countPlay==1){
                    $export[]='SinglePlay';
                }
                if($countPlay==2){
                    $export[]='DoblePlay';
                }
                if($countPlay==3){
                    $export[]='TriplePlay';   
                }
                $export[]=utf8_encode($play);
                $export[]=utf8_encode($row['nombre']);
                $export[]=utf8_encode($row['empresa']);

                //Precio
                $export[]=utf8_encode($row['precio']);
                //$export['precio']['precio_oportuno']

                //Bullets
                //$export['Bullets']['canales_sd']
                $bulletCanalesHD=false;
                if($row['id_tipoDato_principal_1']==12){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletCanalesHD=true;
                }
                if($row['id_tipoDato_principal_2']==12){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletCanalesHD=true;
                }
                if($row['id_tipoDato_principal_3']==12){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletCanalesHD=true;
                }
                if($row['id_tipoDato_principal_4']==12){
                    $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletCanalesHD=true;
                }
                if($bulletCanalesHD==false){
                    $export[]="- -";
                }
                //$export['Bullets']['canales_musica']
                $bulletCanalesTotal=false;
                if($row['id_tipoDato_principal_1']==13){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletCanalesTotal=true;
                }
                if($row['id_tipoDato_principal_2']==13){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletCanalesTotal=true;
                }
                if($row['id_tipoDato_principal_3']==13){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletCanalesTotal=true;
                }
                if($row['id_tipoDato_principal_4']==13){
                   $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletCanalesTotal=true;
                }
                if($bulletCanalesTotal==false){
                    $export[]="- -";
                }
                $bulletMBPS=false;
                if($row['id_tipoDato_principal_1']==11){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletMBPS=true;
                }
                if($row['id_tipoDato_principal_2']==11){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletMBPS=true;
                }
                if($row['id_tipoDato_principal_3']==11){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletMBPS=true;
                }
                if($row['id_tipoDato_principal_4']==11){
                    $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletMBPS=true;
                }
                if($bulletMBPS==false){
                    $export[]="- -";
                }
                $bulletLlamadasNac=false;
                if($row['id_tipoDato_principal_1']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($row['id_tipoDato_principal_2']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($row['id_tipoDato_principal_3']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($row['id_tipoDato_principal_4']==7){
                    $export[]="Si";
                    $bulletLlamadasNac=true;
                }
                if($bulletLlamadasNac==false){
                    $export[]="No";
                }
                
                $bulletMinutosCelular=false;
                if($row['id_tipoDato_principal_1']==11){
                    $export[]=utf8_encode($row['dato_principal_1']);
                    $bulletMinutosCelular=true;
                }
                if($row['id_tipoDato_principal_2']==11){
                    $export[]=utf8_encode($row['dato_principal_2']);
                    $bulletMinutosCelular=true;
                }
                if($row['id_tipoDato_principal_3']==11){
                    $export[]=utf8_encode($row['dato_principal_3']);
                    $bulletMinutosCelular=true;
                }
                if($row['id_tipoDato_principal_4']==11){
                    $export[]=utf8_encode($row['dato_principal_4']);
                    $bulletMinutosCelular=true;
                }
                if($bulletMinutosCelular==false){
                    $export[]="- -";
                }
                
                $bulletLD_EU_CAN=false;
                if($row['id_tipoDato_principal_1']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($row['id_tipoDato_principal_2']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($row['id_tipoDato_principal_3']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($row['id_tipoDato_principal_4']==7){
                    $export[]="Si";
                    $bulletLD_EU_CAN=true;
                }
                if($bulletLD_EU_CAN==false){
                    $export[]="No";
                }
                
                $bulletLD_INT=false;
                if($row['id_tipoDato_principal_1']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($row['id_tipoDato_principal_2']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($row['id_tipoDato_principal_3']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($row['id_tipoDato_principal_4']==7){
                    $export[]="Si";
                    $bulletLD_INT=true;
                }
                if($bulletLD_INT==false){
                    $export[]="No";
                }

                //Fechas
                $export[]=utf8_encode($row['fecha_actualizacion']);

                fputcsv($output, $export);
                //$tojson[]=$export;
                //print_r($csv);
                //echo "<br>";
                //fputcsv($output, $csv);
                $export=array();
        }
    }
    
    
    //print_r($export);
    //header('Content-Type: application/json');
    //echo json_encode($tojson);
    //echo $pr;
    
    // output the column headings
    //fputcsv($output, $tojson);
    //$json_str= json_encode($tojson);
    //$json_obj = json_decode ($json_str);

    //$fp = fopen('file.csv', 'w');


    //fclose($fp);





    //close the db connection
    mysqli_close($connection);
?>