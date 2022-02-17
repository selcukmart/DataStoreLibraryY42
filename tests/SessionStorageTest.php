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

use DataStoreLibrary\SessionFactory;
use PHPUnit\Framework\TestCase;

class SessionStorageTest extends TestCase
{

    public static function prepareStorage(): void
    {
        $_SESSION['DataStoreLibrary'] = [];
    }

    public function testInsertString(): void
    {
        $expected = 'Test String';
        self::prepareStorage();
        $storage = $_SESSION['DataStoreLibrary'];
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
        $storage = $_SESSION['DataStoreLibrary'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();

        $this->assertSame($expected, $storage_factory->retrieve($hash));
    }

    public function testInsertObject(): void
    {
        self::prepareStorage();
        $expected = (object)[
            'a' => [
                'b' => 'Test'
            ]
        ];
        $storage = $_SESSION['DataStoreLibrary'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();
        $this->assertInstanceOf('stdClass', $storage_factory->retrieve($hash));
        $this->assertEquals($expected, $storage_factory->retrieve($hash));
    }

    public function testDeleteOverHash(): void
    {
        self::prepareStorage();
        $expected = 'Test String';
        $storage = $_SESSION['DataStoreLibrary'];
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
        $storage = $_SESSION['DataStoreLibrary'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($expected);
        $hash = $storage_factory->getHash();
        $storage_factory->delete($expected, is_data: true);

        $this->assertNull($storage_factory->retrieve($hash));
    }

    public function testUpdate(): void
    {
        $str1 = 'Test String';
        $str2 = 'Test String2';
        self::prepareStorage();
        $storage = $_SESSION['DataStoreLibrary'];
        $storage_factory = SessionFactory::create($storage);
        $storage_factory->insert($str1);
        $old_hash = $storage_factory->getHash();
        $storage_factory->update($str1,$str2);
        $new_hash = $storage_factory->getHash();
        $this->assertSame($old_hash, $new_hash);

        $new_hash = $storage_factory->filter($str2)[0]->getHash();
        $this->assertSame($old_hash, $new_hash);
    }

    public function testFilter(): void
    {
        self::prepareStorage();
        $storage = $_SESSION['DataStoreLibrary'];
        $storage_factory = SessionFactory::create($storage);
        $str = 'Contrary to popular belief, Lorem Ipsum is not simply random text.';
        $str2 = 'Lorem Ipsum is simply dummy text of the printing and typesetting';
        $str3 = 'There are many variations of passages of Lorem Ipsum available';
        $str4 = 'It is a long established fact that a reader will be distracted by the';
        $storage_factory->insert($str);
        $storage_factory->insert($str2);
        $storage_factory->insert($str3);
        $str3_hash = $storage_factory->getHash();
        $storage_factory->insert($str4);
        $results = $storage_factory->filter($str3);
        $this->assertSame($str3_hash, $results[0]->getHash());
    }

    public function testLists(): void
    {
        self::prepareStorage();
        $storage = $_SESSION['DataStoreLibrary'];
        $storage_factory = SessionFactory::create($storage);
        $batch_insert_array = [
            'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'Lorem Ipsum is simply dummy text of the printing and typesetting',
            'There are many variations of passages of Lorem Ipsum available',
            'It is a long established fact that a reader will be distracted by the',
            'It is a long established fact that a reader will be distracted by the2',
            'It is a long established fact that a reader will be distracted by the3',
            'It is a long established fact that a reader will be distracted by the4',
            'It is a long established fact that a reader will be distracted by the5',
            'It is a long established fact that a reader will be distracted by the6',
            'It is a long established fact that a reader will be distracted by the7',
            'It is a long established fact that a reader will be distracted by the8',
            'It is a long established fact that a reader will be distracted by the9',
            'It is a long established fact that a reader will be distracted by the10',
            'It is a long established fact that a reader will be distracted by the11',
            'It is a long established fact that a reader will be distracted by the12',
            'It is a long established fact that a reader will be distracted by the13',
            'It is a long established fact that a reader will be distracted by the14',
            'It is a long established fact that a reader will be distracted by the15',
            'It is a long established fact that a reader will be distracted by the16',
            'It is a long established fact that a reader will be distracted by the17',
            'It is a long established fact that a reader will be distracted by the18',
            'It is a long established fact that a reader will be distracted by the19',
            'It is a long established fact that a reader will be distracted by the20',
            'It is a long established fact that a reader will be distracted by the21',
            'It is a long established fact that a reader will be distracted by the22',
            'It is a long established fact that a reader will be distracted by the23',
            'It is a long established fact that a reader will be distracted by the24',
            'It is a long established fact that a reader will be distracted by the25',
            'It is a long established fact that a reader will be distracted by the26',
            'It is a long established fact that a reader will be distracted by the27',
            'It is a long established fact that a reader will be distracted by the28',
            'It is a long established fact that a reader will be distracted by the29',
            'It is a long established fact that a reader will be distracted by the30',
            'It is a long established fact that a reader will be distracted by the31',
            'It is a long established fact that a reader will be distracted by the32',
            'It is a long established fact that a reader will be distracted by the33',
            'It is a long established fact that a reader will be distracted by the34',
            'It is a long established fact that a reader will be distracted by the35',
        ];

        $storage_factory->insertBatch($batch_insert_array);
        $result = $storage_factory->lists(limit: 5, offset: 6);
        $collected = [];
        foreach ($result as $FilterResult) {
            $collected[] = $FilterResult->getItem();
        }
        $expected = [
            'It is a long established fact that a reader will be distracted by the4',
            'It is a long established fact that a reader will be distracted by the5',
            'It is a long established fact that a reader will be distracted by the6',
            'It is a long established fact that a reader will be distracted by the7',
            'It is a long established fact that a reader will be distracted by the8',
        ];

        $this->assertSame($expected, $collected);
    }
}
