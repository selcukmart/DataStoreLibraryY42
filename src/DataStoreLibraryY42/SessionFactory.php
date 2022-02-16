<?php

namespace DataStoreLibraryY42;


use DataStoreLibraryY42\DataStoreProviders\DataStoreProviderFactoryInterface;
use DataStoreLibraryY42\DataStoreProviders\SessionStorage\Delete;
use DataStoreLibraryY42\DataStoreProviders\SessionStorage\Filter;
use DataStoreLibraryY42\DataStoreProviders\SessionStorage\Insert;
use DataStoreLibraryY42\DataStoreProviders\SessionStorage\Retrieve;
use DataStoreLibraryY42\DataStoreProviders\SessionStorage\Update;

/**
 * @author selcukmart
 * 15.02.2022
 * 15:01
 */
class SessionFactory extends AbstractDataStoreLibraryY42 implements DataStoreProviderFactoryInterface
{
    use
        Insert,
        Filter,
        Insert,
        Retrieve,
        Update,
        Delete;

    public function __construct(protected array $storage_session){}

    public static function create(array $config): SessionFactory
    {
        return new self($config);
    }

}