<?php
class db_pdo
{
    //local developeement
    /*const DB_SERVER_TYPE = 'mysql'; // MySQL or MariaDB server
    const DB_HOST = '127.0.0.1'; // local server on my laptop
    const DB_PORT = 3307; // optional, default 3306, use 3307 for MariaDB
    const DB_NAME = 'optimiste'; // for Database classicmodels
    const DB_CHARSET = 'utf8mb4'; // pour français correct
    const DB_USER_NAME = 'optimiste'; // if not root it must have been previously created on DB server
    const DB_PASSWORD = '12345';
*/
    //public developpement

    const DB_SERVER_TYPE = 'mysql'; // MySQL or MariaDB server
    const DB_HOST = 'sql203.epizy.com'; // local server on my laptop
    const DB_PORT = 3306; // optional, default 3306, use 3307 for MariaDB
    const DB_NAME = 'epiz_33225733_optimiste'; // for Database classicmodels
    const DB_CHARSET = 'utf8mb4'; // pour français correct
    const DB_USER_NAME = 'epiz_33225733'; // if not root it must have been previously created on DB server
    const DB_PASSWORD = 'gPXDqevjiY8Fea';

    // PDO connection options
    const DB_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    private $DB_connection = null;
    public function connect()
    {
        try {
            $DSN = self::DB_SERVER_TYPE . ':host=' . self::DB_HOST . ';port=' . self::DB_PORT . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHARSET;
            $this->DB_connection = new PDO($DSN, self::DB_USER_NAME, self::DB_PASSWORD, self::DB_OPTIONS);
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB connection Error : ' . $e->getMessage());
        }
        // echo 'connected';
    }
    //pour update,delete pour insert update delete
    public function query($sql)
    {
        try {
            $result = $this->DB_connection->query($sql);
            return $result;
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB query error' . $e->getMessage());
        }
    }
    //pour select  retouner la table de result
    public function querySelect($sql)
    {
        try {
            $result = $this->DB_connection->query($sql);
            return  $result->fetchAll();
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB query error' . $e->getMessage());
        }
    }

    public function table($nom)
    {
        try {
            $result = $this->DB_connection->query("SELECT * FROM " . $nom);
            return $result;
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB query error' . $e->getMessage());
        }
    }
    //version parametre de query pour insert update delete
    public function queryParams($sql, $params)
    {
        try {
            $stmt = $this->DB_connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB query error' . $e->getMessage());
        }
    }
    //version parametre de querySelect
    public function querySelectParams($sql, $params)
    {
        try {
            $stmt = $this->DB_connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            http_response_code(500);
            exit('DB query error' . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $this->DB_connection = null;
    }
}
