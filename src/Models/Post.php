<?php

require_once "../src/Core/Database.php";

class Post {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllPosts() {
        $query = "SELECT * FROM posts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPostById($id) {
    $query = "SELECT * FROM posts WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPost($title, $content) {
    $query = "INSERT INTO posts (title, content) VALUES (:title, :content)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":content", $content);
    return $stmt->execute();

}
public function deletePost($id) {
    $query = "DELETE FROM posts WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    return $stmt->execute();
}
public function updatePost($id, $title, $content) {
    $query = "UPDATE posts 
              SET title = :title, content = :content
              WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":content", $content);
    return $stmt->execute();
}

}