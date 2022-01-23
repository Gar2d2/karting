<?php
include_once "backend\NaprawyDTO.php";
include_once "backend\NaprawyDAO.php";
                $naprawyDAO = new NaprawyDAO();
                $naprawa = $naprawyDAO->pobierzNaprawepoID($_GET['rid']);
                print("<table border='1'>
    <tbody>        
<form method='get'>
<tr> 
        <td>ID naprawy</td>
        <td>Gokart</td>
        <td>Usterka</td>
        <td>Data rozpoczęcia</td>
        <td>Status</td>
        <td rowspan='2'><input name='setRepair' type='submit' value='Zmien status naprawy' /></td>
      </tr>
      <tr>
        <td><input readonly name='rid' value='$naprawa->id'/></td>
        <td>$naprawa->idKarta</td>
        <td>$naprawa->usterka</td>
        <td>$naprawa->dataRozpoczecia</td>
        <td><select name='status'>
              <option>WTRAKCIE</option>
              <option>NOWA</option>
              <option>OCZEKIWANIE_NA_CZESCI</option>
              <option>ZAKONCZONA</option>
            </select></td>
      </tr>
</form>   </tbody>
  </table>
");

?>