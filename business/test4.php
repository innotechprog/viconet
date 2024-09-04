<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "vico";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Pagination variables
$results_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $results_per_page;

// Search query
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM candidate_tbl WHERE c_name LIKE '%$search%' LIMIT $start, $results_per_page";

$result = $conn->query($sql);
?>

<!-- Display search results -->
<table>
    <tr>
        <th>Column 1</th>
        <th>Column 2</th>
        <!-- Add more columns as needed -->
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['c_name'] . "</td>";
        echo "<td>" . $row['c_surname'] . "</td>";
        // Add more columns as needed
        echo "</tr>";
    }
    ?>
</table>

<!-- Pagination Links -->
<?php
$sql = "SELECT COUNT(*) FROM candidate_tbl WHERE c_name LIKE '%$search%'";
$result = $conn->query($sql);
$row = $result->fetch_row();
$total_records = $row[0];
$total_pages = ceil($total_records / $results_per_page);

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='test4?page=$i&search=$search'>$i</a> ";
}
?>
