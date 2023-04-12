<?php
class Database {
    private $conn;

    function __construct($username, $password) {
        // Starts connection.
        $this->conn = new mysqli("localhost", $username, $password, "web_1_0_227224");

        // Checks if connection was successful created.
        if ($this->conn->connect_error) {
            throw new InvalidArgumentException("Kon niet met database verbinden");
        }
    }

    function insert(string $table, array $columns, array $values) {
        $return_value = false;

        // Checks table for HTML characters and creates sql variable.
        $table = htmlspecialchars($table);
        $sql = "INSERT INTO " . $table . " (" . implode(", ", $columns) . ") " . "VALUES (" . implode(", ", $values) . ");";

        try {
            // Try's to run the query.
            if ($this->conn->query($sql)) {
                $return_value = true;
            }
        } catch (mysqli_sql_exception) {}

        // Return's true or false so the developer knows if the action was successful.
        return $return_value;
    }

    function select(string $table, array $columns, array $where) {
        $return_value = null;

        // Checks table for HTML characters and creates sql variable.
        $table = htmlspecialchars($table);
        $sql = "SELECT " . implode(", ", $columns) . " FROM " . $table;
        
        // Checks if where statement is necessary.
        if (count($where) > 0) {
            $sql = $sql . " WHERE";

            $firstLoop = true;
            foreach ($where as $operand1 => $operand2) {
                // Checks if this is the first loop
                if ($firstLoop) {
                    $sql = $sql . " " . $operand1 . " = " . $operand2;
                    $firstLoop = false;
                } else {
                    $sql = $sql . " AND " . $operand1 . " = " . $operand2;
                }
            }
        }

        try {
            
            // Gets the result from the database and defines it to the return_value.
            $result = $this->conn->query($sql);
            if ($result) {
                $return_value = $result;
            }
        } catch (mysqli_sql_exception) {}

        // returns the result if successful or null if unsuccessful.
        return $return_value;
    }
}
?>
