<?php
include('config.php');

if ($conn) {
    echo "Database connection is successful.";
} else {
    echo "Database connection failed.";
}
?>
