<?php
foreach ($items as $key => $row) {
    if ($row['user_currency'] == "&#0128;") {
        $currency3 = "€";
    }
    if ($row['user_currency'] == "&#163;") {
        $currency3 = "£";
    }
    if ($row['user_currency'] == NULL) {
        $currency3 = "£";
    }
    if ($row['user_currency'] == "$") {
        $currency3 = "$";
    }
    ?>
    {"value":"<?= $row['firstname'] ?> <?= $row['lastname'] ?> (<?= $row['company_name'] ?>)","id":<?= $row['user_id'] ?>, "company":"<?= $row['company_name'] ?>", "currency":"<?= $currency3 ?>", "interestrate":"<?= $row['user_interestrate'] ?>", "initial":"<?= $row['user_initial'] ?>", "regular":"<?= $row['user_regular'] ?>"},
    <?php
}
?>