	<?php
require('./config.php');
 
$apiKey = getenv('5f09c92a528e4a708ae78ee207b60ecf');
// echo($apiKey);
$categories = ['technology', 'sports', 'science', 'business', 'entertainment'];
foreach ($categories as $category) {
    $endpoint = "https://newsapi.org/v2/top-headlines?category=$category&pageSize=100&country=usfr&apiKey=$apiKey";
 
    $response = file_get_contents($endpoint);
    //var_dump($endpoint);
    $response = json_decode($response);
    //var_dump($response);
 
    foreach ($response-> articles as $article) {
        $q = $db->prepare('INSERT INTO articles (title, author, content, description, imageUrl, publishedAt) VALUES (:title, :author, :content, :description, :imageUrl, :publishedAt)');
        $q->bindValue('title', $article->title);
        $q->bindValue('author', $article->author);
        $q->bindValue('content', $article->content);
        $q->bindValue('description', $article->description);
        $q->bindValue('imageUrl', $article->urlToImage);
        $q->bindValue('publishedAt', date("Y-m-d H:i:s", strtotime($article->publishedAt)));
        $q->execute();
    }
}