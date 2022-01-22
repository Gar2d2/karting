<?php
    include_once 'backend\ZakonczoneDTO.php';
    include_once 'backend\DBConnector.php';
    class ZakonczoneDAO
    {
        
        public function dodajDoZakonczonych($zakonczonyDTO)
        {
            $connection = new DBConnector();
            $zakonczony = new ZakonczoneDTO();
            $query="INSERT INTO `zakonczoneprzejazdy` (`id`, `idOsoby`, `idPrzejazdu`, `idKarta`, `czas`, `iloscOkrazen`, `miejsce`) VALUES (NULL, '$zakonczonyDTO->idOsoby', '$zakonczonyDTO->idPrzejazdu', '$zakonczonyDTO->idKarta', '$zakonczonyDTO->czas', '$zakonczonyDTO->iloscOkrazen', '$zakonczonyDTO->miejsce')";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            print($result);
            return $result;
        }

    }
?>

