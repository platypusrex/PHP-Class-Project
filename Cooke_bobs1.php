<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bob's Entertainment Universe - Departments</title>
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
    <h1>Bob's Entertainment Universe</h1>
</div>
<div class="container">
    <form class="form-horizontal" action="Cooke_bobs2.php" method="POST">
        <fieldset>
            <div class="container departments">
                <div class="form-group">
                    <p class="lead">Departments</p>
                    <hr>
                    <label class="control-label col-sm-2" for="department">Department: </label>
                    <div class="col-sm-4">
                        <select class="selectpicker show-tick" multiple title="Choose a Department..." data-max-options="1" data-live-search="true" name="department" id="department">
                            <?php
                            //File: Cooke_bobs1.php
                            //Programmer: Frank Cooke
                            //Purpose: PHP script that query the database and grabs all distinct departments from the products table

                            //store database connection data in variable
                            $link = mysqli_connect("localhost", "root", "noneyourbiz", "cpt283db");

                            //handle errors and alert visitor of any connection errors to the database
                            if(!$link) {
                                die("Could not connect: error " . mysqli_connect_errno() . mysqli_connect_error());
                            }

                            //store database query and query results in seperate variables
                            $query = "SELECT DISTINCT department FROM products ORDER BY department";
                            $result_set = mysqli_query($link, $query);

                            //loop through query results and print results to the page
                            while($row = mysqli_fetch_assoc($result_set)){
                                $department = $row['department'];
                                printf("<option>%s</option>", $department);
                            }
                            //close the connection to the database
                            mysqli_close ($link);
                            ?>
                        </select>
                        <p class="help-block">Required</p>
                    </div>
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
        </fieldset>
    </form>
</div>
</body>
</html>
