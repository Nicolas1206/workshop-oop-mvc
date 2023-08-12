<?php
namespace models;

use PDO;
use PDOStatement;

class Database{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=" . getenv('DB_HOST') . ";dbname=" . getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function exec(string $sql, array $param = []): bool
    {
        // prépare la requête
        $stmt = $this->pdo->prepare($sql);

        // bind paramètres
        // bouclé sur le tableau de paramètres
        // $key => clé
        // $value => valeur des clés
        foreach ($param as $key => $value) {
            // check si type de notre value
            /*          
= int
= bool
= autre*/
      if (gettype($value) == "integer") 
      {
        $stmt->bindParam($key, $value, PDO::PARAM_INT);
    } else if (gettype($value) == "boolean") {$stmt->bindParam($key, $value, PDO::PARAM_BOOL);
    } else {$stmt->bindValue($key, $value);}}
  return $stmt->execute();
}
    /**
     * @param string $sql 
     * @param array $param
     * 
     * @return PDOStatement
     */
    public function query(string $sql, array $param = []): PDOStatement
    {
        // prépare la requête
        $stmt = $this->pdo->prepare($sql);



        //bind les paramètres
        // bouclé sur le tableau parametre
        // $key => clé
        // $value => valeur des clés
        foreach($param as $key => $value){
            if (gettype($value) == 'integer'){
            $stmt->bindParam($key, $value, PDO::PARAM_INT);
            }else if (gettype($value) == "boolean"){
                $stmt->bindParam($key, $value, PDO::PARAM_BOOL);
            }else {
                $stmt->bindValue($key, $value);
            }
        }
         $stmt->execute();
         return $stmt;
    }
    /**
     * @return string
     */
    public function lastInsertId(): string|int
    {
        return $this->pdo->lastInsertId();
    }
}