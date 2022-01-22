<?php
  print('<form action="" method="get">
           <table border="1">
             <tbody>');

$osobaDAO = new osobaDAO();
$osoba = $osobaDAO->pobierzOsobePoID($_GET['uid']);
print("<tr>
                 <td>id</td>
                 <td>pseudonim</td>
                 <td>hasło</td>
                 <td>imię</td>
                 <td>nazwisko</td>
                 <td>uprawnienia</td>
               </tr>
               <tr>
                 <td><input readonly value='$osoba->id'></td>
                 <td><input readonly value='$osoba->pseudonim'></td>
                 <td><input readonly value='$osoba->haslo'></td>
                 <td><input readonly value='$osoba->imie'></td>
                 <td><input readonly value='$osoba->nazwisko'></td>
                 <td><input readonly value='$osoba->uprawnienia'></td>
                 <td>PODGLĄD</td>
               </tr>
               <tr>
                 <td><input name='id' value='$osoba->id'></td>
                 <td><input name='pseudonim' value='$osoba->pseudonim'></td>
                 <td><input name='haslo' value='$osoba->haslo'></td>
                 <td><input name='imie' value='$osoba->imie'></td>
                 <td><input name='nazwisko' value='$osoba->nazwisko'></td>
                 <td>

                 <select name='uprawnienia'>
                   <option>UZYTKOWNIK</option>
                   <option>KIEROWNIK</option>
                   <option>PRACOWNIK_PITSTOP</option>
                   <option>PRACOWNIK_RECEPCJI</option>
                   <option>PRACOWNIK_WARSZTATU</option>
                 </select>

                 </td>
               </tr>
               <td colspan='6'><input name='uEdit' type='submit' value='Zapisz' style='width: 100%'/></td>");
             print('</tbody>
           </table>
         </form>');
?>
