<?php
// Database connection configuration
include 'config.php';

// Initialize error message variable
$errorMessage = '';

try {
    // Retrieve total number of surveys
    $sql = "SELECT COUNT(survey_id) FROM tblSurvey";
    $result = $conn->query($sql);
    $totalSurveys = $result->fetch_row()[0];

    // Calculate the average age
    $sql = "SELECT AVG(YEAR(CURRENT_DATE) - YEAR(dateOfBirth)) FROM tblSurvey";
    $result = $conn->query($sql);
    $averageAge = round($result->fetch_row()[0], 2);

    // Get the oldest person
    $sql = "SELECT fullName FROM tblSurvey WHERE dateOfBirth = (SELECT MIN(dateOfBirth) FROM tblSurvey)";
    $result = $conn->query($sql);
    $oldestPerson = $result->fetch_row()[0];

    // Get the youngest person
    $sql = "SELECT fullName FROM tblSurvey WHERE dateOfBirth = (SELECT MAX(dateOfBirth) FROM tblSurvey)";
    $result = $conn->query($sql);
    $youngestPerson = $result->fetch_row()[0];

    // Calculate the percentage of people who like different foods and activities
    $getPercentage = function ($field, $condition) use ($conn, $totalSurveys) {
        $sql = "SELECT COUNT(survey_id) FROM tblSurvey WHERE LOWER({$field}) = LOWER('{$condition}')";
        $result = $conn->query($sql);
        $count = $result->fetch_row()[0];
        return round(($count / $totalSurveys) * 100, 1) . " %";
    };



    $percentagePizza = $getPercentage("fav_food", "Pizza");
    $percentagePasta = $getPercentage("fav_food", "Pasta");
    $percentagePap = $getPercentage("fav_food", "Pap and wors");

    $percentageMovies = $getPercentage("watch_movies", "Strongly Agree");
    $percentageRadio = $getPercentage("listen_radio", "Strongly Agree");
    $percentageEatOut = $getPercentage("eat_out", "Strongly Agree");
    $percentageTV = $getPercentage("watch_tv", "Strongly Agree");
} catch (Exception $e) {
    $errorMessage = "Could not retrieve data from database. Contact the Support team.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Survey Results</title>
    <!-- Include CSS and other relevant headers -->
</head>

<body>


    <div class="container" style="position: absolute; top: 20%; left: 35%; border: 2px solid #000; padding: 10px; border-radius: 10px;">


        <h4>
            _Survey

            <a href="FillSurvey.php" style="position: relative; left: 30%; font-size:smaller;">Fill Out Survey</a>

            <a href="SurveyResult.php" style="position: relative; left: 30%; font-size:smaller;">View Survey Results</a>
        </h4>

        <h1 style="font-weight: 700; font-size: x-large; color: #999966; text-decoration: underline;">Survey Results</h1>
        <?php if (!empty($errorMessage)) : ?>
            <p style="font-weight: 700; font-size: large; color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <table class="table table-bordered">
            <tr>
                <td><strong>Total Number of Surveys</strong></td>
                <td><?php echo $totalSurveys; ?></td>
            </tr>
            <tr>
                <td><strong>Average Age</strong></td>
                <td><?php echo $averageAge; ?></td>
            </tr>
            <tr>
                <td><strong>Oldest Person Who Participated in Survey</strong></td>
                <td><?php echo $oldestPerson; ?></td>
            </tr>
            <tr>
                <td><strong>Youngest Person Who Participated in Survey</strong></td>
                <td><?php echo $youngestPerson; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like Pizza</strong></td>
                <td><?php echo $percentagePizza; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like Pasta</strong></td>
                <td><?php echo $percentagePasta; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like Pap and Wors</strong></td>
                <td><?php echo $percentagePap; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like to Eat Out</strong></td>
                <td><?php echo $percentageEatOut; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like to Watch Movies</strong></td>
                <td><?php echo $percentageMovies; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like to Watch TV</strong></td>
                <td><?php echo $percentageTV; ?></td>
            </tr>
            <tr>
                <td><strong>Percentage of People Who Like to Listen to Radio</strong></td>
                <td><?php echo $percentageRadio; ?></td>
            </tr>
        </table>

    
    </div>
</body>

</html>