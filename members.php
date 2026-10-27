
<!-- Page where admins can see the members' information and set them as admins if needed. -->
<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['update_role'])) {

    $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $newRole = filter_input(INPUT_POST, 'role_id', FILTER_VALIDATE_INT);

    if ($userId && in_array($newRole, [1, 2], true)) {
        $stmt = $conn->prepare(
            "UPDATE user_info SET role_id = ? WHERE user_id = ?"
        );

        $stmt->bind_param("ii", $newRole, $userId);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: members.php");
    exit;
}

// Retrieve members
$sql = "SELECT u.user_id, u.first_name, u.last_name, u.email, u.tel, u.role_id, u.membership_type_id, 
    u.nusach_id, m.membership_type_name, n.nusach_name
        FROM user_info u
        LEFT JOIN membership_type m
            ON u.membership_type_id = m.membership_type_id
        LEFT JOIN nusach_type n
            ON u.nusach_id = n.nusach_id";
        
$result = $conn->query($sql);

if (!$result) {
    error_log("Members query failed: " . $conn->error);
    die("Unable to load members.");
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
            <th>Role</th>
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
                    <form method="POST" action="members.php">
                        <input type="hidden"
                               name="user_id"
                               value="<?= (int)$row['user_id'] ?>">

                        <select name="role_id" required>
                            <option value="2"
                                <?= (int)$row['role_id'] === 2
                                    ? 'selected' : '' ?>>
                                Member
                            </option>

                            <option value="1"
                                <?= (int)$row['role_id'] === 1
                                    ? 'selected' : '' ?>>
                                Admin
                            </option>
                        </select>

                        <button type="submit" name="update_role">
                            Save
                        </button>
                    </form>
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
echo "<a href='admin_dashboard.php'>Back to Admin Dashboard</a><br><br>";
$result->free();
$conn->close();
?> 