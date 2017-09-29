<?php
include('../config.php');

class CarInfoSql
{

    private $dbConnect;

    public function __construct()
    {
        $baseAndHostDbName = MY_SQL_DB . ':host=' . MY_SQL_HOST . '; dbname=' . MY_SQL_DB_NAME;
        try {
            $this->dbConnect = new PDO($baseAndHostDbName, MY_SQL_USER, MY_SQL_PASSWORD);
            $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->dbConect = 'connect error';
        }
    }

    private function generateSortSql($paramArr)
    {
        $select = 'SELECT mark,model,id ';
        $where = 'WHERE ';
        $arrLength = count($paramArr);
        $i = 1;
        foreach ($paramArr as $paramName => $paramValue) {

            if ($arrLength != $i) {
                $where .= $paramName . '=:' . $paramName . ' AND ';
            } else {
                $where .= $paramName . '=:' . $paramName;
            }
            $i++;
        }

        $sql = $select . ' FROM cars ' . $where;

        return $sql;
    }

    public function getCarMarkAndModel()
    {
//        return 'sdasa';
        $result = [];
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('SELECT id, mark, model
                FROM cars');
            $stmt->execute();
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result[]=$assocRow;
            }
        }else
        {
            return 'error';
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
            while($assocRow = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $result[]=$assocRow;
            }
        }else
        {
            return 'error';
        }

        return $result;
    }

    public function getCarsInfoByParams($paramsArr)
    {

        $sql = $this->generateSortSql($paramsArr);

        $result = [];

        if ($this->dbConnect !== 'connect error') {
            $stmt = $this->dbConnect->prepare($sql);
            foreach ($paramsArr as $paramName => &$paramValue) {
                $stmt->bindParam($paramName, $paramValue);
            }
            $stmt->execute();

            while ($assocRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $assocRow;
            }

        }else
        {
            return 'error';
        }

        return $result;
    }

    public function addOrder($orderParams)
    {
        if($this->dbConnect !== 'connect error')
        {
            $stmt =$this->dbConnect->prepare('INSERT INTO orders(id_car,firstName,surname,paymentMethod)
                                              VALUES(:carId,:firstName,:surname,:paymentMethod)');
            $stmt->bindParam(':carId',$orderParams['carId']);
            $stmt->bindParam(':firstName',$orderParams['firstName']);
            $stmt->bindParam(':surname',$orderParams['surname']);
            $stmt->bindParam(':paymentMethod',$orderParams['paymentMethod']);
//            var_dump($stmt);
            $result = $stmt->execute();
//            var_dump($result);
        }else
        {
            return 'error';
        }

        return $result;
    }

}

//$c = new CarInfoSql();
//////$v = json_decode('{
//////	"mark": "BMW",
//////	"color": "red",
//////	"model": "x5"
//////}');
//$x = $c->addOrder(['carId'=>1,'firstName'=>'Andrew','surname'=>'Kolotii','paymentMethod'=>'credit card']);
//////$x = $c->getCarsInfoByParams(['mark'=>'BMW','color'=>'red']);
//////$x = $c->getModelYearAmountColorSpeedPrice(2);
//////foreach
//var_dump($x);
