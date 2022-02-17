<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 15:45
 */

namespace DataStoreLibrary;

use DataStoreLibrary\DataStorageManipulation\DataStorageConvert;
use DataStoreLibrary\Tools\FilterResult;
use GlobalTraits\ErrorMessagesWithResultTrait;

abstract class AbstractDataStoreFactory
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

    /**
     * @param int|string $hash
     * @param array $results
     * @return array
     * @author selcukmart
     * 17.02.2022
     * 10:54
     */
    protected function setResults(int|string $hash,mixed $item, array $results): array
    {
        $filter_object = new FilterResult();
        $filter_object->setHash($hash);
        $filter_object->setItem($item);
        $results[] = $filter_object;
        return $results;
    }
}