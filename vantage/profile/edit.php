<?php
include "../sessions/user.php";
include "../header.php";
?>
<style>
#box {
  height: 25%;
  width: 70%;
  /*margin-left: 3%;*/
  background-color: #E9E7E7;
  border-radius: 5px;
  position: relative;
  /*bottom: 60px;*/
  background: rgb(200, 200, 200);
  background: rgba(200, 200, 200, 0.5);
}
</style>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div id="container">
                <center>
                <div id="box">
                  <br>
                  <form action="" method="POST">
                    <input style="width: 40%; height: 35px;" name="change_school" type="text" placeholder="Change School...">
                    <button name="changed_school" class="btn btn-success">Change</button>
                  </form>
                  <br>
                  <form action="change_profile_picture.php" method="POST" enctype="multipart/form-data">
                    <input type='file' name='image' placeholder='Paste url for image'>
                    <button name="changed_profile_picture" class="btn btn-success">Change</button>
                  </form>
                  <?php
                    include "edit_queries.php";
                  ?>
                    <br>
                  </form>
                </div>
              </center>
              </div>
            </div>
        </div>
    </div>
</div>
