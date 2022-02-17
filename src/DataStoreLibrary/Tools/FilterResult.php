<?php
/**
 * @author selcukmart
 * 17.02.2022
 * 10:33
 */

namespace DataStoreLibrary\Tools;

class FilterResult
{
    private string
        $hash,
        $item;

    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @param string $item
     */
    public function setItem(string $item): void
    {
        $this->item = $item;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getItem(): string
    {
        return $this->item;
    }
}