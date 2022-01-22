<?php
    include_once 'backend\ZakonczoneDTO.php';
    include_once 'backend\OsobaDAO.php';
    include_once 'backend\PrzejazdDAO.php';
    include_once 'backend\DBConnector.php';
    class ZakonczoneDAO
    {
        
        public function dodajDoZakonczonych($zakonczonyDTO)
        {
            $connection = new DBConnector();
            $zakonczony = new ZakonczoneDTO();
            $query="INSERT INTO `zakonczoneprzejazdy` (`id`, `idOsoby`, `idPrzejazdu`, `idKarta`, `czas`, `iloscOkrazen`, `miejsce`) VALUES (NULL, '$zakonczonyDTO->idOsoby', '$zakonczonyDTO->idPrzejazdu', '$zakonczonyDTO->idKarta', '$zakonczonyDTO->czas', '$zakonczonyDTO->iloscOkrazen', '$zakonczonyDTO->miejsce')";
            $result = mysqli_query($connection->GetBazaConnection(), $query);

            return $result;
        }


        public function pokazSzczegoly($id)
        {
            $connection = new DBConnector();
            $query="SELECT * FROM `zakonczoneprzejazdy` WHERE idPrzejazdu='$id'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
              print('<table border="1">
                       <tbody>
                         <tr>
                           <td>Kierowca:</td>
                           <td>Kart: </td>
                           <td>Czas: </td>
                           <td>Data: </td>
                           <td>Ilość okrażeń: </td>
                           <td>Miejsce: </td>
                         </tr>
                       ');
                $osobaDAO = new OsobaDAO();
                $przejazdDAO = new PrzejazdDAO();
                while($row = mysqli_fetch_array($result))
                {
                    $osoba = $osobaDAO->pobierzOsobePoID($row[1]);
                    $przejazd = $przejazdDAO->pobierzPrzejazdZID($row[2]);
                    #print($row['id']);
                    print("<tr><td>$osoba->pseudonim</td>");
                    print("<td>$row[3]</td>");
                    print("<td>$row[4]</td>");
                    print("<td>$przejazd->data $przejazd->godzinaRozpoczecia".'-'."$przejazd->godzinaZakonczenia</td>");
                    print("<td>$row[5]</td>");
                    print("<td>$row[6]</td></tr>");

                }
                print("</tbody>
                     </table>");
            }
            return 1;
        }

    }
?>

