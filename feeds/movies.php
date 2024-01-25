<?php

include '../app/config/db.config.php'; // Database configuration 

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql = "SELECT * FROM posts WHERE type LIKE 'm%' ORDER BY created DESC LIMIT 15";
$private = "2";
if ($result = mysqli_query($link, $sql))
{
    if (mysqli_num_rows($result) > 0)
    {
        echo header("Content-type: text/xml");
        echo "<?xml version='1.0' encoding='UTF-8'?>";
        echo "<rss version='2.0'>";
        echo "<channel>";
        echo "<title>Most Recent Movies RSS Feed</title>";
        echo "<link>https://" . $_SERVER['SERVER_NAME'] . "</link>";
        echo "<language>en</language>";
        while ($row = mysqli_fetch_array($result))
        {
			
			if ($row['private'] == $private) 
			{
			if(preg_match('/&/',$row['title'])){
            }
	else {
		if(preg_match('/movie/',$row['type'])){
            echo "<item>";
            echo "<title>" . $row['title'] . "</title>";
            echo "<link>https://" . $_SERVER['SERVER_NAME'] . "/" . $row['type'] . "/" . $row['self'] . "-" . $row['id'] . "</link>";
            echo "<description>Watch " . $row['title'] . " for free at Watch A Movie, a new place to watch Movies and TV Shows for free! #123movies #putlocker #watchonlinefree</description>";
            echo "<enclosure url='https://" . $_SERVER['SERVER_NAME'] . "/public/upload/cover/" . $row['image'] . "' length='174093' type='image/webp'/>";
            echo "<pubDate>" . $row['created'] . "</pubDate>";
            echo "</item>";
        }
        }
            }
        }
        echo "</channel>";
        echo "</rss>";
        mysqli_free_result($result);
    }
    else
    {
        echo "<?php echo __('No records matching your query were found');?>";
    }
}
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
