<?php
namespace DataStoreLibraryY42;

use DataStoreLibraryY42\DataStoreProviders\DataStoreProviderFactoryInterface;
use DataStoreLibraryY42\Tools\DB\PDOConnection;

/**
 * @author selcukmart
 * 15.02.2022
 * 15:01
 */
class PDOFactory implements DataStoreProviderFactoryInterface
{
    private \PDO $dbh;
    public function __construct(private readonly array $config)
    {
        $this->dbh = PDOConnection::connect($this->config);
    }

    public static function create(array $config): PDOFactory
    {
        return new self($config);
    }


    public function delete($data, bool $is_data)
    {
        // TODO: Implement delete() method.
    }

    public function insert($data)
    {
        // TODO: Implement insert() method.
    }

    public function filter(string $str)
    {
        // TODO: Implement filter() method.
    }

    public function update($old_data, $new_data)
    {
        // TODO: Implement update() method.
    }
}