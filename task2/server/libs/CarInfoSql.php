<?php

class CarInfoSql{

    private $dbConnect;

    public function __construct()
    {
        $baseAndHostDbName = MY_SQL_DB.':host='.MY_SQL_HOST.'; dbname='.MY_SQL_DB_NAME;
        try {
            $this->dbConnect =  new PDO($baseAndHostDbName, MY_SQL_USER , MY_SQL_PASSWORD);
            $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->dbConect =  'connect error';
        }
    }

    private function generateSortSql($paramArr)
    {
        $select = 'SELECT mark,model ';
        $where = 'WHERE ';
        //var_dump($paramArr);
        $arrLength = count($paramArr);
        $i = 1;
        foreach($paramArr as $paramName=>$paramValue)
        {
            if($arrLength != $i)
            {
                //    $select .= $paramName . ',';
                $where .= $paramName . '=:' . $paramName . ' AND ';
            }else
            {
                //  $select .= $paramName;
                $where .= $paramName . '=:' . $paramName;
            }
            $i++;
        }
        $sql = $select . ' FROM cars ' . $where;
        // var_dump($sql);
        //var_dump($select);
        //var_dump($where);
        return $sql;
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

    public function getCarsInfoByparams($paramsArr)
    {
        $sql = $this->generateSortSql($paramsArr);

        $result = [];

        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare($sql);
            $arrLength = count($paramsArr);
            foreach($paramsArr as $paramName=>&$paramValue)
            {
                $stmt->bindParam($paramName,$paramValue);
            }
           // var_dump($stmt);


            $stmt->execute();

            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result[]=$assocRow;
            }
           // var_dump($result);
            return $result;
        }
    }

    public function asd($id){
        return $id;
    }

}
//define("MY_SQL_DB",     "mysql");
//define("MY_SQL_HOST",     "localhost");
//define("MY_SQL_DB_NAME",     "user14");
//define("MY_SQL_USER",     "user14");
//define("MY_SQL_PASSWORD",     "tuser14");

//$c = new carInfoSql();
//$x = $c->getModelYearAmountColorSpeedPrice(1);


//$x = $c->getCarsInfoByparams(['mark'=>'BMW','color'=>'red']);

//var_dump($x);
