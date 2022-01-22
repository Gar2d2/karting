<?php
    include_once 'backend\PrzejazdDTO.php';
    include_once 'backend\PrzejazdDAO.php';
  print('

<script>
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
  document.getElementById(ev.target.id).setAttribute("value",data);
}



</script>');
$przejazdDAO = new PrzejazdDAO();
$now = strtotime("now");
$day = date('Y-m-d', $now);
$time = date('H:i', $now);
$przejazd = $przejazdDAO -> pobierzObecnyPrzejazd($time, $day);
if(!is_null($przejazd))
{
print('<div id="przypis" style="width: 50%; height: 100%; float: left">

<form action="" method="get">
  
<table>
    <thead>
      <tr>
        <th>Przypisz gokarty do uczestników</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Dostępne karty</td>
        <td>Uczestnik</td>
        <td>Gokart</td>
      </tr>');
  
for($i = 1;  $i<10; $i++)#tu będzie trzeba dać ilość kartów
{
 print('<tr>
        <td><input readonly type="text" name="kart" value='."$i".' style="width: 100px; height: 100px"  draggable="true" ondragstart="drag(event)" id='."$i".'></td>
        <td style="width: 200px">Uczestnik '."$i".'</td>
        <td><input readonly name="uczestnik'."$i".'" type="text" value="" style="width: 100px; height: 100px" id="div'."$i".'" ondrop="drop(event)" ondragover="allowDrop(event)"></td>
      </tr>');
} 


    

print('
       <tr>
        <td><input type="submit" value="Zapisz" style="width: 100%; height: 100px"></td>
      </tr>
    </tbody>
  </table>
</form>
</div>
<div id="czas" style="width: 50%; height: 100px; float: right">
');

print('
</div><div id="rest" style="width: 50%; height: 100%; float: right">
</div>');

}




 
?>
