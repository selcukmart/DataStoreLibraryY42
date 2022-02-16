<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibraryY42\DataStoreProviders\SessionStorage;


use DataStoreLibraryY42\SessionFactory;

trait Delete
{

    public function delete($data_or_hash, bool $is_data)
    {
        if ($is_data) {
            $this->setData($data_or_hash);
            $hash = $this->getConvertedData();
        } else {
            $hash = $data_or_hash;
        }
        if (isset($this->storage_session[$hash])) {
            unset($this->storage_session[$hash]);
            $this->setResult(true);
        } else {
            $this->setErrorMessage('This data is before deleted');
        }
    }
    
}