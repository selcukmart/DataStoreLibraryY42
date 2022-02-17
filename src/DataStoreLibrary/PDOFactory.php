<?php
namespace DataStoreLibrary;

use DataStoreLibrary\Tools\DB\PDOConnection;

/**
 * @author selcukmart
 * 15.02.2022
 * 15:01
 */
class PDOFactory extends AbstractDataStoreFactory implements FactoryInterface
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

    public function insertBatch(array $data)
    {
        // TODO: Implement insertBatch() method.
    }

    public function filter(string $str): array
    {
        // TODO: Implement filter() method.
    }

    public function update($old_data, $new_data)
    {
        // TODO: Implement update() method.
    }

    public function retrieve(string $hash)
    {
        // TODO: Implement retrieve() method.
    }

    public function lists(int $limit, int $offset): array
    {
        // TODO: Implement lists() method.
    }
}