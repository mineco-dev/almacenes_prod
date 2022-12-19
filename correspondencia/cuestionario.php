

<?
//Pregunta No. 1

$result1=mysql_query("select * from cat_preg where id_preg = 1", $connection);
$result2=mysql_query("select * from cat_resp where id_resp = 1");
while ($row=mysql_fetch_array($result1))
{

echo '<tr><td>'.$row["id_preg"].'</td>';
echo '<td>'.$row["preg"].'</td></tr>';

	while ($row=mysql_fetch_array($result2))
	{?>
	<table>
    <tr >
      </tr>
        <td> </td> <td><input type=radio name=RespPreg1 value=a><?=$row['resp1'];?>
      </td>
     
    <tr>
        <td> </td><td><input type=radio name=RespPreg1 value=b><?=$row['resp2'];?></td>
    </tr>
    
	<tr>
        <td> </td><td><input type=radio name=RespPreg1 value=c><?=$row['resp3'];?></td>
    </tr>
    
	<tr align=left>
      <td height=20 colspan=2>
</table>
