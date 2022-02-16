<?php
namespace DataStoreLibraryY42\DataStoreProviders;
/**
 * @author selcukmart
 * 15.02.2022
 * 14:56
 */
interface DataStoreProviderFactoryInterface
{
    public function delete($data, bool $is_data);

    public function insert($data);

    public function filter(string $str);

    public function update($old_data,$new_data);

}