```
composer require selcukmart/data-store-library-y42
```

### What does it?

It can store/get/change any data.

It manipulates the data as;

* Record inserts & batch inserts
* Record query/retrieval
* Query filters (equality operations only), limit & offset
* Update and delete operations

The code has unit tests. It can be tested after cloned.
```
tests/SessionStorageTest.php
```

### How to use

For example we choose using Session Storage;
Insert Example;

```php
    $storage = $_SESSION['DataStoreLibrary'];
    $storage_factory = SessionFactory::create($storage);
    $expected = [
            'a' => [
                'b' => 'Test'
            ]
        ];
    $storage_factory->insert($expected);
    $hash = $storage_factory->getHash();
```

Batch Insert Example;

```php
    $storage = $_SESSION['DataStoreLibrary'];
    $storage_factory = SessionFactory::create($storage);
    $batch_insert_array = [
            'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'Lorem Ipsum is simply dummy text of the printing and typesetting',
            'There are many variations of passages of Lorem Ipsum available',
            'It is a long established fact that a reader will be distracted by the',            
        ];
    $results = $storage_factory->insertBatch($batch_insert_array);        
```

Update Example;

```php
    $storage = $_SESSION['DataStoreLibrary'];
    $storage_factory = SessionFactory::create($storage);
    $str1 = 'Test String';
        $str2 = 'Test String2';
        $storage_factory->insert($str1);
        $old_hash = $storage_factory->getHash();
        $storage_factory->update($str1,$str2);
```

Filter Example;

```php
    $storage = $_SESSION['DataStoreLibrary'];
    $storage_factory = SessionFactory::create($storage);
    $str = 'Contrary to popular belief, Lorem Ipsum is not simply random text.';
        $str2 = 'Lorem Ipsum is simply dummy text of the printing and typesetting';
        $str3 = 'There are many variations of passages of Lorem Ipsum available';
        $str4 = 'It is a long established fact that a reader will be distracted by the';
        $storage_factory->insert($str);
        $storage_factory->insert($str2);
        $storage_factory->insert($str3);
        $storage_factory->insert($str4);
        $results = $storage_factory->filter($str3);
        echo $results[0]->getHash();
        echo $results[0]->getItem();
```

Lists Example;

```php
    $storage = $_SESSION['DataStoreLibrary'];
    $storage_factory = SessionFactory::create($storage);
    $batch_insert_array = [
            'Contrary to popular belief, Lorem Ipsum is not simply random text.',
            'Lorem Ipsum is simply dummy text of the printing and typesetting',
            'There are many variations of passages of Lorem Ipsum available',
            'It is a long established fact that a reader will be distracted by the',            
        ];
    $results = $storage_factory->insertBatch($batch_insert_array);
    $result = $storage_factory->lists(limit: 2, offset: 2);
```

Delete Example;

```php
    $storage = $_SESSION['DataStoreLibrary'];
    $storage_factory = SessionFactory::create($storage);
    $expected = 'Test String';
    $storage_factory->insert($expected);
    $hash = $storage_factory->getHash();
    $storage_factory->delete($hash, is_data: false); // OR $storage_factory->delete($expected, is_data: true);
```

### If you want to use other providers

PDOFactory creates own table named as "data_storage" and uses it. If you want to set your table name please add the config: 'TABLE'=>'abc_table'

```php
    $config = [
        'SQLDRIVER'=>'mysql',
        'DBNAME'=>'data_store',
        'SQLHOST'=>'localhost',
        'DBUSER'=>'root',
        'DBPASS'=>''
    ];
    $storage_factory = PDOFactory::create($config);
```

### If you want to create own provider

For example Aws S3;
```php
class AWSS3Factory  extends AbstractDataStoreFactory implements FactoryInterface
{
    public function __construct(private readonly array $sc_config)
    {
    }


    public static function create(array $config): AWSS3Factory
    {
        return new self($config);
    }
    
    public function delete($data, bool $is_data)
    {
        // TODO: Implement delete() method.
    }

    public function insert($data)
    {
        // TODO: Implement insert() method.
    }

    public function insertBatch(array $data)
    {
        // TODO: Implement insertBatch() method.
    }

    public function filter(string $str): array
    {
        // TODO: Implement filter() method.
    }

    public function update($old_data, $new_data)
    {
        // TODO: Implement update() method.
    }

    public function retrieve(string $hash)
    {
        // TODO: Implement retrieve() method.
    }

    public function lists(int $limit, int $offset): array
    {
        // TODO: Implement lists() method.
    }
}
```

AbstractDataStoreFactory

```php
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
```