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




      }
?>
