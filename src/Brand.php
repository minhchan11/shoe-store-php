<?php
    class Brand
    {
      //property
      private $Name;
      private $id;

      //constructor
      function __construct($Name, $id = null)
      {
        $this->Name = $Name;
        $this->id = $id;
      }

      function getName()
      {
        return $this->Name;
      }

      function setName($new_Name)
      {
        $this->Name = (string) $new_Name;
      }

      function getId()
      {
        return $this->id;
      }

      static function getAll()
      {
        $db_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
        $brands=array();
        foreach ($db_brands as $brand) {
          $new_name=$brand['name'];
          $id=$brand['id'];
          $new_brand= new Brand($new_Name,$id);
          array_push($brands,$new_brand);
        }
        return $brands;
      }

      static function deleteAll()
      {
        $executed = $GLOBALS['DB']->query("DELETE FROM brands;");
      }
        if ($executed){
          return true;
        } else {
          return false;
        }

      }
?>
