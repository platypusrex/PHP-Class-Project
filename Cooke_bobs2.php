<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bob's Entertainment Universe - Department Items</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        hr {
            height: 30px;
            border-style: solid;
            border-color: #8c8b8b;
            border-width: 1px 0 0 0;
            border-radius: 20px;
            margin-top: -0.6em;
            margin-bottom: 2em;
        }
        hr:before {
            display: block;
            content: "";
            height: 30px;
            margin-top: -31px;
            border-style: solid;
            border-color: #8c8b8b;
            border-width: 0 0 1px 0;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<div class="title">
    <h1>Bob’s Entertainment Universe</h1>
</div>
<div class="container">
    <?php
    //File: Cooke_bobs2.php
    //Programmer: Frank Cooke
    //Purpose: PHP script that handles initial form submission from visitor, checks for required department input, and list all
    //items available from that department in order of entertainer/author names

    //extract data from the input in the html form
    extract($_POST);

    //if statement to deal with the lack of required input, or else handles the successful submission of department
    //and handles database query
    if(!isset($department)){
        printf("<h2>You have not selected a Department.</h2>");
        printf("<p class='lead'>Please hit the back button and select a Department to see the items available for purchase.</p>");
    }else{
    //variable containing database connection specific info
    $link = mysqli_connect("localhost", "root", "noneyourbiz", "cpt283db");

    //if there is an error, kill the connection and alert the error number and error to the visitor
    if(!$link) {
        die("Could not connect: error " . mysqli_connect_errno() . mysqli_connect_error());
    }

    //store query in variable and database query result in variable as well
    $query = "SELECT ID, entertainerauthor, title, media, feature, image FROM products WHERE department = '$department' ORDER BY entertainerauthor";
    $result_set = mysqli_query($link, $query);

    //print the name of the visitor selected department on the page
    printf("<div class='department'><p class='lead'>%s</p><hr></div>", $department);
    ?>
    <form class='form-horizontal' action='Cooke_bobs3.php' method='POST'>
        <input type="hidden" name="department" value="<?php echo $department; ?>"
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php
                    //loop through each item in the selected department and create horizontal display of all results
                    while($row = mysqli_fetch_assoc($result_set)){
                        $id = $row['ID'];
                        $entertainer_author = $row['entertainerauthor'];
                        $title = $row['title'];
                        $media = $row['media'];
                        $feature = $row['feature'];
                        $image = $row['image'];

                        printf("<div class='col-md-4'>");
                        printf("<div class='form-group'>");
                        printf("<label class='checkbox-inline'>");
                        ?>
                        <input type="checkbox" name="options[]" value="<?php print $id;?>">
                        <?php
                        printf("ID: %s</label>", $id);
                        printf("<p class='help-block'><strong>Entertainer/Author: </strong>%s</p>", $entertainer_author);
                        printf("<p class='help-block'><strong>Title: </strong>%s</p>", $title);
                        printf("<p class='help-block'><strong>Media: </strong>%s</p>", $media);
                        printf("<p class='help-block'><strong>Feature: </strong>%s</p>", $feature);
                        printf("</div></div>");
                    }
                    //close the connection to the database
                    mysqli_close ($link);
                    ?>
                </div>
            </div>
            <div class="container buttons">
                <div class="form-group">
                    <div class="form-actions">
                        <div class="col-xs-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" value="clear" class="btn" name="reset">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </form>
</div>
</body>
</html>
