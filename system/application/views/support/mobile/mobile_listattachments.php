<?php     if ($bucket_contents) { ?>
<ul data-role="listview" data-inset="true">

 <li data-role="list-divider">
        Attachments
    </li>
    <?php

        foreach ($bucket_contents as $file):

            $fname = $file['name'];
            $size = $file['size'];
            $sizeMB = round($size / 1048576, 4);
            $timeadded = $file['time'];
            $timeadded = date('Y-m-d H:i:s', $timeadded);
            $furl = "http://" . $mainbucket . ".s3.amazonaws.com/" . $fname;

            if (strlen(strstr($fname, $bucket_name)) > 0) {
                //output a link to the file
                $filename = str_replace($bucket_name . "/", "", $fname);
                ?>

                <li>

                    <a href="<?= $furl ?>"><?= $filename ?></a>

                </li>


            <?php
            }
        endforeach;
    
    ?>

</ul>

<?php } ?>