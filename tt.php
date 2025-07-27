<?php
include 'conn.php';

$mybooks_result = mysqli_query($conn, "SELECT * FROM `books`");
$c = 0
?>
<?php for ($i = $c; $i < mysqli_num_rows($mybooks_result); $i++) {
        $row = mysqli_fetch_assoc($mybooks_result);
?>
        <li>
            <?php echo $row["id"]; ?>
        </li>
<?php } ?>
