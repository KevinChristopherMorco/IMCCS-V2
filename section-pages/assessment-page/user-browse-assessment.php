<?php
$selQuestion = "SELECT * FROM assessment_tbl ";
$selQuestionRow = mysqli_query($mysqli, $selQuestion);
?>
<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>IMCCS List of Assessments</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="d-flex justify-content-end mt-4 px-4">
    <form class='searchbox'>
        <input class="form-control assessment searchbar" type="text" placeholder="Search Assessments" name="search">
    </form>

</div>

<section class="user-browse-assessment">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="d-flex">
                <div class="menu me-2">
                    <div class="filter" class="p-2 ms-md-4 ms-sm-2 ">
                        <div class="box-label text-uppercase text-black fw-bolder d-flex align-items-center">Difficulty <button class="btn ms-auto btn-filter-difficulty" type="button" data-bs-toggle="collapse" data-bs-target="#difficulty" aria-expanded="true" aria-controls="inner-box"> <i name="custom-icon-difficulty" class="custom-icon-difficulty fa-solid"></i>
                            </button> </div>
                        <div id="difficulty" class="collapse show">
                            <?php

                            $query = "SELECT DISTINCT (difficulty) FROM assessment_tbl ORDER BY FIELD(difficulty,'Beginner','Intermediate','Expert') ";
                            $selDifficultRow = mysqli_query($mysqli, $query);
                            mysqli_fetch_all($selDifficultRow, MYSQLI_ASSOC);

                            foreach ($selDifficultRow as $row) {
                            ?>
                                <div class="my-1"> <label class="tick"> <input type="checkbox" name="difficulty" class="check-filter difficulty" value="<?php echo $row['difficulty']; ?>"> <span class="check"></span> <?php echo $row['difficulty']; ?> </label> </div>

                            <?php
                            }

                            ?>
                        </div>
                        <div class="box-label text-uppercase text-black fw-bolder d-flex align-items-center">Completion Time <button class="btn ms-auto btn-filter-time" type="button" data-bs-toggle="collapse" data-bs-target="#time" aria-expanded="true" aria-controls="inner-box"> <i name="custom-icon-time" class="custom-icon-time  fa-solid"></i>
                            </button> </div>
                        <div id="time" class="collapse show">
                            <?php

                            $query = "SELECT DISTINCT (unit_time) FROM assessment_tbl ORDER BY FIELD(unit_time,'Hours','Days','Weeks','Months') ";
                            $selDifficultRow = mysqli_query($mysqli, $query);
                            mysqli_fetch_all($selDifficultRow, MYSQLI_ASSOC);

                            foreach ($selDifficultRow as $row) {
                            ?>
                                <div class="my-1"> <label class="tick"> <input type="checkbox" name="difficulty" class="check-filter time" value="<?php echo $row['unit_time']; ?>"> <span class="check"></span> <?php echo $row['unit_time']; ?> </label> </div>

                            <?php
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="assessment-containers col-sm-12 col-md-8 col-lg-9">
            <ul class="nav nav-pills nav-fill mt-4 pb-4 ">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#assessment-catalog"><i class="fa-solid fa-file-lines"></i> Pre Assessment Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#retake-catalog"><i class="fa-solid fa-file-export"></i> Post Assessment Catalog</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="assessment-catalog" class="tab-pane main-topic-section fade in active show">
                    <div class="assessment-card-container ">
                        <div class="assessment-list row" style="width: 100%;">
                            <?php /* VIEW THE FILTERED ASSESSMENTS HERE */ ?>

                        </div>
                    </div>
                </div>

                <div id="retake-catalog" class="tab-pane main-topic-section fade in">
                <div class="assessment-card-container ">
                        <div class="retake-assessment-list row" style="width: 100%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>