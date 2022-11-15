<?php
    class Model extends Conectar {

        public  $db;
        // private $table;
        // private $view;
        // private $values = array();
        // public  $id;
        private $sql;
        private $field;


        public function __construct(){
            $con = new Conectar();
            $this->db = $con->conexionBD();
            $this->field = array();
        }

        // public static function setTable($tab)   {
        //     $this->table = $tab;
        //     // return $table;  
        // }

        public function getAll($tab) {
            $this->table = $tab;
            $sql = "SELECT * FROM {$this->table}";

            $result = $this->db->query($sql);
            while($row = $result->fetch_assoc())   {
                $this->field[] = $row;
            }
            return $this->field;
        }


        // public static function addField($coll)  {
        //     $this->column[] = $coll;
        // }

        // public static function addValues($valu)   {
        //     $this->values[] = $valu;
        // }


        // public function getKardex() {



        // }
        

        // public static function getId($id) {
            
        //     $this->sql = "SELECT * FROM ";
        //     $this->id = $id;

        //     $result = $this->db->query($sql . $this->table . " WHERE id" . $this->id . " ORDER BY id DESC");
        //     while($row = $result->fetch_object())   {
        //         $this->field = $row;
        //     }
        //     return $field;
        // }

        // public static function getWhere($condition) {
            
        //     $this->sql = "SELECT * FROM ";

        //     $result = $this->db->query($sql . $this->table . " WHERE " . $condition . " ORDER BY id DESC");
        //     while($row = $result->fetch_object())   {
        //         $this->field = $row;
        //     }
        //     return $field;
        // }

        // public static function getBy($column, $value)   {
        //     $this->sql = "SELECT * FROM ";
        //     $this->col = $column;
        //     $this->val = $value;

        //     $result = $this->db->query($sql . $this->table . " WHERE " . $col . $val);
        //     while($row = $result->fetch_object())   {
        //         $this->field = $row;
        //     }
        //     return $field;
        // }

        // public static function update($id)   {
        //     $this->col = implode(",", $this->column);
        //     $this->sql = "UPDATE ";

        //     $result = $this->sql->query($sql . $this->table . " SET " . $col . "=" . $this->values . "WHERE" );
        //     while($row = $result->fetch_object())   {
        //         $this->field = $row;
        //     }
        //     return $field;
        // }

        // public static function insert()   {
        //     $this->field = implode(",", $this->column);
        //     $this->sql = "INSERT INTO ";

        //     $result = $this->sql->query($sql . $this->table . "(" . $field . ")" . " VALUE " ."(". $this . ")");
        //     while($row = $result->fetch_object())   {
        //         $this->field = $row;
        //     }
        //     return $field;
        // }

    }


?>