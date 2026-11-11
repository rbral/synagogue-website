
<!-- Page where members can see their account information. -->
<?php
session_start();
require_once 'db_connect.php';

if ($_SESSION['LoggedIn'] !== TRUE || !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_COOKIE['username'];

// Retrieve members
$sql = "SELECT u.user_id, u.first_name, u.last_name, u.email, u.tel, u.membership_type_id, 
    u.nusach_id, m.membership_type_name, n.nusach_name
        FROM user_info u
        LEFT JOIN membership_type m
            ON u.membership_type_id = m.membership_type_id
        LEFT JOIN nusach_type n
            ON u.nusach_id = n.nusach_id
        WHERE u.email = ?";
        
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if (!$result) {
    error_log("Account query failed: " . $conn->error);
    die("Unable to load account information.");
}

include 'header.php';
?>

<h1>Our Members</h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone #</th>
            <th>Membership Type</th>
            <th>Nusach</th>
            
        </tr>
    </thead>

    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <?= htmlspecialchars(
                        $row['first_name'] . ' ' . $row['last_name']
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['email'] ?? '') ?>
                </td>

                <td>
                    <?= htmlspecialchars($row['tel'] ?? '') ?>
                </td>
                
                <td>
                    <?= htmlspecialchars($row['membership_type_name'] ?? '') ?>
                </td>
                
                <td>
                    <?= htmlspecialchars($row['nusach_name'] ?? '') ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
echo "<a href='member_dashboard.php'>Back to Member Dashboard</a><br><br>";
$result->free();
$conn->close();
?> 