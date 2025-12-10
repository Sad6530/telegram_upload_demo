<?php
if(isset($_FILES['file'])){
    $filename = $_POST['filename'] ?? $_FILES['file']['name'];
    $target = "uploads/" . basename($filename);

    if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
        $caption = $_POST['caption'] ?? '';
        
        // ক্যাপশন JSON ফাইলে সংরক্ষণ (বা DB ব্যবহার করা যাবে)
        $data = ['file' => $filename, 'caption' => $caption];
        $json_file = 'uploads/data.json';
        $all_data = [];

        if(file_exists($json_file)){
            $all_data = json_decode(file_get_contents($json_file), true);
        }

        $all_data[] = $data;
        file_put_contents($json_file, json_encode($all_data, JSON_PRETTY_PRINT));

        echo "File uploaded successfully!";
    } else {
        echo "Upload failed!";
    }
}
?>
