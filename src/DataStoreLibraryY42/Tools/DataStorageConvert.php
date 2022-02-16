<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 15:23
 */

namespace DataStoreLibraryY42\Tools;

class DataStorageConvert
{
    private string
        $base64_encoded_str,
        $hash;
    private mixed $base64_decoded;

    public function __construct(private $data)
    {
    }

    public static function getInstance($data): DataStorageConvert
    {
        return new self($data);
    }

    public function execute(): void
    {
        $this->convert();
        $this->hash();
    }

    private function hash()
    {
        $this->hash = DataHash::get($this);
    }


    private function convert()
    {
        $this->base64_encoded_str = DataStorageFormat::toFormat($this->data);
    }

    public function fromFormat()
    {
        return $this->base64_decoded = DataStorageFormat::fromFormat($this->data);
    }


    /**
     * @return string
     */
    public function getBase64EncodedStr(): string
    {
        return $this->base64_encoded_str;
    }

    /**
     * @return string
     */
    public function getBase64Decoded(): string
    {
        return $this->base64_decoded;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    public function __destruct()
    {

    }
}