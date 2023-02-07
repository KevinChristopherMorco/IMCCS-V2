<?php
if (isset($_GET['topic'])) {

    $selLesson = $mysqli->prepare("SELECT * FROM lesson_tbl where title = ?");
    $selLesson->bind_param('s', $_GET['topic']);
    $selLesson->execute();
    $selLessonRow = $selLesson->get_result();
    $row = $selLessonRow->fetch_assoc();

    $topic =   $_GET['topic'];


    $selRandom = $mysqli->prepare("SELECT * FROM lesson_tbl ORDER BY RAND() LIMIT 3");
    $selRandom->execute();
    $selRandomRow = $selRandom->get_result();
}
?>

<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>IMCCS: <?php echo $row['title'] ?></h1>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="view-topic">
    <div class="topic-information">
        <div class="row">
            <div class="col-lg-12 pt-4 pt-lg-0 px-4">
                <img src="admin/assets/img/<?php echo $row['lesson_img'] ?>" class="float-end img-topic-view">
                <div class="topic-view">
                    <nav class="topic-view-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb mt-4">
                            <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="history.back(-1)">IMCCS: Topics</a></li>
                            <li class="breadcrumb-item"><a href="#"> <?php echo $row['title'] ?></a></li>
                        </ol>
                    </nav>
                    <h2><?php echo $row['title'] ?></h2>
                    <p class="topic-view-description mt-4"><?php echo $row['description'] ?></p>
                    <form id="insert-chosen" method="POST">

                        <input type="hidden" name="" id="title" value="<?php echo $row['title'] ?>">

                        <input type="submit" class="btn btn-custom-primary btn-chose-topic mt-4">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-7">
            <div class="topic-summary px-4">
                <p class="topic-view-paragraph mx-4 pt-4"><?php echo $row['lesson_paragraph'] ?></p>
            </div>
            <h3 class="mx-4 mt-4">Lessons that you may also like:</h3>
            <?php while ($randomRow = $selRandomRow->fetch_assoc()) { ?>
                <div class="topic-assessment-card">
                    <img src="admin/assets/img/<?php echo $randomRow['lesson_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                    <div class="card-details">
                        <div class="">
                            <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $randomRow['difficulty'] ?></span>
                            <span title="Recommended Completion Time" class="tag"><i class="fa-solid fa-clock"></i> <?php echo $randomRow['estimated_time'] ?> <?php echo $randomRow['unit_time'] ?></span>
                        </div>
                        <!-- A div with name class for the name of the card -->
                        <div class="name"><?php echo $randomRow['title'] ?></div>
                        <div class="card-description">
                            <p class="mt-4 mb-4"><?php echo $randomRow['description'] ?></p>
                        </div>

                        <form id="view-chosen-lesson" class="view-chosen-lesson" method="GET">
                            <input type="hidden" name="title" class="title" id="title" value="<?php echo $randomRow['title'] ?>">
                            <input type="hidden" name="lesson-id" class="lesson-id" id="lesson-id" value="<?php echo $randomRow['lesson_id'] ?>">
                            <div class="btn-topic-assessment-container">
                                <input type="submit" class="ch-topic-assessment-btn" value="View">
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="col-lg-5">
            <div class="topic-view-container">
                <p class="topic-view-paragraph icon mx-4 pt-4"><i class="fa-solid fa-star pe-4"></i> <?php echo $row['difficulty'] ?></p>
                <p class="topic-view-paragraph icon-text mx-4 pt-2">Level of the Lesson</p>
            </div>
            <div class="topic-view-container">
                <p class="topic-view-paragraph icon mx-4 pt-4"><i class="fa-solid fa-clock pe-4"></i></i> <?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></p>
                <p class="topic-view-paragraph icon-text mx-4 pt-2">The Estimated Time of Completion - Still you can learn on your own pace</p>
            </div>
        </div>
    </div>
</section>