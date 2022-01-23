<?php
include_once "backend/OsobaDAO.php";
include_once "backend/OsobaDTO.php";
  print("<table border='1'>
           <tbody>
             <tr>
               <td colspan='5'>Użytkownicy systemu</td>
             </tr>");

$osobaDAO = new osobaDAO();
$osoby = $osobaDAO->pobierzOsoby();

foreach($osoby as $osoba)
{
 if(!is_null($osoba->id))
 {
  print("<form action='' method='get'>
  <tr>
  <td><input readonly name='uid' value='$osoba->id'/></td>
  <td>$osoba->imie $osoba->nazwisko</td>
  <td>$osoba->uprawnienia</td>
  <td><input name='edy'type='submit' value='Edytuj'/></td>
  <td><input name='del'type='submit' value='Usuń'/></td>
  </form></tr>");
 }
}





print("
           </tbody>
         </table>");
?>
