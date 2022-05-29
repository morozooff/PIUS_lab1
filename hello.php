<?php
echo "<h1>Exercise TEST (out string)</h1>";
echo "Hello from PHP";

include './vendor/autoload.php';
include './User.php';
include './Comment.php';

echo "<h1>Exercise 2.1 (User class)</h1>";

echo "Invalid exapmple user:<br>";
$user = new User(-999, "yarik", "abrakadabra", "pip");
echo $user->getName() , " doesn't created account, try again <br>";

echo "<br>Valid exapmple user:<br>";
$user = new User(999, "Yaroslav", "morozoff@gmail.com", "piP12&8#");
echo $user->getName() , " created account at " , $user->getTimeOfCreate() , "<br>";


echo "<h1>Exercise 2.2 (Comment class)</h1>";
$comments = [];
for ($i = 0; $i < 10; $i += 1)
{
    $comments[$i] = new Comment($user, "hahaha hello, my name is Yarik and i have $i apples");
}


$Date = "12/12/2012 12:12:12 AM";

$datetime = DateTime::createFromFormat("m/d/Y h:i:s A", $Date)->getTimestamp();

foreach($comments as $comment)
{
    if (strtotime($comment->getUser()->getTimeOfCreate()) >= $datetime)
    {
        $text = $comment->getText();
        echo "$text<br>";
    }
}