<?php
    //Open Connection to db
    require 'include/db.php';

    $table = 'recipe';

// SEARCH
    if(isset($_POST['submit'])){
        $search = htmlspecialchars($_POST['search']);

        // print_r($search);
        
        $query = "SELECT * FROM {$table} WHERE title LIKE '%{$search}%' OR subtitle LIKE '%{$search}%'";
        $result = mysqli_query($connection, $query);
        
        // print_r($result);

        if( !$result ){
            die('Search query failed.');
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
    <title>Recipe</title>
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
        <form class="search_form" action="index.php" method="POST">
            <input type="text" name="search"  placeholder="Search.." id="search_bar"hidden>
            <input type="submit" name="submit" value="Submit" id="submit" hidden>
        </form>
        
        <?php
        // Get ID 

        $id = $_GET['id'];

        // Query the ID

        $table = 'recipe';
        $query = "SELECT * FROM {$table} WHERE id={$id}";
        $result = mysqli_query($connection, $query);

        // Error Check

        if( !$result ){
            die('Database query failed.');
        }else{
            $row = mysqli_fetch_assoc($result);
            // print_r($row);
        }

        // Extract record assoiated with ID

        ?>

        


        <main>
            <div id="header">
                <div id="headerImg">
                    <img src="img/<?php echo $row['main_img'];?>" alt="<?php echo $row['title'];?>">
                </div>
                <h1><?php echo $row['title'];?></h1>
                <h2><?php echo $row['subtitle']?></h2>
                <h4><?php echo $row['servings'];?> servings   | |   <?php echo $row['cal_per_serving'];?> calories</h4>
            </div>
            <div id="ingredients">
                <img src="img/<?php echo $row['ingredients_img'];?>" alt="<?php echo $row['title'];?> Ingrdients">
                <ul>

                    <?php
                    
                    $ingStr = $row['all_ingredients'];
                    // echo $ingStr

                    //Convert String to Array

                    $ingArray = explode("*", $ingStr);
                    // print_r($ingArray)

                    for($lp = 0; $lp < count($ingArray); $lp++){
                        $ing = $ingArray[$lp];
                        echo "<li>" . $ing . "</li>";
                    }

                    ?>
                </ul>

            </div>
            <div id="body">

                <!--Clean up the code of the loop for steps-->

                <?php
                
                function stepToWord($num)
                    {
                        switch ($num)
                        {
                            case "1":
                                return "one";
                            case "2":
                                return "two";
                            case "3":
                                return "three";
                            case "4":
                                return "four";
                            case "5":
                                return "five";
                            case "6":
                                return "six";
                            break;
                        }
                }

                $stepStr = $row['all_steps'];
                $stepImgStr = $row['step_imgs'];

                //Convert String to Array

                $stepArray = explode("*", $stepStr);
                $stepImgArray = explode("*", $stepImgStr);
                // print_r($stepArray);
                // echo "<br>";
                // print_r($stepImgArray);


                for($lp = 0; $lp < count($stepImgArray); $lp++){
                    $stepImg = $stepImgArray[$lp];
                    $cnt = $lp;

                    if($cnt > 0){
                        $cnt += $lp;
                    }

                    $stepHead = substr($stepArray[$cnt], 2);
                    $stepNum = $stepArray[$cnt][0];

                    $stepNumWord = stepToWord($stepNum);

                    echo "
                    <div class=\"step\" id=\"" . $stepNumWord . "\">
                        <div class=\"step_head\"> 
                            <h3>" . $stepNum . "</h3>
                            <h4>" . $stepHead . "</h4>
                            <img src=\"img/" . $stepImg . "\" alt=\"Step Img\">
                        </div>
                        <p>" . $stepArray[$cnt + 1] . "</p> 
                    </div>";
                   
                    
                }

                ?>
                
                <!-- <div id="old">
                    <div class="step" id="one">
                        <div class="step_head">
                            <h3>1</h3>
                            <h4>Prepare the ingredients</h4>
                            <img src="img/0101_FPV_Broccoli-Mozzarella-Calzones_18498_WEB_retina_feature.jpg" alt="Step 1">
                        </div>
                        <p>Remove the <b>dough</b> from the refrigerator to bring to room temperature. Place an oven rack in the center of the oven, then preheat to 475°F. Wash and dry the fresh produce. Cut off and discard the bottom 1/2 inch of the broccoli stem, then roughly chop the <b>broccoli</b>. Peel and roughly chop the <b>garlic</b>. Tear the <b>mozzarella cheese</b> into small pieces. Quarter and deseed the <b>lemon</b>.</p>
                    </div>
                    <div class="step" id="two">
                        <div class="step_head">
                            <h3>2</h3>
                            <h4>Cook the broccoli & make the filling</h4>
                            <img src="img/0101_FPV_Broccoli-Mozzarella-Calzones_18532_WEB_retina_feature.jpg" alt="Step 2">
                        </div>
                        <p>In a large pan (nonstick, if you have one), heat 2 teaspoons of olive oil on medium-high until hot. Add the <b>chopped broccoli</b>; season with salt and pepper. Cook, stirring occasionally, 4 to 6 minutes, or until lightly browned. Add <b>2/3 of the chopped garlic</b>. Cook, stirring constantly, 30 seconds to 1 minute, or until fragrant. Add <b>1/4 cup of water</b>; season with salt and pepper. Cook, stirring occasionally, 2 to 3 minutes, or until the broccoli has softened and the water has cooked off. Transfer to a large bowl. Add the mozzarella cheese, ricotta cheese, half the Italian seasoning, and the juice of 1 lemon wedge; stir to combine. Season with salt and pepper.
                            Wipe out the pan.</p>
                    </div>
                    <div class="step" id="three">
                        <div class="step_head">
                            <h3>3</h3>
                            <h4>Assemble & bake the calzones</h4>
                            <img src="img/0101_FPV_Broccoli-Mozzarella-Calzones_18402_WEB_retina_feature.jpg" alt="Step 3">
                        </div>
                        <p>Lightly oil a sheet pan. Divide the <b>dough</b> into 2 equal-sized portions; using your hands and a rolling pin (or wine bottle), gently stretch and roll the portions into ¼-inch-thick rounds. (If the dough is resistant, let rest for 5 minutes.) Divide the <b>filling</b> between the centers of the rounds; fold each round in half over the filling. Using a fork, crimp the edges of the dough to seal. Transfer to the sheet pan. Using a fork, poke a few holes across the tops of the calzones to vent. Lightly drizzle the calzones with olive oil. Bake 16 to 18 minutes, or until golden brown. Transfer to a cutting board and let stand for at least 2 minutes.</p>
                    </div>
                    <div class="step" id="four">
                        <div class="step_head">
                            <h3>4</h3>
                            <h4>Prepare the remaining ingredients</h4>
                            <img src="img/0101_FPV_Broccoli-Mozzarella-Calzones_18410_WEB_retina_feature.jpg" alt="Step 4">
                        </div>
                        <p>While the calzones bake, using the flat side of your knife, smash the <b>olives</b>; remove and discard the pits, then roughly chop. Cut off and discard the root end of the <b>lettuce</b>; roughly chop the leaves. To make the dressing, in a large bowl, combine the <b>mayonnaise, half the parmesan cheese, the juice of the remaining lemon wedges</b>, and a drizzle of olive oil. Season with salt and pepper to taste.</p>
                    </div>
                    <div class="step" id="five">
                        <div class="step_head">
                            <h3>5</h3>
                            <h4></h4>
                            <img src="img/0101_FPV_Broccoli-Mozzarella-Calzones_18416_WEB_retina_feature.jpg" alt="Step 5">
                        </div>
                        <p>While the calzones continue to bake, in the pan used to cook the broccoli,heat 2 teaspoons of olive oil on medium-high until hot. Add the <b>remaining chopped garlic</b>; cook, stirring constantly, 30 seconds to 1 minute, or until fragrant. Add the <b>tomato sauce</b> and remaining <b>Italian seasoning</b>. Cook, stirring frequently, 2 to 3 minutes, or until slightly thickened. Turn off the heat and season with salt and pepper to taste.</p>
                    </div>
                    <div class="step" id="six">
                        <div class="step_head">
                            <h3>6</h3>
                            <h4>Make the salad & serve your dish</h4>
                            <img src="img/0101_FPV_Broccoli-Mozzarella-Calzones_18428_WEB_retina_feature.jpg" alt="Step 6">
                        </div>
                        <p>Just before serving, add the <b>chopped olives and lettuce</b> to the bowl of dressing. Toss to coat; season with salt and pepper to taste. Cut the <b>baked calzones</b> in half. Serve with the sauce and salad on the side. Garnish with the <b>remaining parmesan cheese</b>. Enjoy!</p>
                    </div>
                </div>
            </div> -->
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