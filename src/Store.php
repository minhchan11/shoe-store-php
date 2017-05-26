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

      }
?>
