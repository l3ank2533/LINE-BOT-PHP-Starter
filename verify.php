<?php
$access_token = 'YRvfUBa96Ch6eVHl1B+n8DLqIu1gwukbVIZFGQDBNhMtKBiL59CrT3K+Y9wCh7dHK83mOrK9YJXJ3PE/yEIhpKPQPCd4KdtNJglXeo0y8gB0J3XKD6DqcoNMG5EK9NAc1dYucc7B45VY7SdlX0YnDgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
