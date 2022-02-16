<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibraryY42\DataStoreProviders\SessionStorage;


use DataStoreLibraryY42\SessionFactory;
use DataStoreLibraryY42\Tools\DataStorageConvert;

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