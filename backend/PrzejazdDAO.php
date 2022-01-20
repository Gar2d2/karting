<?php
    include_once 'backend\PrzejazdDTO.php';
    class PrzejazdDAO
    {
        
        public function pobierzPrzejazdyZData($dataPrzejazdow, $link)
        {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $baza = 'tor_kartingowy';
            
            $link = mysqli_connect($dbhost, $dbuser, $dbpass, $baza);
            //'2022-01-21'
            $przejazdy[] = new PrzejazdDTO();
            $index = 0;
                //WHERE dataPrzejazdu='$dataPrzejazdow'
            $query="SELECT * FROM `przejazd`";
            $result = mysqli_query($link, $query);
            while($row = mysqli_fetch_array($result))
            {
                print($row['id']);
                $przejazdy[$index] = new PrzejazdDTO();
                $przejazdy[$index]->id = $row['id'];
                $przejazdy[$index]->data = $row['dataPrzejazdu'];
                $przejazdy[$index]->godzinaRozpoczecia = $row['godzinaRozpoczecia'];
                $przejazdy[$index]->godzinaZakonczenia = $row['godzinaZakonczenia'];
            }
            print($przejazdy[0]->id);
            return $przejazdy;
        }
    }
?>

