<?php
    //Open Connection to db
    require 'include/db.php';

    $table = 'recipe';
//FILTER
    
    $filter = $_GET['filter'];




// SEARCH
    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        // print_r($search);
        
        $query = "SELECT * FROM {$table} WHERE title LIKE '%{$search}%' OR subtitle LIKE '%{$search}%'";
        $result = mysqli_query($connection, $query);
        
        // print_r($result);

        if( !$result ){
            die('Search query failed.');
        }
    }else if(isset($filter)){
        
        $query = "SELECT * FROM {$table} WHERE proteine LIKE '%{$filter}%'";
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
        <form class="search_form" action="index.php" method="post">
            <input id="search_bar" type="text" placeholder="Search.." hidden>
        </form>

        <div id="buttons">
            <div id="filter">
                <!-- <div class="filter_b" id="filter_b"><img src="img/filter.png" alt="filter"></div> -->

                <div id="fill">
                    <div class="top">
                        <!-- s -->
                        <h1 class="top_h">Filter</h1>
                    </div>
                    <div class="cat">
                        <div id="cat1">
                            <h2>Proteins</h2>
                            <ul>
                                <li>
                                    <a href="index.php?filter=Chicken"><button>Chicken</button></a>
                                </li>
                                <li>
                                    <a href="index.php?filter=Beef"><button>Beef</button></a>
                                </li>
                                <li>
                                    <a href="index.php?filter=Pork"><button>Pork</button></a>
                                </li>
                                <li>
                                    <a href="index.php?filter=Turkey"><button>Turkey</button></a>
                                </li>
                                <li>
                                    <a href="index.php?filter=Fish"><button>Fish</button></a>
                                </li>
                            </ul>
                        </div>
                        <div id="cat2">
                            <h2>Vegtables</h2>
                        <ul>
                            <li>
                                <a href=""><button>Carrot</button></a>
                            </li>
                            <li>
                                <a href=""><button>Broccoli</button></a>
                            </li>
                            <li>
                                <a href=""><button>Tomato</button></a>
                            </li>
                            <li>
                                <a href=""><button>Spinach</button></a>
                            </li>
                            <li>
                                <a href=""><button>Corn</button></a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
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
            <?php
                if(isset($_POST['submit'])){

                    if ($result->num_rows==0){
                        echo "<h2 class=\"resultH\">No recipes found</h2>";
                    }else{
                        echo "<h2 class=\"resultH\">Result(s)</h2>";
                    }
                    

                }else if(isset($filter)){
                    echo "<h2 class=\"resultH\">".$filter." Filter Result(s)</h2>";
                }else{
                    echo "<h2 class=\"resultH\">All Recipe</h2>";
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
                        </figcaption>
                    </a>
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
</body>
</html>