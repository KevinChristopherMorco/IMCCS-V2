<?php
include_once('../../database/config.php');

?>
<?php
$content =   mysqli_real_escape_string($mysqli, $_POST['module']);

$subTopicQuerys = $mysqli->prepare("SELECT * FROM subtopic_tbl where module = ?");
$subTopicQuerys->bind_param('s', $content);
$subTopicQuerys->execute();
$subTopicResults = $subTopicQuerys->get_result();

while ($returnSubTopics = $subTopicResults->fetch_assoc()) {
    $rowss[] = $returnSubTopics;
}
?>
<div class="media-pages-container" id="media-pages-container">
    <ul class="nav nav-tabs" data-id="">


        <?php foreach ($rowss as $row) { ?>
            <li class="nav-item">
                <a class="nav-link content-link nav-link-<?php echo $row['subtopic_id'] ?>" data-bs-toggle="tab" href=".home-<?php echo $row['subtopic_id'] ?>"><?php echo $row['subtopic'] ?></a>
            </li>
        <?php }  ?>

    </ul>
</div>

<div class="tab-content">
<div id="sweetalert-popup" style="width: 100%; height:100%;"></div>
    <?php foreach ($rowss as $row) { ?>

        <div class="tab-pane home-<?php echo $row['subtopic_id'] ?> <?php echo $row['module'] ?>" id="home-<?php echo $row['subtopic_id'] ?>">
            <p><?php echo $row['content'] ?></p>
            <div class="topic-btn-container text-center mt-4" data-module="<?php echo $row['module'] ?>" data-topic="<?php echo $row['title'] ?>" style="background-color: #fff; padding: 3rem 1rem 3rem 1rem">
                <a class="btn btn-toggle btnPrevious">Back</a>
                <a class="btn btn-toggle btnNext">Next</a>
                <button class="btn btn-toggle btnFinish" data-id="<?php echo $row['lesson_id'] ?>" data-topic="<?php echo $row['title'] ?>" data-subtopic="<?php echo $row['subtopic_id'] ?>" data-module="<?php echo $row['module'] ?>">Finish Topic</button>
            </div>
        </div>
    <?php }  ?>
</div>

<script>
    $('.btnFinish').hide();

    $('.topic-content').each(function() {
        $('.btnPrevious:first').hide();
        $('.btnNext:last').hide();
        $('.btnFinish:last').show();

    });
</script>
<script>
    $(document).ready(function() {
        $('.tab-pane').each(function(index) {

            var src = $(this).closest('.tab-pane').find('section.headers img').attr('src');
            $(this).css({
                "background-image": "url(" + src + ")",
                'background-repeat': 'no-repeat',
                'background-size': '100% 100%',
                'height': '900px',

            });

        })
    })
    var lol = $('.tab-pane section.headers img').hide();
</script>

<script>
    $(document).ready(function () {
        $(".image img").click(function () {
            $(".caption").slideToggle();
        });

        $('.f1_container').click(function() {
        $(this).toggleClass('active');
    });
    });

    $(document).ready(function() {
        $('.headers').find('h1, h6').addClass('animated pulse');

    })

</script>