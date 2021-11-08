<?php require 'includes/header.php';
 require 'env.php'?>

<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <form>
        <section>
            <select name="select">
                <?php //todo: logica voor dropdown?>
            </select>

        </section>

    </form>

    <h4>Hello <?php echo $customer->getFullName()?>,</h4>

    <p><a href="index.php?page=info">To info page</a></p>

    <?php

    class TableRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }

        function current() {
            return "<option>" . parent::current(). "</option>";
        }
    }

    $servername = $server;
    $username = $login;
    $password = $pass;
    $dbname = $db;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT firstname, lastname FROM Customer");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
            echo $v;
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
    ?>
</section>
<?php require 'includes/footer.php'?>