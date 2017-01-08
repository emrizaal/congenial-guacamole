<?php
$this->load->view("header");
?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h2 align="center">Edit E-Book</h2>
        <hr>
      </div>
    </div>
    <div class="row">
     <div class="col-md-12">
       <form action="<?=API_LINK?>/ebook/updateEbook" method="POST" role="form" enctype="multipart/form-data">
         <input type="hidden" name="id_mosque" value="<?=$this->session->userdata('id_mosque')?>">
         <input type="hidden" name="token" value="<?=$this->session->userdata('token')?>">
         <input type="hidden" name="id_ebook" value="<?=$data['id_ebook']?>">
         <div class="form-group">
          <label>Title</label>
          <input type="text" value="<?=$data['title']?>" class="form-control" name="title" required/>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control"><?=$data['description']?></textarea>
        </div>
        <div class="form-group">
          <label>Url</label>
          <input type="text" value="<?=$data['url']?>" class="form-control" name="url" required/>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
          <label>Photo</label>
          <br>
          <img src="<?=API_LINK?>/assets/image/ebook/<?=$data['pic']?>" height="300px">
          <input type="file" class="form-control" name="fupload"/>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?=base_url()?>ebook"><button type="button" class="btn btn-default">Cancel</button></a>
      </form>
    </div>
  </div>
</div>
<!-- /. PAGE INNER  -->
</div>
<?php
$this->load->view("footer");
?>
