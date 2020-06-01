<?php
    //Open Connection to db
    require 'include/db.php';

    //DB Table query

    $table = 'recipe';
    $query = "SELECT * FROM {$table}";
    $result = mysqli_query($connection, $query);

    // Error Check

    if( !$result ){
        die('Database query failed.');
    }

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
        <input id="search_bar" type="text" placeholder="Search.." hidden>
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
                                    <a href=""><button>Chicken</button></a>
                                </li>
                                <li>
                                    <a href=""><button>Beef</button></a>
                                </li>
                                <li>
                                    <a href=""><button>Pork</button></a>
                                </li>
                                <li>
                                    <a href=""><button>Turkey</button></a>
                                </li>
                                <li>
                                    <a href=""><button>Fish</button></a>
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