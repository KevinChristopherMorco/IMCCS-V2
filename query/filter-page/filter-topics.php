<?php
include_once('../../database/config.php');
session_start();


$query = " SELECT * FROM lesson_tbl lesson WHERE NOT EXISTS (SELECT 1 FROM topic_chosen chosen WHERE lesson.lesson_id = chosen.lesson_id AND chosen.user_id = '" . $_SESSION['user_id'] . "')";

if (isset($_POST["difficulty"])) {
    $difficulty_filter = implode("','", $_POST["difficulty"]);
    $query .= " AND difficulty IN('" . $difficulty_filter . "')";
}
if (isset($_POST["time"])) {
    $time = implode("','", $_POST["time"]);
    $query .= " AND unit_time IN('" . $time . "')";
}
?>
<?php
$selQuestionRow = mysqli_query($mysqli, $query);
mysqli_fetch_all($selQuestionRow, MYSQLI_ASSOC);
$rowcount = mysqli_num_rows($selQuestionRow);
if ($rowcount > 0) {
    foreach ($selQuestionRow as $row) { ?>

        <div class="col-lg-6">
            <div class="topic-assessment-container mb-4" id="">
                <div class="topic-assessment-card">
                    <img src="admin/assets/img/<?php echo $row['lesson_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                    <div class="card-details">
                        <div class="">
                            <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $row['difficulty'] ?></span>
                            <span title="Recommended Completion Time" class="tag"><i class="fa-solid fa-clock"></i> <?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></span>
                        </div>
                        <!-- A div with name class for the name of the card -->
                        <div class="name"><?php echo $row['title'] ?></div>

                        <div class="card-description">
                            <p class="mt-4 mb-4"><?php echo $row['description'] ?></p>
                        </div>

                        <form id="insert-chosen-lesson" class="insert-chosen-lesson" method="GET">
                            <input type="hidden" name="title" class="title" id="title" value="<?php echo $row['title'] ?>">
                            <input type="hidden" name="lesson-id" class="lesson-id" id="lesson-id" value="<?php echo $row['lesson_id'] ?>">
                            <div class="btn-topic-assessment-container">
                                <input type="submit" class="ch-topic-assessment-btn" value="Get Started">
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    <?php }
} else { ?>
    <div class="text-center mt-4">
        <p class="chosen-empty"><img src="assets/images/icons/search-gif.gif" width="50" height="50" alt="">No available topics yet</p>
        <p class="chosen-suggestion mt-2">Please wait for more upcoming IMCCS topics!</p>
    </div>
<?php  } ?>

<script>
    $('.insert-chosen-lesson').submit(function(event) {
        event.preventDefault();


        var lesson_id = $(this).closest('form').find('input[name=lesson-id]').val();
        var title = $(this).closest('form').find('input[name=title]').val();

        $.ajax({
            type: "GET",
            data: {
                lesson_id: lesson_id,
                title: title,
            },

            success: function(data) {

                window.location = 'home-student.php?page=user-preview-topic&topic=' + title;

            },
            error: function(xhr, status, error) {


            }
        });


    });
</script>