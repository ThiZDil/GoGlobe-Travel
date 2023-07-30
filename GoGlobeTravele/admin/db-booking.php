<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- favicon -->
      <link rel="icon" type="image/png" href="../assets/images/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="style.css">
      <title>Travele | Travel & Tour HTML5 template </title>
</head>
<body>

    <!-- start Container Wrapper -->
    <div id="container-wrapper">
        <!-- Dashboard -->
        <div id="dashboard" class="dashboard-container">
        <div class="dashboard-header sticky-header">
            <div class="content-left  logo-section pull-left">
                <h1><a href="#"><img src="assets/images/logo.png" alt=""></a></h1>
            </div>
            <div class="heaer-content-right pull-right">
                <div class="search-field">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="search" placeholder="Search Now">
                            <a href="#"><span class="search_btn"><i class="fa fa-search" aria-hidden="true"></i></span></a>
                        </div>
                    </form>
                </div>
                <?php
                require_once('db_connection.php');
                // Fetch count of unread notifications from the database
                $unreadNotificationsQuery = "SELECT * FROM notification WHERE is_read = 0 ORDER BY timestamp DESC";
                $unreadNotificationsResult = mysqli_query($conn, $unreadNotificationsQuery);
                    ?>
                                        
                <div class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <div class="dropdown-item">
                            <i class="far fa-envelope"></i>
                            <?php
                                // Display the count of unread notifications
                            $unreadNotificationCount = mysqli_num_rows($unreadNotificationsResult);
                            if ($unreadNotificationCount > 0) {
                                echo '<span class="notify">' . $unreadNotificationCount . '</span>';
                            }
                            ?>
                        </div>
                    </a>
                    <div class="dropdown-menu notification-menu">
                        <h4><?php echo $unreadNotificationCount; ?> Unread Notifications</h4>
                        <ul>
                            <?php
                                // Display unread notifications in the admin header
                            while ($row = mysqli_fetch_assoc($unreadNotificationsResult)) {
                                    echo '<li>';
                                    echo '<a href="#">';
                                    echo '<div class="list-img">';
                                    echo '<img src="assets/images/comment4.jpg" alt="">';
                                    echo '</div>';
                                    echo '<div class="notification-content">';
                                    echo '<p>' . htmlspecialchars($row['message']) . '</p>';
                                    echo '<small>' . date("M j, Y g:i A", strtotime($row['timestamp'])) . '</small>';
                                    echo '</div>';
                                    echo '</a>';
                                    echo '</li>';
                            }
                            ?>
                        </ul>
                        <a href="all-notifications.php" class="all-button">See all notifications</a>
                    </div>
                </div>
                    

                <?php
                require_once('db_connection.php');
                // Fetch count of unread notifications from the database
                $unreadNotificationsQuery = "SELECT * FROM admin WHERE id = 1";
                $unreadNotificationsResult = mysqli_query($conn, $unreadNotificationsQuery);
                while($row = mysqli_fetch_array($unreadNotificationsResult)){
                    $profile_pic = $row['profile_photo'];
                }
                    
                echo"
                <div class='dropdown'>
                    <a class='dropdown-toggle' data-toggle='dropdown'>
                        <div class='dropdown-item profile-sec'>
                            <img src='uploads/$profile_pic' alt=''>
                            <span>My Account </span>
                            <i class='fas fa-caret-down'></i>
                        </div>
                    </a>
                    <div class='dropdown-menu account-menu'>
                        <ul>
                            <li><a href='#'><i class='fas fa-cog'></i>Settings</a></li>
                            <li><a href='#'><i class='fas fa-user-tie'></i>Profile</a></li>
                            <li><a href='#'><i class='fas fa-sign-out-alt'></i>Logout</a></li>
                        </ul>
                    </div>
                </div>";
                ?>
            </div>
        </div>  
            <div class="dashboard-navigation">

                <div id="dashboard-Navigation" class="slick-nav"></div>
                    <div id="navigation" class="navigation-container">
                        <ul>
                            <li><a href="dashboard.php"><i class="far fa-chart-bar"></i> Dashboard</a></li>
                            <li><a href="user.php"><i class="fas fa-user"></i>Users</a>
                            
                            </li>
                            <li><a href="admin_list.php"><i class="fas fa-user"></i>Admins</a>
                            <li><a href="new-user.php">Add admin</a></li>
                            
                            <li><a href="db-add-destination.php"><i class="fas fa-umbrella-beach"></i>Add Destination</a></li>
                            <li><a href="db-add-package.php"><i class="fas fa-umbrella-beach"></i>Add Package</a></li>
                            <li class="active-menu">
                                <a><i class="fas fa-hotel"></i></i>packages</a>
                                <ul>
                                    <li><a href="db-package-active.php">Active</a></li>
                                    <li><a href="db-package-pending.php">Pending</a></li>
                                    <li><a href="db-package-change.php">Change package details</a></li>
                                </ul>   
                            </li>
                            <li><a href="db-booking.php"><i class="fas fa-ticket-alt"></i> Booking  </a></li>
                            <li><a href="db-Enquiry-list.php"><i class="fas fa-ticket-alt"></i> Enquiry  </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="db-info-wrap db-booking">
                <div class="dashboard-box table-opp-color-box">
                    <h4>Recent Booking</h4>
                    <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                    <div class="table-responsive">
                        <table id="exportTable" class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Destination</th>
                                    <th>Id</th>
                                    <th>status</th>
                                    
                                    <th>People</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
require_once "db_connection.php";

$query = "SELECT pb.booking_ID, pb.check_in_date, pb.grp_size, p.title, p.city, p.status, u.fName
FROM pack_booking pb
LEFT JOIN packages p ON pb.pack_ID = p.pack_ID
LEFT JOIN users u ON pb.user_ID = u.user_ID
";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
        $bookingID = $row['booking_ID'];
        $checkinDate = $row['check_in_date'];
        $grpSize = $row['grp_size'];
        $title = $row['title'];
        $city = $row['city'];
        $status = ($row['status'] == 1) ? "Active" : "Pending";
        $userName = $row['fName'];

        echo "
            <tr>
                <td>
                    <span class='list-enq-name'>$userName</span>
                </td>
                <td>$checkinDate</td>
                <td>$city</td>
                <td>$bookingID</td>
                <td><span class='badge badge-success'>$status</span></td>
               
                <td><span class='badge badge-success'>$grpSize</span></td>
                <td>
                <form action='' method='post' class='delete-form'>
                <input type='hidden' name='bookingID' value='$bookingID'>
                <button type='submit' name='deleteBooking' class='badge badge-danger delete-btn' data-bookingid='$bookingID'><i class='far fa-trash-alt'></i></button>
            </form>
                </td>
            </tr>
        ";
    }
} else {
    echo "<tr><td colspan='8'>No bookings found.</td></tr>";
}
?>

                            </tbody>
                        </table>
                        <form action="datatoexcel.php" method="POST">
                        
        <button  type="submit" name="exportToExcel">Export to Excel</button>
        
  
</form>
                    </div>
                </div>
            </div>
      

            <!-- Content / End -->
            <!-- Copyrights -->
            <div class="copyrights">
               Copyright © 2021 Travele. All rights reserveds.
            </div>
        </div>
        <!-- Dashboard / End -->
    </div>
        <!-- Include TableExport.js -->
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include TableExport.js -->
<script src="https://cdn.jsdelivr.net/npm/tableexport@5.2.2/dist/js/tableexport.min.js"></script>

    
<!-- Add this script after including jQuery -->
<script>
    $(document).ready(function() {
        // Attach a click event handler to the delete buttons
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var bookingID = $(this).data('bookingid');

            // Show a confirmation dialog before proceeding with the delete
            if (confirm('Are you sure you want to delete this booking?')) {
                // Submit the delete form via AJAX
                $.ajax({
                    type: 'POST',
                    url: 'delete_booking.php', // Replace with the actual PHP script that handles the delete operation
                    data: { deleteBooking: true, bookingID: bookingID },
                    success: function(response) {
                        // Display the success message from the PHP script
                        

                        // Remove the deleted row from the table
                        $('.delete-form input[value="' + bookingID + '"]').closest('tr').remove();
                    },
                    error: function(xhr, status, error) {
                        // Display the error message if deletion fails
                        alert('Error: ' + error);
                    }
                });
            }
        });
    });
</script>

    <!-- end Container Wrapper -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/canvasjs.min.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/dashboard-custom.js"></script>
</body>
</html>