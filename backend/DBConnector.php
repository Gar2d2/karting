<?php
    class DBConnector
    {
        public $dbhost = 'localhost';
        public $dbuser = 'torkartingowy999_torkartingowy';
        public $dbpass = 'jzfw3d3uk5';
        public $baza = 'torkartingowy999_torkartingowy';
        public $link;

        public function GetBazaConnection()
        {
            $this->link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->baza);
            return $this->link;
        }
    }
?>
