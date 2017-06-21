<?php
$access_token = 'YRvfUBa96Ch6eVHl1B+n8DLqIu1gwukbVIZFGQDBNhMtKBiL59CrT3K+Y9wCh7dHK83mOrK9YJXJ3PE/yEIhpKPQPCd4KdtNJglXeo0y8gB0J3XKD6DqcoNMG5EK9NAc1dYucc7B45VY7SdlX0YnDgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = '||'.$event['message']['text'];
			$str = '';
			if(strpos($text,"ดี")){
				$str = 'ดีจ้ะน้องสาว';
			}else if(strpos($text,"ไป")){
				$str = 'เสม็ดก็ดีนะ';
			}else if(strpos($text,"ชื่อ")){
				$str = 'โอ๊คสายเบิร์น';
			}else if(strpos($text,"ข้าว")){
				$str = 'ก่อนกินเจต้อง ล้างท้อง เเล้วถ้าก่อนกินน้องพี่ต้อง ล้างอะไร?';
			}else if(strpos($text,"นอน")){
				$str = 'นอนไม่หลับรับสมัครคนพาไปกินตับ';
			}else{
				$num = rand(0,5);
				$arr = array('ไม่หล่อ..แต่อร่อยมาก','ร้อยท่า5นาที', 'ถึงหน้าตาจะโซนพม่า. . . แต่ลีลาสไตล์ยุโรป','สุขใจ…เมื่อไกลเมีย….','ถึงเจ้าชู้ แต่ก็รู้ว่าใครสําคัญ','ไปกับพี่ไหมน้อง');
				$str = $arr[$num];
			}
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $str
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
