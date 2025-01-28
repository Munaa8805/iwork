<?php


namespace Framework;

use PDO;

class Database
{
    public $conn;
    /**
     * Constructor for Database class
     * 
     * @param array $config
     */
    public function __construct($config)
    {
        $dns = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

        ];
        try {
            $this->conn = new PDO($dns, $config['username'], $config['password'], $options);
            // echo "Database connection successful";
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Query the database
     * 
     * @param string $query
     * 
     * @return PDOStatement
     * @throws PDOException
     */
    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            // inspect($sql);

            // Bind named params
            foreach ($params as $param => $value) {
                $stmt->bindValue(':' . $param, $value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute : " . $e->getMessage());
        }
    }
}
