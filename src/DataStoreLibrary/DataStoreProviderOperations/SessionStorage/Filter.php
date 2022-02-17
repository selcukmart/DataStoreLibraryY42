<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibrary\DataStoreProviderOperations\SessionStorage;


trait Filter
{

    public function filter(string $str): array
    {
        $results = [];
        foreach ($this->storage_session as $hash => $item) {
            $item = $this->retrieve($hash);
            if ($str === $item) {
                $results = $this->setResults($hash, $item, $results);
            }
        }
        return $results;
    }

}