<?php
namespace DataStoreLibraryY42\DataStoreProviders;
/**
 * @author selcukmart
 * 15.02.2022
 * 14:56
 */
interface DataStoreProviderFileFactoryInterface
{
    public function delete(string $file);

    public function insert(string $file);

    public function filter(string $file);

    public function update(string $file,string $new_file);
}