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

      }
?>
