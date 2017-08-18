<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 18.08.2017 14:30
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
</head>
<body>
<div class="container">

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default panel-table">
            <div class="panel-heading">Dropbox</div>
            <div class="panel-body">
                <form method="post" action="/download.php" enctype="multipart/form-data">
                    <table class="table table-striped table-bordered table-list">
                        <tbody>

                        <?php

                        /** @var Kunnu\Dropbox\Models\FileMetadata $element */
                        foreach ($list as $element):
                            print "<tr>\n";
                            print "<td><input type='checkbox' name='download[]' value='{$element->getPathDisplay()}'></td>\n";
                            print "<td>{$element->getPathDisplay()}</td>";
                            print "</tr>\n";
                        endforeach;

                        ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <input type="submit" name="Submit" value="Скачать" class="btn btn-primary">
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</body>
</html>
