<?php
require_once "db_connection.php";

// Query to get destination data from the "destination" table
$query = "SELECT * FROM destination";

$result = mysqli_query($conn, $query);
echo '<div class="row">';
if ($result) {
    $count = 0;
   
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $dest_id = $row['dest_id'];
        $dest_image = $row['pack_image'];
        $city = $row['city'];

        echo '
        <div class="col-md-12 mb-4">
            <div class="desti-item overlay-desti-item">
                <figure class="desti-image">
                    <img src="' . $dest_image . '" alt="" style="width: 100%; height: 300px; object-fit: cover;">
                </figure>
                <div class="meta-cat bg-meta-cat">
                    <a href="single-destination.php?dest_id=' . $dest_id . '">' . $city . '</a>
                </div>
                <div class="desti-content">
                    <h3>
                        <a href="single-destination.php?dest_id=' . $dest_id . '">' . $title . '</a>
                    </h3>
                    <div class="rating-start" title="Rated 5 out of 4">
                        <span style="width: 53%"></span>
                    </div>
                </div>
            </div>
        </div>';
    

        $count++;
    }
    echo '</div>'; // Close the row
} else {
    // Error occurred while fetching data
    echo "Error: " . mysqli_error($conn);
}
?>
