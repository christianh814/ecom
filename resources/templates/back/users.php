<div class="col-lg-12">
    <h1 class="page-header">Users</h1>
      <p class="bg-success">
    </p>
    <a href="/admin/index.php?add_user" class="btn btn-primary">Add User</a>
    <h3 class="bg-success"><?php displayMessage()?></h3>
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions </th>
                </tr>
            </thead>
            <tbody>
	    	<?php showUsersinAdmin() ?>
            </tbody>
        </table> <!--End of Table-->
    </div>
</div>
