<?php
include_once("backend/PrzejazdDAO.php");
include_once("backend/RezerwacjaDAO.php");
     function rezerwuj($dzien)
     {        
       print('<form action="" method="get"><table border="1">
    <tbody>
	<tr>
	<td>Dzień</td>
	<td>Godzina rozpoczęcia</td>
	<td>Godzina zakończenia</td>
	<td></td>
	<td>Ilość rezerwacji</td>
	</tr>
      <tr>');
$d = strtotime($dzien);
$t = date("Y-m-d", $d);
$now = strtotime("now");
$startdate = strtotime("+0 days", $d);
$startdate = strtotime("+10 hours", $startdate); 
$enddate = strtotime("+8 hours", $startdate); 
$i = 0;
$przejazdDAO = new PrzejazdDAO();
$przejazdy = $przejazdDAO->pobierzPrzejazdyZData(date("Y-m-d", $startdate));

while ($startdate < $enddate && $now < $enddate) {
  if($now < $startdate)
  {
   $data = date("H:i", $startdate);
   $ileRezerwacji = 0;
   foreach($przejazdy as $przejazd)
   {
	if($startdate == strtotime($przejazd->godzinaRozpoczecia, $d))
	{
	$rezerwacjeDAO = new RezerwacjaDAO();
	$ileRezerwacji = count($rezerwacjeDAO->pobierzRezerwacjeDlaPrzejazdu($przejazd->id));
	}
   }
   if($ileRezerwacji < 2)
   {
	print("<td><input readonly name='dat' type='text' value=$t style='width: 75px'></td>");
	print("<td><input readonly name='startH' type='text' value=$data style='width: 50px'></td>");
    $startdate = strtotime("+20 minutes", $startdate);
   $data = date("H:i", $startdate);
   print("<td><input readonly name='endH' type='text' value=$data style='width: 50px'></td>
   <td><input name='rezerwuj' type='submit' value='Zarezerwuj' style='height: 60px'></td>");
   
   print("<td>$ileRezerwacji</td></tr><tr></form><form action='' method='get'>");
   } else
   {
	   
    $startdate = strtotime("+20 minutes", $startdate);
   }
   
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
   
