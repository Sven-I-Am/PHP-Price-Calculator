<?php require 'includes/header.php';
if (!empty($_SESSION)){
    $currentCustomer = $_SESSION['customer'];
    $currentProduct = $_SESSION['product'];
}?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <form method="post">
        <div class="row">
            <div class="col">
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
            </div>
            <div class="col">
                <select name="product">
                    <?php
                    if (!empty($_SESSION["product"])){?>
                        <option value="<?php echo $currentProduct; ?>"><?php echo $showProduct->getName(); ?></option>
                    <?php } else { ?>
                        <option>--Select your product here--</option>
                    <?php }
                    ?>
                    <?php foreach ($products as $product){
                        echo "<option value='".$product["id"]."'>".$product["name"]." ".number_format($product["price"]/100, 2)."€</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row" id="submit">
            <button type="submit"> submit here </button>
        </div>
    </form>
</section>
<section class="calculation">
    <?php
    if (!empty($_POST)){?>
        <div>
            <h1>Welcome, <?php echo $showCustomer->getFullName();?></h1>
            <h2>Below you can find the price calculation for your chosen product:</h2>
        </div>
        <div class="calcTable">
            <table>
                <tr>
                    <th>Productname</th>
                    <th><?php echo $showProduct->getName();?></th>
                </tr>
                <tr>
                    <td>Original Price</td>
                    <td class="price"> <?php echo $showProduct->getPrice(); ?>&euro;</td>
                </tr>
                <tr>
                    <th>Fixed discounts</th>
                </tr>
                <tr>
                    <td>Personal Fixed discount</td>
                    <td class="price disc">-<?php echo $showCustomer->getFixedDiscount(); ?>&euro;</td>
                </tr>
                <tr>
                    <td>Group Fixed discount</td>
                    <td class="price disc">-<?php echo $showGroup->getFixedDiscount(); ?>&euro;</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td class="price subTotal"><?php
                        $subtotal = $showProduct->getPrice()-$showCustomer->getFixedDiscount()-$showGroup->getFixedDiscount();
                        if ($subtotal < 0) {
                            $subtotal = 0;
                        }
                        echo $subtotal;  ?>&euro;</td>
                </tr>
                <tr>
                    <th>Highest variable discount</th>
                </tr>
                <tr>
                    <?php
                    if ($showCustomer->getVarDiscount()>$showGroup->getVarDiscount()){
                        echo "<td>Personal Variable discount (".$showCustomer->getVarDiscount()."%)</td>";
                        echo "<td class='price disc'>-" . $subtotal*$showCustomer->getVarDiscount()/100 . "&euro;</td>";
                    } else {
                        echo "<td>Group Variable discount (".$showGroup->getVarDiscount()."%)</td>";
                        echo "<td class='price disc'>-" . $subtotal*$showGroup->getVarDiscount()/100 . "&euro;</td>";
                    }
                        ?>
                </tr>
                <tr>
                    <td>Final price</td>
                    <td class="price disc subTotal"><?php echo $finalPrice;  ?>&euro;</td>
                </tr>




            </table>
        </div>
    <?php
    } ?>
</section>


<?php require 'includes/footer.php'?>