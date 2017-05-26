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

      $name2 = "LA";
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

      $name2 = "LA";
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


    function test_delete()
    {
      //Arrange
      $name1 = "New York";
      $test_store1 = new Store($name1);
      $test_store1->save();

      //Act
      $test_store1->delete();
      $this->assertEquals([], Store::getAll());
    }

    function test_find()
    {
      //Arrange
      $name1 = "New York";
      $test_store1 = new Store($name1);
      $test_store1->save();

      $name2 = "LA";
      $test_store2 = new Store($name2);
      $test_store2->save();

      //Act
      $id = $test_store1->getId();
      $result = Store::find($id);

      //Assert
      $this->assertEquals($test_store1, $result);
    }

    function test_addBrand()
    {
      //Arrange
      $name1 = "Gucci";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $storeName1 = "New York";
      $test_store1 = new Store($storeName1);
      $test_store1->save();

      $test_store1->addBrand($test_brand1);
      //Act
      $result = $test_store1->getBrands();
      $expected = array($test_brand1);

      //Assert
      $this->assertEquals($result, $expected);
    }

    function test_getBrands()
    {
      //Arrange
      $name1 = "Gucci";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $name2 = "Versace";
      $test_brand2 = new Brand($name2);
      $test_brand2->save();

      $storeName1 = "New York";
      $test_store1 = new Store($storeName1);
      $test_store1->save();

      $test_store1->addBrand($test_brand1);
      $test_store1->addBrand($test_brand2);
      //Act
      $result = $test_store1->getBrands();
      $expected = array($test_brand1, $test_brand2);

      //Assert
      $this->assertEquals($result, $expected);
    }

    protected function tearDown()
    {
      Brand::deleteAll();
      Store::deleteAll();
    }
  }
 ?>
