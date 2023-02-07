<?php $query = "SELECT usertype, count(*) as number FROM user_tbl GROUP BY usertype";
$result = mysqli_query($mysqli, $query);   ?>

<?php $gender_query = "SELECT gender, count(*) as gender_number FROM student_faculty_profile_tbl GROUP BY gender";
$gender_result = mysqli_query($mysqli, $gender_query);   ?>

<?php $pass_query = "SELECT verdict, count(*) as pass_rate FROM assessment_score GROUP BY verdict ORDER BY verdict DESC";
$pass_result = mysqli_query($mysqli, $pass_query);   ?>

<?php $postpass_query = "SELECT verdict, count(*) as pass_rate FROM retake_score_tbl GROUP BY verdict ORDER BY verdict DESC";
$postpass_result = mysqli_query($mysqli, $postpass_query);   ?>

<?php
$assessmentNo = "select COUNT(assessment_id) from assessment_tbl";
$assessmentNoResult = mysqli_query($mysqli, $assessmentNo);
while ($row = mysqli_fetch_array($assessmentNoResult)) {

  $count_assessment = $row['COUNT(assessment_id)'];
}
?>

<?php
$questionNo = "select COUNT(question_id) from assessment_question_tbl";
$questionNoResult = mysqli_query($mysqli, $questionNo);
while ($row = mysqli_fetch_array($questionNoResult)) {

  $count_questions = $row['COUNT(question_id)'];
}
?>

<?php
$topicNo = "select COUNT(lesson_id) from lesson_tbl";
$topicNoResult = mysqli_query($mysqli, $topicNo);
while ($row = mysqli_fetch_array($topicNoResult)) {

  $count_topics = $row['COUNT(lesson_id)'];
}
?>

<?php
$topicNo = "select COUNT(lesson_id) from lesson_tbl";
$topicNoResult = mysqli_query($mysqli, $topicNo);
while ($row = mysqli_fetch_array($topicNoResult)) {

  $count_topics = $row['COUNT(lesson_id)'];
}
?>

<?php
$assessmentTakerNo = "select COUNT(user_id) from assessment_chosen";
$assessmentTakerNoResult = mysqli_query($mysqli, $assessmentTakerNo);
while ($row = mysqli_fetch_array($assessmentTakerNoResult)) {
  $count_takers = $row['COUNT(user_id)'];
}
?>

<?php

$assessmentRegisterQuery = "SELECT MONTHNAME(created_at) as month_name, COUNT(user_id) as register FROM user_tbl GROUP BY MONTH(created_at)";
$count_register = mysqli_query($mysqli, $assessmentRegisterQuery);



?>

<?php

$institution_no = " SELECT status, count(*) as stat FROM institution_tbl GROUP BY status";
$institution_result = mysqli_query($mysqli, $institution_no); ?>


<head>

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
  <script>
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Students', 'Faculties'],
        ['2022', 1000, 400],
        ['2023', 1170, 460],
        ['2024', 660, 1120],
        ['2025', 1030, 540]
      ]);

      var options = {
        title: 'Student and Faculty Registration Trend',
        curveType: 'function',
        legend: {
          position: 'bottom'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
  </script>

</head>
<main id="main" class="main">
  <div class="pagetitle">
    <section class="main-section" id="admin-dashboard">
      <div class="main-content">
        <div class="container page-container">
          <div class="row">
            <h1 class="mb-4">Admin Dashboard</h1>
            <div class="col-md-3 mb-4">
              <div class="admin-card topics p-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                  <h5>Total: <?php echo "$count_topics" ?></h5>
                  <p>Topics</p>
                </div>
                <i class="fa-solid fa-person-chalkboard fs-1 primary-text rounded-full bg-cyan p-3"></i>
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="admin-card assessment p-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                  <h5>Total: <?php echo "$count_assessment" ?></h5>
                  <p style="font-size: 15px;">Assessments</p>
                </div>
                <i class="fa-solid fa-file-lines fs-1 primary-text rounded-full bg-red p-3"></i>
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="admin-card question-bank p-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                  <h5>Total: <?php echo "$count_questions" ?></h5>
                  <p>Question Bank</p>
                </div>
                <i class="fa-solid fa-circle-question fs-1 primary-text rounded-full bg-orange p-3"></i>
              </div>
            </div>

            <div class="col-md-3 mb-4">
              <div class="admin-card taker p-1 shadow-sm d-flex justify-content-around align-items-center rounded">
                <div>
                  <h5>Total: <?php echo "$count_takers" ?></h5>
                  <p>Assessment Takers</p>
                </div>
                <i class="fa-solid fa-person fs-1 primary-text rounded-full bg-blue p-3"></i>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6 mb-4">
              <canvas id="piechart_user" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="col-6 mb-4">
              <canvas id="piechart_gender" style="width:100%;max-width:600px"></canvas>
            </div>
            <div class="col-6 mb-4">
              <canvas id="piechart_institution" style="width:100%;max-width:600px"></canvas>
            </div>

            <div class="col-6 mb-4">
              <canvas id="piechart_passfail" style="width:100%;max-width:600px"></canvas>
            </div>

            <div class="col-6 mb-4">
              <canvas id="piechart_postpassfail" style="width:100%;max-width:600px"></canvas>
            </div>

            <div class="col-12 mb-4">
              <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
            </div>
          </div>
        </div>
        <script>
          <?php
          $chartLabel = [];
          $chartData = [];

          while ($row = mysqli_fetch_array($result)) {

            $chartLabel[] = $row['usertype'];
            $chartData[] = $row['number'];
          }
          $returnChatLabels = json_encode($chartLabel);
          $returnChatData = json_encode($chartData);
          ?>

          var barColors = [
            "#EA640C",
            "#7F60FA",
            "#2CCAAA",
            "#e8c3b9"
          ];

          <?php if (empty($chartLabel) && empty($chartData)) { ?>
            var chartLabel = ["No Data"];
            var chartData = [0];
            new Chart("piechart_user", {
              type: "pie",
              data: {
                labels: chartLabel,
                datasets: [{
                  backgroundColor: ['#F2F2F2'],
                  data: chartData
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Users"
                }
              }
            });
          <?php   } else { ?>

            new Chart("piechart_user", {
              type: "pie",
              data: {
                labels: <?php echo $returnChatLabels ?>,
                datasets: [{
                  backgroundColor: barColors,
                  data: <?php echo $returnChatData ?>
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Users"
                }
              }
            });
          <?php   } ?>
        </script>

        <script>
          <?php
          $chartLabel = [];
          $chartData = [];
          $barColors = [];

          while ($rows = mysqli_fetch_array($gender_result)) {

            $chartLabel[] = $rows['gender'];
            $chartData[] = $rows['gender_number'];

            if ($rows['gender'] === 'Male') {
              $barColors[] = "#009FCA";
            } else if ($rows['gender'] === 'Female') {
              $barColors[] = "#F766AE";
            } else {
              $randomColor = '#'.dechex(mt_rand(0x000000, 0xFFFFFF));
              $barColors[] = $randomColor;
            }
          }
          $returnChatLabels = json_encode($chartLabel);
          $returnChatData = json_encode($chartData);
          $returnBarColors = json_encode($barColors);

          ?>

          <?php if (empty($chartLabel) && empty($chartData)) { ?>
            var chartLabel = ["No Data"];
            var chartData = [0];
            new Chart("piechart_gender", {
              type: "pie",
              data: {
                labels: chartLabel,
                datasets: [{
                  backgroundColor: ['#F2F2F2'],
                  data: chartData
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of User Gender"
                }
              }
            });
          <?php   } else { ?>

            new Chart("piechart_gender", {
              type: "pie",
              data: {
                labels: <?php echo $returnChatLabels ?>,
                datasets: [{
                  backgroundColor: <?php echo $returnBarColors ?>,
                  data: <?php echo $returnChatData ?>
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of User Gender"
                }
              }
            });
          <?php   } ?>
        </script>

        <script>
          <?php
          $chartLabel = [];
          $chartData = [];
          $barColors = [];
          while ($rows = mysqli_fetch_array($institution_result)) {

            $chartLabel[] = $rows['status'];
            $chartData[] = $rows['stat'];

            if ($rows['status'] === 'Active') {
              $barColors[] = "#76EF00";
            } else if ($rows['status'] === 'Inactive') {
              $barColors[] = "#E60000";
            } else {
              $barColors[] = "#F2F2F2";
            }
          }
          $returnChatLabels = json_encode($chartLabel);
          $returnChatData = json_encode($chartData);
          $returnBarColors = json_encode($barColors);
          ?>

          <?php if (empty($chartLabel) && empty($chartData)) { ?>
            var chartLabel = ["No Data"];
            var chartData = [0];
            new Chart("piechart_institution", {
              type: "pie",
              data: {
                labels: chartLabel,
                datasets: [{
                  backgroundColor: ['#F2F2F2'],
                  data: chartData
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Participating Institution"
                }
              }
            });
          <?php   } else { ?>

            new Chart("piechart_institution", {
              type: "pie",
              data: {
                labels: <?php echo $returnChatLabels ?>,
                datasets: [{
                  backgroundColor: <?php echo $returnBarColors ?>,
                  data: <?php echo $returnChatData ?>
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Participating Institution"
                }
              }
            });
          <?php   } ?>
        </script>

        <script>
          <?php
          $chartLabel = [];
          $chartData = [];
          $barColors = [];
          while ($rows = mysqli_fetch_array($pass_result)) {
            $chartLabel[] = $rows['verdict'];
            $chartData[] = $rows['pass_rate'];
            if ($rows['verdict'] === 'Passed') {
              $barColors[] = "#76EF00";
            } else if ($rows['verdict'] === 'Failed') {
              $barColors[] = "#E60000";
            }
          }
          $returnChatLabels = json_encode($chartLabel);
          $returnChatData = json_encode($chartData);
          $returnBarColors = json_encode($barColors);
          ?>
          <?php
          if (empty($chartLabel) && empty($chartData)) { ?>
            var chartLabel = ["No Data"];
            var chartData = [0];
            new Chart("piechart_passfail", {
              type: "pie",
              data: {
                labels: chartLabel,
                datasets: [{
                  backgroundColor: ['#F2F2F2'],
                  data: chartData
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Pre Assessment Passing Rate and Failing Rate"
                }
              }
            });
          <?php   } else { ?>
            new Chart("piechart_passfail", {
              type: "pie",
              data: {
                labels: <?php echo $returnChatLabels ?>,
                datasets: [{
                  backgroundColor: <?php echo $returnBarColors ?>,
                  data: <?php echo $returnChatData ?>
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Pre Assessment Passing Rate and Failing Rate"
                }
              }
            });
          <?php   } ?>
        </script>

        <script>
          <?php
          $chartLabel = [];
          $chartData = [];
          $barColors = [];
          while ($rows = mysqli_fetch_array($postpass_result)) {
            $chartLabel[] = $rows['verdict'];
            $chartData[] = $rows['pass_rate'];
            if ($rows['verdict'] === 'Passed') {
              $barColors[] = "#76EF00";
            } else if ($rows['verdict'] === 'Failed') {
              $barColors[] = "#E60000";
            }
          }
          $returnChatLabels = json_encode($chartLabel);
          $returnChatData = json_encode($chartData);
          $returnBarColors = json_encode($barColors);
          ?>
          <?php if (empty($chartLabel) && empty($chartData)) { ?>
            var chartLabel = ["No Data"];
            var chartData = [0];
            new Chart("piechart_postpassfail", {
              type: "pie",
              data: {
                labels: chartLabel,
                datasets: [{
                  backgroundColor: ['#F2F2F2'],
                  data: chartData
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Post Assessment Passing Rate and Failing Rate"
                }
              }
            });
          <?php   } else { ?>
            new Chart("piechart_postpassfail", {
              type: "pie",
              data: {
                labels: <?php echo $returnChatLabels ?>,
                datasets: [{
                  backgroundColor: <?php echo $returnBarColors ?>,
                  data: <?php echo $returnChatData ?>
                }]
              },
              options: {
                title: {
                  display: true,
                  text: "Percentage of Post Assessment Passing Rate and Failing Rate"
                }
              }
            });
          <?php   } ?>
        </script>

        <script>
          <?php
          $chartLabel = [];
          $chartData = [];

          while ($rows = mysqli_fetch_array($count_register)) {

            $chartLabel[] = $rows['month_name'];
            $chartData[] =  $rows['register'];
          }
          $returnChatLabels = json_encode($chartLabel);
          $returnChatData = json_encode($chartData);
          ?>
          var barColors = ["red", "green", "blue", "orange", "brown"];

          new Chart("myChart", {
            type: "bar",
            data: {
              labels: <?php echo $returnChatLabels ?>,

              datasets: [{
                backgroundColor: barColors,
                data: <?php echo $returnChatData ?>,
              }]
            },
            options: {
              legend: {
                display: false
              },
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }],
              },
              title: {
                display: true,
                text: "Total of Registered Users per Month"
              }
            }
          });
        </script>
      </div>

    </section>
</main>