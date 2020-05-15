<?php 
   // Check if the form was submitted
   $ok = false;
   $response;
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $target_file;
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 32 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("uploadimages/" . $filename)){
                echo $filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "uploadimages/" . $filename);
                echo "Your file was uploaded successfully.";
                $ok = true;
                
            } 
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "Error: " . $_FILES["photo"]["error"];
    }
    if($ok){
        $key = 'a0a52413a54db42adba1af3f75912e14';
        $data = array(
            'key' => $key,
            'image' => base64_encode(file_get_contents("uploadimages/".$_FILES["photo"]["name"]))
        );
        # Create a connection
        $url = 'https://api.imgbb.com/1/upload';
        $ch = curl_init($url);
        # Form data string
        $postString = http_build_query($data, '', '&');
        # Setting our options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Get the response
        $response = curl_exec($ch);
        $response = json_decode($response, true);
        curl_close($ch);
        unlink("uploadimages/".$_FILES["photo"]["name"]);
    }
}


?>
<?php require 'templates/top.php' ?>
<form  method="post" enctype="multipart/form-data">
    <h2>Upload File</h2>
    <label for="fileSelect">Filename:</label>
    <input type="file" name="photo" id="fileSelect">
    <input type="submit" name="submit" value="Upload">
    <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 32 MB.</p>
</form>
<div>
    <?php if($ok){
        echo("<img src='".$response["data"]["url"]."'><br>");
    }
    ?>
</div>
