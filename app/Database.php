<?php
    class database{
        public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS){
            $this->pdo = new PDO("$DB_TYPE:dbname=$DB_NAME;host=$DB_HOST", $DB_USER, $DB_PASS);
            $this->pdo->exec("set names utf8");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function select($sql){
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        public function insert($sql){
            $stmt = $this->pdo->exec($sql);
            return $this->pdo->lastInsertId();
        }
        public function update($sql){
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }
        public function delete($sql){
            $stmt = $this->pdo->exec($sql);
        }
    }