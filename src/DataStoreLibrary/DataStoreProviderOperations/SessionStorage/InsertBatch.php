<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibrary\DataStoreProviderOperations\SessionStorage;


trait InsertBatch
{

    public function insertBatch(array $data_array): array
    {
        $results = [];
        foreach ($data_array as $data) {
            $this->insert($data);
            $results[$this->getHash()] = $data;
        }
        return $results;
    }

}