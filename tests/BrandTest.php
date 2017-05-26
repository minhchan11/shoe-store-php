<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Brand.php";
// require_once "src/Store.php";

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

      $name2 = "Photos";
      $test_brand2 = new Brand($name2);
      $test_brand2->save();
      //Act
      $expected = array($test_brand1, $test_brand2);
      $result = Brand::getAll();
      //Assert
      $this->assertEquals($expected, $result);
    }

    protected function tearDown()
    {
      Brand::deleteAll();
      // Store::deleteAll();
    }
  }
 ?>
