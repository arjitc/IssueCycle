<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#summernote').summernote({
			height: 200,
			placeholder: 'Reply Here..',
			toolbar: [
			['style', ['style']],
			['style', ['bold', 'italic', 'underline', 'clear', 'blockquote']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['table']
			]
		});
	});
</script>
<script type="text/javascript">
	$('.confirmation').on('click', function () {
		return confirm('Are you sure?');
	});
</script>
<script type="text/javascript">
	$('[data-toggle="ajaxModal"]').on('click',
		function(e) {
			$('#ajaxModal').remove();
			e.preventDefault();
			var $this = $(this)
			, $remote = $this.data('remote') || $this.attr('href')
			, $modal = $('<div class="modal" id="ajaxModal"><div class="modal-body"></div></div>');
			$('body').append($modal);
			$modal.modal({backdrop: 'static', keyboard: false});
			$modal.load($remote);
		});
	</script>
	<script>
		function showIssue(project_id, issue_id) {
			if (project_id == "") {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else { 
				if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
        		document.getElementById("txtHint").innerHTML = this.responseText;
        	}
        };
        xmlhttp.open("GET","libraries/dropdown_issue_filter.php?id="+project_id + "&issue_id=" + issue_id, true);
        xmlhttp.send();
    }
}
</script>