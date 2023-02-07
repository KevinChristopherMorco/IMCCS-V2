<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section">
            <div class="main-content">
                <div class="container page-container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">

                                <h1>Assessment Results</h1>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-pills nav-fill pass-fail-link pb-4" id="nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#pass"><i class="fa-solid fa-user-check"></i>Passed Pre Assessments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#fail"><i class="fa-solid fa-user-xmark"></i>Failed Pre Assessments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" aria-current="page" href="#passPost"><i class="fa-solid fa-user-check"></i>Passed Post Assessments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" aria-current="page" href="#failPost"><i class="fa-solid fa-user-xmark"></i>Failed Post Assessments</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="pass" class="tab-pane fade in active show">
                            <table class="admin table table-striped table-hover table-bordered" id="passTable">
                                <thead>
                                    <tr>
                                        <th>Name <i class="fa fa-sort"></i></th>
                                        <th>Title <i class="fa fa-sort"></i></th>
                                        <th>Passing Rate <i class="fa fa-sort"></i></th>
                                        <th>Score <i class="fa fa-sort"></i></th>
                                        <th>Percentage <i class="fa fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT DISTINCT user.*, prfl.*, answer.*, assessment.*, score.*
                                    FROM user_tbl user
                                    INNER JOIN student_faculty_profile_tbl prfl
                                    ON user.user_id=prfl.user_id
                                    INNER JOIN assessment_chosen answer
                                    ON user.user_id = answer.user_id
                                    INNER JOIN assessment_tbl assessment
                                    ON answer.assessment_id = assessment.assessment_id
                                    INNER JOIN assessment_score score
                                    ON answer.assessment_id = score.assessment_id
                                    AND user.user_id = score.user_id
                                    WHERE score.verdict = 'Passed'
                                    GROUP BY assessment_score_id";
                                    $test2 = mysqli_query($mysqli, $sql);

                                    while ($row2 = mysqli_fetch_assoc($test2)) { ?>

                                        <h1> </h1>
                                        <?php
                                        $eid = $row2['user_id'];
                                        $aid = $row2['assessment_id'];

                                        $test3 = "SELECT * FROM assessment_tbl assessment INNER JOIN assessment_chosen answer ON assessment.assessment_id=answer.assessment_id  INNER JOIN user_tbl user  ON user.user_id=answer.user_id INNER JOIN assessment_score score WHERE  answer.user_id='$eid' AND assessment.assessment_id='$aid' AND score.verdict = 'Passed'";
                                        $test4 = mysqli_query($mysqli, $test3);
                                        $row3 = mysqli_fetch_assoc($test4);

                                        ?>
                                        <?php $queryScore = "SELECT *  FROM assessment_score score INNER JOIN assessment_tbl assessment WHERE score.user_id= '$eid' AND score.assessment_id = '$aid'";

                                        $resultScore = mysqli_query($mysqli, $queryScore);
                                        $rowCount = mysqli_fetch_assoc($resultScore);

                                        $selOver = "SELECT SUM(point) as point  FROM answer_tbl WHERE assessment_id = '$aid' AND user_id = '$eid'";
                                        $resultOver = mysqli_query($mysqli, $selOver);
                                        $rowCountOver = mysqli_fetch_assoc($resultOver); ?>
                                        <tr>
                                            <td><?php echo $row2['fname']; ?></td>

                                            <td><?php echo $row3['title']; ?></td>

                                            <td><?php echo $row3['passing_rate']; ?>%</td>

                                            <td><span class="score">
                                                    <?php echo $rowCount['assessment_score']
                                                    ?>



                                                    / <?php echo $rowCountOver['point']
                                                        ?></span></td>
                                            <td>
                                                <span class="percent">
                                                    <?php echo $ans = number_format($rowCount['assessment_score'] / $rowCountOver['point'] * 100, 2); ?>%
                                                </span>

                                            </td>
                                        </tr>



                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>

                    </div>

                    <div class="tab-content">
                        <div id="fail" class="tab-pane fade in">
                            <table class="admin table table-striped table-hover table-bordered" id="failTable">
                                <thead>
                                    <tr>
                                        <th>Name <i class="fa fa-sort"></i></th>
                                        <th>Title <i class="fa fa-sort"></i></th>
                                        <th>Passing Rate <i class="fa fa-sort"></i></th>

                                        <th>Score <i class="fa fa-sort"></i></th>
                                        <th>Percentage <i class="fa fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sqlFail = "SELECT DISTINCT user.*, prfl.*, answer.*, assessment.*, score.*
                                    FROM user_tbl user
                                    INNER JOIN student_faculty_profile_tbl prfl
                                    ON user.user_id=prfl.user_id
                                    INNER JOIN assessment_chosen answer
                                    ON user.user_id = answer.user_id
                                    INNER JOIN assessment_tbl assessment
                                    ON answer.assessment_id = assessment.assessment_id
                                    INNER JOIN assessment_score score
                                    ON answer.assessment_id = score.assessment_id
                                    AND user.user_id = score.user_id
                                    WHERE score.verdict = 'Failed'
                                    GROUP BY assessment_score_id";
                                    $countSqlFail = mysqli_query($mysqli, $sqlFail);

                                    while ($returnSqlFail = mysqli_fetch_assoc($countSqlFail)) { ?>

                                        <h1> </h1>
                                        <?php
                                        $eid = $returnSqlFail['user_id'];
                                        $aid = $returnSqlFail['assessment_id'];

                                        ?>
                                        <?php $queryScores = "SELECT *  FROM assessment_score score INNER JOIN assessment_tbl assessment WHERE score.user_id= '$eid' AND score.assessment_id = '$aid'";

                                        $resultScores = mysqli_query($mysqli, $queryScores);
                                        $rowCounts = mysqli_fetch_assoc($resultScores);

                                        $selOvers = "SELECT SUM(point) as point  FROM answer_tbl WHERE assessment_id = '$aid' AND user_id = '$eid'";
                                        $resultOvers = mysqli_query($mysqli, $selOvers);
                                        $rowCountOvers = mysqli_fetch_assoc($resultOvers); ?>
                                        <tr>
                                            <td><?php echo $returnSqlFail['fname']; ?></td>

                                            <td><?php echo $returnSqlFail['title']; ?></td>

                                            <td><?php echo $returnSqlFail['passing_rate']; ?>%</td>

                                            <td><span class="score">
                                                    <?php echo $rowCounts['assessment_score']
                                                    ?>

                                                    / <?php echo $rowCountOvers['point']
                                                        ?></span></td>
                                            <td>
                                                <span class="percent">
                                                    <?php echo $ans = number_format($rowCounts['assessment_score'] / $rowCountOvers['point'] * 100, 2); ?>%
                                                </span>

                                            </td>
                                        </tr>



                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="passPost" class="tab-pane fade in">
                            <table class="admin table table-striped table-hover table-bordered" id="passPostTable">
                                <thead>
                                    <tr>
                                        <th>Name <i class="fa fa-sort"></i></th>
                                        <th>Title <i class="fa fa-sort"></i></th>
                                        <th>Passing Rate <i class="fa fa-sort"></i></th>
                                        <th>Score <i class="fa fa-sort"></i></th>
                                        <th>Percentage <i class="fa fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT *
                                   FROM user_tbl user
                                   INNER JOIN student_faculty_profile_tbl prfl
                                   ON user.user_id=prfl.user_id
                                   INNER JOIN retake_chosen_tbl answer
                                   ON user.user_id = answer.user_id
                                   INNER JOIN assessment_tbl assessment
                                   ON answer.assessment_id = assessment.assessment_id
                                   INNER JOIN retake_score_tbl score
                                   ON user.user_id = score.user_id
                                   INNER JOIN retake_answer_tbl
                                   ON answer.assessment_id = retake_answer_tbl.assessment_id
                                   AND user.user_id = retake_answer_tbl.user_id
                                   WHERE score.verdict = 'Passed'
                                   AND score.code = retake_answer_tbl.code
                                   GROUP BY score.code";
                                    $test2 = mysqli_query($mysqli, $sql);

                                    while ($row2 = mysqli_fetch_assoc($test2)) { ?>

                                        <h1> </h1>
                                        <?php
                                        $eid = $row2['user_id'];
                                        $aid = $row2['assessment_id'];
                                        $code = $row2['code'];

                                        $test3 = "SELECT * FROM assessment_tbl assessment INNER JOIN retake_chosen_tbl answer ON assessment.assessment_id=answer.assessment_id  INNER JOIN user_tbl user  ON user.user_id=answer.user_id INNER JOIN retake_score_tbl score WHERE  answer.user_id='$eid' AND assessment.assessment_id='$aid' AND answer.code='$code' AND score.verdict = 'Passed'";
                                        $test4 = mysqli_query($mysqli, $test3);
                                        $row3 = mysqli_fetch_assoc($test4);

                                        ?>
                                        <?php $queryScore = "SELECT *  FROM retake_score_tbl score INNER JOIN assessment_tbl assessment WHERE score.user_id= '$eid' AND score.assessment_id = '$aid' AND score.code='$code'";

                                        $resultScore = mysqli_query($mysqli, $queryScore);
                                        $rowCount = mysqli_fetch_assoc($resultScore);

                                        $selOver = "SELECT SUM(point) as point  FROM retake_answer_tbl WHERE code= '$code' AND assessment_id = '$aid' AND user_id = '$eid'";
                                        $resultOver = mysqli_query($mysqli, $selOver);
                                        $rowCountOver = mysqli_fetch_assoc($resultOver); ?>
                                        <tr>
                                            <td><?php echo $row2['fname']; ?></td>

                                            <td><?php echo $row2['title']; ?></td>

                                            <td><?php echo $row2['passing_rate']; ?>%</td>

                                            <td><span class="score">
                                                    <?php echo $row2['retake_score']
                                                    ?>



                                                    / <?php echo $rowCountOver['point']
                                                        ?></span></td>
                                            <td>
                                                <span class="percent">
                                                    <?php echo $ans = number_format($row2['retake_score'] / $rowCountOver['point'] * 100, 2); ?>%
                                                </span>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div id="failPost" class="tab-pane fade in">
                            <table class="admin table table-striped table-hover table-bordered" id="failPostTable">
                                <thead>
                                    <tr>
                                        <th>Name <i class="fa fa-sort"></i></th>
                                        <th>Title <i class="fa fa-sort"></i></th>
                                        <th>Passing Rate <i class="fa fa-sort"></i></th>
                                        <th>Score <i class="fa fa-sort"></i></th>
                                        <th>Percentage <i class="fa fa-sort"></i></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = "SELECT *
                                   FROM user_tbl user
                                   INNER JOIN student_faculty_profile_tbl prfl
                                   ON user.user_id=prfl.user_id
                                   INNER JOIN retake_chosen_tbl answer
                                   ON user.user_id = answer.user_id
                                   INNER JOIN assessment_tbl assessment
                                   ON answer.assessment_id = assessment.assessment_id
                                   INNER JOIN retake_score_tbl score
                                   ON user.user_id = score.user_id
                                   INNER JOIN retake_answer_tbl
                                   ON answer.assessment_id = retake_answer_tbl.assessment_id
                                   AND user.user_id = retake_answer_tbl.user_id
                                   WHERE score.verdict = 'Failed'
                                   AND score.code = retake_answer_tbl.code
                                   GROUP BY score.code";
                                    $test2 = mysqli_query($mysqli, $sql);

                                    while ($row2 = mysqli_fetch_assoc($test2)) { ?>

                                        <h1> </h1>
                                        <?php
                                        $eid = $row2['user_id'];
                                        $aid = $row2['assessment_id'];
                                        $code = $row2['code'];

                                        $test3 = "SELECT * FROM assessment_tbl assessment INNER JOIN retake_chosen_tbl answer ON assessment.assessment_id=answer.assessment_id  INNER JOIN user_tbl user  ON user.user_id=answer.user_id INNER JOIN retake_score_tbl score WHERE  answer.user_id='$eid' AND assessment.assessment_id='$aid' AND answer.code='$code' AND score.verdict = 'Passed'";
                                        $test4 = mysqli_query($mysqli, $test3);
                                        $row3 = mysqli_fetch_assoc($test4);

                                        ?>
                                        <?php $queryScore = "SELECT *  FROM retake_score_tbl score INNER JOIN assessment_tbl assessment WHERE score.user_id= '$eid' AND score.assessment_id = '$aid' AND score.code='$code'";

                                        $resultScore = mysqli_query($mysqli, $queryScore);
                                        $rowCount = mysqli_fetch_assoc($resultScore);

                                        $selOver = "SELECT SUM(point) as point  FROM retake_answer_tbl WHERE code= '$code' AND assessment_id = '$aid' AND user_id = '$eid'";
                                        $resultOver = mysqli_query($mysqli, $selOver);
                                        $rowCountOver = mysqli_fetch_assoc($resultOver); ?>
                                        <tr>
                                            <td><?php echo $row2['fname']; ?></td>

                                            <td><?php echo $row2['title']; ?></td>

                                            <td><?php echo $row2['passing_rate']; ?>%</td>

                                            <td><span class="score">
                                                    <?php echo $row2['retake_score']
                                                    ?>



                                                    / <?php echo $rowCountOver['point']
                                                        ?></span></td>
                                            <td>
                                                <span class="percent">
                                                    <?php echo $ans = number_format($row2['retake_score'] / $rowCountOver['point'] * 100, 2); ?>%
                                                </span>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>




                </div>
            </div>

        </section>
</main>

<script>
    $(document).ready(function() {

        <?php /*

        $(".table tbody tr span.percent").each(function() {
        if ($(this).text() >= <?php echo $row3['passing_rate'] ?>) {
            $(this).closest('tr').find('span:eq(0)').addClass('pass');
            $(this).closest('tr').find('span:eq(1)').addClass('pass');

        } else {
            $(this).closest('tr').find('span:eq(0)').addClass('fail');
            $(this).closest('tr').find('span:eq(1)').addClass('fail');
        }
    });
    */ ?>
        $("#passTable tbody tr span.percent").each(function() {
            $(this).closest('tr').find('span:eq(0)').addClass('pass');
            $(this).closest('tr').find('span:eq(1)').addClass('pass');

        });

        $("#failTable tbody tr span.percent").each(function() {
            $(this).closest('tr').find('span:eq(0)').addClass('fail');
            $(this).closest('tr').find('span:eq(1)').addClass('fail');
        });

        $("#passPostTable tbody tr span.percent").each(function() {
            $(this).closest('tr').find('span:eq(0)').addClass('pass');
            $(this).closest('tr').find('span:eq(1)').addClass('pass');

        });

        $("#failPostTable tbody tr span.percent").each(function() {
            $(this).closest('tr').find('span:eq(0)').addClass('fail');
            $(this).closest('tr').find('span:eq(1)').addClass('fail');
        });

    })
</script>