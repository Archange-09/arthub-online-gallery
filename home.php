<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>

    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Home</a></p>
        </div>
        <div class="logo">
            <p><a href="view.php">Art Gallery</a></p>
        </div>
        <div class="right-links"> 
            <a href="php/logout.php"><button class="btns"><b>Log Out</b></button></a>
        </div>
    </div>
    
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class='layoutz'>
            <div class='box form-box'>
                <header>Showcase your Art!</header>
                <label for="artist_name">Artist's name:</label>
                <input type="text" id="artist_name" name="artist_name"  class='inputfield' placeholder="Enter artist's name" autocomplete="off" value="" required><br>
                <label for="art_name">Art piece:</label>
                <input type="text" id="art_name" name="art_name" class='inputfield' placeholder="Name of art piece:" autocomplete="off" value="" required><br>
                <label for="contact_info">Contact information:</label>
                <input type="text" id="contact_info" name="contact_info" class='inputfield' placeholder="Enter contact information" autocomplete="off" value="" required><br>
                <label for="image">Upload image:</label>
                <input type="file" id="image" name="image" class='image' accept=".jpg, .jpeg, .png" value=""><br>
                <label for="description">Describe your art piece:</br>
                <textarea id="description" name="description" autocomplete="off" rows="5" cols="60" class='textareasize'></textarea>

                <input type='submit' name='submit' value='Submit' class='btn'>
                <input type='submit' name='clear'value='Clear' class='btn'>
            </div>
        </div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $artist_name = $_POST['artist_name'];
        $art_name = $_POST['art_name'];
        $contact_info = $_POST['contact_info'];
        $description = $_POST['description'];

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if ($error === 0){
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
           $img_ex_lc = strtolower($img_ex);

           $allowed_exs = array("jpg", "jpeg", "png");

           if (in_array($img_ex_lc, $allowed_exs)){
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

         
        
        if(empty($artist_name) || empty($art_name) || empty($contact_info)){
            echo "Please fill in all required fields.";
        } else {

            $query_artist_data = mysqli_query($con, "INSERT INTO artworks (artist_name,art_name,contact_info,image,description) VALUES ('$artist_name','$art_name','$contact_info','$new_img_name','$description')");

            if($query_artist_data){
                echo "Data saved into Database";
            }
            else{
                echo "Failed to save data";
            }
        } 
    }

}else{
    echo "error!";
}
    } 
        
?>

<?php
    if(isset($_POST['clear']))
    {
        $item_id = -1;

        $reset_query = mysqli_query($con, "DELETE FROM artworks WHERE item_id = '$item_id'");

        if($reset_query){
            echo "Cleared";
        }
        else{
            echo "Failed to clear";
        }
    }
?>