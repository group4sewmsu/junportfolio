<?php
include_once 'connection.php';
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit;
}

// Logout logic
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: index.php");
    exit;
}


$sql_fetch_name = "SELECT * FROM names"; // Assuming you have only one row in the table
$result_fetch_name = mysqli_query($conn, $sql_fetch_name);

if(mysqli_num_rows($result_fetch_name) > 0) {
    $row_name = mysqli_fetch_assoc($result_fetch_name);
    $first_name = $row_name['first_name'];
    $last_name = $row_name['last_name'];
    $full_name = $first_name . ' ' . $last_name; 
}
$sql_description = "SELECT * FROM description";
$result_description = mysqli_query($conn, $sql_description);
		if ($row_description = mysqli_fetch_assoc($result_description)) {
			$description = $row_description['description'];
						
		} else {
			  $description = "Default description if no description is found in the database.";
			   }
$sql_about = "SELECT * FROM about";
$result_about = mysqli_query($conn, $sql_about);
		if ($row_about = mysqli_fetch_assoc($result_about)) {
			$about = $row_about['about_text'];
						
		} else {
			  $about = "Default about if no description is found in the database.";
			   }
	$sql_contacts = "SELECT * FROM contacts";
					$result_contacts = mysqli_query($conn, $sql_contacts);

					if (mysqli_num_rows($result_contacts) > 0) {   
						$row_contact = mysqli_fetch_assoc($result_contacts);
						$email = $row_contact['email'];
						$phone = $row_contact['phone'];
						$address = $row_contact['address'];
					} else {
						$email = '';
						$phone = '';
						$address = '';
					}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Bootstrap JS -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
    // Prevent form submission and handle it via AJAX
    $("#aboutForm").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize(); // Serialize form data
        $.post("aboutUpdate.php", formData, function(response) {
            alert(response); // Show response in an alert (for testing)
			if (response === "Record updated successfully") {
                location.reload();
            }
            // You can also close the modal or do other actions
            $("#aboutModal").modal("hide"); // Hide the modal
        });
    });

    // Open the modal when "Edit About" button is clicked
    $(".edit-about-btn").click(function() {
        var currentAboutText = "<?php echo htmlspecialchars($about); ?>";
        $("#aboutTextarea").val(currentAboutText);
        $("#aboutModal").modal("show"); // Ensure modal is shown using Bootstrap's modal function
    });

    // Close the modal when the close button (x) is clicked
    $(".close").click(function() {
        $("#aboutModal").modal("hide"); // Ensure modal is hidden using Bootstrap's modal function
    });
});
</script>
<script>
	$(document).ready(function() {
    $(".edit-contacts-btn").click(function() {
        var id = $(this).data("id");
        var email = $(this).data("email");
        var phone = $(this).data("phone");
        var address = $(this).data("address");

        $("#id").val(id);
        $("#email").val(email);
        $("#phone").val(phone);
        $("#address").val(address);
    });

    $("#contactsForm").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        
        $.post("contactsUpdate.php", formData, function(response) {
            alert(response); // Show response message (optional)
            
            if (response === "Record updated successfully") {
                // Hide the modal
                $("#contactsModal").modal("hide");
                
                // Reload the page after a brief delay (to ensure modal is fully hidden)
                setTimeout(function() {
                    location.reload();
                }, 500); // Adjust delay as needed
            } else {
                // Handle error if needed
                console.log(response); // Log the error message
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
        $(".edit-description-btn").click(function() {
            var description = $(this).data("description");
            $("#descriptionInput").val(description);
        });

        $("#descriptionForm").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.post("descUpdate.php", formData, function(response) {
                alert(response); // Show response message (optional)
                
                if (response === "Record updated successfully") {
                    // Hide the modal
                    $("#descriptionModal").modal("hide");
                    
                    // Reload the page after a brief delay (to ensure modal is fully hidden)
                    setTimeout(function() {
                        location.reload();
                    }, 500); // Adjust delay as needed
                } else {
                    // Handle error if needed
                    console.log(response); // Log the error message
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".edit-name-btn").click(function() {
            var firstName = $(this).data("first-name");
            var lastName = $(this).data("last-name");
            $("#firstNameInput").val(firstName);
            $("#lastNameInput").val(lastName);
        });

        $("#nameForm").submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.post("nameUpdate.php", formData, function(response) {
                alert(response); // Show response message (optional)
                
                if (response === "Record updated successfully") {
                    // Hide the modal
                    $("#nameModal").modal("hide");
                    
                    // Reload the page after a brief delay (to ensure modal is fully hidden)
                    setTimeout(function() {
                        location.reload();
                    }, 500); // Adjust delay as needed
                } else {
                    // Handle error if needed
                    console.log(response); // Log the error message
                }
            });
        });
    });
</script>
    <title>Dashboard</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group img {
            display: block;
            max-width: 100%;
			margin: 0 auto;
            height: 25vh;
            margin-top: 10px; /* Adjust as needed */
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group textarea {
            height: 100px; /* Adjust height as needed */
        }

        .form-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
		        .logout-button {
            margin-top: 20px; /* Adjust margin as needed */
        }

    </style>
</head>
<body>
		<div class="container">
			<h2>Dashboard</h2>
			<?php if(isset($error_message)) { ?>
				<p class="error"><?php echo $error_message; ?></p>
			<?php } ?>
			 <?php
				 // Retrieve the latest uploaded image
				$sql = "SELECT image_data, image_type FROM images ORDER BY id DESC LIMIT 1";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$imageData = $row['image_data'];
					$imageType = $row['image_type'];
					$base64 = base64_encode($imageData);
					$src = "data:image/" . $imageType . ";base64," . $base64;
					echo "<img src='$src' style='max-width: 180px; display: block; margin: 0 auto;'><br>";
				} else {
					echo "<h3>No image uploaded yet.</h3>";
				}

				// Close connection
				$conn->close();
				?>
				<!-- Upload form -->
				<form action="imageUpdate.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
					<input type="file" name="image" accept="image/*" required>
					<button type="submit" name="submit">Update Photo</button>
					</div>
				</form>

			   <form method="post" action="">
				<div class="form-group">
					<label for="name">FULLNAME:</label>
					<input type="text" id="name" name="name" value="<?php echo $full_name; ?>" required readonly>
				</div>
			   </form>  
			   <!-- Button to trigger modal -->
				<button class="btn btn-primary edit-name-btn"
					data-toggle="modal"
					data-target="#nameModal"
					data-first-name="<?php echo htmlspecialchars($first_name); ?>"
					data-last-name="<?php echo htmlspecialchars($last_name); ?>">
					Edit Name
				</button>

				<!-- Modal for Name -->
				<div id="nameModal" class="modal fade">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Name</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="nameForm" class="modal-form" method="POST" action="">
									<div class="form-group">
										<label for="first_name">First Name:</label>
										<input type="text" id="firstNameInput" name="first_name" class="form-control" required>
									</div>
									<div class="form-group">
										<label for="last_name">Last Name:</label>
										<input type="text" id="lastNameInput" name="last_name" class="form-control" required>
									</div>
									<button type="submit" class="btn btn-primary">Update</button>
								</form>
							</div>
						</div>
					</div>
				</div>

			   
				<form method="post" action="">
					<div class="form-group">
					<label for="descS"> </label><BR>
					<label for="description">DESCRIPTION FIELD:</label>
					<textarea id="description" name="description" required readonly><?php echo $description; ?></textarea>
					</div>
				</form>
			   <!-- Button to trigger modal -->
				<button class="btn btn-primary edit-description-btn"
					data-toggle="modal"
					data-target="#descriptionModal"
					data-description="<?php echo htmlspecialchars($description); ?>">
					Edit Description
				</button>

				<!-- Modal for Description -->
				<div id="descriptionModal" class="modal fade">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Description</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="descriptionForm" class="modal-form" method="POST" action="">
									<div class="form-group">
										<label for="description">Description:</label>
										<textarea id="descriptionInput" name="description" class="form-control" required></textarea>
									</div>
									<button type="submit" class="btn btn-primary">Update</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			   
			   <form method="post" action="">
				   <label for="contactS"> </label><BR>
					<label for="contact">CONTACTS FIELD:</label>
					
				   
		

					<form method="post" action="">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly>
						</div>
						<div class="form-group">
							<label for="phone">Phone:</label>
							<input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required readonly>
						</div>
						<div class="form-group">
							<label for="address">Address:</label>
							<input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required readonly>
						</div>
					</form>

			   </form>
			<button class="btn btn-primary edit-contacts-btn"
					data-toggle="modal"
					data-target="#contactsModal"
					data-id="1"
					data-email="<?php echo htmlspecialchars($email); ?>"
					data-phone="<?php echo htmlspecialchars($phone); ?>"
					data-address="<?php echo htmlspecialchars($address); ?>">
				Edit Contacts
			</button>
				 <!-- Modal for contacts section -->
		<div id="contactsModal" class="modal fade">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Contacts</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="contactsForm" class="modal-form" method="POST" action="">
							<div class="form-group">
								<input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($id); ?>">
								<label for="email">Email:</label>
								<input type="text" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
							</div>
							<div class="form-group">
								<label for="phone">Phone:</label>
								<input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" required>
							</div>
							<div class="form-group">
								<label for="address">Address:</label>
								<input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($address); ?>" required>
							</div>
							<button type="submit" class="btn btn-primary">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<form method="post" action="">
			<div class="form-group">
				<label for="abouts"> </label><BR>
				<label for="about">ABOUT SECTION:</label>
				<!-- Use the content between <textarea> tags for the initial value -->
				<textarea id="about" name="about" required readonly><?php echo htmlspecialchars($about); ?></textarea>
			</div>
		</form>
			<!-- Trigger button to open modal -->
		<button class="btn btn-primary edit-about-btn" data-toggle="modal" data-target="#aboutModal">Edit About</button>

<!-- Modal for about section -->
	<div id="aboutModal" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit About</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="aboutForm" class="modal-form" method="POST" action="aboutUpdate.php">
						<div class="form-group">
							<label for="aboutTextarea">About:</label>
							<textarea id="aboutTextarea" name="about" class="form-control" required></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
			 <form method="post" action="">
            <div class="form-group logout-button">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </div>
        </form>
    </div>
</body>
</html>
