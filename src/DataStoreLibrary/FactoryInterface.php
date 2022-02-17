<?php

namespace DataStoreLibrary;
/**
 * @author selcukmart
 * 15.02.2022
 * 14:56
 */
interface FactoryInterface
{
    public function delete($data, bool $is_data);

    public function insert($data);

    public function insertBatch(array $data);

    public function filter(string $str):array;

    public function update($old_data, $new_data);

    public function retrieve(string $hash);

    public function lists(int $limit,int $offset):array;

}