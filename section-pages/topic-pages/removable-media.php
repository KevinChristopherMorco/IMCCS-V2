<head>
    <style>
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

        .sidemenu-topic {
            margin-bottom: 30px;
            align-items: flex-start;
            justify-content: space-between;
            display: flex;
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

        .topic-home-picture {
            background: url("https://www.lifewire.com/thmb/EAuqLfRkAn1MFeeqrtdwpcnqg4I=/1996x1497/smart/filters:no_upscale()/flash-drive-58a36fe45f9b58819c41f0f6.jpg") 100% 100%;
            background-size: cover;
        }

        .div-one {
            background: url("https://www.lifewire.com/thmb/EAuqLfRkAn1MFeeqrtdwpcnqg4I=/1996x1497/smart/filters:no_upscale()/flash-drive-58a36fe45f9b58819c41f0f6.jpg") 100% 100%;
            background-size: cover;
        }

        .topic-home-container {
            display: flex;
            flex-wrap: wrap;
        }

        .column {

            /*for demo purposes only */
            background: #f2f2f2;
            border: 1px solid #e6e6e6;
            box-sizing: border-box;
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

        .hidden {
            display: none;
        }

        .media-pages .div-one {
            height: 500px;
            position: relative;
        }

        .media-pages .div-one h1 {
            color: white;
            position: absolute;
            top: 40%;

        }

        .media-pages .div-one h6 {
            color: white;
            position: absolute;
            top: 75%;

        }

        .media-pages .div-two {
            padding: 5rem 0 5rem 0;
        }

        .media-pages .title-objectives {
            padding: 5rem 0 0 5rem;
        }
    </style>
</head>
<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>IMCCS: REMOVABLE MEDIA</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<main id="main" class="main" style="padding-top: 100px;">
    <section class="main-section">
        <div class="main-content">

            <div class="container topic-home-container">
                <div class="column column-one d-flex">
                    <div class="mySidebar pt-4" id="mySidebar">
                        <ul class="topic-progress" id="topic-progress">
                            <div class="media-list-item topic-progress-item is-done"><strong>Types of Removable Media</strong>
                            </div>
                            <div class="media-list-item topic-progress-item is-done"><strong>Setting Up Medias</strong></div>
                            <div class="media-list-item topic-progress-item is-done"><strong>Security Best Practices</strong></div>
                        </ul>
                    </div>
                    <div class="toggle-topic-progress" id="toggle" onclick="toggleSidebar()">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>

                <div class="column column-two">
                    <div class="topic-header d-flex" style="background-color: #fff; padding: 10px 20px 20px 20px;">
                        <div>
                            <h4>Removable Media</h4>
                        </div>
                        <div class="fullscreen ms-auto" style="margin-top: 3px;">
                            <h6 onclick="openFullscreen();"><i class=" fa-solid fa-expand"></i> View in Fullscreen</h6>
                        </div>
                    </div>
                    <div id="topic-content">
                        <div class="frontpage-container">
                            <div class="topic-content-frontpage">
                                <div class="row g-0">
                                    <div class="col-6">
                                        <div class="topic-home text-center px-4 pt-4">
                                            <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                            <h2 class="pb-4">
                                                Module:1
                                                <br>
                                                Types of Removable Media
                                            </h2>
                                            <div class="topic-home-list">
                                                <h4 class="media-list-item">1. Introduction</h4>
                                                <h4 class="media-list-item" href="javascript:void(0)">2. Flash Storage</h4>
                                                <h4 class="media-list-item" href="javascript:void(0)">3. USB Storage</h4>
                                                <h4 class="media-list-item">4. CD-ROM/DVD-ROM Drives</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="topic-home-picture h-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="topic-content-frontpage">
                                <div class="row g-0">
                                    <div class="col-6">
                                        <div class="topic-home text-center px-4 pt-4">
                                            <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                            <h2 class="pb-4">
                                                Module:2
                                                <br>
                                                Setting Up Medias
                                            </h2>
                                            <div class="topic-home-list">
                                                <h4 class="media-list-item">1. Item for page 2</h4>
                                                <h4 class="media-list-item" href="javascript:void(0)">2. Item for page 2</h4>
                                                <h4 class="media-list-item" href="javascript:void(0)">3. Item for page 2</h4>
                                                <h4 class="media-list-item">4. Item for page 2</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="topic-home-picture h-100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="topic-content-frontpage">
                                <div class="row g-0">
                                    <div class="col-6">
                                        <div class="topic-home text-center px-4 pt-4">
                                            <img src="assets/images/website-main-logo/IMCCS-black.png" width="400px" height="200px" alt="Logo" />

                                            <h2 class="pb-4">
                                                Module:3
                                                <br>
                                                Security Best Practices
                                            </h2>
                                            <div class="topic-home-list">
                                                <h4 class="media-list-item">1. Item for page 3</h4>
                                                <h4 class="media-list-item" href="javascript:void(0)">2. Item for page 3</h4>
                                                <h4 class="media-list-item" href="javascript:void(0)">3. Item for page 3</h4>
                                                <h4 class="media-list-item">4. Item for page 3</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="topic-home-picture h-100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media-pages-container">
                            <div class="media-pages">
                                <section class="div-one px-4">
                                    <h1>Introduction</h1>
                                    <h6>Get Started</h6>
                                </section>

                                <section class="div-two">
                                    <h1 class="text-center">What Will I Learn in this Module?</h1>
                                    <div class="title-objectives">
                                        <h4 class="mb-3">Module Title: Build a Home Network:</h4>
                                        <h4 class="mb-3"> Module Objective: Configure an integrated wireless router and wireless client to connect securely to the internet.</h4>
                                    </div>
                                </section>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Topic Title</th>
                                            <th>Topic Objective</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John</td>
                                            <td>Doe</td>
                                        </tr>
                                        <tr>
                                            <td>Mary</td>
                                            <td>Moe</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="media-pages">
                                <p>Hello</p>
                            </div>
                            <div class="media-pages">USB Basics</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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
        localStorage.clear();

        $('.topic-content-frontpage:not(.frontpage-container .topic-content-frontpage:nth-child(1)').css("display", "none")

        vare1 = $('.topic-progress .media-list-item:nth-child(1)');
        vare2 = $('.topic-progress .media-list-item:nth-child(2)');
        vare3 = $('.topic-progress .media-list-item:nth-child(3)');

        var1 = $('.topic-home-list .media-list-item:nth-child(1)');
        var2 = $('.topic-home-list .media-list-item:nth-child(2)');
        var3 = $('.topic-home-list .media-list-item:nth-child(3)');

        $('.media-pages').css("display", "none");

        vare1.on('click', function() {
            $('.frontpage-container .topic-content-frontpage:nth-child(1)').attr("style", "display:block")
            $('.topic-content-frontpage:not(.frontpage-container .topic-content-frontpage:nth-child(1)').css("display", "none")
            $('.media-pages').css("display", "none");

        });

        vare2.on('click', function() {
            $('.frontpage-container .topic-content-frontpage:nth-child(2)').attr("style", "display:block")
            $('.topic-content-frontpage:not(.frontpage-container .topic-content-frontpage:nth-child(2)').css("display", "none")
            $('.media-pages').css("display", "none");

        });

        vare3.on('click', function() {
            $('.frontpage-container .topic-content-frontpage:nth-child(3)').attr("style", "display:block")
            $('.topic-content-frontpage:not(.frontpage-container .topic-content-frontpage:nth-child(3)').css("display", "none")
            $('.media-pages').css("display", "none");

        });

        var1.on('click', function() {
            $('.topic-content-frontpage').addClass('hidden');
            $('.media-pages-container .media-pages:nth-child(1)').attr("style", "display:block")
            $('.media-pages:not(.media-pages-container .media-pages:nth-child(1))').css("display", "none")
            $('.frontpage-container .topic-content-frontpage').css("display", "none")
            localStorage.setItem('page1', "true");
            localStorage.removeItem('page2');
            localStorage.removeItem('page3');

        });
        if (localStorage.getItem('page1')) {
            var1.trigger('click');
        }

        var2.on('click', function() {
            $('.topic-content-frontpage').addClass('hidden');
            $('.media-pages-container .media-pages:nth-child(2)').attr("style", "display:block")
            $('.media-pages:not(.media-pages-container .media-pages:nth-child(2))').css("display", "none")
            $('.frontpage-container .topic-content-frontpage').css("display", "none")


            localStorage.setItem('page2', "true");
            localStorage.removeItem('page1');
            localStorage.removeItem('page3');


        });
        if (localStorage.getItem('page2')) {
            var2.trigger('click');
        }

        var3.on('click', function() {
            $('.topic-content-frontpage').addClass('hidden');
            $('.media-pages-container .media-pages:nth-child(3)').attr("style", "display:block")
            $('.media-pages:not(.media-pages-container .media-pages:nth-child(3))').css("display", "none")

            localStorage.setItem('page3', "true");
            localStorage.removeItem('page1');
            localStorage.removeItem('page2');

        });
        if (localStorage.getItem('page3')) {
            var3.trigger('click');
        }

    });
</script>