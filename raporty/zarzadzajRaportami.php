<?php
print('
         <table border="1">
           <tbody>
             <tr >
               <td colspan="3" style="width: 1050px; text-align: center">Lista dostępnych raportów</td>
             </tr>');
include_once("backend\RaportDAO.php");         
include_once("backend\RaportDTO.php");

$raportDAO = new RaportDAO();
$raporty;
if($_SESSION['role'] == "KIEROWNIK")
{
$raporty = $raportDAO->pobierzRaporty();
} else
{
 $today = date('Y-m-d', strtotime("now"));
 $raporty = $raportDAO->pobierzRaportyZData($today);
}
foreach($raporty as $raport)
{
 if(!empty($raport->dataUtworzenia))
 {
 print("<form action='' method='get'>
         <tr>
         <td rowspan='2' style='width: 50px'><input name='rid' readonly type='text' value='$raport->id'/></td>
         <td rowspan='2' style='width: 900px; text-align: center'>Raport $raport->dataUtworzenia</td>
         <td style='width: 100px'><input name='podglad' type='submit' value='otwórz' /></td></tr>
         <tr><td style='width: 100px'><input name='raportEdit' type='submit' value='edytuj swoją część' /></td>
         </tr></form>");
 }
}
print('  <form action="" method="get">
           <input id="addRaport" name="addRaport" type="submit" value="Dodaj nowy raport" />
         </form></tbody>
         </table>
       ');

?>
