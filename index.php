<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Telegram Upload Demo</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Telegram Upload Demo</h1>
<div class="gallery">
<?php
$json_file = 'uploads/data.json';
if(file_exists($json_file)){
    $data = json_decode(file_get_contents($json_file), true);
    foreach($data as $item){
        $file = "uploads/" . $item['file'];
        $caption = $item['caption'];
        if(preg_match("/\.(mp4)$/i", $file)){
            echo "<div class='item'><video controls src='$file'></video><p>$caption</p></div>";
        } else {
            echo "<div class='item'><img src='$file'><p>$caption</p></div>";
        }
    }
}
?>
</div>
</body>
</html>
