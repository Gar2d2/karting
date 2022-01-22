<?php
include_once "backend\PrzejazdDAO.php";
include_once "backend\PrzejazdDTO.php";

$przejazdDAO = new PrzejazdDAO();
$przejazdy = $przejazdDAO->pobierzPrzejazdy();
print('<table border="1">
         <tbody>
           <tr>
             <td>Data</td>
             <td>Godzina rozpoczęcia</td>
             <td>Godzina zakończenia</td>
           </tr>
        ');
foreach($przejazdy as $przejazd)
{
	if(!empty($przejazd->godzinaZakonczenia))
	{
		print("<tr>
             <td>$przejazd->data</td>
             <td>$przejazd->godzinaRozpoczecia</td>
             <td>$przejazd->godzinaZakonczenia</td>
             <td><a href='?detail=$przejazd->id'>Sprawdź szczegóły</a></td>
           </tr>");
	}
}

print(' </tbody>
       </table>')
?>
