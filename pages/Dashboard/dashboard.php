<?php
if (!isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/homepage');
}
if ($_SESSION['level'] !== 'Admin') {
    header('location: ' . HOME_URL_PREFIX . '/homepage');
}
$dashboard = new Dashboard();
$users = $dashboard->getUsers();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $cleanData = filter_var($_POST['userID'], FILTER_SANITIZE_NUMBER_INT);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/dashboard?error');
    };
    if ($_POST['submit'] === 'status') {
        $dashboard->setStatus($cleanData);
    } else if ($_POST['submit'] === 'delete') {
        $dashboard->deleteUser($cleanData);
    }
    header("Refresh:0");
}
?>
<?php if (isset($_GET['error'])) {
    include_once('./includes/error.php');
} ?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Users</h1>
        <div class="row mt-5">
            <table class="table table-light table-hover">
                <thead>
                    <tr class="table-light text-center">
                        <th scope="col">Image</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Level</th>
                        <th scope="col">Status</th>
                        <th scope="col">Since</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($users)) {
                        foreach ($users as $user) {
                    ?>
                            <tr class="table-light text-center" style="vertical-align: middle;">
                                <td class="table-light"><img src="./assets/images/uploads/users/<?php echo ($user['imagePath']); ?>" class="avatar rounded-circle" /></td>
                                <th class="table-light"><?php echo ($user['id']); ?></th>
                                <td class="table-light"><?php echo ($user['firstName'] . ' ' . $user['lastName']); ?></td>
                                <td class="table-light"><?php echo ($user['telephone']); ?></td>
                                <td class="table-light"><?php echo ($user['email']); ?></td>
                                <td class="table-light"><?php echo ($user['level']); ?></td>
                                <td class="table-light"><?php echo ($user['status']); ?></td>
                                <td class="table-light"><?php echo (date("d M Y", strtotime($user['createdDate']))); ?></td>
                                <td class="table-light">
                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                                        <input type="hidden" name="userID" value="<?php echo $user['id']; ?>" required>
                                        <button type="submit" class="btn btn-emerald fw-bold shadow-none" name="submit" value="status">
                                            <?php
                                            if ($user['status'] === 'Allowed') { ?>
                                                <i class="bi bi-x-lg"></i>
                                            <?php
                                            } elseif ($user['status'] === 'Blocked') { ?>
                                                <i class="bi bi-check-lg"></i>
                                            <?php
                                            }
                                            ?>
                                        </button>
                                    </form>
                                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                                        <input type="hidden" name="userID" value="<?php echo $user['id']; ?>" required>
                                        <button type="submit" class="btn btn-emerald fw-bold shadow-none" name="submit" value="delete">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>