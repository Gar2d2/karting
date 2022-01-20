<?php
     function rezerwuj($dzien)
     {        
       print('<form action="" method="get"><table border="1">
    <tbody>
      <tr>');
$d = strtotime($dzien);
$now = strtotime("now");
$startdate = strtotime("+0 days", $d);
$startdate = strtotime("+10 hours", $startdate); 
$enddate = strtotime("+8 hours", $startdate); 
$i = 0;
while ($startdate < $enddate && $now < $enddate) {
  if($now < $startdate)
  {
   $data = date("H:i", $startdate);
   $temp = $data;
   print("<td><input readonly name='startH' type='text' value=$data style='width: 50px'></td>");
   $startdate = strtotime("+20 minutes", $startdate);
   $data = date("H:i", $startdate);
   print("<td><input readonly name='endH' type='text' value=$data style='width: 50px'></td><td><input name='rezerwuj' type='submit' value='Zarezerwuj' style='height: 60px'></td></tr><tr></form><form action='' method='get'>");
  } else
  {
   $startdate = strtotime("+20 minutes", $startdate);
  }
  $i++;
}

  print('</tr>
    </tbody>
  </table></form>');
     }
?>
   
