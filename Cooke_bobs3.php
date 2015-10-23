<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bob’s Entertainment Universe - Selected Department Items</title>
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
    //File: Cooke_bobs3.php
    //Programmer: Frank Cooke
    //Purpose: PHP script that handles the second form filled out by the visitor. This script query the database for more info
    //on items specifically selected by the visitor

    //extract data from the form submission in the Cooke_bobs1.php file
    extract($_POST);

    //print the name of the department which the visitor has selected on the top of the page
    printf("<div class='department'><p class='lead'>Your Selection(s) From: %s</p><hr></div>", $department);
    ?>
    <form class='form-horizontal' action='Cooke_bobs4.php' method='POST'>
        <input type="hidden" name="department" value="<?php echo $department; ?>"
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php

                    //store the database connection info in a variable
                    $link = mysqli_connect("localhost", "root", "g@ryH0st", "cpt283db");

                    //conditional to handle any errors when connecting to the database
                    if(!$link){
                        die("Could not connect: error " . mysqli_connect_errno() . mysqli_connect_error());
                    }

                    //conditional that first checks to see if the $options array has data
                    if(isset($options)) {

                    //if $options is set, loops through each index, query the database for each selected item, and creates a horizontal listing of each visitor
                    //selected item with info on each item
                    foreach($options as $val) {
                        $query = "SELECT entertainerauthor, title, UnitPrice, UnitsInStock, summary FROM products, prodinv WHERE products.id = prodinv.id AND products.id = '$val' ORDER BY entertainerauthor";
                        $result_set = mysqli_query($link, $query);
                        $row = mysqli_fetch_assoc($result_set);

                        $entertainer_author = $row['entertainerauthor'];
                        $title = $row['title'];
                        $price = $row['UnitPrice'];
                        $total_units = $row['UnitsInStock'];
                        $summary = $row['summary'];

                        printf("<div class='col-md-4'>");
                        printf("<div class='form-group'>");
                        printf("<label class='checkbox-inline'>");
                        ?>
                        <input type="checkbox" name="prices[]" value="<?php print $price; ?>">
                        <input type="hidden" name="titles[]" value="<?php echo $title; ?>">
                        <?php
                        printf("ID: %s</label>", $val);
                        printf("<p class='help-block'><strong>Entertainer/Author: </strong>%s</p>", $entertainer_author);
                        printf("<p class='help-block'><strong>Title: </strong>%s</p>", $title);
                        printf("<p class='help-block'><strong>Price: </strong>%s</p>", $price);
                        printf("<p class='help-block'><strong>Available Units: </strong>%s</p>", $total_units);
                        printf("<p class='help-block summary'><strong>Summary: </strong>%s</p>", $summary);
                        printf("</div></div>");

                    }

                    //close the connection to the database
                    mysqli_close ($link);
                    ?>

                </div>
            </div>
            <?php
            printf("<h3 class='intro'>This is the last chance to accept/reject any of your choices...</h3>");
            ?>
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
        </div>
    </form>
<?php

}else {
    printf("<h2 class='intro'>It looks like you didn't select anything.</h2>");
    printf("<p class='lead intro'>Please hit the back button if you want more information on a product(s).</p>");
}
?>
</div>
</body>
</html>

