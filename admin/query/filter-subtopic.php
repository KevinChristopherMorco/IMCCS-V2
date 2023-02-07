<?php include_once('../../database/config.php'); ?>
<head>
    <style>
        .newModule {
    width: 90%;
    position: relative;
    padding: .375rem 2.25rem .375rem .75rem;
    border: transparent;
    background-color: #F7E8E3;
}
    </style>
</head>
<?php
$title =   mysqli_real_escape_string($mysqli, $_POST['title']);

$selQuestion = "SELECT DISTINCT module FROM subtopic_tbl WHERE title = '$title' ";
$selQuestionRow = mysqli_query($mysqli, $selQuestion);
?>
<input class="newModule" style="display:none;"></input>

<select class="form-control form-select mb-4" name="subtopic-add-bullet" id="subtopic-add-bullet">
    <option value="" disabled selected>Please select a module:</option>

    <?php while ($row = mysqli_fetch_assoc($selQuestionRow)) { ?>
        <option value="<?php echo  $row['module'] ?>"><?php echo $row['module'] ?></option>
    <?php } ?>
    <option value="" disabled>You can add a new module below:</option>

    <option class="editable" value="other">New</option>
</select>

<script>
    var initialText = $('.editable').val();
        $('.newModule').val(initialText);

        $('#subtopic-add-bullet').change(function () {
            var selected = $('option:selected', this).attr('class');
            var optionText = $('.editable').text();

            if (selected == "editable") {
                $('.newModule').show();


                $('.newModule').keyup(function () {
                    var editText = $('.newModule').val();
                    $('.editable').val(editText);
                });

            } else {
                $('.newModule').hide();
            }
        });

        $(document).ready(function () {

$('#subtopic-add-bullet').on('change', function () {

    if ($('#subtopic-add-bullet').val().length != "") {

        $('#subtopic-add-bullet').removeClass('is-invalid');
        $('#subtopic-add-bullet').addClass('is-valid');
    }


});
});
</script>