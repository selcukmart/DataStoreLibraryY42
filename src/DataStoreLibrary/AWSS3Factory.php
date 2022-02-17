<?php

namespace DataStoreLibrary;

/**
 * @author selcukmart
 * 15.02.2022
 * 16:32
 */
class AWSS3Factory  extends AbstractDataStoreFactory implements FactoryInterface
{
    public function __construct(private readonly array $sc_config)
    {
    }

    public static function create(array $config): AWSS3Factory
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