<!DOCTYPE html>
<?php require_once("../resources/config.php"); ?>                                     
<?php require_once("cart.php"); ?> 
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?> 

<?php processTransaction(); ?>
    <!-- Page Content -->
    <div class="container">
    	<h1 class="text-center">THANK YOU</h1>

    </div>
    <!-- /.container -->
    <?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
