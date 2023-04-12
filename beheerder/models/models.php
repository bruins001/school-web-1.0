<?php
class Database {
    private $conn;

    function __construct($username, $password) {
        $this->conn = new mysqli("localhost", $username, $password, "web_1_0_227224");

        if ($this->conn->connect_error) {
            throw new InvalidArgumentException("Kon niet met database verbinden");
        }
    }

    function insert(string $table, array $columns, array $values) {
        $return_value = false;

        $table = htmlspecialchars($table);
        $sql = "INSERT INTO " . $table . " (" . implode(", ", $columns) . ") " . "VALUES (" . implode(", ", $values) . ");";

        try {
            if ($this->conn->query($sql)) {
                $return_value = true;
            }
        } catch (mysqli_sql_exception) {}

        return $return_value;
    }

    function select(string $table, array $columns, array $where) {
        $return_value = null;

        $table = htmlspecialchars($table);
        $sql = "SELECT " . implode(", ", $columns) . " FROM " . $table;
        
        if (count($where) > 0) {
            $sql = $sql . " WHERE";

            $firstLoop = true;
            foreach ($where as $operand1 => $operand2) {
                if ($firstLoop) {
                    $sql = $sql . " " . $operand1 . " = " . $operand2;
                    $firstLoop = false;
                } else {
                    $sql = $sql . " AND " . $operand1 . " = " . $operand2;
                }
            }
        }

        try {
            $result = $this->conn->query($sql);
            if ($result) {
                $return_value = $result;
            }
        } catch (mysqli_sql_exception) {}

        return $return_value;
    }
}
?>
