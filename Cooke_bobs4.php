<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bob's Entertainment Universe - Customer Info</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js"></script>
    <script>
        $('.selectpicker').selectpicker();
    </script>
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
    //File: Cooke_bobs4.php
    //Programmer: Frank Cooke
    //Purpose: PHP script that handles the third form submission from the Cooke_bobs2.php file. This form extracts
    //the price and title info from each of the visitor's selected items and display's the total for each one selected

    //extract the data from the post in the previous form
    extract($_POST);

    //print the name of the department from the $department variable passed from the previous 2 forms
    printf("<div class='department'><p class='lead'>%s</p><hr></div>", $department);
    ?>
    <div class="items">
    <?php

    //loop through each selected item and concat each price, storing the total amount for each purchase
    //in the $total variable
    //print title and price info for visitor selections on page
    $total = 0;

    printf("<div class='total'>");
    if(isset($prices) && isset($titles)){
        for($i = 0; $i < count($prices); $i++){
            $count = $i + 1;
            $total += $prices[$i];
            printf("<p class='lead'><strong>$count: </strong> %s</p><p class='lead'>Price: $%s</p>", $titles[$i], $prices[$i]);
        }
    }
    //print the total amount on the page for the visitor
    printf("<h1 class=''>Your total: $%s", $total);
    printf("</div>");
    printf("<hr>");
    ?>
    <div class="final-form">
        <form class="form-horizontal" action="Cooke_bobs5.php" method="POST">
            <?php
            //loops to carry price and title array data to the next page
            foreach($prices as $val){
                ?>
                <input type="hidden" name="prices[]" value="<?php echo $val; ?>">
                <?php
            }
            ?>
            <?php
            foreach($titles as $val){
                ?>
                <input type="hidden" name="titles[]" value="<?php echo $val; ?>">
                <?php
            }
            ?>
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <fieldset>
                <div class="user-name">
                    <div class="form-group ">
                        <label class="control-label col-sm-4" for="fullname">Your Fullname:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="fullname" placeholder="Full Name" name="fullname">
                        </div>
                    </div>
                </div>
                <div class="address">
                    <div class="form-group ">
                        <label class="control-label col-sm-4" for="address">Your Address:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="address" placeholder="Address" name="address">
                        </div>
                    </div>
                </div>
                <div class="form-group card-type text-left">
                    <label class="control-label col-sm-4" for="cardType">Card Type: </label>
                    <div class="col-sm-8">
                        <select class="selectpicker show-tick" multiple title="Card Type" data-max-options="1" name="cardType" id="cardType">
                            <option>Visa</option>
                            <option>American Express</option>
                            <option>MasterCard</option>
                        </select>
                    </div>
                </div>
                <div class="card-number">
                    <div class="form-group ">
                        <label class="control-label col-sm-4" for="cardNumber">Card Number:</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="cardNumber" placeholder="Card Number" name="cardNumber">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <div class="form-group">
                        <div class="form-actions">
                            <div class="col-xs-12">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Save changes</button>
                                <button type="reset" value="clear" class="btn" name="reset">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div
</div>
</div>
</body>
</html>