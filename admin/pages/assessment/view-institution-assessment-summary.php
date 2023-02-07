<?php
$institution_id =  mysqli_real_escape_string($mysqli, $_GET['institution_id']);
$name =  mysqli_real_escape_string($mysqli, $_GET['name']);
?>



<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

    <style>
        #header {
            display: none !important;
        }

        .sidebar {
            display: none !important;
        }
    </style>
</head>
<input type="hidden" id="institution-assessment-view" value="<?php echo $institution_id ?>">
<div class="container mt-5 mb-3">
    <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb mt-4">
            <li class="breadcrumb-item"><a href="home-admin.php?page=manage-institution">Manage Institution</a></li>
            <li class="breadcrumb-item active"><a href="#"><?php echo $name ?> Assessment Summary</a></li>
        </ol>
    </nav>
</div>
<script>
    $(document).ready(function() {
        $('#institution-view-summary').on('change', function() {
            var conceptName = $('#institution-view-summary').find(":selected").val();
            var instituion_id = $('#institution-assessment-view').val();

            $.ajax({
                type: "POST",
                url: "query/assessment-retake/institution-view-assessment-summary-filter.php",
                data: {
                    selected: conceptName,
                    instituion_id: instituion_id,

                },
                success: function(data) {
                    someFunction(data);
                    $('.response-holder').html(data);

                    // Stuff
                },
                error: function(data) {

                    // Stuff
                }
            });
        });
    });

    function someFunction(data) {
        <?php ?>
        $institution = data;


    }
</script>


<div class="assessment-statistics jumbotron pb-5" style="background-color: #F4F6F7;">
    <div class="container mb-3">
        <?php
        $selQuestion = "SELECT * FROM assessment_tbl";
        $selQuestionRow = mysqli_query($mysqli, $selQuestion);
        ?>
        <select class="form-select" name="institution-view-summary" id="institution-view-summary">
            <option value="" disabled selected>Please select an assessment</option>
            <?php while ($row = mysqli_fetch_assoc($selQuestionRow)) {
            ?>
                <option value="<?php echo  $row['assessment_id'] ?>"><?php echo $row['title'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="container mt-5 mb-3">
        <div class="response-holder">
            <div class="not-found">
                <p> <img src="assets/img/icons/find.png" alt="" height="50%">Choose an assessment</p>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Question1', 'Number1'],
            <?php
            if ($returnChoiceRow['type'] == 'Multiple Choice Question') {
                echo "['" . $returnChoiceRow["assessment_choice1"] . "', " . $returnChoiceRow["total_choice_1"] . "],", "['" . $returnChoiceRow["assessment_choice2"] . "', " . $returnChoiceRow["total_choice_2"] . "],", "['" . $returnChoiceRow["assessment_choice3"] . "', " . $returnChoiceRow["total_choice_3"] . "],", "['" . $returnChoiceRow["assessment_choice4"] . "', " . $returnChoiceRow["total_choice_4"] . "],";
            } else if ($returnChoiceRow['type'] == 'Identification Question') {
                foreach ($identificationAnswer as $answer) {
                    echo "['" . $answer['answer'] . "', " . $returnChoiceRow["total_right"] . "],";
                }
            } else {
                echo "['True'," . $returnChoiceRow["total_true"] . "],", "['False'," . $returnChoiceRow["total_false"] . "],";
            }
            ?>

        ]);
        var options = {
            title: 'Assessment Average Percentage',
            sliceVisibilityThreshold: 0,
            //is3D:true,
            pieHole: 0.3,
            animation: {
                duration: 1000,
                easing: 'out',
            },
            colors: ['#990099', '#109618', '#FF9900', '#DC3912', getRandomColor()],

            'backgroundColor': 'white',
            'is3D': true

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_question<?php echo $returnChoiceRow['question_id']; ?>'));
        chart.draw(data, options);

    }
</script>

<script>
    $(document).ready(function() {
        $('.right-answer').each(function() {
            if ($(this).text() == 'True') {
                $(this).closest('.choice-container').find('.dot-indentifier').css('background-color', '#8A008A');
            } else if ($(this).text() == 'False') {
                $(this).closest('.choice-container').find('.dot-indentifier').css('background-color', '#00990A');

            }
        });
    });
</script>