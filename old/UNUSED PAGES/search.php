<?php
$search_input = $_POST['search_input'];
$course_code = $_POST['course_code'];

$sql = "SELECT * FROM course_schedule WHERE name LIKE '%$search_input%' AND course_code = '$category'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row['name'] . "<br>";
        echo "Category: " . $row['category'] . "<br>";
    }   
} else {
    echo "No results found";
}

$conn->close();
?>