<?php
    class Store
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

      function setName($new_Name)
      {
        $this->name = (string) $new_Name;
      }

      function getId()
      {
        return $this->id;
      }

      function save()
      {
        $executed = $GLOBALS['DB'] -> exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
        if ($executed){
          $this->id = $GLOBALS['DB']->lastInsertId();
          return true;
        } else {
          return false;
        }
      }

      function update($new_name)
      {
        $executed = $GLOBALS['DB'] -> exec("UPDATE stores SET name='{$new_name}' WHERE id = {$this->getId()};");
        if ($executed) {
          $this->setName($new_name);
          return true;
        } else {
          return false;
        }
      }

      function delete()
      {
        $executed = $GLOBALS['DB'] -> exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};DELETE FROM stores WHERE id = {$this->getId()};");
        if ($executed)
        {
          return true;
        } else {
          return false;
        }
      }

      function addBrand($brand)
      {
        $executed = $GLOBALS['DB']->query("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()},{$this->getId()});");
        if ($executed) {
            return true;
          } else {
            return false;
          }
      }

      function getBrands()
      {
        $return_brands= $GLOBALS['DB']->query("SELECT brands.* FROM brands
          JOIN brands_stores ON (brands_stores.brand_id = brands.id)
          JOIN stores ON (brands_stores.store_id = stores.id)
          WHERE store_id ={$this->getId()};");
        $brands = array();
        foreach($return_brands as $brand){
          $name = $brand['name'];
          $id = $brand['id'];
          $new_brand = new Brand($name, $id);
          array_push($brands, $new_brand);
        }
        return $brands;
      }

      static function getAll()
      {
        $db_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
        $stores=array();
        foreach ($db_stores as $store) {
          $new_name=$store['name'];
          $id=$store['id'];
          $new_store= new Store($new_name,$id);
          array_push($stores,$new_store);
        }
        return $stores;
      }

      static function deleteAll()
      {
        $executed = $GLOBALS['DB']->query("DELETE FROM stores;");
        if ($executed){
          return true;
        } else {
          return false;
        }
      }

      static function find($search_id)
      {
        $found_store = $GLOBALS['DB']->prepare("SELECT * FROM stores WHERE id = :id");
        $found_store->bindParam(':id', $search_id, PDO::PARAM_STR);
        $found_store->execute();
        foreach ($found_store as $store) {
          $new_storeName = $store['name'];
          $new_id = $store['id'];
          if ($new_id == $search_id)
          {
            $found_store = new Store($new_storeName,$new_id);
          }
          return $found_store;
        }
      }

      }
?>
