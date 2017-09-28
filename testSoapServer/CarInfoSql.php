<?php

class CarInfoSql{

    private $dbConnect;

    public function __construct($baseToConnect,$hostToConnect,$dbName,$user,$password)
    {
        $baseAndHostDbName = $baseToConnect.':host='.$hostToConnect.'; dbname='.$dbName;
        try {
            $this->dbConnect =  new PDO($baseAndHostDbName, $user , $password);
            $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->dbConect =  'connect error';
        }
    }

    public function getCarMarkAndModel()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT id, mark, model
                FROM cars');
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result; 
    }

    public function getModelYearAmountColorSpeedPrice($id)
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT model, year, engine, color, maxSpeed, price
                FROM cars
                WHERE id = :id');
            $stmt->bindParam(':id',$id);
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result;
    }

    public function getColors()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT color
                FROM carColor');
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result;
    }

    public function getYearsOfIssue()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT yearOfIssue
                FROM carYearOfIssue');
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result;
    }

    public function getMarks()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT mark
                FROM carMark');
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result;
    }

    public function getEngineCapacity()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT engineCapacity
                FROM carEngineCapacity');
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result;
    }

    public function getModel($mark)
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT mo.model
                FROM car as c
                JOIN carModel as mo on c.model = mo.id
                JOIN carMark as ma on c.mark = ma.id
                WHERE ma.mark = :mark'
            );
            $stmt->bindParam(':mark',$mark);
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result;
    }

}
define("MY_SQL_DB",     "mysql");
define("MY_SQL_HOST",     "localhost");
define("MY_SQL_DB_NAME",     "carTest5");
define("MY_SQL_USER",     "user14");
define("MY_SQL_PASSWORD",     "tuser14");

$c = new carInfoSql(MY_SQL_DB, MY_SQL_HOST, MY_SQL_DB_NAME, MY_SQL_USER, MY_SQL_PASSWORD);
$x = $c->getModelYearAmountColorSpeedPrice(1);
//var_dump($x);
