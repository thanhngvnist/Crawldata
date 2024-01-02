<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;

class cve extends Eloquent
{
    protected $connection = 'mongodb'; // specify the MongoDB connection
    
 
    protected $collection = 'cves'; // specify the MongoDB collection name

    

    
// Your model definition here
}