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
}

?>
