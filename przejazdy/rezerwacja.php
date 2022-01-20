
<?php
$startdate = strtotime("today");
$enddate = strtotime("+5 weeks", $startdate);
$array = array();
$dates = array();
$i = 0;
while ($startdate < $enddate) {
  $array[$i] = strtotime("+0 day", $startdate);
  $startdate = strtotime("+1 day", $startdate);
  $i++;
}
for($i = 0; $i <count($array); $i++)
{
 $dates[$i] = date("d-m-Y",$array[$i]);
}
print('
<form action="" method="get">
       <table border="1" class="rezerwacje">
           <tbody>
             <tr>
               <td><input name="data" type="submit" value='."$dates[0]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[1]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[2]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[3]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[4]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[5]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[6]".' style="height: 100px"></td>
             </tr>
             <tr>
               <td><input name="data" type="submit" value='."$dates[7]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[8]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[0]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[10]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[11]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[12]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[13]".' style="height: 100px"></td>
             </tr>
             <tr>
               <td><input name="data" type="submit" value='."$dates[14]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[15]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[16]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[17]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[18]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[19]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[20]".' style="height: 100px"></td>
             </tr>
             <tr>
               <td><input name="data" type="submit" value='."$dates[21]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[22]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[23]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[24]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[25]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[26]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[27]".' style="height: 100px"></td>
             </tr>
             <tr>
               <td><input name="data" type="submit" value='."$dates[28]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[29]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[30]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[31]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[32]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[32]".' style="height: 100px"></td>
               <td><input name="data" type="submit" value='."$dates[34]".' style="height: 100px"></td>
             </tr>
           </tbody>
         </table>
</form>
');
?>
