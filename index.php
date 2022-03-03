<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recursive</title>
</head>
<body>
    <?php
    
    ?>
    <!-- Test -->
    <h3>Example</h3>
    <nav>
        <ul>
            <li>
                Parent1
                <ul>
                    <li>Child 1</li>
                    <li>Child 2</li>
                </ul>
            </li>
            <li>Parent2</li>
            <li>Parent3</li>
        </ul>
    </nav>

    <!-- Database -->
    <h3>Database</h3>
    <?php
        function menu($parent) {
            try {
                $database = new PDO('mysql:host=localhost;dbname=test_recursive', 'root', '');
                echo '<i>Database connected</i><br>';
                
                if(is_null($parent)) {
                    $sql = "SELECT * FROM _recursive R WHERE id_parent is null;";
                } else {
                    $sql = "SELECT * FROM _recursive R WHERE id_parent = $parent;";
                }
                $request = $database->query($sql);
                $categories = $request->fetchAll(PDO::FETCH_OBJ);

                echo '<ul>';
                foreach($categories as $categorie) { 
                    if(menu($parent)) {
                        echo"<li>$categorie->nom</li>";
                    }
                echo '</ul>';
                }
            }
            catch (PDOException $e) {
                echo "<i>Erreur !: " . $e->getMessage() . "</i><br/>";
                die();
            }
        }
    ?>
</body>
</html>