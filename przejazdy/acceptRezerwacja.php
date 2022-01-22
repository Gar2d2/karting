<?php
include_once 'backend\RezerwacjaDTO.php';
include_once 'backend\RezerwacjaDAO.php';
include_once 'backend\OsobaDAO.php';
include_once 'backend\OsobaDTO.php';
include_once 'backend\PrzejazdDAO.php';
include_once 'backend\PrzejazdDTO.php';

$rezerwacjeDAO = new rezerwacjaDAO();
$today = date("Y-m-d", strtotime("today"));
$rezerwacje = $rezerwacjeDAO -> pobierzRezerwacjeZData($today);
print('<table border="1">
         <tbody>
          <tr>
		 <td>ID rezerwacji</td>
         <td>Pseudonim</td>
         <td>Godzina rozpoczęcia</td>
         <td>Data przejazdu</td>
         <td>Potwierdzono rezerwacje?</td>
         <td>&nbsp;</td>
		 </tr>');
foreach($rezerwacje as $rezerwacja)
{
	if(!is_null($rezerwacja->id))
	{
		$osobaDAO = new osobaDAO();
		$idOsoby = $rezerwacja->idOsoby;
		$osoba = $osobaDAO -> pobierzOsobePoID($idOsoby);
		$przejazdDAO = new przejazdDAO();
		$przejazd = $przejazdDAO -> pobierzPrzejazdZID($rezerwacja->idPrzejazdu);
		$potwierdzono = $rezerwacja->potwierdzono;
		$p = $potwierdzono;
		if($potwierdzono)
		{
			$potwierdzono = 'Tak';
		} else
		{
			$potwierdzono = 'Nie';
		}
		print("<form action='' method='get'><tr>
		 <td><input readonly type='text' name='rez' value='$rezerwacja->id' style='width: 100px; height: 100px'></td>
         <td>$osoba->pseudonim</td>
         <td>$przejazd->godzinaRozpoczecia</td>
         <td>$przejazd->data</td>
         <td>$potwierdzono</td>");
         
		 if(!$p)
		 {
			 print("<td><input type='submit' value='Potwierdź' style='width: 100%; height: 100px'></td>");
		 } else
		 {
			 print("<td></td>");
		 }
		 
		 print("</form></tr>");
	}
}
print('
         </tbody>
       </table>')
?>
