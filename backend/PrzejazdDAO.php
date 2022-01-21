<?php
    include_once 'backend\PrzejazdDTO.php';
    include_once 'backend\DBConnector.php';
    class PrzejazdDAO
    {
        
        public function pobierzPrzejazdyZData($dataPrzejazdow)
        {
            $connection = new DBConnector();
            $przejazdy[] = new PrzejazdDTO();
            $index = 0;
            $query="SELECT * FROM `przejazd` WHERE dataPrzejazdu='$dataPrzejazdow'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    print($row['id']);
                    $przejazdy[$index] = new PrzejazdDTO();
                    $przejazdy[$index]->id = $row['id'];
                    $przejazdy[$index]->data = $row['dataPrzejazdu'];
                    $przejazdy[$index]->godzinaRozpoczecia = $row['godzinaRozpoczecia'];
                    $przejazdy[$index]->godzinaZakonczenia = $row['godzinaZakonczenia'];
                    $index++;
                }
            }
            return $przejazdy;
        }
        public function dodajPrzejazd($przejazdDTO)//tutaj DTO przejazd
        {
            $przejazdy = $this->pobierzPrzejazdyZData($przejazdDTO->data);
            if($przejazdy)
            {
                for($i =0; $i<count($przejazdy);$i++)
                {
                    print($przejazdy[$i]->data);
                    if($przejazdy[$i]->godzinaRozpoczecia == $przejazdDTO->godzinaRozpoczecia)
                    {
                        return 0;
                    }
                }
            }
            $connection = new DBConnector();
            $query="INSERT INTO `przejazd` (`id`, `dataPrzejazdu`, `godzinaRozpoczecia`) VALUES (NULL, '$przejazdDTO->data', '$przejazdDTO->godzinaRozpoczecia');";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            return $result;
        }

        public function modyfikujPrzejazd($przejazdDTO)//tutaj DTO przejazd
        {
            $connection = new DBConnector();
            $query="UPDATE `przejazd` SET `dataPrzejazdu` = '$przejazdDTO->data', `godzinaRozpoczecia` = '$przejazdDTO->godzinaRozpoczecia', `godzinaZakonczenia` = '$przejazdDTO->godzinaZakonczenia' WHERE `przejazd`.`id` = $przejazdDTO->id;";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            print($result);
            return $result;
        }
    }
?>

