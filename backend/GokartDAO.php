<?php
    include_once 'backend/GokartDTO.php';
    include_once 'backend/DBConnector.php';
    class GokartDAO
    {
        
        public function pobierzGokarty()
        {
            $connection = new DBConnector();
            $Gokart[] = new GokartDTO();
            $query="SELECT * FROM `kart`";
            $result = mysqli_query($connection->GetBazaConnection(), $query);
            if($result)
            {
                $index = 0;
                while($row = mysqli_fetch_array($result))
                {
                    $Gokart[$index] = new GokartDTO();
                    $Gokart[$index]->id = $row['id'];
                    $Gokart[$index]->numerKarta = $row['numerKarta'];
                    $index++;
                }
               
            }
            return $Gokart;
        } 
    }
?>

