<?php
  print('
  <table border="1">
    <tbody>
      ');

include_once "backend\NaprawyDTO.php";
include_once "backend\NaprawyDAO.php";

$naprawyDAO = new NaprawyDAO();
$naprawy = $naprawyDAO->pobierzNaprawy();


foreach($naprawy as $naprawa)
{
print("        
<form method='get'>
<tr> 
        <td>ID naprawy</td>
        <td>Gokart</td>
        <td>Usterka</td>
        <td>Data rozpoczęcia</td>
        <td>Status</td>
        <td rowspan='2'><input name='repair' type='submit' value='Zmien status naprawy' /></td>
      </tr>
      <tr>
        <td><input readonly name='rid' value='$naprawa->id'/></td>
        <td>$naprawa->idKarta</td>
        <td>$naprawa->usterka</td>
        <td>$naprawa->dataRozpoczecia</td>
        <td>$naprawa->stanNaprawy</td>
      </tr>
</form>");
}

print("    </tbody>
  </table>
<form method='get'>
  <input name='newRepair' type='submit' value='Dodaj nową naprawę' />
</form>
         ");





?>
