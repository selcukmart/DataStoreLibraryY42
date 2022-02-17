<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibrary\DataStoreProviderOperations\SessionStorage;


trait Update
{

    public function update($old_data, $new_data): void
    {
        $old_hash = $this->filter($old_data)[0]->getHash();
        $this->setData($new_data);
        $this->getConvertedData();
        $this->hash = $old_hash;
        $this->storage_session[$old_hash] = $this->DataStorageConvert->getBase64EncodedStr();
    }

}