<?php require_once './MVC/Views/navbar.php'?>
<div class="container">
    <form class=""  enctype="multipart/form-data" id="form-test">
        <input type="text" id="name">
        <input type="file" name="file" id="file">
        <button type="submit" id="submit">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('#submit').click(function () {
            var form = new FormData();
            var file = $('#file')[0].files[0];
            // var array = [];
            // array.push(file);
            var name = $('#name').val();
            form.append('name', name);
            // form.append('array', array);
            form.append('file', file);
            $.ajax({
                method: 'POST',
                data: form,
                url: '/../QuizSys/APIThread/test',
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            })
            return false;
        })
    })
</script>