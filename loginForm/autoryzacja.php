<?php
include_once "DBConnection.php";
function loguj($login, $haslo)
{
    $query="SELECT * FROM `osoba` WHERE pseudonim='$login'";
    $result = mysqli_query($_SESSION['link'], $query);
    if($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if($row['haslo'] == $haslo)
        {
            return $row['uprawnienia'];
        }
    }
    return -1;
}
function rejestruj($imie, $nazwisko, $pseudonim, $haslo, $uprawnienia)
{
    $query="SELECT * FROM `osoba` WHERE pseudonim='$pseudonim'";
    $result = mysqli_query($_SESSION['link'], $query);
    //sprawdzenie czy nie ma juz kogos w bazie z takim pseudonimem 
    if(!$row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $query="INSERT INTO `osoba` (`id`, `pseudonim`, `haslo`, `imie`, `nazwisko`, `uprawnienia`) VALUES (NULL, '$pseudonim', '$haslo', '$imie', '$nazwisko', '$uprawnienia')";
        $result = mysqli_query($_SESSION['link'], $query);
        return 1;
    }  
    return 0;
}
?>
