<?php
     function przejazd()
     {
       print('<table class="main">
                <tbody>
                  <tr>
                    <td>
                    <a href="index.php?s=zakonczonePrzejazdy">  
                    <input type="submit" value="Przejdź do zakonczonych przejazdow" style="width: 100%; height: 100px">  
                    </a>
                    </td>
					<td>
                    <a href="index.php?s=rezerwacja">  
                    <input type="submit" value="Przejdź do rezerwacji" style="width: 100%; height: 100px">  
                    </a>
                    </td>');
					if($_SESSION['role'] == "KIEROWNIK" || $_SESSION['role'] == "PRACOWNIK_RECEPCJI")
					{
						print('<td>
                    <a href="index.php?s=nieukPrzejazdy">  
                    <input type="submit" value="Przejdź do nieukończone przejazdy" style="width: 100%; height: 100px">  
                    </a>
                    </td>
					<td>
					<a href="index.php?s=acceptRezerwacja">  
                    <input type="submit" value="Przejdź do rezerwacji klientów" style="width: 100%; height: 100px">  
                    </a>
					<td>
                    </td>');
					}
                    
                  print('</tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </tbody>
              </table>
');
     }



?>

