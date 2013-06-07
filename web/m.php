<!-- Place inside the <head> of your HTML -->
<head>
<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste moxiemanager"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script> 
</head>

<!-- Place this in the body of the page content -->
<body>
<h1 class="edit">Edit this title</h1>
<div class="edit">This is my content</div>
<textarea name="content" style="width:100%"></textarea>
<form method="post">


    <textarea>Hola</textarea>
</form>
</body>
