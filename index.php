<?php
    //Open Connection to db
    require 'include/db.php';

    $table = 'recipe';

//FILTER
    
    $filter = $_GET['filter'];

// SEARCH
    if(isset($_POST['submit'])){
        $search = htmlspecialchars($_POST['search']);

        // print_r($search);
        
        $query = "SELECT * FROM {$table} WHERE title LIKE '%{$search}%' OR subtitle LIKE '%{$search}%' OR servings LIKE '%{$search}%' OR protein LIKE '%{$search}%' OR cal_per_serving LIKE '%{$search}%' OR all_ingredients LIKE '%{$search}%'";
        $result = mysqli_query($connection, $query);
        
        // print_r($result);

        if( !$result ){
            die('Search query failed.');
        }
    }else if(isset($filter)){

        if($filter == "600"){
            $query = "SELECT * FROM {$table} WHERE cal_per_serving < '600'";
        }else if($filter == "800"){
            $query = "SELECT * FROM {$table} WHERE cal_per_serving < '800' AND cal_per_serving > '601'";
        }else if($filter == "999"){
            $query = "SELECT * FROM {$table} WHERE cal_per_serving < '999' AND cal_per_serving > '801'";
        }else{
            $query = "SELECT * FROM {$table} WHERE protein LIKE '%{$filter}%' OR servings LIKE '%{$filter}%'";
        }
        $result = mysqli_query($connection, $query);
        
        // print_r($result);

        if( !$result ){
            die('Filter query failed.');
        }

    }else{
        
        $query = "SELECT * FROM {$table}";
        $result = mysqli_query($connection, $query);

        // Error Check

        if( !$result ){
            die('Database query failed.');
        }
    }

    //DB Table query

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Chef</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="#top"></a>
    <div class="contain">
        <div id="head">
            <header>
                <div id="logo">
                    <a href="index.php"><img src="img/logo.svg" alt="logo"></a>
                </div>
                <a href="#top"><h1 id="name">Home Chef</h1></a>
                <div id="search">
                    <div id="search_b"><img src="img/search.png" alt="search"></div>
                </div>
            </header>
        </div>
        <!--look into why this isnt working-->
        <form class="search_form" action="index.php" method="POST">
            <input type="text" name="search"  placeholder="Search.." id="search_bar"hidden>
            <input type="submit" name="submit" value="Submit" id="submit" hidden>
        </form>

        <div id="buttons">
            <div id="help">
                <div class="quest" id="quest"><img src="img/help.png" alt="help"></div>

                <div id="info" hidden>
                    <div class="top">
                        <h1 class="quest">x</h1>
                        <h1 class="top_h">Help</h1>
                    </div>
                    <div class="info_p">
                        <p>Browse through recipes, use the filter, or search for a specific name. Find your next perfect meal!
                        </p>
                        <p>Filter by including or excluding certain ingredients by selecting the check mark or the cross out respectively. Find your next meal through moods or needs.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <main>
            <div class="container">              
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Filter
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                        <a class="test" tabindex="-1" href="#">by Protein <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?filter=Chicken">Chicken</a></li>
                            <li><a href="index.php?filter=Beef">Beef</a></li>
                            <li><a href="index.php?filter=Pork">Pork</a></li>
                            <li><a href="index.php?filter=Turkey">Turkey</a></li>
                            <li><a href="index.php?filter=Fish">Seafood</a></li>
                            <li><a href="index.php?filter=Vegitarian">Vegitarian</a></li>
                        </ul>
                        </li>
                        <li class="dropdown-submenu">
                        <a class="test" tabindex="-1" href="#">by Calories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?filter=600">600 & Under</a></li>
                            <li><a href="index.php?filter=800">601 - 800 Cal</a></li>
                            <li><a href="index.php?filter=999">801 & Over</a></li>
                        </ul>
                        </li>
                        <li class="dropdown-submenu">
                        <a class="test" tabindex="-1" href="#">by Servings <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?filter=2">2 Servings</a></li>
                            <li><a href="index.php?filter=4">4 Servings</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
                if(isset($_POST['submit'])){

                    if ($result->num_rows==0){
                        echo "<h2 class=\"resultH\">No recipes found</h2>";
                    }else{
                        echo "<h2 class=\"resultH\">Result(s)</h2>";
                    }
                    

                }else if(isset($filter)){
                    if($filter == "600"){
                        echo "<h2 class=\"resultH\">600 Cal & Under Result(s)</h2>";
                    }else if($filter == "800"){
                        echo "<h2 class=\"resultH\">601 Cal - 800 Cal Result(s)</h2>";
                    }else if($filter == "999"){
                        echo "<h2 class=\"resultH\">801 Cal & Over Result(s)</h2>";
                    }else if($filter == "Fish")
                    {
                        echo "<h2 class=\"resultH\"> Seafood Filter Result(s)</h2>";
                    }else if($filter == "2" || $filter =="4"){
                        echo "<h2 class=\"resultH\">".$filter." Servings Filter Result(s)</h2>";
                    }else{
                        echo "<h2 class=\"resultH\">".$filter." Filter Result(s)</h2>";
                    }
                }else{
                    echo "<h2 class=\"resultH\">All Recipes</h2>";
                }
            ?>
            
            <div class="preview">

            <?php
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <figure>
                    <!-- <a href="recipe.php"> -->

                    <?php
                        $id = $row['id'];

                        echo "<a href=\"recipe.php?id={$id}\">";
                    ?>
                            <img src="img/<?php echo $row['main_img'];?>" alt="<?php echo $row['title'];?>">
                            <figcaption>
                                <h2><?php echo $row['title'];?></h2>
                                <h3><?php echo $row['subtitle'];?></h3>
                                </a>
                                <h4><?php echo $row['servings'];?> servings   | |   <?php echo $row['cal_per_serving'];?> calories</h4>
                            </figcaption>
                </figure>
                
            <?php    
                } //end of while loop 

                // Release return data
                mysqli_free_result($result);
                // Close database connection
                mysqli_close($connection);
            ?>
            </div>
        </main>
        <!-- <footer>
            <a href="index.php">Home</a>
            <a href="alpha/index.html">Wireframe & Style Tile</a>
            <a href="alpha/static/index.html">Static Page</a>
            <a href="recipe.php">Recipe</a>
        </footer> -->
    </div>
    <script src="java.js"></script>
    <script>
        $(document).ready(function(){

            $('.dropdown-submenu a.test').on("click", function(e){
            if($(this).next('ul').is(':visible')){ //if dropdown click again, it closes the drop down.
                $('.dropdown-submenu ul:visible').toggle();
                $(this).next('ul').hide();
                
            }else{ // closes all dropdown that are visible and only shows the one clicked
                $('.dropdown-submenu ul:visible').toggle();
                $(this).next('ul').show();
            }
            e.stopPropagation();
            e.preventDefault();
            });

            // $('.dropdown-submenu a.test').on("blur", function(e){ //if user closes filter closes all the menu options that were open and visible
            // $('.dropdown-submenu ul:visible').hide();
            // });

        });
    </script>
</body>
</html>