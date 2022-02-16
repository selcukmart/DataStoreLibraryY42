<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:10
 */

namespace DataStoreLibraryY42\Tools;

class DataStorageFormat
{
    private static array $controlled_as_serialized;
    private static array $from_format;

    public static function toFormat(mixed $data)
    {
        if (is_array($data) || is_object($data)) {
            $str = serialize($data);
        } else {
            $str = $data;
        }
        return base64_encode($str);
    }

    public static function fromFormat(mixed $data)
    {
        if (isset(self::$from_format[$data])) {
            return self::$from_format[$data];
        }
        $new_data = base64_decode($data);
        if (self::isSmartSerialized($new_data)) {
            return self::$from_format[$data] = unserialize($new_data);
        }
        return self::$from_format[$data] = $new_data;
    }

    private static function isSmartSerialized(string $value)
    {
        if (isset(self::$controlled_as_serialized[$value])) {
            return self::$controlled_as_serialized[$value];
        }
        // Bit of a give away this one
        if (empty($value) || !is_string($value)) {
            return false;
        }
        // Serialized false, return true. unserialize( ) returns false on an
        // invalid string or it could return false if the string is serialized
        // false, eliminate that possibility.
        if ($value === 'b:0;') {
            return true;
        }
        $length = strlen($value);
        $end = '';
        switch ($value[0]) {
            case 's':
                if ($value[$length - 2] !== '"') {
                    return false;
                }
            case 'b':
            case 'i':
            case 'd':
                // This looks odd but it is quicker than isset( )ing
                $end .= ';';
            case 'a':
            case 'O':
                $end .= '}';
                if ($value[1] !== ':') {
                    return false;
                }
                switch ($value[2]) {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                        break;
                    default:
                        return false;
                }
            case 'N':
                $end .= ';';
                if ($value[$length - 1] !== $end[0]) {
                    return false;
                }
                break;
            default:
                return false;
        }
        if ((@unserialize($value)) === false) {
            self::$controlled_as_serialized[$value] = false;
            return false;
        }
        self::$controlled_as_serialized[$value] = true;
        return true;
    }

}