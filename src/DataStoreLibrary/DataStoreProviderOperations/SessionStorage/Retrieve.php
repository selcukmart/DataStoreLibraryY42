<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibrary\DataStoreProviderOperations\SessionStorage;


use DataStoreLibrary\DataStorageManipulation\DataStorageConvert;

trait Retrieve
{

    public function retrieve(string $hash)
    {
        if (!isset($this->storage_session[$hash])) {
            $this->setErrorMessage('This data is not found');
        } else {
            $this->setResult(true);
            return DataStorageConvert::getInstance($this->storage_session[$hash])->fromFormat();
        }
    }
    
}