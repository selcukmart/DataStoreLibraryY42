<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibrary\DataStoreProviderOperations\SessionStorage;


trait Lists
{

    public function lists(int $limit, int $offset): array
    {
        if ($offset < 0) {
            $offset = 0;
        }
        $results = [];
        $total_data = count($this->storage_session);
        if ($offset >= $total_data) {
            return $results;
        }
        if ($limit < 0) {
            $limit = 1;
        }
        $a = 0;
        $collected = 0;
        foreach ($this->storage_session as $hash => $item) {
            $a++;
            if ($collected === $limit || $a === $total_data) {
                break;
            }
            if ($a > $offset) {
                $collected++;
                $item = $this->retrieve($hash);
                $results = $this->setResults($hash, $item, $results);
            }

        }
        return $results;
    }


}