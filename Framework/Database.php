<?php
/**
 * Database Access Class
 *
 * Provides the database access tools used by our micro-framework
 *
 * Filename:        Database.php
 * Location:        /Framework/
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    13/03/2025
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

namespace Framework;

use Exception;
use PDO;
use PDOException;

class Database
{
    /**
     * Define Properties
     */

    /**
     * Connection property
     *
     * @var PDO
     */
    public $conn;


    /**
     * Constructor for Database class
     *
     * @param array $config
     * @throws Exception
     */
    public function __construct($config)
    {
        $host = $config['host'];
        $port = $config['port'];
        $dbName = $config['dbname'];

        $dsn = "mysql:host={$host};port={$port};dbname={$dbName}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: {$e->getMessage()}");
        }
    }


    /**
     * Query the database
     *
     * The SQL to execute and an optional array of named parameters and values
     * are required.
     *
     * Use:
     * <code>
     *   $sql = "SELECT name, description from products WHERE name like '%:name%'";
     *   $filter = ['name'=>'ian',];
     *   $results = $dbConn->query($sql,$filter);
     * </code>
     *
     * @param string $query
     * @param array $params []|[associative array of parameter names and values]
     *
     * @return PDOStatement
     * @throws PDOException|Exception
     */
    public function query($query, $params = [])
    {
        try {
            $sth = $this->conn->prepare($query);

            // Bind named params
            foreach ($params as $param => $value) {
                $sth->bindValue(':' . $param, $value);
            }

            $sth->execute();
            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query failed to execute: {$e->getMessage()}");
        }
    }
}