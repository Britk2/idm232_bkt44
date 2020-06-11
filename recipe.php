<?php
    //Open Connection to db
    require 'include/db.php';

    $table = 'recipe';

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
    }else{
        
        $query = "SELECT * FROM {$table}";
        $result = mysqli_query($connection, $query);

        // Error Check

        if( !$result ){
            die('Database query failed.');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Chef: Recipe</title>
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
        ?>

        <main>
            <div id="header">
                <div id="headerImg">
                    <img src="img/<?php echo $row['main_img'];?>" alt="<?php echo $row['title'];?>">
                </div>
                <h1><?php echo $row['title'];?></h1>
                <h2><?php echo $row['subtitle']?></h2>
                <h4><?php echo $row['servings'];?> servings   | |   <?php echo $row['cal_per_serving'];?> calories</h4>
                <p id="desc"><?php echo $row['description']?></p>
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

                // Release return data
                mysqli_free_result($result);
                // Close database connection
                mysqli_close($connection);
                ?>
            </div>
        </main>
    <script src="java.js"></script>
</body>
<footer>
    
</footer>
</html>