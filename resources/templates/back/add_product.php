<?php addProduct(); ?>
<div class="col-md-12">

<div class="row">
<h1 class="page-header"> Add Product </h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number"  placeholder="0.00" step="0.01" min="0" name="product_price" class="form-control" size="60">
      </div>
    </div>
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <h3>Actions</h3>
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>


          <hr>
     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
        <select name="product_category_id" id="" class="form-control">
            <option value="">Select Category</option>
           
        </select>


</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
          <input type="number"  placeholder="0" step="1" min="0" name="product_qty" class="form-control" size="60">
         </select>
    </div>


<!-- Product Tags -->


    <div class="form-group">
          <label for="product-title">Product Short Description</label>
        <textarea name="product_short_desc" maxlength="200" cols="30" rows="3" class="form-control"></textarea>
    </div>

          <hr>
    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>
