<head>
    <style>
        #topic-content::-webkit-scrollbar,
        .topic-home::-webkit-scrollbar {
            width: 5px;
        }

        #topic-content::-webkit-scrollbar-track,
        .topic-home::-webkit-scrollbar {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        #topic-content::-webkit-scrollbar-thumb,
        .topic-home::-webkit-scrollbar {
            background-color: #800000;
            outline: 1px solid var(--sidebar--header-color);
        }

        .mySidebar {
            background-color: #fff;
            color: #000;

            width: 100%;
            height: 100%;
            min-width: 350px;
            overflow-x: hidden;
            overflow-y: auto;
            border-right: 1px solid #A2A2A2;
            transition: 0.2s;

        }

        .topic-home {
            background-color: #EAE6C1;
            width: 100%;
            height: 100vh;
            min-width: 350px;
            overflow-x: hidden;
            overflow-y: auto;
            border-right: 1px solid #A2A2A2;
            transition: 0.5s;
        }

        .topic-home h4 {
            color: #000;
            margin: 0 0 50px 0;
            cursor: pointer;
        }

        #topic-content {
            overflow-y: auto;
            max-height: 100vh;
            transition: 0.5s;
            background-color: white;
            padding-left: 10px;
        }

        .topic-progress {
            position: relative;
            padding-left: 45px;
            list-style: none;
        }

        .topic-progress::before {
            display: inline-block;
            content: '';
            position: absolute;
            top: 0;
            left: 15px;
            width: 10px;
            height: 100%;
        }

        .topic-progress-item {
            position: relative;
            counter-increment: list;
        }

        .topic-progress-item:not(:last-child) {
            padding-bottom: 20px;
        }

        .topic-progress-item::before {
            display: inline-block;
            content: '';
            position: absolute;
            left: -30px;
            height: 100%;
            width: 10px;
        }

        .topic-progress-item::after {
            content: '';
            display: inline-block;
            position: absolute;
            top: 0;
            left: -37px;
            width: 20px;
            height: 20px;
            border: 2px solid #CCC;
            border-radius: 50%;
            background-color: #FFF;
        }

        .topic-progress-item.is-done::before {
            border-left: 2px solid #800000;
        }

        .topic-progress-item.is-done::after {
            content: "✔";
            font-size: 13px;
            color: #FFF;
            text-align: center;
            border: 2px solid #800000;
            background-color: #800000;
        }

        .topic-progress-item.current::before {
            border-left: 2px solid #800000;
        }

        .topic-progress-item.current::after {
            content: counter(list);
            padding-top: 1px;
            width: 25px;
            height: 25px;
            top: -4px;
            left: -40px;
            font-size: 14px;
            text-align: center;
            color: #800000;
            border: 2px solid #800000;
            background-color: white;
        }

        .topic-progress strong {
            display: block;
        }

        .topic-content-frontpage:nth-child(1) .topic-home-picture:nth-child(1) {
            background: url("https://blog.ipleaders.in/wp-content/uploads/2020/12/phishing-hook-on-computer.jpg") 100% 100%;
            background-size: cover;
        }

        .topic-content-frontpage:nth-child(2) .topic-home-picture:nth-child(1) {
            background: url("https://www.peoplesbanknet.com/content/uploads/2022/07/types-of-phishing-attacks.jpg") 100% 100%;
            background-size: cover;
        }

        .topic-content-frontpage:nth-child(3) .topic-home-picture:nth-child(1) {
            background: url("http://www.menlosecurity.com/wp-content/uploads/2021/05/ZeroTrust_EmailSecurity.png") 100% 100%;
            background-size: cover;
        }

        .media-pages-container:nth-child(1) .div-one:nth-child(1) {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("https://blog.ipleaders.in/wp-content/uploads/2020/12/phishing-hook-on-computer.jpg") 100% 100%;
            background-size: cover;
        }

        .media-pages-container:nth-child(2) .div-one:nth-child(1) {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("https://www.peoplesbanknet.com/content/uploads/2022/07/types-of-phishing-attacks.jpg") 100% 100%;
            background-size: cover;
        }

        .media-pages-container:nth-child(3) .div-one:nth-child(1) {
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("http://www.menlosecurity.com/wp-content/uploads/2021/05/ZeroTrust_EmailSecurity.png") 100% 100%;
            background-size: cover;
        }


        .topic-home-container {
            display: flex;
            flex-wrap: wrap;
        }

        .topic-progress {
            cursor: pointer;

        }

        .topic-home-list {
            white-space: pre-line;

        }

        .topic-home-list a {
            cursor: pointer;
            color: #000;
            font-size: 20px;
            margin: 0 0 2rem 0;

        }


        .column {

            /*for demo purposes only */
            background: #f2f2f2;
            border: 1px solid #e6e6e6;
            box-sizing: border-box;
        }

        @media (min-width:0px) and (max-width:1000px) {




            .topic-progress-item {
                display: block !important;
            }

            .toggle-topic-progress {
                display: none;
            }

            .topic-home-container {
                flex-direction: column;

            }


        }


        .column-one {
            flex: 0;

        }

        .column-two {
            flex: 1;
        }

        .topic-header .fullscreen {
            cursor: pointer;
        }

        .topic-header .fullscreen i {
            color: #800000;
        }

        .toggle-topic-progress {
            cursor: pointer;
            background: #F4F6F7;
            padding: 10px 5px 0 5px;
            height: 100%;
        }



        .media-pages section {
            padding: 5rem 5rem 5rem 5rem;
        }

        .media-pages section p {
            font-size: 18px;
            padding: 0 0 3rem 0;
            color: #000;
        }

        .media-pages section img.cover-photo {
            padding: 5rem 0 5rem 0;

        }

        .media-pages h1 {
            padding: 0 0 5rem 0;
        }

        .media-pages .div-one {
            height: 500px;
        }

        .media-pages .div-one h1 {
            color: white;
            top: 40%;

        }

        .media-pages .div-one h6 {
            color: white;
            top: 75%;

        }

        .media-pages .div-two {
            background-color: #FFF5E4;
        }

        .media-pages .title-objectives {
            padding: 5rem 0 0 0;
        }

        table.table-bordered>thead>tr>th {
            background-color: #800000 !important;
            color: #fff;
        }

        table.table-bordered>thead>tr>th {
            border: 2px solid black;
        }

        table.table-bordered>tbody>tr>td {
            border: 2px solid black;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: #800000;
            width: 20%;

            color: #fff;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #FEAD00;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #FEAD00;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        .first-tab {
            display: block;
        }



        .media-pages {
            display: none;
        }

        .media-pages.active {
            display: block;
        }

        .button {
            padding: 1rem 1rem 1rem 1rem;
            background-color: #800000;
            color: #fff;
            border: none;
            text-align: center;
        }

        .flip {
            -webkit-perspective: 800;
            perspective: 800;
            position: relative;
            text-align: center;
        }

        .flip .custom-card.flipped {
            -webkit-transform: rotatey(-180deg);
            transform: rotatey(-180deg);
        }

        .flip .custom-card {
            width: 270px;
            height: 200px;
            -webkit-transform-style: preserve-3d;
            -webkit-transition: 0.5s;
            transform-style: preserve-3d;
            transition: 0.5s;
            background-color: #fff;

        }

        .flip .custom-card .face {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            z-index: 2;
        }

        .flip .custom-card .front {
            position: absolute;
            width: 270px;
            z-index: 1;
        }

        .flip .card .front img {
            width: 270px;
            height: 100%;
            object-fit: cover;
        }



        .flip .custom-card .back {
            padding: 1rem 1rem 1rem 1rem;
            height: 200px;
            background-color: #800000;
            -webkit-transform: rotatey(-180deg);
            transform: rotatey(-180deg);
            position: absolute;
        }

        .flip .custom-card .back p,
        .flip .custom-card .back h3 {
            color: #fff !important;


        }

        .inner {
            margin: 0px !important;
            width: 270px;
        }

        .card-img-top {
            width: 100%;
            height: 20vw;
            object-fit: cover;
        }
    </style>


</head>
<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>IMCCS: Phishing Attacks</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<main id="main" class="main" style="padding-top: 100px;">
    <section class="main-section">
        <div class="main-content">

            <div class="topic-home-container">
                <div class="column column-one d-flex">
                    <div class="mySidebar pt-4" id="mySidebar">
                        <ul class="topic-progress" id="topic-progress">
                            <a class="topic-progress-item is-done" target="1" id="choice1"><strong>How Phishing Works</strong>
                            </a>
                            <a class="topic-progress-item is-done" target="2" id="choice2"><strong>Types of Phishing Attacks</strong></a>
                            <a class="topic-progress-item is-done" target="3" id="choice3"><strong>Phishing Prevention</strong></a>
                        </ul>
                    </div>
                    <div class="toggle-topic-progress" id="toggle" onclick="toggleSidebar()">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>

                <div class="column column-two">
                    <div class="topic-header d-flex" style="background-color: #fff; padding: 10px 20px 20px 20px;">
                        <div>
                            <h4>Phishing Attacks</h4>
                        </div>
                        <div class="fullscreen ms-auto" style="margin-top: 3px;">
                            <h6 onclick="openFullscreen();"><i class=" fa-solid fa-expand"></i> View in Fullscreen</h6>
                        </div>
                    </div>
                    <div class="topic-content" id="topic-content">
                        <div class="frontpage-container">
                            <div class="topic-content-frontpage" id="topic-content-frontpage1">
                                <div class="row g-0">
                                    <div class="col-lg-6 col-sm-12">
                                        <img class="img-screen" src="https://blog.ipleaders.in/wp-content/uploads/2020/12/phishing-hook-on-computer.jpg" alt="">

                                        <div class="topic-home text-center px-4 pt-4">
                                            <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                            <h2 class="pb-4">
                                                Module:1
                                                <br>
                                                How Phishing Works
                                            </h2>
                                            <div class="topic-home-list">
                                                <a class="media-list-item" target="1" id="page-1">1. Introduction</a>
                                                <a class="media-list-item" target="2" id="page-2">2. The Use of the Victims Emotion</a>
                                                <a class="media-list-item" target="3" id="page-3">3. Legitimate Appearance</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="topic-home-picture h-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="topic-content-frontpage" id="topic-content-frontpage2">
                                <div class="row g-0">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="topic-home col-lg-6 col-sm-12 text-center px-4 pt-4">
                                            <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                            <h2 class="pb-4">
                                                Module:2
                                                <br>
                                                Types of Phishing Attacks
                                            </h2>
                                            <div class="topic-home-list">
                                                <a class="media-list-item" target="4" id="page-4">1. Introduction</a>
                                                <a class="media-list-item" target="5" id="page-5">2. Spear Phishing</a>
                                                <a class="media-list-item" target="6" id="page-6">3. Microsoft 365 Phishing</a>
                                                <a class="media-list-item" target="7" id="page-7">4. Business Email Compromise (BEC)</a>
                                                <a class="media-list-item" target="8" id="page-8">5. Whaling</a>
                                                <a class="media-list-item" target="9" id="page-9">6. Social Media Phish</a>
                                                <a class="media-list-item" target="10" id="page-10">7. Voice Phishing</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="topic-home-picture h-100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="topic-content-frontpage" id="topic-content-frontpage3">
                                <div class="row g-0">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="topic-home text-center px-4 pt-4">
                                            <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                            <h2 class="pb-4">
                                                Module:3
                                                <br>
                                                Phishing Prevention
                                            </h2>
                                            <div class="topic-home-list">
                                                <a class="media-list-item" target="11" id="page-11">1. Introduction</a>
                                                <a class="media-list-item" target="12" id="page-12">2. How to Protect Yourself</a>
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
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">Menu 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu2">Menu 2</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane container active" id="home">
                            <div class="media-pages" id="media-pages1">
                                    <section class="div-one px-4">
                                        <h1>Introduction</h1>
                                        <h6>Get Started</h6>
                                    </section>
                            </div>
                                <a class="btn btn-primary btnNext">Next</a>

                            </div>
                            <div class="tab-pane container fade" id="menu1">
                                <h1>Menu 1</h1>
                                <a class="btn btn-primary btnPrevious">Back</a>
                                <a class="btn btn-primary btnNext">Next</a>
                            </div>
                            <div class="tab-pane container fade" id="menu2">
                                <h1>Menu 2</h1>
                                <a class="btn btn-primary btnPrevious">Back</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.btnNext').click(function() {
        const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
        const nextTab = new bootstrap.Tab(nextTabLinkEl);
        nextTab.show();
    });

    $('.btnPrevious').click(function() {
        const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
        const prevTab = new bootstrap.Tab(prevTabLinkEl);
        prevTab.show();
    });
</script>
<script>
    function openFullscreen() {
        var content = document.getElementById("topic-content");

        if (content.requestFullscreen) {
            content.requestFullscreen();
            content.style.paddingLeft = "0px";
        } else if (content.mozRequestFullScreen) {
            /* Firefox */
            content.mozRequestFullScreen();
            content.style.paddingLeft = "0px";

        } else if (content.webkitRequestFullscreen) {
            /* Chrome, Safari and Opera */
            content.webkitRequestFullscreen();
            content.style.paddingLeft = "0px";

        } else if (content.msRequestFullscreen) {
            /* IE/Edge */
            content.msRequestFullscreen();
            content.style.paddingLeft = "0px";

        }
    }


    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            /* Firefox */
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            /* Chrome, Safari and Opera */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            /* IE/Edge */
            document.msExitFullscreen();
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

    $(function() {
        $('.topic-progress-item').click(function() {
            $('.topic-content-frontpage').not('#topic-content-frontpage' + $(this).attr('target')).hide();
            $('#topic-content-frontpage' + $(this).attr('target')).show();
            $('.media-pages').hide();
            $('.button').hide();


        });
    });

    $(function() {
        $('.media-list-item').click(function() {
            $('.media-pages').not('#media-pages' + $(this).attr('target')).hide();
            $('#media-pages' + $(this).attr('target')).show();
            $('.topic-content-frontpage').hide();
        });

        $('.topic-home-list:first .media-list-item').click(function() {
            $('.media-pages-container:nth-child(1) .button').show();
            $('.media-pages-container:nth-child(2) .button').hide();
            $('.media-pages-container:nth-child(3) .button').hide();



        });

        $('.topic-home-list:eq(1) .media-list-item').click(function() {
            $('.media-pages-container:nth-child(1) .button').hide();
            $('.media-pages-container:nth-child(2) .button').show();
            $('.media-pages-container:nth-child(3) .button').hide();
        });

        $('.topic-home-list:eq(2) .media-list-item').click(function() {
            $('.media-pages-container:nth-child(1) .button').hide();
            $('.media-pages-container:nth-child(2) .button').hide();
            $('.media-pages-container:nth-child(3) .button').show();
        });


    });
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

    }



    /* $(".nextBtn").click(function() {
         var nextDiv = $(this).parents(':eq(1)').find(".media-pages:visible").next(".media-pages");
         if (nextDiv.length == 0) { // wrap around to beginning
             //nextDiv = $(this).parents(':eq(1)').find(".media-pages:first");
         } else if (nextDiv.length == 1) {
             $('.prevBtn').show()

         }
         $(this).parents(':eq(1)').find(".media-pages").hide();
         nextDiv.show();
     });

     $(".prevBtn").click(function() {
         var prevDiv = $(this).parents(':eq(1)').find(".media-pages:visible").prev(".media-pages");

         if (prevDiv.length == 0) { // wrap around to end
             //prevDiv = $(this).parents(':eq(1)').find(".media-pages:last");

         }
         $(this).parents(':eq(1)').find(".media-pages").hide();
         prevDiv.show();
     });*/

    $(function() {

        /* add next/previous buttons to all class body_next */


        var collBodyNext = $('.media-pages-container');

        collBodyNext.each(function() {

            // Current 'body next' item
            var curBodyNext = $(this),

                // Total sections within current 'body next'
                totalSections = $('.media-pages', curBodyNext).length,

                // Tracker
                tracker = 1;

            /* hide all media-pages except the first */
            $(".media-pages:not(:first)", curBodyNext).hide();

            $(".nextBtn", curBodyNext).click(function() {
                // Current element
                var curElement = $(this);

                // Get related 'body next' section
                var bodyNext = curElement.closest('.media-pages-container');

                $(".media-pages:visible", bodyNext).next(".media-pages:hidden").show().prev(".media-pages:visible").hide();


                /* show previous button if displayed section is not the first one */
                if (tracker > 1) {
                    $(".prevBtn", bodyNext).show();
                }

                /* hide next button if displayed section is the last one */
                if (tracker === totalSections) {
                    $(".nextBtn", bodyNext).hide();
                } else {
                    $(".nextBtn", bodyNext).show();
                }

            });

            $(".prevBtn", curBodyNext).click(function() {

                // Current element
                var curElement = $(this);

                // Get related 'body next' section
                var bodyNext = curElement.closest('.media-pages-container');

                $(".media-pages:visible", bodyNext).prev(".media-pages:hidden").show().next(".media-pages:visible").hide();


                /* show next button if displayed section is not the first one */
                if (tracker === 1) {
                    $(".nextBtn", bodyNext).show();
                }

                /* hide previous button if displayed section is the first one */
                if (tracker === 0) {
                    $(".prevBtn", bodyNext).hide();
                }

            });
        });

    })

    $('.flip').click(function() { //hover  can be used
        $(this).find('.custom-card').toggleClass('flipped');

    });

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