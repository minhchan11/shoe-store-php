<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Brand.php";
require_once "src/Store.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server,$username,$password);

//Same name as file
  class BrandTest extends PHPUnit_Framework_TestCase
  {

    function test_getAll()
    {
      //Arrange
      $name1 = "Versace";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $name2 = "Gucci";
      $test_brand2 = new Brand($name2);
      $test_brand2->save();
      //Act
      $expected = array($test_brand1, $test_brand2);
      $result = Brand::getAll();
      //Assert
      $this->assertEquals($expected, $result);
    }

    function test_deleteAll()
    {
      //Arrange
      $name1 = "Versace";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $name2 = "Photos";
      $test_brand2 = new Brand($name2);
      $test_brand2->save();
      Brand::deleteAll();
      //Act
      $expected = array();
      $result = Brand::getAll();
      //Assert
      $this->assertEquals($expected, $result);
    }

    function test_getId()
    {
      //Arrange
      $name1 = "Versace";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      //Act
      $all_brands = Brand::getAll();
      $expected = $test_brand1->getId();
      $result = $all_brands[0]->getId();

      //Assert
      $this->assertEquals($expected, $result);
    }

    function test_find()
    {
      //Arrange
      $name1 = "Versace";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $name2 = "Gucci";
      $test_brand2 = new Brand($name2);
      $test_brand2->save();

      //Act
      $id = $test_brand1->getId();
      $result = Brand::find($id);

      //Assert
      $this->assertEquals($test_brand1, $result);
    }

    function test_addStore()
    {
      //Arrange
      $name1 = "Gucci";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $storeName1 = "New York";
      $test_store1 = new Store($storeName1);
      $test_store1->save();

      $test_brand1->addStore($test_store1);
      //Act
      $result = $test_brand1->getStores();
      $expected = array($test_store1);

      //Assert
      $this->assertEquals($result, $expected);
    }

    function test_getStores()
    {
      //Arrange
      $name1 = "Gucci";
      $test_brand1 = new Brand($name1);
      $test_brand1->save();

      $storeName1 = "New York";
      $test_store1 = new Store($storeName1);
      $test_store1->save();

      $name2 = "LA";
      $test_store2 = new Store($name2);
      $test_store2->save();

      $test_brand1->addStore($test_store1);
      $test_brand1->addStore($test_store2);
      //Act
      $result = $test_brand1->getStores();
      $expected = array($test_store1, $test_store2);

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
