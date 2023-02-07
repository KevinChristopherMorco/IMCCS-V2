<?php
$title = $_GET['title'];

$subTopicQuery = "SELECT * FROM subtopic_tbl where title = '$title' GROUP BY module ORDER BY subtopic_id ASC  ";
$subTopicResult =  mysqli_query($mysqli, $subTopicQuery);

while ($returnSubTopic = mysqli_fetch_assoc($subTopicResult)) {
    $rows[] = $returnSubTopic;
}


$subTopicQuerys = "SELECT * FROM subtopic_progress_tbl WHERE user_id = '" . $_SESSION['user_id'] . "'";
$subTopicResults =  mysqli_query($mysqli, $subTopicQuerys);
$countTopicResults =  mysqli_num_rows($subTopicResults);

while ($returnSubTopics = mysqli_fetch_assoc($subTopicResults)) {
    //$rowss[] = $returnSubTopics;
    $rowss[] = $returnSubTopics;
}


$queryChosen = "SELECT * FROM topic_chosen WHERE status = 'completed' AND user_id = '" . $_SESSION['user_id'] . "' AND title = '$title'";
$resultChosen =  mysqli_query($mysqli, $queryChosen);
$countChosenResults =  mysqli_num_rows($resultChosen);

while ($returnChosen = mysqli_fetch_assoc($resultChosen)) {
    $returnChosenArrays[] = $returnChosen;
}


$topicQuery = $mysqli->prepare("SELECT * from subtopic_tbl WHERE title= ?");
$topicQuery->bind_param('s', $title);
$topicQuery->execute();
$topicQuery->store_result();
$returnTopicQuery = $topicQuery->num_rows;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>IMCCS: <?php echo $title ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>



<main id="main" class="main">
    <section class="main-section">
        <div class="main-content">
            <div id="overlay">
                <p>Topic Finished</p>
                <div id="text">You have already completed this topic, <br> Do you want to continue? </br></div>
                <div class="overlay-button">
                    <a href="home-student.php?page=user-browse-topics" class="btn btn-secondary">Go to topic catalog</a>
                    <button class="btn btn-success" onclick="off()">Continue</button>
                </div>
            </div>
            <div class="loader-page">
                <div id="preloader">
                    <img src="assets/loader/Bean Eater-0.5s-200px.gif" alt="Loading...">
                    <p>Loading Stuff...</p>

                </div>


                <?php if (!empty($returnTopicQuery)) { ?>
                    <div class="topic-home-container">
                        <div class="column column-one d-flex">
                            <div class="mySidebar pt-4" id="mySidebar">
                                <ul class="topic-progress" id="topic-progress">
                                    <?php foreach ($rows as $row) {
                                        $itemss =  $row['title'];
                                    ?>
                                        <a class="topic-progress-item inprogress" data-id="<?php echo $row['subtopic_id'] ?>" data-module="<?php echo $row['module'] ?>" target="1" id="choice-<?php echo $row['subtopic_id'] ?>"><strong><?php echo $row['module']; ?></strong>

                                        </a>
                                        <br>
                                    <?php  } ?>
                                </ul>
                            </div>
                            <div class="toggle-topic-progress" id="toggle" onclick="toggleSidebar()">
                                <i class="fa-solid fa-list"></i>
                            </div>
                        </div>

                        <div class="column column-two">
                            <div class="topic-header">
                                <div class="left-item">
                                    <h4><?php echo $title ?></h4>
                                </div>
                                <div class="right-items">
                                    <div class="right-item back-home">
                                        <h6><i class="fa-solid fa-house"></i> Home</h6>
                                    </div>
                                    <div class="right-item">
                                        <h6 onclick="openFullscreen();"><i class=" fa-solid fa-expand"></i> View in Fullscreen</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="topic-content" id="topic-content">
                                <div class="frontpage-container">
                                    <div class="topic-content-frontpage" id="topic-content-frontpage1">
                                        <div class="row g-0">
                                            <div class="col-lg-6 col-sm-12">
                                                <img class="img-screen" src="assets/images/banner/iMCCS.png" alt="">

                                                <div class="topic-home text-center px-4 pt-4">
                                                    <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                                    <h2 class="module-heading pb-4">


                                                    </h2>
                                                    <div class="topic-home-list">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="topic-home-picture h-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="topic-pages">

                                    <div class="subtopic-content-view"></div>



                                </div>
                                <a href="javascript:void(0)" onclick="closeFullscreen();" class="exit-fullscreen" id="exit-fullscreen" style="display: none;">
                                    <i class="fa-solid fa-minimize"></i></a>
                            </div>
                        </div>
                    </div>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger text-center">
                <i class="fa-solid fa-triangle-exclamation"></i> <strong>Seems like there are no available topics for viewing yet on <?php echo $title ?> .</strong> Please wait or you may check later, our administrators our working on it.
            </div> <?php } ?>
        </div>
    </section>
</main>

<script>
    function openFullscreen() {
        var content = document.getElementById("topic-content");
        var exitFullscreen = document.getElementById("exit-fullscreen");


        if (content.requestFullscreen) {
            content.requestFullscreen();
            content.style.paddingLeft = "0px";
            exitFullscreen.style.display = "block";
        } else if (content.mozRequestFullScreen) {
            /* Firefox */
            content.mozRequestFullScreen();
            content.style.paddingLeft = "0px";
            exitFullscreen.style.display = "block";

        } else if (content.webkitRequestFullscreen) {
            /* Chrome, Safari and Opera */
            content.webkitRequestFullscreen();
            content.style.paddingLeft = "0px";
            exitFullscreen.style.display = "block";

        } else if (content.msRequestFullscreen) {
            /* IE/Edge */
            content.msRequestFullscreen();
            content.style.paddingLeft = "0px";
            exitFullscreen.style.display = "block";

        }
    }


    function closeFullscreen() {
        var exitFullscreen = document.getElementById("exit-fullscreen");

        if (document.exitFullscreen) {
            document.exitFullscreen();
            exitFullscreen.style.display = "none";

        } else if (document.mozCancelFullScreen) {
            /* Firefox */
            document.mozCancelFullScreen();
            exitFullscreen.style.display = "none";

        } else if (document.webkitExitFullscreen) {
            /* Chrome, Safari and Opera */
            document.webkitExitFullscreen();
            exitFullscreen.style.display = "none";

        } else if (document.msExitFullscreen) {
            /* IE/Edge */
            document.msExitFullscreen();
            exitFullscreen.style.display = "none";

        }
    }

    function toggleSidebar() {
        var sidebar = document.getElementById("mySidebar");
        var content = document.getElementById("topic-content");
        var step = document.getElementById("topic-progress");
        var toggle = document.getElementById("toggle");
        var item = document.querySelectorAll(".topic-progress-item");
        if (sidebar.style.width === "0%") {
            sidebar.style.width = "100%";
            sidebar.style.minWidth = "350px";
            step.style.display = "block";
        } else {
            sidebar.style.width = "0%";
            sidebar.style.minWidth = "0px";
            step.style.display = "none";
        }
    }

    $(document).ready(function() {

        //$('.media-pages').hide();
        $('.topic-content-frontpage').not('#topic-content-frontpage1').hide();
        $('.button').hide();
        $('.prevBtn').hide();
        $(".first-tab-link").addClass("active");


    });

    /*  $(function() {
          $('.topic-progress-item').click(function() {
              $('.topic-content-frontpage').not('#topic-content-frontpage' + $(this).attr('target')).hide();
              $('#topic-content-frontpage' + $(this).attr('target')).show();
              $('.media-pages').hide();
              $('.button').hide();


          });
      });*/
</script>

<script>
    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
        console.log(tabcontent)
    }





    if ($(window).width() < 1000) {
        $('.img-screen').show();
    } else {
        $('.img-screen').hide();
    }

    $(window).resize(function() {
        if ($(window).width() < 1000) {
            $('.img-screen').show();
        } else {
            $('.img-screen').hide();
        }
    });
</script>




<script>
    $('.topic-progress a:first').each(function() { //hover  can be used

        var title = $(this).data('module')

        $(".module-heading:first").html(title)

        $.ajax({
            type: "POST",
            url: 'query/filter-page/filter-subtopic.php',
            data: {
                module: title,
            },
            success: function(data) {
                $('.topic-home-list').html(data)


            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);

            }
        });

    });


    $('.media-pages-container').hide();

    $('.back-home').click(function() { //hover  can be used

        $('.topic-content-frontpage').show();
        $('.subtopic-content-view').hide();

    });


    $('.topic-progress a').click(function() { //hover  can be used
        /*  var id = $(this).data('id')
           var title = $(this).data('module') */

        var id = $(this).data('id')
        var title = $(this).data('module')

        $('.topic-content-frontpage').not('#topic-content-frontpage' + $(this).attr('target')).hide();
        $('#topic-content-frontpage' + $(this).attr('target')).show();
        $('.media-pages-container').hide();
        $('.tab-content').hide();

        $('.button').hide();

        $('.module-heading').html(title);

        $.ajax({
            type: "POST",
            url: 'query/filter-page/filter-subtopic.php',
            data: {
                module: title,
            },
            success: function(data) {
                $('.topic-home-list').html(data)


            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);

            }
        });
    });


    $(document).on('click', '.topic-home-list a', function(e) {
        e.preventDefault();
        $('.subtopic-content-view').show();

        var id = $(this).data('id')
        var title = $(this).data('module')
        var value = this

        var img = $(this).find(".tab-pane .headers img:first-of-type")
        /* var src = $('.tab-pane section.headers img').attr('src');
         console.log(src)*/


        $('#media-pages-container-' + $(this).attr('target')).addClass('active').show();

        $('.topic-content-frontpage').hide();

        $('.module-heading').html(title);

        $.ajax({
            type: "POST",
            url: 'query/filter-page/filter-content.php',
            data: {
                module: title,
            },
            success: function(data) {

                $(document).ready(function() {
                    <?php if (!empty($countTopicResults)) { ?>
                        <?php
                        $items = array();
                        foreach ($rowss as $rows) {
                            $items[] =  $rows['module_title'];
                        }
                        ?>
                        var arrayFromPHP = <?php echo json_encode($items) ?>;

                        $.each(arrayFromPHP, function(i, elem) {

                            $(".topic-btn-container").each(function(index) {
                                if ($(this).data('module') === elem) {
                                    $(this).find('.btnFinish').css('color', 'white')
                                    $(this).find('.btnFinish').css('background', 'green')

                                    $(this).find('.btnFinish').html('<i class="fa-solid fa-circle-check"></i> Module Finished')
                                    $(this).find('.btnFinish').prop("disabled", true);

                                }

                            });
                        });
                    <?php } ?>
                })

                $('.subtopic-content-view').html(data)
                $('.nav-link-' + $(value).attr('target')).addClass('active');
                $('.home-' + $(value).attr('target')).addClass('active');

                // $('.tab-pane:first').addClass('active');


            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);

            }
        });

    });
</script>



<script>
    $(document).on('click', '.btnNext', function() {


        const nextTabLinkEl = $('.media-pages-container .nav-tabs .active').closest('li').next('li').find('a')[0];
        const nextTab = new bootstrap.Tab(nextTabLinkEl);
        nextTab.show();
        $('#topic-content')[0].scrollTo(0, 0);

    });
    $(document).on('click', '.btnPrevious', function() {

        const prevTabLinkEl = $('.media-pages-container .nav-tabs .active').closest('li').prev('li').find('a')[0];
        const prevTab = new bootstrap.Tab(prevTabLinkEl);
        prevTab.show();
        $('#topic-content')[0].scrollTo(0, 0);

    });
</script>

<script>
    <?php if (!empty($countTopicResults)) { ?>
        $(document).ready(function() {

            <?php
            $items = array();
            foreach ($rowss as $rows) {
                $items[] =  $rows['module_title'];
            }
            ?>


            <?php $array = ['Cloud Importance', 'test']; ?>
            var arrayFromPHP = <?php echo json_encode($items) ?>;

            $.each(arrayFromPHP, function(i, elem) {

                $(".topic-progress-item").each(function(index) {


                    if ($(this).data('module') === elem) {
                        $(this).addClass('is-done')
                        $(this).nextAll('.topic-progress-item:first').removeClass('lock-topic').toggleClass('inprogress')

                    }

                });
            });


        })
    <?php  } ?>
    <?php /*
    $(document).ready(function() {

        <?php
        $items = array();
        foreach ($rowss as $rows) {
            $items[] =  $rows['module_title'];
        }
        ?>


        <?php $array = ['Cloud Importance', 'test']; ?>
        var arrayFromPHP = <?php echo json_encode($items) ?>;

        $.each(arrayFromPHP, function(i, elem) {

            $(".topic-progress-item").each(function(index) {


                if ($(this).data('module') === elem) {
                    $(this).addClass('is-done')
                    $(this).nextAll('.topic-progress-item:first').removeClass('lock-topic').toggleClass('inprogress')

                }

            });
        });

        $.ajax({
            type: "POST",
            url: 'query/test-query.php',
            dataType: 'json',
            success: function(data) {},
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);

            }
        });
    })
    */ ?>
</script>

<script>
    $(document).on('click', '.btnFinish', function(e) {

        var user_id = $('#topic-user-id').val()
        var topic_title = $(this).data('topic')
        var module_title = $(this).data('module')
        var subtopic_id = $(this).data('subtopic')
        var lesson_id = $(this).data('id')

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'query/filter-page/finish-topic.php',
            data: {
                id: user_id,
                title: topic_title,
                module_title: module_title,
                subtopic_id: subtopic_id,
                lesson_id: lesson_id
            },
            success: function() {
                Swal.fire({
                    title: 'Topic Complete!',
                    text: "You can now browse and read the next topic",
                    icon: 'success',
                    confirmButtonColor: '#800000',
                    confirmButtonText: 'OK',
                    target: document.getElementById("sweetalert-popup"),

                }).then((result) => {
                    if (result) {
                        window.location.reload();
                    } else {
                        // something other stuff
                    }

                })
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            }
        });



    })
</script>



<script>
    $(document).on('click', '.flip', function() {
        $(this).find('.custom-card').toggleClass('flipped');

    });
</script>

<script>
    function off() {
        document.getElementById("overlay").style.display = "none";
    }



    $(document).ready(function() {



        $(document).on('fullscreenchange', function(e) {
            if (document.fullscreenElement) {} else {
                // Left fullscreen; run your code here
                $('#exit-fullscreen').hide();
            }
        });

    })

    $(document).ready(function() {
        $('.headers').addClass('animated pulse')

    })

    $(document).ready(function() {
        $('#preloader').fadeIn();
        setTimeout(function() {
            $('#preloader').fadeOut();
        }, 1500);
    });
</script>