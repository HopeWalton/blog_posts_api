<?php
    class Category {
        private $conn;
        private $table = 'categories';

        public $id;
        public $name;
        public $created_at;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Get Categories
        public function read(){
            //Create query
            $query = 'SELECT
                id,
                name,
                created_at
            FROM
                ' . $this->table . '
            ORDER BY
                created_at DESC';

            //Prepare Statment
            $stmt = $this->conn->prepare($query);

            //Execute Statement
            $stmt->execute();

            return $stmt;
        }

        // Get single category
        public function read_single_cat(){
            $query = 'SELECT
                id,
                name,
                created_at
            FROM
                '. $this->table .'
            WHERE
                id=?
            LIMIT 0, 1';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->created_at = $row['created_at'];
            } else {
                $this->id = null;
                $this->name = null;
                $this->created_at = null;
            }
            
        }
    }