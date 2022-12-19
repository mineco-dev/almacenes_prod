<?
if($op1=='Generar Xls'){
  //$worksheet->write(Fila, Colimna,  valor);
set_time_limit(100);


        require_once "class.writeexcel_workbook.inc.php";
        require_once "class.writeexcel_worksheet.inc.php";
            $fname = tempnam("/tmp", "archivo.xls");
            $workbook = &new writeexcel_workbook($fname);
            $worksheet = &$workbook->addworksheet();
        $border2 =& $workbook->addformat();
        $border2->set_pattern(0x1);
        $border2->set_fg_color('silver');
            $dat_text1="Informe Cuadro Estadístico Examen Finales 1º y 2ª Oportunidad";
        $worksheet->write(0, 1,  $dat_text1);
            list($var_carrera, $var_asignatura)=Sql_fetch_row(Sql_query("Select nombre_ca,(Select nombre_as From asignaturas Where id_as='$var_id_as' And id_ca='$var_id_ca') from carreras Where id_ca=$var_id_ca"));
        $worksheet->write(1, 1,  " ");
        $worksheet->write(2, 1,  " ");


         $worksheet->write(3, 1,  "Carrera");$worksheet->write(3, 2,  $var_carrera);
         $worksheet->write(4, 1,  "Asignatura");$worksheet->write(4, 2,  $var_asignatura);
         $worksheet->write(5, 1,  "Periodo");$worksheet->write(5, 2,  $wbsem.', '.$wbano);

            $worksheet->write(7,3,"1º Oportunidad", $border2);
            $worksheet->write(7,4,"2º Oportunidad", $border2);

         $worksheet->write(8,2,"Alumnos Inscritos");$worksheet->write(8,3,$var_alu_ins);$worksheet->write(8,4,$var_alu_ins);
         $worksheet->write(9,2,"Alumnos Examinados");$worksheet->write(9,3,$var_alu_exa);$worksheet->write(9,4,$var_alu_exa2);
         $worksheet->write(10,2,"Alumnos No Examinados");$worksheet->write(10,3,$var_alu_no_exa);$worksheet->write(10,4,$var_alu_no_exa2);
         $worksheet->write(11,2,"Aprueban Examen");$worksheet->write(11,3,$var_apr_exa);$worksheet->write(11,4,$var_apr_exa2);
         $worksheet->write(12,2,"Reprueban Examen");$worksheet->write(12,3,$var_rep_exa);$worksheet->write(12,4,$var_rep_exa2);
         $worksheet->write(13,2,"Aprueban Asignatura");$worksheet->write(13,3,$var_apr_asi);$worksheet->write(13,4,$var_apr_asi);
         $worksheet->write(14,2,"Reprueban Asignatura");$worksheet->write(14,3,$var_rep_asi);$worksheet->write(14,4,$var_rep_asi);
         $worksheet->write(15,2,"Promedio Nota Examen");$worksheet->write(15,3,$var_pro_not_exa);$worksheet->write(15,4,$var_pro_not_exa2);
         $worksheet->write(16,2,"Promedio Nota Presentación a Examen");$worksheet->write(16,3,$var_pro_not_pre_exa);$worksheet->write(16,4,$var_pro_not_pre_exa2);
         $worksheet->write(17,2,"Validación de Esudios");$worksheet->write(17,3,$var_tot_ve);$worksheet->write(17,4,$var_tot_ve);
         $worksheet->write(18,2,"Retirados");$worksheet->write(18,3,$var_tot_ret);$worksheet->write(18,4,$var_tot_ret);
         $worksheet->write(19,2,"Anulación");$worksheet->write(19,3,$var_tot_anu);$worksheet->write(19,4,$var_tot_anu);
         $worksheet->write(20,2,"Abandono");$worksheet->write(20,3,$var_tot_aba);$worksheet->write(20,4,$var_tot_aba2);
/******************************************************************************/
/******************************************************************************/
        $workbook->close();
        header("Content-Type: application/x-msexcel");
        $fh=fopen($fname, "r");
        fpassthru($fh);
        unlink($fname);
}
?>