<?php
namespace loray\projet_3;

class DaoManager
{
    protected $dao;
   
    public function __construct()
    {
      $this->dao = $this->dbConnect();
    }

    protected function dbConnect()
    {
        $dao = new \PDO('mysql:host=localhost;dbname=projet_3;charset=utf8', 'root', '');
        return $dao;
    }

}