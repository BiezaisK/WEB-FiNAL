<?php
// mysql connection
require_once 'db.php';
$query = "SELECT * FROM `students`";

$results = mysqli_query($conn, $query);
$records = mysqli_num_rows($results);
$msg = "";
if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
    $alert_msg = ($msg == "add") ? "Jauns lietotajs pievienots!" : (($msg == "del") ? "Veiksmigi dzests!" : "Veiksmigi atjaunots!");
} else {
    $alert_msg = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';?>
<body>
   <?php include 'nav.php';?>
    <div class="container">
<?php if (!empty($alert_msg)) {?>
        <div class="alert alert-success"><?php echo $alert_msg; ?></div>
<?php }?>
    <div class="info"></div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Vards</th>
                <th scope="col">Dzimums</th>
                <th scope="col">Epasts</th>
                <th scope="col">Kurss</th>

                </tr>
            </thead>
            <tbody>
                <?php
if (!empty($records)) {
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                                    <td><?php echo $row['gender']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['course']; ?></td>
                                    <td>
                                        <a href="/finals/add.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Labot</a>
                                        <a href="/finals/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onClick="javascript:return confirm('Tiesam velies dzest?');" >Dzest</a>
                                    </td>
                                </tr>

                            <?php
}
}
?>



            </tbody>
        </table>
    </div>
</body>
</html>