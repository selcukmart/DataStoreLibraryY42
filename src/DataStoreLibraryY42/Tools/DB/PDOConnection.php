<?php
/**
 * @author selcukmart
 * 8.02.2022
 * 22:31
 */

namespace DataStoreLibraryY42\Tools\DB;

use PDO;

class PDOConnection
{

    /**
     * @description Singleton
     * @var PDO
     * @author selcukmart
     * 15.02.2022
     * 15:13
     */
    private static PDO $instance;

    public static function connect(array $config): PDO
    {
        if (!isset($config['SQLDRIVER'], $config['DBNAME'])) {
            throw new \RuntimeException("No connection information");
        }
        $instance_key = $config['SQLDRIVER'] . '_' . $config['DBNAME'];
        if (!isset(self::$instance[$instance_key])) {
            if (isset($config['SQLHOST'],  $config['SQLHOST'], $config['DBUSER'], $config['DBPASS'])) {
                /**
                 * SQL CONNECTION OPERATIONS
                 */
                $dsn = $config['SQLDRIVER'] . ':host=' . $config['SQLHOST'] . ';dbname=' . $config['DBNAME'];
                $dbOptions = [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ];

                try {
                    $dbh = new PDO($dsn, $config['DBUSER'], $config['DBPASS'], $dbOptions);
                } catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int)$e->getCode());
                }
                $dbh->query("SET NAMES 'utf8'");
                $dbh->query("SET CHARACTER SET utf8");
                $dbh->query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");
                self::$instance[$instance_key] = $dbh;
                /**
                 * SQL BAĞLANTI İŞLEMLERİ SONU
                 */
            } else {
                throw new \RuntimeException("No connection information");
            }
        }
        return self::$instance[$instance_key];
    }

}