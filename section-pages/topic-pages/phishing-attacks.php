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
                        <div class="topic-pages">
                            <div class="media-pages-container">
                                <div class="media-pages" id="media-pages1">
                                    <section class="div-one px-4">
                                        <h1>Introduction</h1>
                                        <h6>Get Started</h6>
                                    </section>

                                    <section class="div-two">
                                        <h1 class="text-center">What Will I Learn in this Module?</h1>
                                        <div class="title-objectives">
                                            <h4 class="mb-3">Module Title: How Phishing Works:</h4>
                                            <h4 class="mb-3"> Module Objective: Identify the ways on how phishers conducts the attack.</h4>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Topic Title</th>
                                                    <th>Topic Objective</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>The Use of the Victims Emotion</td>
                                                    <td>Identify on how phishers uses the victims emotions</td>
                                                </tr>
                                                <tr>
                                                    <td>Legitimate Appearance</td>
                                                    <td>Identify on how phishers uses legitimacy to persuade victims</td>
                                                </tr>
                                                <tr>
                                                    <td>Innovative Styles and Techniques</td>
                                                    <td>Identify on how phishers and cybercriminals uses various styles and techniques</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>

                                </div>
                                <div class="media-pages" id="media-pages2">
                                    <section class="div-three">
                                        <h1>Inside the Mind of a Phisher</h1>
                                        <p>Mitnick says his favorite emotional tool was fear.

                                            He writes about this in his book, "Ghost in the Wires":
                                            </br>

                                            "I would call the company I'd targeted, ask for their computer room, make sure I was talking to a system administrator, and tell him, 'This is [whatever fictitious name popped into my head at that moment], from DEC support. We've discovered a catastrophic bug in your version of RSTS/E. You could lose your data.'

                                            This is a very powerful social-engineering technique, because the fear of losing data is so great that most people won't hesitate to cooperate.

                                            With the person sufficiently scared, I'd say, 'We can patch your system without interfering with your operations.' By that point the guy (or sometimes, lady) could hardly wait to give me the dial-up phone number and access to the system-manager account."
                                            </br>
                                            Fear repeatedly got Mitnick access to a network so he could create a new account and install a back door to give him a secret way into the system.</p>
                                        <img class="cover-photo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Cyber_Incursion_event_at_the_City_of_London.jpg/1200px-Cyber_Incursion_event_at_the_City_of_London.jpg" alt="">
                                        <h1>5 emotions hackers and cybercriminals use against us</h1>
                                        <p class="pb-4">Click to view each description</p>
                                        <div class="tab">
                                            <button class="tablinks first-tab-link" onclick="openTab(event, 'greed')">Greed</button>
                                            <button class="tablinks" onclick="openTab(event, 'curiosity')">Curiosity</button>
                                            <button class="tablinks" onclick="openTab(event, 'urgency')">Urgency</button>
                                            <button class="tablinks" onclick="openTab(event, 'helpfulness')">Helpfulness</button>
                                            <button class="tablinks" onclick="openTab(event, 'fear')">Fear</button>
                                        </div>

                                        <div id="greed" class="first-tab tabcontent">
                                            <div class="row">
                                                <h3 class="col-12">Greed</h3>
                                                <p class="col-6">
                                                    Here's an example of a phishing email your employees might receive that uses greed to try to get them to click a link. You've got the inside track on a hot IPO if you click.
                                                    <br>
                                                    This is your "last chance" to get in on this deal. If your investment does well, maybe you can finally quit your day job!
                                                </p>
                                                <img class="col-6" width="50px" height="400px" src="https://cdn.scmagazine.com/wp-content/uploads/sites/2/2019/11/salary-phish.jpg" alt="">

                                            </div>
                                        </div>

                                        <div id="curiosity" class="tabcontent">
                                            <div class="row">
                                                <h3 class="col-12">Curiosity</h3>
                                                <p class="col-6">
                                                    Here's one that could make your employees wonder: did the State Department accidentally share some confidential information with me? Yes, but only for a "short time," according to this phishing example:
                                                </p>
                                                <img class="col-6" width="50px" height="400px" src="https://www.secureworld.io/hs-fs/hubfs/phishing-attack-microsoft-one-drive-1.gif?width=1020&name=phishing-attack-microsoft-one-drive-1.gif" alt="">

                                            </div>
                                        </div>

                                        <div id="urgency" class="tabcontent">
                                            <div class="row">
                                                <h3 class="col-12">Urgency</h3>
                                                <p class="col-6">
                                                    Hackers use fake security alerts like this one—exclamation mark and all. Clearly, it's urgent: "Virus Infection Blocked... Virus will steal and delete your iCloud, Photos and contacts if you don't Act Now."
                                                    <br>
                                                    And how convenient, there are two buttons you can click to get phished. Choose Install or choose Cancel and you've been hooked by hackers.
                                                </p>
                                                <img class="col-6" width="50px" height="400px" src="https://www.secureworld.io/hs-fs/hubfs/social-engineering-apple-smishing-VPN.png?width=516&name=social-engineering-apple-smishing-VPN.png" alt="">

                                            </div>
                                        </div>

                                        <div id="helpfulness" class="tabcontent">
                                            <div class="row">
                                                <h3 class="col-12">Helpfulness</h3>
                                                <p class="col-6">
                                                    Studies have shown that most of us are willing to help, which is why campaigns asking for help are often very successful. Unfortunately, hackers and cybercriminals use major tragedies to appeal for help—but they are only helping themselves. <br>

                                                </p>
                                                <img class="col-6" width="50px" height="400px" src="https://3j44dp2ae82c1mdbu51lj2dm-wpengine.netdna-ssl.com/wp-content/uploads/2020/07/fake-WHO-charity-donation-min.png" alt="">

                                            </div>
                                        </div>

                                        <div id="fear" class="tabcontent">
                                            <div class="row">
                                                <h3 class="col-12">Fear</h3>
                                                <p class="col-6">
                                                    And now, here we are, back with hacker Kevin Mitnick's old friend, fear. Hackers love to use fear against us.

                                                    We are seeing this right now in COVID-19 related cyberattacks, like the app that promises to alert you of new cases on "your street" but once you download it, it serves up ransomware instead. And guess what, this part of the attack also uses fear. Pay $100 in Bitcoin or lose your contacts, photos, and everything on your phone.
                                                </p>
                                                <img class="col-6" width="50px" height="400px" src="https://www.secureworld.io/hs-fs/hubfs/covid-19-app-is-ransomware-note.png?width=479&name=covid-19-app-is-ransomware-note.png" alt="">

                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="media-pages" id="media-pages3">
                                    <section>
                                        <h1>The Art of Deception</h1>
                                        <p> Fraudsters impersonate a legitimate company to steal people’s personal data or login credentials. Those emails use threats and a sense of urgency to scare users into doing what the attackers want.</p>
                                        <h1>Ways to Detect a Phishing Email</h1>

                                        <h4>1. The message is sent from a public email domain</h4>

                                        <p>No legitimate organisation will send emails from an address that ends ‘@gmail.com’.

                                            Not even Google.

                                            Except for some small operations, most companies will have their own email domain and email accounts. For example, genuine emails from Google will read ‘@google.com’.

                                            If the domain name (the bit after the @ symbol) matches the apparent sender of the email, the message is probably legitimate.

                                            By contrast, if the email comes from an address that isn’t affiliated with the apparent sender, it’s almost certainly a scam.

                                            The most obvious way to spot a bogus email is if the sender uses a public email domain, such as ‘@gmail.com’.</p>

                                        <img class="cover-photo" src="https://www.itgovernance.co.uk/blog/wp-content/uploads/2022/03/59C99078-E7CB-42FE-9B95-0664543232DF-911x1024.jpeg" alt="">

                                        <p>In this example, you can see that the sender’s email address doesn’t align with the message’s content, which appears to be from PayPal.

                                            However, the message itself looks realistic, and the attacker has customised the sender’s name field so that it will appear in recipients’ inboxes as ‘Account Support’.

                                            Other phishing emails will take a more sophisticated approach by including the organisation’s name in the local part of the domain. In this instance, the address might read ‘paypalsupport@gmail.com’.

                                            At first glance, you might see the word ‘PayPal’ in the email address and assume it is legitimate. However, you should remember that the important part of the address is what comes after the @ symbol. This dictates the organisation from which the email has been sent.

                                            If the email is from ‘@gmail.com’ or another public domain, you can be sure it has come from a personal account.</p>

                                        <h4>2. The domain name is misspelt</h4>

                                        <p>There’s another clue hidden in domain names that provides a strong indication of phishing scams ­– unfortunately, it complicates our previous clue.

                                            The problem is that anyone can buy a domain name from a registrar. And although every domain name must be unique, there are plenty of ways to create addresses that are indistinguishable from the one that’s being spoofed.

                                            Take a look at this example:</p>

                                        <img class="cover-photo" src="https://www.itgovernance.co.uk/blog/wp-content/uploads/2022/03/image.png" alt="">

                                        <p>Here, scammers have registered the domain ‘microsfrtfonline.com’, which to a casual reader mimics the words ‘Microsoft Online’, which could reasonably be considered a legitimate address.

                                            Meanwhile, some fraudsters get even more creative. The Gimlet Media podcast ‘Reply All’ demonstrated that in the episode What Kind Of Idiot Gets Phished?.

                                            Phia Bennin, the show’s producer, hired an ethical hacker to phish various employees. He bought the domain ‘gimletrnedia.com’ (that’s r-n-e-d-i-a, rather than m-e-d-i-a) and impersonated Bennin.

                                            His scam was so successful that he tricked the show’s hosts, Gimlet Media’s CEO and its president.

                                            As Bennin went on to explain, you don’t even need to fall victim for a criminal hacker to gain vital information.

                                            In this scam, the ethical hacker, Daniel Boteanu, could see when the link was clicked, and in one example, that it had been opened multiple times on different devices.

                                            He reasoned that the target’s curiosity kept bringing him back to the link but that he was suspicious enough not to follow its instructions.

                                        </p>

                                        <p>Therefore, criminal hackers often still win even when you’ve thwarted their initial attempt.

                                            That is to say, indecisiveness in spotting a phishing scam provides clues to the scammer about where the strengths and weaknesses in your organisation are.

                                            Launching subsequent scams that use this information takes minimal effort, and they can keep doing this until they find someone who falls victim.

                                            Remember, criminal hackers only require one mistake from one employee for their operation to be a success. Everyone in your organisation must be confident in their ability to spot a scam upon first seeing it.</p>
                                        <h4>3. Suspicious Links</h4>
                                        <p>You can spot a suspicious link if the destination address doesn’t match the context of the rest of the email.

                                            For example, if you receive an email from Netflix, you would expect the link to direct you towards an address that begins ‘netflix.com’.

                                            Unfortunately, many legitimate and scam emails hide the destination address in a button, so it’s not immediately apparent where the link goes.</p>
                                        <img class="cover-photo" src="https://www.itgovernance.co.uk/blog/wp-content/uploads/2022/03/image-2.png" alt="">

                                        <p>In this example, the scammers are claiming that there is an issue with the recipient’s Netflix subscription. The email is designed to direct them to a mock-up of Netflix’s website, where they will be prompted to enter their payment details.

                                            The fraudsters achieve two things by including the link within a button that says ‘Update account now’.

                                            First, it makes the message look genuine, with buttons becoming increasingly popular in emails and websites. But more importantly, it hides the destination address, making it a hyperlink.

                                            To ensure you don’t fall for schemes like this, you must train yourself to check where links go before opening them.

                                            Thankfully, this is straightforward: on a computer, hover your mouse over the link, and the destination address appears in a small bar along the bottom of the browser.

                                            On a mobile device, hold down on the link, and a pop-up will appear containing the link.</p>

                                    </section>
                                </div>
                                <div class="button-toggle text-center">
                                    <button class="button prevBtn">Prev</button>
                                    <button class="button nextBtn">Next</button>
                                </div>
                            </div>

                            <div class="media-pages-container">
                                <div class="media-pages" id="media-pages4">
                                    <section class="div-one px-4">
                                        <h1>Introduction</h1>
                                        <h6>Get Started</h6>
                                    </section>

                                    <section class="div-two">
                                        <h1 class="text-center">What Will I Learn in this Module?</h1>
                                        <div class="title-objectives">
                                            <h4 class="mb-3">Module Title: Types of Phishing Attacks:</h4>
                                            <h4 class="mb-3"> Module Objective: Identify the ways on how phishers conducts the attack.</h4>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Topic Title</th>
                                                    <th>Topic Objective</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Spear Phishing</td>
                                                    <td>Explain Spear Phishing</td>
                                                </tr>
                                                <tr>
                                                    <td>Microsoft 365 Phishing</td>
                                                    <td>Explain Microsoft 365 Phishing</td>
                                                </tr>
                                                <tr>
                                                    <td>Business Email Compromise (BEC)</td>
                                                    <td>Explain Business Email Compromise (BEC)</td>
                                                </tr>

                                                <tr>
                                                    <td>Whaling</td>
                                                    <td>Explain Whaling</td>
                                                </tr>
                                                <tr>
                                                    <td>Social Media Phish</td>
                                                    <td>Explain Social Media Phish</td>
                                                </tr>
                                                <tr>
                                                    <td>Voice Phishing</td>
                                                    <td>Explain Social Media Voice Phishing</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>

                                </div>
                                <div class="media-pages" id="media-pages5">
                                    <section>
                                        <h1>Spear Phishing</h1>
                                        <p> Spear phishing targets specific individuals instead of a wide group of people.
                                            That way, the attackers can customize their communications and appear more authentic.
                                            Spear phishing is often the first step used to penetrate a company's defenses and carry out a targeted attack.
                                            According to the SANS Institute, 95 percent of all attacks on enterprise networks are the result of successful spear phishing.</p>

                                        <h1>How to Identify a Spear Phish</h1>
                                        <p>
                                            <b>Forged link.</b> Even if a link has a name you recognize somewhere in it, it doesn’t mean it links to the real organization. Roll your mouse over the link and see if it matches what appears in the email. If there is a discrepancy, don’t click on the link. Also, websites where it is safe to enter personal information begin with “https” — the “s” stands for secure. If you don’t see “https” do not proceed.
                                        </p>
                                        <p>
                                            <b>Requests personal information.</b> The point of sending phishing email is to trick you into providing your personal information. If you receive an email requesting your personal information, it is probably a phishing attempt. You can always check out their claim safely by heading to your bank’s website and calling them or emailing them directly.
                                        </p>
                                        <p>
                                            <b> Sense of urgency. </b> Internet criminals want you to provide your personal information now. They do this by making you think something has happened that requires you to act fast. The faster they get your information, the faster they can move on to another victim.
                                        </p>
                                    </section>
                                </div>
                                <div class="media-pages" id="media-pages6">
                                    <section>
                                        <h1> Microsoft 365 Phishing </h1>
                                        <p>The methods used by attackers to gain access to a Microsoft 365 email account are fairly simple and becoming the most common. These phishing campaigns usually take the form of a fake email from Microsoft. The email contains a request to log in, stating the user needs to reset their password, hasn't logged in recently, or that there's a problem with the account that needs their attention. A URL is included, enticing the user to click to remedy the issue.</p>
                                        <h1> Attackers have taken notice</h1>
                                        <p>Of course, its popularity has led to malicious attacks. Attackers are crafting and launching phishing campaigns targeting Office 365 users. The attackers attempt to steal a user’s login credentials with the goal of taking over the accounts. If successful, attackers can often log into the compromised accounts, and perform a wide variety of malicious activity:</p>

                                        <p>At first glance, this may not seem very different than external email-based attacks. However, there is one critical difference: The malicious emails sent are now coming from legitimate accounts. For the recipient, it’s often even someone that they know, eliciting trust in a way that would not necessarily be afforded to an unknown source. To make things more complicated, attackers often leverage “conversation hijacking,” where they deliver their payload by replying to an email that’s already located in the compromised inbox.</p>
                                        <img class="cover-photo" src="https://storage.googleapis.com/blogs-images/ciscoblogs/1/5cee928d679c8-550x468.jpg" alt="">

                                    </section>
                                </div>
                                <div class="media-pages" id="media-pages7">
                                    <section>
                                        <h1>Business Email Compromise (BEC)</h1>

                                        <p>BEC is carefully planned and researched attacks that impersonate a company executive vendor or supplier.</p>
                                        <h1>Why BEC now?</h1>
                                        <p>Social Media and social engineering has
                                            added to the success rate for spoofing
                                            attacks. Attackers are not just randomly
                                            choosing their targets.
                                            </br>
                                            These attackers are extremely sophisticated
                                            and will follow targets for months, on social
                                            media, news sites, and other social platforms
                                        </p>

                                        <h1>How it works</h1>
                                        <p>Adversaries create targeted messages and add unique details about either the person they
                                            are posing as, and/or the person they are attacking, to add legitimacy to the request.</p>


                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="flip">
                                                    <div class="custom-card">
                                                        <div class="face front">
                                                            <div class="inner">
                                                                <img class="card-img-top" src="https://cdn.iconscout.com/icon/free/png-256/mail-1299-1100772.png">
                                                            </div>
                                                        </div>
                                                        <div class="face back">
                                                            <div class="inner text-center">
                                                                <h3>BEC Campaign</h3>
                                                                <p>Adversary sends an email</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="flip">
                                                    <div class="custom-card">
                                                        <div class="face front">
                                                            <div class="inner">
                                                                <img class="card-img-top" src="data:image/png;base64,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">
                                                            </div>
                                                        </div>
                                                        <div class="face back">
                                                            <div class="inner text-center">
                                                                <h3>Urgent Message</h3>
                                                                <p>Compels recipient to send money</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="flip">
                                                    <div class="custom-card">
                                                        <div class="face front">
                                                            <div class="inner">
                                                                <img class="card-img-top" src="https://www.citypng.com/public/uploads/small/1164025073765lrfn5r2fudwdjesoladcytuvjylynki3sfgdob9ihqofiwxsx3xbpurijyq9kjc6uycqmoiqg7lvxaox33cudkvaoiu47mcegf.png">
                                                            </div>
                                                        </div>
                                                        <div class="face back">
                                                            <div class="inner text-center">
                                                                <h3>Criminal Accounts</h3>
                                                                <p>Money ends in foreign and
                                                                    domestic bank accounts</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                </div>
                                <div class="media-pages" id="media-pages8">
                                    <section>
                                        <h1>Whaling</h1>
                                        <p>When attackers go after a "big fish" like a CEO, it's called whaling. These attackers often spend considerable time profiling the target to find the opportune moment and means to steal login credentials. Whaling is of particular concern because high-level executives are able to access a great deal of sensitive company information.</p>
                                    </section>
                                </div>
                                <div class="media-pages" id="media-pages9">
                                    <section>
                                        <h1>Social Media Phish</h1>
                                        <p>Attackers often research their victims on social media and other sites to collect detailed information, and then plan their attack accordingly.</p>
                                    </section>
                                </div>
                                <div class="media-pages" id="media-pages10">
                                    <section>
                                        <h1>Voice Phishing</h1>
                                        <p>Voice phishing, or "vishing," is a form of social engineering. It is a fraudulent phone call designed to obtain sensitive information such as login credentials. For instance, the attacker might call pretending to be a support agent or representative of your company. New employees are often vulnerable to these types of scams, but they can happen to anyone--and are becoming more common.</p>
                                    </section>
                                </div>
                                <div class="button-toggle text-center">
                                    <button class="button prevBtn">Prev</button>
                                    <button class="button nextBtn">Next</button>
                                </div>
                            </div>
                            <div class="media-pages-container">
                                <div class="media-pages" id="media-pages11">
                                    <section class="div-one px-4">
                                        <h1>Introduction</h1>
                                        <h6>Get Started</h6>
                                    </section>

                                    <section class="div-two">
                                        <h1 class="text-center">What Will I Learn in this Module?</h1>
                                        <div class="title-objectives">
                                            <h4 class="mb-3">Module Title:Phishing Prevention:</h4>
                                            <h4 class="mb-3"> Module Objective: Identify ways to avoid becoming a victim of phishing scams and attacks.</h4>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Topic Title</th>
                                                    <th>Topic Objective</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>How to Protect Yourself </td>
                                                    <td>Identify ways to protect yourself from phishers</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>

                                </div>
                                <div class="media-pages" id="media-pages12">
                                    <section>
                                        <h1>How to Protect Yourself </h1>
                                        <p>Phishing is one of the most enduring security risks IT professionals face. It’s been a common avenue for credential theft for years — but despite all the notoriety, phishing campaigns continue to fool even the most vigilant among us. As attacks become more sophisticated, the security that prevents them is evolving as well, moving beyond network-based tools to an identity-based model.</p>

                                        <h1>Tips to Prevent Phishing Attacks </h1>

                                        <h4>1. Know what a phishing scam looks like</h4>
                                        <p>New phishing attack methods are being developed all the time, but they share commonalities that can be identified if you know what to look for. There are many sites online that will keep you informed of the latest phishing attacks and their key identifiers. The earlier you find out about the latest attack methods and share them with your users through regular security awareness training, the more likely you are to avoid a potential attack.</p>

                                        <h4>2. Don’t click on that link</h4>
                                        <p>It’s generally not advisable to click on a link in an email or instant message, even if you know the sender. The bare minimum you should be doing is hovering over the link to see if the destination is the correct one. Some phishing attacks are fairly sophisticated, and the destination URL can look like a carbon copy of the genuine site, set up to record keystrokes or steal login/credit card information. If it’s possible for you to go straight to the site through your search engine, rather than click on the link, then you should do so.</p>

                                        <h4>3. Don’t give your information to an unsecured site</h4>
                                        <p>If the URL of the website doesn’t start with “https”, or you cannot see a closed padlock icon next to the URL, do not enter any sensitive information or download files from that site. Sites without security certificates may not be intended for phishing scams, but it’s better to be safe than sorry.
                                        </p>
                                    </section>
                                </div>
                                <div class="button-toggle text-center">
                                    <button class="button prevBtn">Prev</button>
                                    <button class="button nextBtn">Next</button>
                                </div>
                            </div>

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