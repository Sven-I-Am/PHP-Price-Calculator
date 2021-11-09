<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <form method="post">
        <select name="customer">
            <option>--Select your customer here--</option>
            <?php
            foreach ($customers as $customer){
                echo "<option value='".$customer["id"]."'>".$customer["lastname"]." ".$customer["firstname"]."</option>";
            }

            echo $customers[0]["firstname"]
            ?>
        </select>
        <select name="product">
            <option>--Select your product here--</option>
            <?php foreach ($products as $product){
                echo "<option value='".$product["id"]."'>".$product["name"]." ".number_format($product["price"]/100, 2)."€</option>";
            }
            ?>
        </select>
        <button type="submit"> submit here </button>
    </form>
</section>
<section>
    <?php
    if (!empty($_POST)){?>
        <h1>Welcome, <?php echo $showCustomer->getFullName();?></h1>
        <h2>Below you can find the price calculation for your chosen product: <?php echo $showProduct->getName(); ?></h2>
        <table>
            <tr>
                <td>Original Price</td>
                <td>&euro; <?php echo $showProduct->getPrice(); ?></td>
            </tr>
            <?php if($showCustomer->getFixedDiscount() !=NULL){ ?>
                <tr>
                    <td>Personal Fixed discount</td>
                    <td>&euro; <?php echo $showCustomer->getFixedDiscount(); ?></td>
                </tr>
            <?php }
            if($showCustomer->getVarDiscount() !=NULL){ ?>
                <tr>
                    <td>Personal Variable discount</td>
                    <td><?php echo $showCustomer->getVarDiscount(); ?> %</td>
                </tr>
            <tr>
                <td>New Price</td>
                <td><?php echo $finalPrice; ?></td>
            </tr>
            <?php }?>

        </table>
    <?php }
    ?>
</section>


<?php require 'includes/footer.php'?>