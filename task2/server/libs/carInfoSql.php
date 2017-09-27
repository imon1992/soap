<?php

class carInfoSql{

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
            $stmt =$this->dbConnect->prepare('SELECT c.id, m.mark, c.model
                FROM car as c
                INNER JOIN carMark as m on c.id = m.id');
            $stmt->execute();
        }

        while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $result[]=$assocRow;
        }
        return $result; 
    }

    public function getModelYearAmountColorSpeedPrice()
    {
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT c.model, y.yearOfIssue, c.model
                FROM car as c
                INNER JOIN carMark as m on c.id = m.id');
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
define("MY_SQL_DB_NAME",     "user14");
define("MY_SQL_USER",     "user14");
define("MY_SQL_PASSWORD",     "tuser14");

$c = new carInfoSql(MY_SQL_DB, MY_SQL_HOST, MY_SQL_DB_NAME, MY_SQL_USER, MY_SQL_PASSWORD);
$x = $c->getCarMarkAndModel();
var_dump($x);
