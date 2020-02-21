
<script type="text/javascript" src="/assets/js/jquery_1.5.2.js"></script>
<script type="text/javascript" src="/assets/js/uploader.js"></script>
<link type="text/css" href="/assets/css/uploader.css" rel="stylesheet" />

<script type="text/javascript">
$(document).ready(function()
{
	new multiple_file_uploader
	({
		form_id: "fileUpload", 
		autoSubmit: true,
		server_url: "/includes/uploader/uploader.php<?php if(isset($extra_link)) echo $extra_link;?>" // PHP file for uploading the browsed files
	});
});
</script>

<div class="upload_box">
<form name="fileUpload" id="fileUpload" action="javascript:void(0);" enctype="multipart/form-data">
<div class="file_browser"><input type="file" name="multiple_files[]" id="_multiple_files" class="hide_broswe" multiple /></div>
<div class="file_upload"><input type="submit" value="Upload" class="upload_button" /> </div>
</form>
</div>	


<div class="file_boxes">

</div>
<span id="removed_files"></span>