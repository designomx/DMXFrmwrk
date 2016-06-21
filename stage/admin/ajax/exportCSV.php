<?php
    //require_once('../phpTools/utilities.php');
    // mysql database connection details
    $host = "localhost";
    $username = "dbo600436593";
    $password = "20eligefacil15#";
    $dbname = "stage-db600436593UTF8";

    // open connection to mysql database
    $connection = mysqli_connect($host, $username, $password, $dbname) or die("Connection Error " . mysqli_error($connection));
    mysqli_query("SET NAMES 'utf8'");
    if(!isset($_POST['estado'])){
        $_POST['estado']=0;
    }
    // fetch mysql table rows
    if($_POST['estado']==0){
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
                P.fecha_actualizacion
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
                GROUP BY PT.id_plan HAVING count(*) >= 3
                ";
    }else{ 
        $sql = "SELECT 
                DISTINCT(P.id_plan),
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
                P.fecha_actualizacion
                FROM planes P
                INNER JOIN empresas E ON P.ID_EMPRESA=E.ID_EMPRESA
                INNER JOIN cobertura C ON P.ID_PLAN=C.ID_PLAN
                INNER JOIN planes_tipoServicios PT ON P.ID_PLAN=PT.ID_PLAN
                LEFT JOIN tipoDatosServicios TDS1 ON P.id_tipoDato_principal_1 = TDS1.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS2 ON P.id_tipoDato_principal_2 = TDS2.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS3 ON P.id_tipoDato_principal_3 = TDS3.id_tipoDato 
                LEFT JOIN tipoDatosServicios TDS4 ON P.id_tipoDato_principal_4 = TDS4.id_tipoDato 
                WHERE C.ID_ESTADO='".$_POST['estado']."' 
                AND PT.id_plan NOT IN (SELECT id_plan FROM planes_tipoServicios WHERE id_tipoServicio IN (SELECT id_tipoServicio from tipoServicios where id_tipoServicio NOT IN (2,3,4) ) )
                AND visible=1
                GROUP BY P.id_plan HAVING count(*) >= 3";
    }
    $result = mysqli_query($connection, $sql) or die("Selection Error " . mysqli_error($connection));

    //$fp = fopen('ListaPlanes.csv', 'w');
    $export = array();
    while($row = mysqli_fetch_assoc($result))
    {
        //fputcsv($fp, $row);
        //id
         $export['id']['id_plan'][]=$row['id_plan'];

        //Region
        $export['region']['estado'][]=utf8_encode($row['estado']);
        //$export['region']['ciudad'][]

        //Servicio
        $export['servicio']['play'][]='TriplePlay';
        $export['servicio']['servicios'][]='Tel.Fijo+Internet+TV';
        $export['servicio']['producto'][]=utf8_encode($row['nombre']);
        $export['servicio']['operador'][]=utf8_encode($row['empresa']);

        //Precio
        $export['precio']['precio_lista'][]=utf8_encode($row['precio']);
        //$export['precio']['precio_oportuno'][]

        //Bullets
        //$export['Bullets']['canales_sd'][]
        $bulletCanalesHD=false;
        if($row['id_tipoDato_principal_1']==12){
            $export['Bullets']['canales_hd'][]=utf8_encode($row['dato1']);
            $bulletCanalesHD=true;
        }
        if($row['id_tipoDato_principal_2']==12){
            $export['Bullets']['canales_hd'][]=utf8_encode($row['dato2']);
            $bulletCanalesHD=true;
        }
        if($row['id_tipoDato_principal_3']==12){
            $export['Bullets']['canales_hd'][]=utf8_encode($row['dato3']);
            $bulletCanalesHD=true;
        }
        if($row['id_tipoDato_principal_4']==12){
            $export['Bullets']['canales_hd'][]=utf8_encode($row['dato4']);
            $bulletCanalesHD=true;
        }
        if($bulletCanalesHD==false){
            $export['Bullets']['canales_hd'][]="- -";
        }
        //$export['Bullets']['canales_musica'][]
        $bulletCanalesTotal=false;
        if($row['id_tipoDato_principal_1']==13){
            $export['Bullets']['canales_total'][]=utf8_encode($row['dato1']);
            $bulletCanalesTotal=true;
        }
        if($row['id_tipoDato_principal_2']==13){
            $export['Bullets']['canales_total'][]=utf8_encode($row['dato2']);
            $bulletCanalesTotal=true;
        }
        if($row['id_tipoDato_principal_3']==13){
            $export['Bullets']['canales_total'][]=utf8_encode($row['dato3']);
            $bulletCanalesTotal=true;
        }
        if($row['id_tipoDato_principal_4']==13){
           $export['Bullets']['canales_total'][]=utf8_encode($row['dato4']);
            $bulletCanalesTotal=true;
        }
        if($bulletCanalesTotal==false){
            $export['Bullets']['canales_total'][]="- -";
        }
        $bulletMBPS=false;
        if($row['id_tipoDato_principal_1']==11){
            $export['Bullets']['mbps_de_velocidad'][]=$row['dato1'];
            $bulletMBPS=true;
        }
        if($row['id_tipoDato_principal_2']==11){
            $export['Bullets']['mbps_de_velocidad'][]=$row['dato2'];
            $bulletMBPS=true;
        }
        if($row['id_tipoDato_principal_3']==11){
            $export['Bullets']['mbps_de_velocidad'][]=$row['dato3'];
            $bulletMBPS=true;
        }
        if($row['id_tipoDato_principal_4']==11){
            $export['Bullets']['mbps_de_velocidad'][]=$row['dato4'];
            $bulletMBPS=true;
        }
        if($bulletMBPS==false){
            $export['Bullets']['mbps_de_velocidad'][]="- -";
        }
        $bulletLlamadasNac=false;
        if($row['id_tipoDato_principal_1']==7){
            $export['Bullets']['llamadas_nacionales'][]="Si";
            $bulletLlamadasNac=true;
        }
        if($row['id_tipoDato_principal_2']==7){
            $export['Bullets']['llamadas_nacionales'][]="Si";
            $bulletLlamadasNac=true;
        }
        if($row['id_tipoDato_principal_3']==7){
            $export['Bullets']['llamadas_nacionales'][]="Si";
            $bulletLlamadasNac=true;
        }
        if($row['id_tipoDato_principal_4']==7){
            $export['Bullets']['llamadas_nacionales'][]="Si";
            $bulletLlamadasNac=true;
        }
        if($bulletLlamadasNac==false){
            $export['Bullets']['llamadas_nacionales'][]="No";
        }
        
        $bulletMinutosCelular=false;
        if($row['id_tipoDato_principal_1']==11){
            $export['Bullets']['minutos_a_celular'][]=utf8_encode($row['dato1']);
            $bulletMinutosCelular=true;
        }
        if($row['id_tipoDato_principal_2']==11){
            $export['Bullets']['minutos_a_celular'][]=utf8_encode($row['dato2']);
            $bulletMinutosCelular=true;
        }
        if($row['id_tipoDato_principal_3']==11){
            $export['Bullets']['minutos_a_celular'][]=utf8_encode($row['dato3']);
            $bulletMinutosCelular=true;
        }
        if($row['id_tipoDato_principal_4']==11){
            $export['Bullets']['minutos_a_celular'][]=utf8_encode($row['dato4']);
            $bulletMinutosCelular=true;
        }
        if($bulletMinutosCelular==false){
            $export['Bullets']['minutos_a_celular'][]="- -";
        }
        
        $bulletLD_EU_CAN=false;
        if($row['id_tipoDato_principal_1']==7){
            $export['Bullets']['LD-EU_CAN'][]="Si";
            $bulletLD_EU_CAN=true;
        }
        if($row['id_tipoDato_principal_2']==7){
            $export['Bullets']['LD-EU_CAN'][]="Si";
            $bulletLD_EU_CAN=true;
        }
        if($row['id_tipoDato_principal_3']==7){
            $export['Bullets']['LD-EU_CAN'][]="Si";
            $bulletLD_EU_CAN=true;
        }
        if($row['id_tipoDato_principal_4']==7){
            $export['Bullets']['LD-EU_CAN'][]="Si";
            $bulletLD_EU_CAN=true;
        }
        if($bulletLD_EU_CAN==false){
            $export['Bullets']['LD-EU_CAN'][]="No";
        }
        
        $bulletLD_INT=false;
        if($row['id_tipoDato_principal_1']==7){
            $export['Bullets']['LD_internacional'][]="Si";
            $bulletLD_INT=true;
        }
        if($row['id_tipoDato_principal_2']==7){
            $export['Bullets']['LD_internacional'][]="Si";
            $bulletLD_INT=true;
        }
        if($row['id_tipoDato_principal_3']==7){
            $export['Bullets']['LD_internacional'][]="Si";
            $bulletLD_INT=true;
        }
        if($row['id_tipoDato_principal_4']==7){
            $export['Bullets']['LD_internacional'][]="Si";
            $bulletLD_INT=true;
        }
        if($bulletLD_INT==false){
            $export['Bullets']['LD_internacional'][]="No";
        }

        //Fechas
        $export['Fecha']['fecha_modificacion'][]=utf8_encode($row['fecha_actualizacion']);

        //fputcsv($fp, $export);
        $tojson[]=$export;
        $export=array();
    }
    
    //print_r($export);
    //header('Content-Type: application/json');
    echo json_encode($tojson);
    //echo $pr;
    //fclose($fp);

    //close the db connection
    mysqli_close($connection);
?>