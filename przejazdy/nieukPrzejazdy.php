<?php
    include_once 'backend\PrzejazdDTO.php';
    include_once 'backend\PrzejazdDAO.php';
    include_once 'backend\GokartDAO.php';
    include_once 'backend\RezerwacjaDAO.php';
    include_once 'backend\OsobaDAO.php';
    include_once 'backend\ZakonczoneDAO.php';
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
$przejazdy = $przejazdDAO->pobierzPrzejazdyZData($day);
$przejazd;
for($i=0;$i<count($przejazdy);$i++)
{
  if(empty($przejazdy[$i]->godzinaZakonczenia))
  {
    $przejazd = $przejazdy[$i];
    break;
  }
}
print("Aktualny przejazd - Godzina: ");
print($przejazd->godzinaRozpoczecia);
if(!is_null($przejazd))
{
print('<div id="przypis" style="width: 50%; height: 100%; float: left">

<form action="" method="post" >
  
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
//POBRAĆ WSZYSTKIE PRZEJAZDY Z DATĄ - DZIŚ - zrobione
//WZIĄC ID PIERWSZEGO LEPSZEGO BEZ DATY ZAKOŃCZENIA - zrobione
//POBRAĆ REZERWACJE Z TEGO PRZEJAZDU
$RezerwacjaDAO = new RezerwacjaDAO();
$RezerwacjeDlaPrzejazdu = $RezerwacjaDAO->pobierzRezerwacjeDlaPrzejazdu($przejazd->id);
//TUTEJ
$GokartDAO = new GokartDAO();
$Gokarty = $GokartDAO->pobierzGokarty();
$OsobaDAO = new OsobaDAO();
$nickiUczestnikow;
for($i = 0;  $i<count($Gokarty); $i++)#tu będzie trzeba dać ilość kartów
{
  $nick;
  $PoleNaKarta;
  $Uczestnik;
  if($RezerwacjeDlaPrzejazdu!= null && $i < count($RezerwacjeDlaPrzejazdu))
  {
    $nick = $OsobaDAO->pobierzOsobePoID($RezerwacjeDlaPrzejazdu[$i]->idOsoby)->pseudonim;
    $nickiUczestnikow[$i]=$nick;
    $Uczestnik ='<td style=width: 200px>Uczestnik: '.$nick.'</td>'; 
    $PoleNaKarta = '<td><input readonly name="'."$nick".'" type="text" value="" style="width: 100px; height: 100px" id="'."$nick".'" ondrop="drop(event)" ondragover="allowDrop(event)"></td>';
  }
  else
  {
    $Uczestnik ="<td style='width: 200px'>Brak</td>" ;
    $PoleNaKarta ="";
  }
  print('<tr>
          <td><input readonly type="text" name="kart" value='.$Gokarty[$i]->id.' style="width: 100px; height: 100px"  draggable="true" ondragstart="drag(event)" id='.$Gokarty[$i]->id.'></td>
          '.$Uczestnik.'
          '.$PoleNaKarta.'
        </tr>');
} 


    

print('
       <tr>
        <td><input type="submit" value="Zapisz" name="Zapisz" style="width: 100%; height: 100px"></td>
      </tr>
    </tbody>
  </table>
</form>
</div>
<div id="czas" style="width: 50%; height: 100px; float: right">
');
if(isset($_POST['Zapisz']))
{
  $ZakonczoneDAO = new ZakonczoneDAO();
  $ZakonczoneDTO = new ZakonczoneDTO();
  for($i=0;$i<count($nickiUczestnikow);$i++)
  {
    
    //ZAKONCZYCZ PRZEJAZD - DODAC GODZINE ZAKONCZENIA
    $ZakonczoneDTO->idOsoby = $OsobaDAO->pobierzOsobePoPseudonimie($nickiUczestnikow[$i])->id;
    $ZakonczoneDTO->idPrzejazdu =$przejazd->id; 
    $ZakonczoneDTO->idKarta = $_POST[$nickiUczestnikow[$i]];
    $ZakonczoneDTO->czas = "00:25";
    $ZakonczoneDTO->iloscOkrazen = 10+$i;
    $ZakonczoneDTO->miejsce = $i+1;
    $ZakonczoneDAO->dodajDoZakonczonych($ZakonczoneDTO);


    //zakonczenie przejazdu
    $now = strtotime("now");
    $day = date('Y-m-d', $now);
    $time = date('H:i', $now);
    $przejazd->godzinaZakonczenia = $time;
    $przejazdDAO->modyfikujPrzejazd($przejazd);

  }
  
}

print('
</div><div id="rest" style="width: 50%; height: 100%; float: right">
</div>');

}



 
?>
