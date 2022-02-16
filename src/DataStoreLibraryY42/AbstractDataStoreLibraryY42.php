<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 15:45
 */

namespace DataStoreLibraryY42;

use DataStoreLibraryY42\Tools\DataStorageConvert;
use GlobalTraits\ErrorMessagesWithResultTrait;

abstract class AbstractDataStoreLibraryY42
{
    use ErrorMessagesWithResultTrait;

    protected string $hash;
    protected mixed $data;
    protected DataStorageConvert $DataStorageConvert;

    protected function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return string
     * @author selcukmart
     * 16.02.2022
     * 15:52
     */
    protected function getConvertedData(): string
    {
        $this->DataStorageConvert = DataStorageConvert::getInstance($this->data);
        $this->DataStorageConvert->execute();
        $this->hash = $this->DataStorageConvert->getHash();
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}