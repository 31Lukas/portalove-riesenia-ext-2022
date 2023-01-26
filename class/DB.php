<?php

namespace portalove;

class DB
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $port;

    private $connection;

    public function __construct(
        $host,
        $dbname,
        $username,
        $password,
        $port = 3308
    ) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;

        try {
            $this->connection = new \PDO(
                'mysql:host=' . $host . ';dbname=' . $dbname . ';port=' . $port,
                $username,
                $password
            );
            $dbh = null;
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public function getComments() {
        $stmt = $this->connection->query('SELECT * from komentare ORDER BY id');

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createComment($nick, $text) {
        try {
            $sql = "INSERT INTO komentare(nick, text) value (:nick, :text)";

            $sth = $this->connection->prepare($sql);
            $sth->bindParam('nick', $nick, \PDO::PARAM_STR);
            $sth->bindParam('text', $text, \PDO::PARAM_LOB);

            return $sth->execute();
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return false;
        }
    }

    public function updateComment($id, $text) {
        try {
            $sql = "UPDATE komentare SET text = :text WHERE id = :id";

            $sth = $this->connection->prepare($sql);
            $sth->bindParam('text', $text, \PDO::PARAM_LOB);
            $sth->bindParam('id', $id, \PDO::PARAM_INT);

            return $sth->execute();
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return false;
        }
    }

    public function removeComment($id) {
        try {
            $sql = "DELETE FROM komentare WHERE id = :id";

            $sth = $this->connection->prepare($sql);
            $sth->bindParam('id', $id, \PDO::PARAM_INT);

            return $sth->execute();
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return false;
        }
    }

    public function getMenuItem($id)
    {
        $sql = 'SELECT * FROM menu WHERE id = ' . $id;
        try {
            $query = $this->connection->query($sql);
            $menuItem = $query->fetch(\PDO::FETCH_ASSOC);

            return $menuItem;
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return [];
        }
    }

    public function insertMenuItem($display_name, $sys_name, $path)
    {
        $currentDateTime = date('Y-m-d H:i:s', time());
        $sql =
            "INSERT INTO menu(display_name, sys_name, path, created_at, updated_at)
VALUE('" .
            $display_name .
            "','" .
            $sys_name .
            "','" .
            $path .
            "','" .
            $currentDateTime .
            "','" .
            $currentDateTime .
            "')";

        try {
            $this->connection->exec($sql);

            return true;
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return false;
        }
    }

    public function deleteMenuItem($id)
    {
        $sql = 'DELETE FROM menu WHERE id = ' . $id;
        try {
            $this->connection->exec($sql);
            return true;
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return false;
        }
    }

    public function updateMenuItem($display_name, $sys_name, $path, $id)
    {
        $currentDateTime = date('Y-m-d H:i:s', time());
        $sql =
            "UPDATE menu SET display_name = '" .
            $display_name .
            "', sys_name = '" .
            $sys_name .
            "', path = '" .
            $path .
            "', updated_at = '" .
            $currentDateTime .
            "' WHERE id = " .
            $id;

        try {
            $this->connection->exec($sql);

            return true;
        } catch (\PDOException $e) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            return false;
        }
    }
}

?>
