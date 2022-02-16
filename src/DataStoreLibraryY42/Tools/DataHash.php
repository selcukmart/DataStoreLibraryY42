<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 15:23
 */

namespace DataStoreLibraryY42\Tools;

class DataHash
{
    private static array $hashed_value ;

    public static function get(DataStorageConvert $dataStorageConvert)
    {
        $base64_encoded_str = $dataStorageConvert->getBase64EncodedStr();
        if(!isset(self::$hashed_value[$base64_encoded_str])){
            self::$hashed_value[$base64_encoded_str] = md5($base64_encoded_str);
        }
        return self::$hashed_value[$base64_encoded_str];
    }
}