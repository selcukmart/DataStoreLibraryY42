<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:38
 */

namespace DataStoreLibraryY42\DataStoreProviders\SessionStorage;


use DataStoreLibraryY42\SessionFactory;

trait Update
{

    public function update($old_data, $new_data)
    {
        $this->delete(data_or_hash: $old_data, is_data: true);
        $this->insert($new_data);
    }

}