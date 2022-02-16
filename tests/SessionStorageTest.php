<?php
/**
 * @author selcukmart
 * 16.02.2022
 * 16:01
 */

namespace Tests;
if (!session_id()) {
    session_start();
}

use DataStoreLibraryY42\SessionFactory;
use PHPUnit\Framework\TestCase;

class SessionStorageTest extends TestCase
{

    public static function prepareStorage()
    {
        if (!isset($_SESSION['DataStoreLibraryY42'])) {
            $_SESSION['DataStoreLibraryY42'] = [];
        }
    }

    public function testInsertString(): void
    {
        $expected = 'Test String';
        self::prepareStorage();
        $storage = $_SESSION['DataStoreLibraryY42'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();

        $this->assertSame($expected, $storage_factory->retrieve($hash));
    }

    public function testInsertArray(): void
    {
        self::prepareStorage();
        $expected = [
            'a' => [
                'b' => 'Test'
            ]
        ];
        $storage = $_SESSION['DataStoreLibraryY42'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();
        $storage_factory->retrieve($hash);

        $this->assertSame($expected, $storage_factory->retrieve($hash));
    }

    public function testDeleteOverHash(): void
    {
        self::prepareStorage();
        $expected = 'Test String';
        $storage = $_SESSION['DataStoreLibraryY42'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();
        $storage_factory->delete($hash, is_data: false);

        $this->assertNull($storage_factory->retrieve($hash));
    }

    public function testDeleteOverString(): void
    {
        self::prepareStorage();
        $expected = 'Test String';
        $storage = $_SESSION['DataStoreLibraryY42'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();
        $storage_factory->delete($expected, is_data: true);

        $this->assertNull($storage_factory->retrieve($hash));
    }
}
