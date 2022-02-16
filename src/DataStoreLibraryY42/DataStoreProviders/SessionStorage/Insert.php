<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibraryY42\DataStoreProviders\SessionStorage;



use DataStoreLibraryY42\AbstractDataStoreLibraryY42;
use DataStoreLibraryY42\DataStoreProviders\DataStoreProviderFactoryInterface;


trait Insert
{



    public function insert($data): bool
    {
        $this->setData($data);
        $hash = $this->getConvertedData();
        if (isset($this->storage_session[$hash])) {
            $this->setErrorMessage('This data is before inserted, please use update method');
        } else {
            $this->storage_session[$hash] = $this->DataStorageConvert->getBase64EncodedStr();
            $this->setResult(true);
        }
        return $this->isResult();
    }
    
}