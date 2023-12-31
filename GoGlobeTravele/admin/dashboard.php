
<!doctype html>

<?php
// Start output buffering
ob_start();

// Include the specific file that contains the HTML division
include 'country_analysis.php';

// Get the output and stop buffering
$divisionContent = ob_get_contents();
ob_end_clean();
?>

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
                                    <li><a href="db-package-change-details.php">Price change History</a></li>
                                </ul>   
                            </li>
                            <li><a href="db-booking.php"><i class="fas fa-ticket-alt"></i> Booking  </a></li>
                            <li><a href="db-Enquiry-list.php"><i class="fas fa-ticket-alt"></i> Enquiry  </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="db-info-wrap">
                <div class="row">
                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-blue">
                                <i class="far fa-chart-bar"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Today Bookings</h4>
                                <h5 id="bookingCount">Loading...</h5>
                            </div>
                        </div>
                    </div>



                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-green">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Earnings</h4>
                                <h5 id="totalEarnings">Loading...</h5>
                            </div>
                        </div>
                    </div>


                    <!-- Item -->
                    <div class="col-xl-3 col-sm-6">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-purple">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Users</h4>
                                <h5 id="userCount">Loading...</h5>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-3 col-sm-6">
                        <div class="db-info-list">
                            <div class="dashboard-stat-icon bg-red">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <div class="dashboard-stat-content">
                                <h4>Enquiry</h4>
                                <h5 id="enquiryCount">Loading...</h5>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="dashboard-box table-opp-color-box">
                            <h4>Recent Booking</h4>
                            <p>Last 5 Booking history.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>City</th>
                                            <th>Enquiry</th>
                                        </tr>
                                    </thead>
                                   
                                    <?php include 'recent_bookings.php'; ?>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="dashboard-box table-opp-color-box">
                            <h4>Package Enquiry</h4>
                            <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     $servername = "localhost";
                                     $username = "root";
                                     $password = "";
                                     $dbname = "goglobetravel";
         
                                     $conn = new mysqli($servername, $username, $password, $dbname);
                                     if ($conn->connect_error) {
                                         die("Connection failed: " . $conn->connect_error);
                                     }

                                    $query = "SELECT e.*, u.*
                                    FROM enquiries e
                                    JOIN users u ON e.user_id = u.user_ID LIMIT 5
                                    ";
                                    
                                    $result = mysqli_query($conn, $query);
                                    //in here i need to show the enquiry details in the table.
                                    if(mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                            $enquiry_id = $row['enq_id'];
                                            $user_id = $row['user_id'];
                                            $date = $row['date'];
                                            $subject = $row['subject'];
                                            $message = $row['message'];
                                    
                                    
                                            echo "
                                            <tr>
                                                <td>$user_id</td>
                                                <td>$date</td>
                                                <td>$subject</td>
                                                <td>$message</td>
                                                <td>
                                                <form action='delete_enquiry.php' method='post' class='delete-form'>
                                        <input type='hidden' name='enquiry_id' value='$enquiry_id'>
                                        <button type='submit' name='deleteEnquiry' class='badge badge-danger delete-btn' data-enquiry_id='$enquiry_id'><i class='far fa-trash-alt'></i></button>
                                    </form>
                                    
                                            </td>
                                                
                                            ";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No bookings found.</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="dashboard-box">
                            <h4>User Details</h4>
                            <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Listings</th>
                                            <th>Enquiry</th>
                                            <th>Bookings</th>
                                            <th>Reviews</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="list-img"><img src="assets/images/comment.jpg" alt=""></span>
                                            </td>
                                            <td><a href="#"><span class="list-name">Kathy Brown</span><span class="list-enq-city">United States</span></a>
                                            </td>
                                            <td>+01 3214 6522</td>
                                            <td>chadengle@dummy.com</td>
                                            <td>Australia</td>
                                            <td>
                                                <span class="badge badge-primary">02</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">12</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">24</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-dark">36</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-img"><img src="assets/images/comment2.jpg" alt=""></span>
                                            </td>
                                            <td><a href="#"><span class="list-name">Kathy Brown</span><span class="list-enq-city">United States</span></a>
                                            </td>
                                            <td>+01 3214 6522</td>
                                            <td>chadengle@dummy.com</td>
                                            <td>Australia</td>
                                            <td>
                                                <span class="badge badge-primary">02</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">12</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">24</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-dark">36</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-img"><img src="assets/images/comment3.jpg" alt=""></span>
                                            </td>
                                            <td><a href="#"><span class="list-name">Kathy Brown</span><span class="list-enq-city">United States</span></a>
                                            </td>
                                            <td>+01 3214 6522</td>
                                            <td>chadengle@dummy.com</td>
                                            <td>Australia</td>
                                            <td>
                                                <span class="badge badge-primary">02</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">12</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">24</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-dark">36</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="list-img"><img src="assets/images/comment4.jpg" alt=""></span>
                                            </td>
                                            <td><a href="#"><span class="list-name">Kathy Brown</span><span class="list-enq-city">United States</span></a>
                                            </td>
                                            <td>+01 3214 6522</td>
                                            <td>chadengle@dummy.com</td>
                                            <td>Australia</td>
                                            <td>
                                                <span class="badge badge-primary">02</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">12</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">24</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-dark">36</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div> -->
                <div class="row">      
                    <!-- Recent Activity -->
                    <!-- <div class="col-lg-7 col-12">
                        <div class="dashboard-box activities-box">
                            <h4>Recent Activities</h4>
                            <ul>
                                <li>
                                    <i class="far fa-calendar-alt"></i> 
                                    <small>5 mins ago</small>
                                    <h5>Jane has sent a request for access</h5>
                                    <a href="#" class="close-icon"><i class="fas fa-times"></i></a>
                                </li>
                                <li>
                                    <i class="far fa-calendar-alt"></i>
                                    <small>5 mins ago</small>
                                    <h5>Williams has just joined Project X</h5>
                                    <a href="#" class="close-icon"><i class="fas fa-times"></i></a>
                                </li>
                                <li>
                                    <i class="far fa-calendar-alt"></i>
                                    <small>5 mins ago</small>
                                    <h5>Williams has just joined Project X</h5>
                                    <a href="#" class="close-icon"><i class="fas fa-times"></i></a>
                                </li>
                                <li>
                                    <i class="far fa-calendar-alt"></i> 
                                    <small>25 mins ago</small>
                                    <h5>Kathy Brown left a review on Hotel</h5>
                                    <a href="#" class="close-icon"><i class="fas fa-times"></i></a>
                                </li>
                                <li>
                                   <i class="far fa-calendar-alt"></i> 
                                    <small>25 mins ago</small>
                                    <h5>Kathy Brown left a review on Hotel</h5>
                                    <a href="#" class="close-icon"><i class="fas fa-times"></i></a>
                                </li>
                                <li>
                                    <i class="far fa-calendar-alt"></i>
                                    <small>5 mins ago</small>
                                    <h5>Williams has just joined Project X</h5>
                                    <a href="#" class="close-icon"><i class="fas fa-times"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-lg-7 col-12">
                        <div class="dashboard-box activities-box">
                            <h4>Recent Activities</h4>
                            <ul>
                                <?php
                                // Database connection configuration (same as before)
                                // ...
                                // Database connection
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "goglobetravel";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                                // Fetch recent notifications from the database
                                $recentActivitiesQuery = "SELECT * FROM notification ORDER BY timestamp DESC LIMIT 6";
                                $recentActivitiesResult = mysqli_query($conn, $recentActivitiesQuery);

                                // Check if there are any notifications
                                if (mysqli_num_rows($recentActivitiesResult) > 0) {
                                    while ($row = mysqli_fetch_assoc($recentActivitiesResult)) {
                                        echo '<li>';
                                        echo '<i class="far fa-calendar-alt"></i>';
                                        echo '<small>' . date("M j, Y g:i A", strtotime($row['timestamp'])) . '</small>';
                                        echo '<h5>' . htmlspecialchars($row['message']) . '</h5>';
                                        echo '<a href="#" class="close-icon"><i class="fas fa-times"></i></a>';
                                        echo '</li>';
                                    }
                                } else {
                                    // If there are no notifications, display a message
                                    echo '<li>No recent activities found.</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="dashboard-box report-list">
                        <form action="revenue_report.php" method="post">
                            <h4>Reports</h4>
                            <div class="report-list-content">
                                <!-- Date input fields -->
                                <div class="date" style="margin-bottom: 1rem;">
                                    <label for="startDate">Start Date:</label>
                                    <input type="date" id="startDate" name="startDate">
                                </div>
                                <div class="date" style="margin-bottom: 1rem;">
                                    <label for="endDate">End Date:</label>
                                    <input type="date" id="endDate" name="endDate">
                                </div>
                                
                                <div>
                                    <input type="submit" class="button-primary" name="submit" value="Generate revenue report">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-lg-4 " style="height: 290px; width: 600px; margin-bottom: 20px">        
                        <?php include 'country_analysis.php'; ?>
                           <div id="piechart" style="height: 290px; width: 400px; margin-top: 50px; margin-left: 50px;"></div>
                        </div>
                    </div>
                    <!-- Show the chart of last 3 months revenue generated. Chart is generated in the chart_salary-line-chart.php file.-->
                    <div class="col-lg-5 " style="padding-top: 50px;">        
                            <?php include 'chart_salary-line-chart.php'; ?>
                            <div id="piechart" style="height: 290px; width: 300px; margin-top: 50px; margin-left: 100px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 " style="margin-top: 2200px; margin-left: 345px;">        
                            <?php include 'bar-chart.php'; ?>
                            <div id="piechart" style="height: 290px; width: 300px; margin-top: 3500px; margin-left: 100px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Draw the 3 charts seperatly in the dashboard with proper gaps between each other and size of the graphs should be the same -->

            <!-- Content / End -->
            <!-- Copyrights -->
            <div class="copyrights">
               Copyright © 2021 Travele. All rights reserveds.
            </div>
        </div>
        <!-- Dashboard / End -->
    </div>
                            </div>
    <!-- end Container Wrapper -->
    <!-- *Scripts* -->
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Fetch total earning via AJAX
        $.ajax({
            type: 'GET',
            url: 'get_total_earning.php',
            dataType: 'json',
            success: function(data) {
                // Update the "Earnings" section with the fetched value
                if (data.total_earning) {
                    $('#totalEarnings').text(data.total_earning);
                } else {
                    $('#totalEarnings').text('Error fetching data');
                }
            },
            error: function(xhr, status, error) {
                $('#totalEarnings').text('Error fetching data');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Fetch user count via AJAX
        $.ajax({
            type: 'GET',
            url: 'get_user_count.php',
            dataType: 'json',
            success: function(data) {
                // Update the "Users" section with the fetched value
                if (data.user_count) {
                    $('#userCount').text(data.user_count);
                } else {
                    $('#userCount').text('Error fetching data');
                }
            },
            error: function(xhr, status, error) {
                $('#userCount').text('Error fetching data');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Fetch enquiry count via AJAX
        $.ajax({
            type: 'GET',
            url: 'get_enquiry_count.php',
            dataType: 'json',
            success: function(data) {
                // Update the "Enquiry" section with the fetched value
                if (data.enquiry_count) {
                    $('#enquiryCount').text(data.enquiry_count);
                } else {
                    $('#enquiryCount').text('Error fetching data');
                }
            },
            error: function(xhr, status, error) {
                $('#enquiryCount').text('Error fetching data');
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        // Fetch booking count via AJAX
        $.ajax({
            type: 'GET',
            url: 'get_booking_count.php',
            dataType: 'json',
            success: function(data) {
                // Update the "Today Views" section with the fetched value
                if (data.booking_count) {
                    $('#bookingCount').text(data.booking_count);
                } else {
                    $('#bookingCount').text('Error fetching data');
                }
            },
            error: function(xhr, status, error) {
                $('#bookingCount').text('Error fetching data');
            }
        });
    });
</script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/canvasjs.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/jquery.slicknav.js"></script>
    <script src="assets/js/dashboard-custom.js"></script>
</body>
</html>