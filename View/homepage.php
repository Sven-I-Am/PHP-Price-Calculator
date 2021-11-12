<?php require 'includes/header.php';
if (!empty($_SESSION)){
    $currentCustomer = $_SESSION['customer'];
    $currentProduct = $_SESSION['product'];
}?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <form method="get">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                Show only products:
                <ul>
                    <li>
                        <label class="category">
                            <input type="checkbox" value="" name="low" <?php if (isset($_GET["low"])){ echo "checked";}?>>Below 25&euro;
                        </label>
                    </li>
                    <li>
                        <label class="category">
                            <input type="checkbox" value="" name="med" <?php if (isset($_GET["med"])){ echo "checked";}?>>Between 25&euro; and 75&euro;
                        </label>
                    </li>
                    <li>
                        <label class="category">
                            <input type="checkbox" value="" name="high" <?php if (isset($_GET["high"])){ echo "checked";}?>>Above 75&euro;
                        </label>
                    </li>

                </ul>

            <button type="submit"  class="btn btn-primary rounded-pill">Select</button>
            </div>
        </div>

    </form>
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
                        echo "<option value='".$customer["id"]."'>".$customer["firstname"]." ".$customer["lastname"]."</option>";
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
                    <?php
                    if (isset($_GET["low"]) || isset($_GET["med"]) || isset($_GET["high"])){
                        if (isset($_GET["low"])){
                            echo "<option>-- Below 25 --</option>";
                            foreach ($productsLow as $product1){
                                echo "<option value='".$product1["id"]."'>".$product1["name"]." ".number_format($product1["price"]/100, 2)."€</option>";
                            }
                        }
                        if (isset($_GET["med"])) {
                            echo "<option>-- From 25 to 75 --</option>";
                            foreach ($productsMed as $product2) {
                                echo "<option value='" . $product2["id"] . "'>" . $product2["name"] . " " . number_format($product2["price"] / 100, 2) . "€</option>";
                            }
                        }
                        if (isset($_GET["high"])) {
                            echo "<option>-- 75 and up --</option>";
                            foreach ($productsHigh as $product3) {
                                echo "<option value='" . $product3["id"] . "'>" . $product3["name"] . " " . number_format($product3["price"] / 100, 2) . "€</option>";
                            }
                        }
                    } else {
                        foreach ($products as $product){
                            echo "<option value='".$product["id"]."'>".$product["name"]." ".number_format($product["price"]/100, 2)."€</option>";
                        }
                    }

                    ?>
                </select>

                <label>
                    How much would you like to order? <input type="number" name="quantity" value="1">
                </label>


            </div>
        </div>
        <div class="row" id="submit">
            <button type="submit"  class="btn btn-primary rounded-pill"> submit here </button>
        </div>
    </form>
</section>
<?php
if (!empty($_POST)){?>
<section class="calculation">

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
                    <td>Bulk Discount</td>
                    <td class="price"> <?php echo $bulkDiscount; ?> %</td>
                </tr>
                <tr>
                    <td>Bulk Price</td>
                    <td class="price"> <?php echo Calculator::getBulkPrice($showProduct->getPrice(), $bulk); ?>&euro;</td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td class="price"> <?php echo $quantity; ?></td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td class="price subTotal"> <?php echo $quantitySubTotal; ?>&euro;</td>
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
                        echo $subtotal;  ?>&euro;</td>
                </tr>
                <tr>
                    <th>Highest variable discount</th>
                </tr>
                <tr>
                    <?php

                    if ($showCustomer->getVarDiscount()>$showGroup->getVarDiscount()){
                        echo "<td>Personal Variable discount (".$showCustomer->getVarDiscount()."%)</td>";
                    } else {
                        echo "<td>Group Variable discount (".$showGroup->getVarDiscount()."%)</td>";
                    }
                    echo "<td class='price disc'>-" . number_format(Calculator::getVar($subtotal, $varDisc), 2) . "&euro;</td>";
                        ?>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td class="price subTotal"><?php if ($finalPrice > 35){?>FREE <?php } else { ?>4.95&euro;<?php } ?></td>
                </tr>
                <tr>
                    <td>Final price</td>
                    <td class="price disc subTotal"><?php echo $finalPrice;  ?>&euro;</td>
                </tr>





            </table>
        </div>

</section>
    <?php
} ?>


<?php require 'includes/footer.php'?>