<?php
    include("php/config.php");
    // Fetch data from the database
    $query = "SELECT * FROM artworks";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/style.css">
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
    <!-- Navigation and other HTML elements -->
    <div class="contain">
        <?php
            // Display the fetched data
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='artwork'>";
                echo "<h2>Art piece: " . $row['art_name'] . "</h2>";
                echo "</div>";
              
                echo "<div class='artwork'>";
                echo "<h4>Artist: " . $row['artist_name'] . "</h4>";
                echo "</div>";
                
                // Display other information and image as needed
                echo "<div class='artwork'>";
                echo "<img src='uploads/" . $row['image'] . "' alt='Artwork Image' width=25% height=25%>";
                echo "</div>";
                echo "<div class='artwork'>";
                echo "<h4>Description: " . $row['description'] . "</h4>";
                echo "</div>";

                echo "<div class='artwork'>";
                echo "<h4>Contact information: " . $row['contact_info'] . "</h4>";
                echo "</div>";
                echo "<hr>";
                
                
            }
        ?>
    </div>
    <!-- Other HTML content -->
</body>
</html>
