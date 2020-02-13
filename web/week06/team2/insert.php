<?php
// retrieve POST data from the other page
$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse'];
$content = $_POST['content'];
$topics = $_POST['topics'];

require("dbConnect.php");
$db = get_db();

try {
	// insert into database
	$query = 'INSERT INTO Scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)';
	$statement = $db->prepare($query);
	$statement->bindValue(':book', $book);
	$statement->bindValue(':chapter', $chapter);
	$statement->bindValue(':verse', $verse);
	$statement->bindValue(':content', $content);
	$statement->execute();

	$scriptureId = $db->lastInsertId("scriptures_id_seq");

	foreach ($topics as $topic) {
		$query = 'INSERT INTO scripture_topic (scripture_id, topic_id) VALUES (:scriptureId, :topicId);';
		$statement = $db->prepare($query);
		$statement->bindValue(':scriptureId', $scriptureId);
		$statement->bindValue(':topicId', $topic);
		$statement->execute();
	}

	$topicId = $db->lastInsertId("scripture_topic_id_seq");
} catch (Exception $ex) {
	echo "Error with DB. Details: $ex";
	die();
}
header("Location: display.php/?personId=$userId");

die();
