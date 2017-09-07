<h1 class="page-header">All Products</h1>
<h3 class="bg-success"><?php displayMessage(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Title</th>
           <th>Image</th>
           <th>Category</th>
           <th>Price</th>
           <th>Qty</th>
           <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php getProductsinAdmin(); ?>
    </tbody>
</table>
