<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use GraphAware\Neo4j\Client\ClientBuilder;

class BaseModel extends Model
{
    protected $id;
    protected $uuid;

    protected $client;


    public function __construct()
    {
        parent::__construct();
        $client = ClientBuilder::create()
            ->addConnection('default', 'http://'.env('GDB_CONNECTION').':'.env('GDB_PASSWORD').'@'.env('GDB_HOST').':'.env('GDB_PORT')) // Example for HTTP connection configuration (port is optional)
            ->build();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNewUuid(){
        $this->uuid = str_replace(".", "f", uniqid('', true));
    }


    /**
     * Gets the value of uuid.
     *
     * @return mixed
     */
    public function getUuid(){
        return $this->uuid;
    }

    /**
     * Sets the value of uuid.
     *
     * @param mixed $uuid the uuid
     *
     * @return self
     */
    public function setUuid($uuid){
        $this->uuid = $uuid;
        return $this;
    }
}