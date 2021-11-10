<?php require 'includes/header.php';
if (!empty($_SESSION)){
    $currentCustomer = $_SESSION['customer'];
    $currentProduct = $_SESSION['product'];
}?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <form method="post">
        <select name="customer">
            <?php
            if (!empty($_SESSION["customer"])){?>
                <option value="<?php echo $currentCustomer; ?>"><?php echo $showCustomer->getFullName(); ?></option>
            <?php } else { ?>
                <option>--Select your customer here--</option>
            <?php }
            ?>

            <?php
            foreach ($customers as $customer){
                echo "<option value='".$customer["id"]."'>".$customer["lastname"]." ".$customer["firstname"]."</option>";
            }

            echo $customers[0]["firstname"]
            ?>
        </select>
        <select name="product">
            <?php
            if (!empty($_SESSION["product"])){?>
                <option value="<?php echo $currentProduct; ?>"><?php echo $showProduct->getName(); ?></option>
            <?php } else { ?>
                <option>--Select your customer here--</option>
            <?php }
            ?>
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
                <td class="price"> <?php echo $showProduct->getPrice(); ?>&euro;</td>
            </tr>
            <?php if($showCustomer->getFixedDiscount() !=NULL){ ?>
                <tr>
                    <td>Personal Fixed discount</td>
                    <td class="price"> <?php echo $showCustomer->getFixedDiscount(); ?>&euro;</td>
                </tr>
            <?php }
            if($showCustomer->getVarDiscount() !=NULL){ ?>
                <tr>
                    <td>Personal Variable discount</td>
                    <td class="price"><?php echo $showCustomer->getVarDiscount(); ?> %</td>
                </tr>
            <?php }?>
            <tr>

                <td>New Price</td>
                <td><?php echo $finalPrice; ?>&euro;</td>
            </tr>



        </table>
    <?php }

    ?>
</section>


<?php require 'includes/footer.php'?>