<?php

require_once "../src/Controllers/PostController.php";

class Router {

    public function handleRequest() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // enlever /API/public de l'URL
        $uri = str_replace('/API/public', '', $uri);
         $method = $_SERVER['REQUEST_METHOD'];
        $controller = new PostController();

        if ($uri === '/posts' && $method === 'GET') {
            $controller->index();
            return;
        }
        if ($uri === '/post' && $method === 'GET') {
            $controller->show($_GET['id']);
            return;
        }
        if ($uri === '/posts' && $method === 'POST') {
         $controller->store();
         return;
        }
        if ($uri === '/post' && $method === 'DELETE') {
         $controller->delete($_GET['id']);
          return;
        }
        if ($uri === '/post' && $method === 'PUT') {
         $controller->update($_GET['id']);
         return;
        }
        http_response_code(404);
        echo json_encode([
            "error" => "Route not found"
        ]);
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