<h1 class="page-header">All Products</h1>
<h3 class="bg-success"><?php displayMessage(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Report Id</th>
           <th>Product Id</th>
           <th>Order Id</th>
           <th>Prodcut Price</th>
           <th>Product Title</th>
           <th>Qty</th>
           <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php getReport(); ?>
    </tbody>
</table>
