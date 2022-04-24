<?php
    include_once('functions.php');
    function db_connect() {
            $host = 'localhost';
            $db   = 'library';
            $user = 'root';
            $pass = '';
            $charset = 'utf8';
        
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, $user, $pass, $opt);
            return $pdo;
    }

    function selectAuthor (int $idBook) {
        $pdo = db_connect();
        $nameAuthors = '';
        $author = $pdo->prepare('SELECT a.name FROM relbookauthor as r left Join authors a on r.IdAuthor = a.IdAuthor WHERE r.idBook = ?');
        $author->execute([$idBook]);
        foreach ($author as $rowAuthor)
        {
            $nameAuthors = $nameAuthors . ' ' . $rowAuthor['name'];
        }
        return $nameAuthors;
    }

    function selectBookAll () {
        $pdo = db_connect();
        $query = $pdo->prepare('SELECT idbook, name, pages, year FROM books As b');
        $query->execute();
        $listBook = $query->fetchAll();
        return $listBook;
    }

    function selectBook (array $arr) {
        $pdo = db_connect();
        $query = $pdo->prepare('SELECT idbook, name, pages, year FROM books As b' . $arr[0]);
        $query->execute($arr[1]);
        $listBook = $query->fetchAll();
        return $listBook;
    }

    function selectBookAuthor (array $arr) {
        $pdo = db_connect();
        $query = $pdo->prepare('SELECT b.idbook, b.name, b.pages, b.year FROM books As b Inner Join relbookauthor As r On b.IdBook = r.IdBook Inner Join AUTHORS As a On r.IdAuthor = a.IdAuthor ' . $arr[0]);
        $query->execute($arr[1]);
        $listBook = $query->fetchAll();
        return $listBook;
    }

    function authenticateByToken($token) {
        $pdo = db_connect();
        $result = $pdo->prepare('select idUser, name from users where token = ?');
        $result->execute([$token]);
        if($result->rowCount() == 0)
            return false;
        return $result->fetchAll()[0];
    }
    
    function setToken($idUser, $token) {
        $pdo = db_connect();
        $result = $pdo->prepare('update users set token = ? where idUser = ?');
        $result->execute([$token, $idUser]);
    }
    

    function getUserByName(string $name) {
        $pdo = db_connect();
        $query = $pdo->prepare('select idUser from users where name = ?');
        $query->execute([$name]);
        if($query->rowCount() == 0)
            return false;
        return $query->fetchAll()[0];
    }

    function addUser($name, $password, $token) {
        $pdo = db_connect();
        $query = $pdo->prepare('insert into users (name, password, token) values (?,?,?)');
        $query->execute([$name, $password, $token]);
        if($query->rowCount() == 0)
            return false;
        return true;
    }

    
    function authenticate($name, $password) {
        $pdo = db_connect();
        $query = $pdo->prepare('select idUser from users where name = ? and password = ?');
        $query->execute([$name, md5($password)]);
        if($query->rowCount() == 0) {
            return 0;
        }
        return $query->fetchAll()[0]['idUser'];
    }
    
    function addPhoto($idUser, $nameFiles)
    {
        $pdo = db_connect();
        $query = $pdo->prepare('insert into photos(idUser, nameFiles, date) values (?,?,?)');
        $query->execute([$idUser, $nameFiles, date('Y-m-d H:i:s')]);
    }        

?>
