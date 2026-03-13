<?php

require_once "../src/Models/Post.php";

class PostController{ 
    public function index(){
        $postModel = new Post();
        $posts = $postModel ->getAllPosts();
        http_response_code(200);
        echo json_encode([
            "post" => $posts
        ]);
    }

    public function show($id) {
    $postModel = new Post();
    $post = $postModel->getPostById($id);
    if (!$post) {
        http_response_code(404);
        echo json_encode([
            "error" => "Post not found"
        ]);
        return;
    }
    http_response_code(200);
    echo json_encode($post);
    }

    public function store() {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data["title"]) || !isset($data["content"])) {
        http_response_code(400);
        echo json_encode([
            "error" => "Missing data"
        ]);
        return;
    }
    $postModel = new Post();
        $postModel->createPost(
            $data["title"],
            $data["content"]
        );
        http_response_code(201);
        echo json_encode([
            "message" => "Post created"
        ]);
    }
    public function delete($id) {
    $postModel = new Post();
    $postModel->deletePost($id);
    http_response_code(200);
    echo json_encode([
        "message" => "Post deleted"
    ]);
    }
    public function update($id) {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data["title"]) || !isset($data["content"])) {
        http_response_code(400);
        echo json_encode([
            "error" => "Missing data"
        ]);
        return;
    }

    $postModel = new Post();
    $postModel->updatePost(
        $id,
        $data["title"],
        $data["content"]
    );
    http_response_code(200);
    echo json_encode([
        "message" => "Post updated"
    ]);
    }

}
