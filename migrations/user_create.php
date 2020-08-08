<?php

try{
    $table_name = 'user';
    $paramsPath = '../components/Db.php';
    $params = include ($paramsPath);
    $db = Db::getConnection(true);
    if($db)
    {

        $result = $db->query("SELECT 1 FROM ".$table_name." LIMIT 1");
        if($result)
        {
            echo "table ".$table_name." already exist";
            die;
        }
    }
}
catch(PDOException $ex){

    if($ex->getCode() == '42S02')
    {
        $result = $db->query("CREATE TABLE `".$table_name."` (
          `id` int NOT NULL,
          `login` varchar(100) NOT NULL,
          `password` varchar(100) NOT NULL
        );
        ALTER TABLE `".$table_name."`
          ADD UNIQUE KEY `id` (`id`);
        ALTER TABLE `".$table_name."`
          MODIFY `id` int NOT NULL AUTO_INCREMENT;
        COMMIT;
        ");
        echo "Table ".$table_name." created";
    }
    else echo "Error ". $ex->getMessage();
}