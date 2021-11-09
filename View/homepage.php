<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>instantiated <?php echo $customer->getCustomer()?>,</h4>
    <h4>instantiated <?php echo $customerGroup->getCustomerGroup()?>,</h4>
    <h4>instantiated <?php echo $product->getProduct()?>,</h4>
    <h4>instantiated <?php echo $connection->getConnection()?>,</h4>
    <p>
    Content here fool.
    </p>
</section>

<?php require 'includes/footer.php'?>