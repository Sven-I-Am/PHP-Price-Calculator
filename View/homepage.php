<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <form>
        <select>
            <?php
            foreach ($customers as $customer){
                echo "<option value='".$customer["id"]."'>".$customer["lastname"]." ".$customer["firstname"]."</option>";
            }

            echo $customers[0]["firstname"]
            ?>
        </select>
        <select>
            <?php foreach ($products as $product){
                echo "<option value='".$product["id"]."'>".$product["name"]." ".number_format($product["price"]/100, 2)."€</option>";
            }
            ?>
        </select>
        <button type="submit"> submit here </button>
    </form>
</section>


<?php require 'includes/footer.php'?>