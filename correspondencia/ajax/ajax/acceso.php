<?echo "<?xml version=\"1.0\" ?>";?>
<raiz>
        <?php
            include ("include.php");
            list($d)=Sql_fetch_row(Sql_query("Select password_pe from personas where rut_pe=".$_POST['usuario']));
            //$d=$_POST['usuario'];
            if($_POST['password']==$d){
                $autorizacion='true';
            }else{
                $autorizacion='false';
            }
        ?>
		<autoriza><?php echo $autorizacion;?></autoriza>
</raiz>
