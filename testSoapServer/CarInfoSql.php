<?php
include('config.php');
class CarInfoSql{

    private $dbConnect ;

    public function __construct()
    {
        //$this->dbConnect = 'dfdsfs';
        $baseAndHostDbName = MY_SQL_DB.':host='.MY_SQL_HOST.'; dbname='. MY_SQL_DB_NAME;
        try {
            $this->dbConnect =  new PDO($baseAndHostDbName, MY_SQL_USER , MY_SQL_PASSWORD);
            $this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //var_dump($this->dbConnect);
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


    public function getCarsInfoByParams($paramsArr)
    {
        //return 'asd';
        //return $this->dbConnect;
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

    public function asd($id)
    {
        //var_dump($this->dbConnect);
        return $id;
    }

}

$c = new CarInfoSql();
$c->asd(1);
