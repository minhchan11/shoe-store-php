<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Store.php";
require_once "src/Brand.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server,$username,$password);

//Same name as file
  class StoreTest extends PHPUnit_Framework_TestCase
  {

    function test_getAll()
    {
      //Arrange
      $name1 = "New York";
      $test_store1 = new Store($name1);
      $test_store1->save();

      $name2 = "Photos";
      $test_store2 = new Store($name2);
      $test_store2->save();
      //Act
      $expected = array($test_store1, $test_store2);
      $result = Store::getAll();
      //Assert
      $this->assertEquals($expected, $result);
    }

    function test_deleteAll()
    {
      //Arrange
      $name1 = "New York";
      $test_store1 = new Store($name1);
      $test_store1->save();

      $name2 = "Photos";
      $test_store2 = new Store($name2);
      $test_store2->save();
      Store::deleteAll();
      //Act
      $expected = array();
      $result = Store::getAll();
      //Assert
      $this->assertEquals($expected, $result);
    }

    function test_getId()
    {
      //Arrange
      $name1 = "New York";
      $test_store1 = new Store($name1);
      $test_store1->save();

      //Act
      $all_stores = Store::getAll();
      $expected = $test_store1->getId();
      $result = $all_stores[0]->getId();

      //Assert
      $this->assertEquals($expected, $result);
    }

    function test_update()
    {
      //Arrange
      $name1 = "New York";
      $test_store1 = new Store($name1);
      $test_store1->save();
      $new_name = "LA";

      //Act
      $test_store1->update($new_name);
      $expected = $test_store1->getName();
      $result = $new_name;

      //Assert
      $this->assertEquals($expected, $result);
    }

    protected function tearDown()
    {
      Brand::deleteAll();
      Store::deleteAll();
    }
  }
 ?>
