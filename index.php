<?php

require './Src/Lib/vendor/autoload.php';

$serverApi = new \MongoDB\Driver\ServerApi(\MongoDB\Driver\ServerApi::V1);
$client = new \MongoDB\Client(DB_URL, [], ['serverApi' => $serverApi]);

$collection = $client->{DB_BASE}->Pessoa;


// Gravar
$result = $collection->insertOne([
    'nome' => 'Joe Marie',
    'email' => 'joe@marie.com',
        ]);

echo 'Documento inserido: ' . $result->getInsertedId() . "\n";

// Encontrar
$cursor = $collection->find([]);

foreach ($cursor as $document) {
    var_dump($document);
}


// Atualizar
$result = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID('6142fb48a8a74121435e864d')],
        ['$set' => ['email' => 'joe@marie.org']]
);

echo 'Modificados ' . $result->getMatchedCount() . ' documentos' . "\n";

// Delete
$result = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID('6142fb48a8a74121435e864d')]);

echo 'Apagados ' . $result->getDeletedCount() . ' documentos' . "\n";
// With objects

class Person implements \MongoDB\BSON\Persistable {

    private string $id;
    private \MongoDB\BSON\UTCDateTime $createdAt;
    private string $name;

    public function __construct(string $name) {
        $this->id = new \MongoDB\BSON\ObjectId();
        $this->name = $name;
        $this->createdAt = new \MongoDB\BSON\UTCDateTime();
    }

    public function getId(): \MongoDB\BSON\ObjectId {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCreatedAt(): \MongoDB\BSON\UTCDateTime {
        return $this->createdAt;
    }

    public function setId(\MongoDB\BSON\ObjectId $id) {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) {
        $this->name = $name;
        return $this;
    }

    public function setCreatedAt(\MongoDB\BSON\UTCDateTime $createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    function bsonSerialize(): array {
        return [
            '_id' => new \MongoDB\BSON\ObjectId($this->id),
            'name' => $this->name,
            'createdAt' => $this->createdAt,
        ];
    }

    function bsonUnserialize(array $data): void {
        $this->id = $data['_id']->__toString();
        $this->name = $data['name'];
        $this->createdAt = $data['createdAt'];
    }

}

$result = $collection->insertOne(new Person('AmendoBobo'));

$pessoa = $collection->findOne(['_id' => $result->getInsertedId()]);

var_dump($pessoa);

