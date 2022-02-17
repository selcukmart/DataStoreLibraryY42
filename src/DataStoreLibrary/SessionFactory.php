<?php

namespace DataStoreLibrary;


use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\Delete;
use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\Filter;
use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\Insert;
use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\InsertBatch;
use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\Lists;
use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\Retrieve;
use DataStoreLibrary\DataStoreProviderOperations\SessionStorage\Update;

/**
 * @author selcukmart
 * 15.02.2022
 * 15:01
 */
class SessionFactory extends AbstractDataStoreFactory implements FactoryInterface
{
    use
        Insert,
        InsertBatch,
        Filter,
        Retrieve,
        Update,
        Delete,
        Lists;

    public function __construct(protected array $storage_session)
    {
    }

    public static function create(array $config): SessionFactory
    {
        return new self($config);
    }

}