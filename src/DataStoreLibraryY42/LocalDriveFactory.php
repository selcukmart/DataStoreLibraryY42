<?php
namespace DataStoreLibraryY42;

use DataStoreLibraryY42\DataStoreProviders\DataStoreProviderFileFactoryInterface;

/**
 * @author selcukmart
 * 15.02.2022
 * 16:32
 */
class LocalDriveFactory implements DataStoreProviderFileFactoryInterface
{
    public function __construct(private readonly string $to_dir)
    {
    }

    public function delete(string $file)
    {
        // TODO: Implement delete() method.
    }

    public function insert(string $file)
    {
        // TODO: Implement insert() method.
    }

    public function filter(string $file)
    {
        // TODO: Implement filter() method.
    }

    public function update(string $file,string $new_file)
    {
        // TODO: Implement update() method.
    }

}