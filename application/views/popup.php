<?php include_once "header.php"; ?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-sm-8">
      <img width="500" src="<?=API_LINK?>/assets/image/popup/<?=$data['popup']?>">
    </div>
    <div class="col-sm-4">
     <div class="panel panel-default">
      <div class="panel-heading">
        Change Image
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
       <form action="<?=API_LINK?>/popup/updatePopup" method="POST" role="form" enctype="multipart/form-data">
         <input type="hidden" name="id_mosque" value="<?=$this->session->userdata('id_mosque')?>">
         <input type="hidden" name="token" value="<?=$this->session->userdata('token')?>">
        <div class="form-group">
          <label>Image</label>
          <input type="file" class="form-control" name="fupload"/>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>

<?php include_once "footer.php"; ?>
