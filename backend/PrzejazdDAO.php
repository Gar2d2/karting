<?php
    include_once 'backend\PrzejazdDTO.php';
    class PrzejazdDAO
    {
        
        public function pobierzPrzejazdyZData($dataPrzejazdow)
        {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $baza = 'tor_kartingowy';
            
            $link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);

            $przejazdy[] = new PrzejazdDTO();
            $index = 0;
            $query="SELECT * FROM `przejazd` WHERE dataPrzejazdu='$dataPrzejazdow'";
            $result = mysqli_query($link, $query);
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
    }
?>

