<?php
  include_once "backend\NaprawyDAO.php";
  include_once "backend\NaprawyDTO.php";
  print("


  <table border='1'>
  
      <form method='get'>
    <tbody>
      <tr>
        <td>ID Karta</td>
        <td>Usterka</td>
        <td rowspan='2'><input name='addNewRepair' type='submit' value='Dodaj nową naprawę'/></td>
      </tr>
      <tr>
        <td><input name='idKart' type='number'/></td>
        <td><input name='usterka' type='text'/></td>
      </tr>
      </form>
    </tbody>
  </table>


");
?>
