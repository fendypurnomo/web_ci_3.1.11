<div class="row">
	<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		<h3>Upload</h3>
		<form id="upload_form">
			<div class="form-group">
				<label for="upload_title">Title</label>
				<input type="text" class="form-control" id="upload_title" name="title" placeholder="Title">
			</div>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="upload_photo" name="file">
				<label class="custom-file-label" for="upload_photo">Choose file</label>
			</div>
			<div class="form-group mt-3">
				<button type="submit" class="btn btn-sm btn-outline-primary">Upload</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	/* $('.custom-file-input').on('change', function() {
		var fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	}); */

	document.querySelector('.custom-file-input').addEventListener('change', function(e) {
		var fileName = document.getElementById("upload_photo").files[0].name;
		var nextSibling = e.target.nextElementSibling
		nextSibling.innerText = fileName
	});

	$(document).ready(function() {
		$('#upload_form').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?= base_url() ?>upload/do_upload',
				type: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					alert("Upload Image Success..");
				}
			});
		});
	});
</script>
