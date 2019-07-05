<?php


namespace App\Model;

use PDO;

class CommentManager extends DbManager
{

    private $db;
    public function __construct()
    {
        $this->db=self::dbConnection();
    }

    public function getComments()
    {
        $req = $this->db->query('SELECT ch.id, ch.title, ch.content, ch.chapter_number, DATE_FORMAT(ch.creation_date, \'%d/%m/%Y\') AS creationDate,co.id AS comment_id, co.content AS comment_content, co.username, DATE_FORMAT(co.comment_date, \'%d/%m/%Y\') AS commentDate FROM chapter as ch LEFT JOIN comment as co ON ch.id = co.chapter_id WHERE ch.id = ?');
        $result = $req->fetch(PDO::FETCH_ASSOC);
        $comment = new Comment($result);
        return $comment;
    }

    public function postReported(Comment $commentId)
    {
        $req = $this->db->prepare('UPDATE comment SET reported = 1 WHERE id = ?');
        $result = $req->execute([$commentId->getId()]);
        return $result;
    }
}