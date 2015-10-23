<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bob's Entertainment Universe - Customer Receipt</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js"></script>
    <script>
        $('.selectpicker').selectpicker();
    </script>
</head>
<body>
    <div class="title">
        <h1>Bob’s Entertainment Universe</h1>
    </div>
    <div class="container">
        <?php
        //File: Cooke_bobs5.php
        //Programmer: Frank Cooke
        //Purpose: PHP script that handles the fourth form submission. This form extracts uses the visitor selection data from the
            //previous form to create a printable receipt for the visitor

        //extract the data from the post in the previous form
        extract($_POST);

        //convert card number to string and store the last 4 digits in a variable
        $number = substr("$cardNumber", -4);

        //conditional to validate card number being exactly 16 digits
        if(strlen("$cardNumber") == 16){
            //print receipt data to the page
            printf("<h3 class='intro text-center'>Thank you for your purchase!</h3>");
            printf("<h3 class='intro text-center'>Your card has been approved and your printable receipt is below.</h3>");
            printf("<div class='receipt'>");
            printf("<p><strong>Customer Name:</strong> %s</p>", $fullname);
            printf("<p><strong>Address:</strong> %s</p>", $address);
            printf("<p><strong>Card Type:</strong> %s</p>", $cardType);
            printf("<p><strong>Card Number:</strong> XXXX-XXXX-XXXX-%s</p>", $number);
            printf("<hr class='receipt-line'>");
            printf("<p class='text-center'><strong>Products:</strong></p>");

            //loop through the prices and titles array and print data to page
            for($i = 0; $i < count($prices); $i++){
                printf("<p><strong>Item:</strong> %s <strong>Price:</strong> $%s</p>", $titles[$i], $prices[$i]);
            }
            printf("<p class='text-center'><strong>Total Cost: $%s</strong></p>", $total);
            printf("</div>");

            //anchor to take the visitor back to the departments page
            printf("<div class='text-center final-btn'><a class='btn btn-primary btn-lg' href='Cooke_bobs1.php'>Back To Departments</a></div>");
        }else {
            printf("<h2 class='intro'>The Credit Card number needs to be 16 digits. Please input a valid card number.");
        }
        ?>
    </div>
</body>
</html>