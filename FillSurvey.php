<?php
include 'config.php';

// Initialize error and success messages
$error_message = '';
$success_message = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $dateOfBirth = $_POST['dateOfBirth'] ?? '';
    $contactNo = $_POST['contactNo'] ?? '';

    // Check if date of birth is valid and within acceptable range
    $dob_timestamp = strtotime($dateOfBirth);
    if ($dob_timestamp === false) {
        $error_message = "Invalid date of birth.";
    } else {
        $current_date = time();
        $min_age = strtotime("-5 years");
        $max_age = strtotime("-120 years");
        if ($dob_timestamp > $min_age || $dob_timestamp < $max_age) {
            $error_message = "You must be older than 5 and younger than 120 years old to participate.";
        } else {
            // Handling checkbox values
            if (isset($_POST['fav_food'])) {
                $fav_food = implode(", ", $_POST['fav_food']);
            } else {
                $fav_food = '';
            }

            $watch_movies = $_POST['watch_movies'] ?? '';
            $listen_radio = $_POST['listen_radio'] ?? '';
            $eat_out = $_POST['eat_out'] ?? '';
            $watch_tv = $_POST['watch_tv'] ?? '';

            // Prepare SQL query
            $stmt = $conn->prepare("INSERT INTO tblSurvey (fullName, email, dateOfBirth, contactNo, fav_food, watch_movies, listen_radio, eat_out, watch_tv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $fullName, $email, $dateOfBirth, $contactNo, $fav_food, $watch_movies, $listen_radio, $eat_out, $watch_tv);

            // Execute query and check result
            if ($stmt->execute()) {
                $success_message = "Successfully Submitted!";
            } else {
                $error_message = "Could Not Submit. Please contact the database admin.";
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Take Our Survey</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>

<body>
    <div class="container">
       
        <!-- Start of the form -->
        <form action="FillSurvey.php" method="post" style="position: absolute; top: 20%; left: 20%; border: 2px solid #000; padding: 10px; border-radius: 10px;">

            <h2>
                _Survey

                <a href="FillSurvey.php" style="position: relative; left: 30%; font-size: 0.8em;">Fill Out Survey</a>

                <a href="SurveyResult.php" style="position: relative; left: 30%; font-size: 0.8em;">View Survey Results</a>
            </h2>

            <table class="nav-justified">
                <!-- Personal Details -->
                <tr>
                    <td>FullName</td>
                    <td><input type="text" name="fullName" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Date Of Birth</td>
                    <td><input type="date" name="dateOfBirth" required></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><input type="text" name="contactNo" maxlength="10" required></td>
                </tr>
                <!-- Favorite Foods -->
                <tr>
                    <td>Favourite Food</td>
                    <td>
                        <input type="checkbox" name="fav_food[]" value="Pizza"> Pizza
                        <input type="checkbox" name="fav_food[]" value="Pasta"> Pasta
                        <input type="checkbox" name="fav_food[]" value="Pap and Wors"> Pap and Wors
                        <input type="checkbox" name="fav_food[]" value="Other"> Other
                    </td>
                </tr>
                <!-- Agreement Scale -->
                <tr>
                    <td>I like to watch movies</td>
                    <td>
                        <input type="radio" name="watch_movies" value="Strongly Agree"> Strongly Agree
                        <input type="radio" name="watch_movies" value="Agree"> Agree
                        <input type="radio" name="watch_movies" value="Neutral"> Neutral
                        <input type="radio" name="watch_movies" value="Disagree"> Disagree
                        <input type="radio" name="watch_movies" value="Strongly Disagree"> Strongly Disagree
                    </td>
                </tr>
                <tr>
                    <td>I like to listen to radio</td>
                    <td style="width: 447px;">
                        <input type="radio" name="listen_radio" value="Strongly Agree"> Strongly Agree
                        <input type="radio" name="listen_radio" value="Agree"> Agree
                        <input type="radio" name="listen_radio" value="Neutral"> Neutral
                        <input type="radio" name="listen_radio" value="Disagree"> Disagree
                        <input type="radio" name="listen_radio" value="Strongly Disagree"> Strongly Disagree
                    </td>
                </tr>

                <tr>
                    <td>I like to eat Out</td>
                    <td style="width: 447px;">
                        <input type="radio" name="eat_out" value="Strongly Agree"> Strongly Agree
                        <input type="radio" name="eat_out" value="Agree"> Agree
                        <input type="radio" name="eat_out" value="Neutral"> Neutral
                        <input type="radio" name="eat_out" value="Disagree"> Disagree
                        <input type="radio" name="eat_out" value="Strongly Disagree"> Strongly Disagree
                    </td>
                </tr>

                <tr>
                    <td>I like to watch TV</td>
                    <td style="width: 447px;">
                        <input type="radio" name="watch_tv" value="Strongly Agree"> Strongly Agree
                        <input type="radio" name="watch_tv" value="Agree"> Agree
                        <input type="radio" name="watch_tv" value="Neutral"> Neutral
                        <input type="radio" name="watch_tv" value="Disagree"> Disagree
                        <input type="radio" name="watch_tv" value="Strongly Disagree"> Strongly Disagree
                    </td>
                </tr>

                <!-- Form Submission -->
                <tr>
                    <td colspan="2">
                        <button type="submit">Submit</button>
                    </td>
                </tr>
            </table>
        </form><br /><br />


        <?php if ($error_message) : ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php elseif ($success_message) : ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>

    </div>
</body>

</html>