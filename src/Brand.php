<?php
    class Brand
    {
      //property
      private $name;
      private $id;

      //constructor
      function __construct($name, $id = null)
      {
        $this->name = $name;
        $this->id = $id;
      }

      function getName()
      {
        return $this->name;
      }

      function setName($new_name)
      {
        $this->name = (string) $new_Name;
      }

      function getId()
      {
        return $this->id;
      }

      function save()
      {
        $executed = $GLOBALS['DB'] -> exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
        if ($executed){
          $this->id = $GLOBALS['DB']->lastInsertId();
          return true;
        } else {
          return false;
        }
      }

      function addStore($store)
      {
        $executed = $GLOBALS['DB']->query("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()},{$store->getId()});");
        if ($executed) {
            return true;
          } else {
            return false;
          }
      }

      function getStores()
      {
        $return_stores= $GLOBALS['DB']->query("SELECT stores.* FROM stores
          JOIN brands_stores ON (brands_stores.store_id = stores.id)
          JOIN brands ON (brands_stores.brand_id = brands.id)
          WHERE brand_id ={$this->getId()};");
        $stores = array();
        foreach($return_stores as $store){
          $name = $store['name'];
          $id = $store['id'];
          $new_store = new Store($name, $id);
          array_push($stores, $new_store);
        }
        return $stores;
      }


      static function getAll()
      {
        $db_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $brands=array();
        foreach ($db_brands as $brand) {
          $new_name=$brand['name'];
          $id=$brand['id'];
          $new_brand= new Brand($new_name,$id);
          array_push($brands,$new_brand);
        }
        return $brands;
      }

      static function deleteAll()
      {
        $executed = $GLOBALS['DB']->query("DELETE FROM brands;");
        if ($executed){
          return true;
        } else {
          return false;
        }
      }

      static function find($search_id)
      {
        $found_brand = $GLOBALS['DB']->prepare("SELECT * FROM brands WHERE id = :id");
        $found_brand->bindParam(':id', $search_id, PDO::PARAM_STR);
        $found_brand->execute();
        foreach ($found_brand as $brand) {
          $new_brandName = $brand['name'];
          $new_id = $brand['id'];
          if ($new_id == $search_id)
          {
            $found_brand = new Brand($new_brandName,$new_id);
          }
          return $found_brand;
        }
      }

      }
?>
