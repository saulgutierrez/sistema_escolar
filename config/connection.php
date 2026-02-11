<?php
    session_start();

    class Connection {
        protected $dbhandler;

        protected function Connect() {
            try {
                $connect = $this->dbhandler = new PDO("mysql:local=localhost;dbname=dbsistemaescolar", "root", "");
                return $connect;
            } catch (Exception $e) {
                print $e->getMessage();
                die();
            }
        }

        public function set_names() {
            return $this->dbhandler->query("set names utf8");
        }

        public static function route () {
            return "http://localhost/sistema_escolar/";
        }
    }
?>