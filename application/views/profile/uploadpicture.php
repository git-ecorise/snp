<h1>Upload Picture</h1>
<form action="<?=  upload_picture_route();?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    <input type="file" name="userfile" size="20" />
    <input type="submit" value="upload" name="submit"/> 
</form>