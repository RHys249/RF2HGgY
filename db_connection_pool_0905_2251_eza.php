<?php
// 代码生成时间: 2025-09-05 22:51:29
class DbConnectionPool {

    private $pool = [];
    private $dbConfig;
    private $maxConnections;

    /**
     * Constructor for the DbConnectionPool class.
     *
     * @param array $dbConfig The database configuration
     * @param int $maxConnections The maximum number of connections to keep in the pool
     */
    public function __construct($dbConfig, $maxConnections = 5) {
        $this->dbConfig = $dbConfig;
        $this->maxConnections = $maxConnections;
    }

    /**
     * Get a database connection from the pool or create a new one if necessary.
     *
     * @return PDO The database connection
     */
    public function getConnection() {
        if (count($this->pool) < $this->maxConnections) {
            // If pool is not full, create a new connection
            $connection = new PDO("mysql:host=" . $this->dbConfig['host'] . ";dbname=" . $this->dbConfig['dbname'], $this->dbConfig['username'], $this->dbConfig['password']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pool[] = $connection;
        } else {
            // If pool is full, reuse an existing connection
            $connection = array_shift($this->pool);
            $this->pool[] = $connection;
        }

        return $connection;
    }

    /**
     * Release a connection back to the pool.
     *
     * @param PDO $connection The connection to release
     */
    public function releaseConnection($connection) {
        if (count($this->pool) < $this->maxConnections) {
            $this->pool[] = $connection;
        } else {
            // If pool is full, close the connection
            $connection = null;
        }
    }

    /**
     * Close all connections in the pool.
     */
    public function closeAllConnections() {
        foreach ($this->pool as $connection) {
            $connection = null;
        }
        $this->pool = [];
    }

    /**
     * Destructor to ensure all connections are closed when the object is destroyed.
     */
    public function __destruct() {
        $this->closeAllConnections();
    }
}
