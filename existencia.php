


<?php
require("../includes/sqlcommand.inc");
	conectardb($almacen);
//si fue puesto el codigo en la caja de texto
//asumo que le formulario envia por el metodo POST
if(isset($_POST['codigo_categoria']))
if(isset($_POST['codigo_subcategoria']))
if(isset($_POST['codigo_producto']))
if(isset($_POST['existencia']))
{
    //pregunto si existe en la bd
    $sql="select existencia from tb_inventario where codigo_categoria='".$_POST['codigo_categoria']."' and codigo_categoria= '".$_POST['codigo_subcategoria']."' and codigo_producto= '".$_POST['codigo_categoria']."' and existencia='".$_POST['existencia']."'  ";
    $result=mysql_query($sql);
    if(isset($result) && mysql_num_rows($result)>0)
    {
        //mensaje de error
        echo "El codigo ya existe";
    }
    else
    {
        //hacer otra cosa
    }
}
?>

