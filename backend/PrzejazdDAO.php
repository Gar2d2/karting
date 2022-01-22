<?php
    include_once 'backend\PrzejazdDTO.php';
    include_once 'backend\DBConnector.php';
    class PrzejazdDAO
    {
    
     public function pobierzPrzejazdy()
        {
            $connection = new DBConnector();
            $przejazdy[] = new PrzejazdDTO();
            $index = 0;
            $query="SELECT * FROM `przejazd`";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
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
                    #print($row['id']);
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
		
		public function pobierzPrzejazdZID($id)
        {
            $connection = new DBConnector();
            $przejazdy[] = new PrzejazdDTO();
            $query="SELECT * FROM `przejazd` WHERE id='$id' LIMIT 1";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
                    $przejazd = new PrzejazdDTO();
                    $przejazd->id = $row['id'];
                    $przejazd->data = $row['dataPrzejazdu'];
                    $przejazd->godzinaRozpoczecia = $row['godzinaRozpoczecia'];
                    $przejazd->godzinaZakonczenia = $row['godzinaZakonczenia'];
                }
            }
            return $przejazd;
        }

        public function pobierzObecnyPrzejazd($time, $day)
        {
            $connection = new DBConnector();
            $przejazdy[] = new PrzejazdDTO();
            $query="SELECT * FROM `przejazd` WHERE dataPrzejazdu = '$day' and godzinaRozpoczecia < '$time' and godzinaZakonczenia> '$time'";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            $help = 0;
            if($result)
            {
                while($row = mysqli_fetch_array($result))
                {
                    #print($row['id']);
                    $przejazd = new PrzejazdDTO();
                    $przejazd->id = $row['id'];
                    $przejazd->data = $row['dataPrzejazdu'];
                    $przejazd->godzinaRozpoczecia = $row['godzinaRozpoczecia'];
                    $przejazd->godzinaZakonczenia = $row['godzinaZakonczenia'];
                    $help++;
                }
                if($help == 0)
                {
                 
                    $przejazd = new PrzejazdDTO();
                }
            } 
            return $przejazd;
        }


         public function pobierzPrzejazdZDataIGodzina($dataPrzejazdow, $godzinaPrzejazdow)
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
                    $przejazdy[$index] = new PrzejazdDTO();
                    $przejazdy[$index]->id = $row['id'];
                    $przejazdy[$index]->data = $row['dataPrzejazdu'];
                    $przejazdy[$index]->godzinaRozpoczecia = $row['godzinaRozpoczecia'];
                    $przejazdy[$index]->godzinaZakonczenia = $row['godzinaZakonczenia'];
                    $index++;
                }
            }
            if($przejazdy)
            {
                for($i =0; $i<count($przejazdy);$i++)
                {
                    if($przejazdy[$i]->godzinaRozpoczecia == $godzinaPrzejazdow)
                    {
                        return $przejazdy[$i];
                    }
                }
            }
            return 0;
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

