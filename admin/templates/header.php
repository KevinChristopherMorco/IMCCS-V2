<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IMCSS ADMIN</title>
<!-- Icon -->
<link href="assets/img/logo/IMCCS-white.png" rel="icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<!-- <link href="assets/vendor/fontawesome/css/all.css" rel="stylesheet"> -->


<link rel="stylesheet" href="assets/css/admin-custom-css.css">
<link rel="stylesheet" href="assets/css/retake-assessment.css">
<link rel="stylesheet" href="assets/css/account-settings.css">
<link rel="stylesheet" href="assets/css/form.css">
<link rel="stylesheet" href="assets/css/media-query.css">
<link rel="stylesheet" href="assets/css/swal-toast.css">

<!-- ADMIN ICONS -->
<link rel="stylesheet" href="assets/css/admin-icons.css">

<!-- Datatable CSS Files -->
<link rel="stylesheet" href="assets/css/datatable.css">

<!-- Sweet Alert2 Custom CSS File -->
<link rel="stylesheet" href="assets/css/custom-modal-sweetalert2.css">


<!-- CDN FILES REQUIRED INTERNET CONNECTION -->
<!-- CDN FILES REQUIRED INTERNET CONNECTION -->
<!-- CDN FILES REQUIRED INTERNET CONNECTION -->


<!-- FONT AWESOME CDN-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
<!-- SWEET ALERT CDN JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.all.min.js"></script>
<!-- Latest JQUERY VERSION -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Latest JS CHARTS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<!-- Latest TINYMCE WYSIWYG EDITOR

<script src="https://cdn.tiny.cloud/1/7nuzrm7fp027p7lzarywrv3489efi0v2z6ao0cjicy9teq82/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>-->

<script src="assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '.form-add-lesson textarea',
        plugins: 'image code table advtable fullscreen',
        width: "1200",
        height: "800",
        fullscreen_native: true,
        setup: function(ed) {
            ed.on('keyup', function(e) {
                var input = $('.form-add-lesson tox-edit-area__iframe');
                if ($(ed.getBody()).text().length == 0) {
                    $('.form-add-lesson .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-add-lesson .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-add-lesson .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-add-lesson .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
            });
        }
    });


    tinymce.init({
        selector: '.form-update-lesson textarea',
        plugins: 'image code table advtable fullscreen',
        width: "1200",
        height: "800",
        fullscreen_native: true,
        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-update-lesson tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-lesson .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-lesson .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-lesson .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-lesson .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

    tinymce.init({
        selector: '.form-add-assessment textarea',
        plugins: 'image code table advtable fullscreen',
        width: "1200",
        height: "800",
        fullscreen_native: true,
        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-add-assessment tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-add-assessment .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-add-assessment .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-add-assessment .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-add-assessment .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

    tinymce.init({
        selector: '.form-update-assessment textarea',
        plugins: 'image code table advtable fullscreen',
        width: "1200",
        height: "800",
        fullscreen_native: true,
        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-update-assessment tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-assessment .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-assessment .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-assessment .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-assessment .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

    tinymce.init({
        selector: '.form-add-assessment-choice  textarea',
        plugins: 'image code table advtable fullscreen',
        width: "1200",
        height: "300",
        fullscreen_native: true,
        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-add-assessment-choice  tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-add-assessment-choice  .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-add-assessment-choice  .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-add-assessment-choice  .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-add-assessment-choice  .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

    tinymce.init({
        selector: '.form-update-assessment-choice  textarea',
        plugins: 'image code table advtable fullscreen',
        width: "1200",
        height: "800",
        fullscreen_native: true,
        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-update-assessment-choice  tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-assessment-choice  .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-assessment-choice  .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-assessment-choice  .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-assessment-choice  .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });


    tinymce.init({
        selector: '.form-add-subtopic textarea',
        plugins: 'code print preview powerpaste casechange tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
        width: "1200",
        height: "800",
        media_live_embeds: true,
        keep_styles: false,
        toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | link image | code',
        templates: [{

                title: 'Page Header',
                description: 'Add custom header',
                url: 'assets/html-template/premade-template/header/header.html'
            },

            {
                title: 'Aqua Template',
                description: 'Premade Template with aqua theme',
                url: 'assets/html-template/premade-template/template-theme/aqua-template.html'
            },

            {
                title: 'Orange Template',
                description: 'Premade Template with orange theme',
                url: 'assets/html-template/premade-template/template-theme/orange-template.html'
            },

            {
                title: 'Green Template',
                description: 'Premade Template with green theme',
                url: 'assets/html-template/premade-template/template-theme/green-template.html'
            },

            {
                title: 'Introduction Template',
                description: 'Template for introduction',
                url: 'assets/html-template/premade-template/Introduction-template.html'
            },

            {
                title: 'Table Content',
                description: 'Add a div with table',
                url: 'assets/html-template/premade-template/content/content-table.html'
            },

            {
                title: 'Section Content',
                description: 'Add a section',
                url: 'assets/html-template/premade-template/content/content-section.html'
            },

            {
                title: 'Pictures Container w/ Text',
                description: 'Add a picture w/ text',
                url: 'assets/html-template/premade-template/content/content-picture-wtext.html'
            },

            {
                title: 'Pictures Container w/o Text',
                description: 'Add a picture w/o text',
                url: 'assets/html-template/premade-template/content/content-picture-wotext.html'
            },

            {
                title: 'Pictures Section',
                description: 'Add multiple pictures with rows',
                url: 'assets/html-template/premade-template/content/content-section-picture.html'
            },

            {
                title: 'Video Container',
                description: 'Add a video',
                url: 'assets/html-template/premade-template/content/content-video.html'
            }
        ],
        image_class_list: [{
                title: 'No Class',
                value: ''
            },
            {
                title: 'Flip Image with text',
                value: 'card-img-top'
            },

        ],

        /* enable title field in the Image dialog*/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
              Note: In modern browsers input[type="file"] is functional without
              even adding it to the DOM, but that might not be the case in some older
              or quirky browsers like IE, so you might want to add it to the DOM
              just in case, and visually hide it. And do not forget do remove it
              once you do not need it anymore.
            */

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function() {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        content_css: 'assets/css/tinymce-css.css, https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',

        content_style: 'img {width: 100%;}',

        visualblocks_default_state: true,
        end_container_on_empty_block: true,

        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-add-subtopic  tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-add-subtopic  .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-add-subtopic  .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-add-subtopic  .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-add-subtopic  .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });

            eds.on('change', function(e) {
                var input = $('.form-add-subtopic  tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-add-subtopic  .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-add-subtopic  .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-add-subtopic  .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-add-subtopic  .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

    // Prevent Bootstrap dialog from blocking focusin
    document.addEventListener('focusin', (e) => {
        if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
            e.stopImmediatePropagation();
        }
    })



    tinymce.init({
        selector: '.form-update-subtopic textarea',
        plugins: 'code print preview powerpaste casechange tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
        width: "1200",
        height: "800",
        media_live_embeds: true,
        keep_styles: false,
        toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | link image | code',
        image_class_list: [{
                title: 'No Class',
                value: ''
            },
            {
                title: 'Flip Image with text',
                value: 'card-img-top'
            },

        ],
        templates: [{

                title: 'Page Header',
                description: 'Add custom header',
                url: 'assets/html-template/premade-template/header/header.html'
            },

            {
                title: 'Aqua Template',
                description: 'Premade Template with aqua theme',
                url: 'assets/html-template/premade-template/template-theme/aqua-template.html'
            },

            {
                title: 'Orange Template',
                description: 'Premade Template with orange theme',
                url: 'assets/html-template/premade-template/template-theme/orange-template.html'
            },

            {
                title: 'Green Template',
                description: 'Premade Template with green theme',
                url: 'assets/html-template/premade-template/template-theme/green-template.html'
            },

            {
                title: 'Introduction Template',
                description: 'Template for introduction',
                url: 'assets/html-template/premade-template/Introduction-template.html'
            },

            {
                title: 'Table Content',
                description: 'Add a div with table',
                url: 'assets/html-template/premade-template/content/content-table.html'
            },

            {
                title: 'Section Content',
                description: 'Add a section',
                url: 'assets/html-template/premade-template/content/content-section.html'
            },

            {
                title: 'Pictures Container w/ Text',
                description: 'Add a picture w/ text',
                url: 'assets/html-template/premade-template/content/content-picture-wtext.html'
            },

            {
                title: 'Pictures Container w/o Text',
                description: 'Add a picture w/o text',
                url: 'assets/html-template/premade-template/content/content-picture-wotext.html'
            },

            {
                title: 'Pictures Section',
                description: 'Add multiple pictures with rows',
                url: 'assets/html-template/premade-template/content/content-section-picture.html'
            },

            {
                title: 'Video Container',
                description: 'Add a video',
                url: 'assets/html-template/premade-template/content/content-video.html'
            }
        ],

        /* enable title field in the Image dialog*/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
              Note: In modern browsers input[type="file"] is functional without
              even adding it to the DOM, but that might not be the case in some older
              or quirky browsers like IE, so you might want to add it to the DOM
              just in case, and visually hide it. And do not forget do remove it
              once you do not need it anymore.
            */

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function() {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        content_css: 'assets/css/tinymce-css.css, https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',
        content_style: 'img {width: 100%;}',

        visualblocks_default_state: true,
        end_container_on_empty_block: true,

        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-update-subtopic   tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });

            eds.on('change', function(e) {
                var input = $('.form-update-subtopic   tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

    // Prevent Bootstrap dialog from blocking focusin
    document.addEventListener('focusin', (e) => {
        if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
            e.stopImmediatePropagation();
        }
    })



    tinymce.init({
        selector: '.form-view-subtopic textarea',
        plugins: 'code print preview powerpaste casechange tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
        width: "1200",
        height: "800",
        media_live_embeds: true,
        keep_styles: false,
        toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | link image | code',
        image_class_list: [{
                title: 'No Class',
                value: ''
            },
            {
                title: 'Flip Image with text',
                value: 'card-img-top'
            },

        ],
        templates: [{

                title: 'Page Header',
                description: 'Add custom header',
                url: 'assets/html-template/premade-template/header/header.html'
            },

            {
                title: 'Aqua Template',
                description: 'Premade Template with aqua theme',
                url: 'assets/html-template/premade-template/template-theme/aqua-template.html'
            },

            {
                title: 'Orange Template',
                description: 'Premade Template with orange theme',
                url: 'assets/html-template/premade-template/template-theme/orange-template.html'
            },

            {
                title: 'Green Template',
                description: 'Premade Template with green theme',
                url: 'assets/html-template/premade-template/template-theme/green-template.html'
            },

            {
                title: 'Introduction Template',
                description: 'Template for introduction',
                url: 'assets/html-template/premade-template/Introduction-template.html'
            },

            {
                title: 'Table Content',
                description: 'Add a div with table',
                url: 'assets/html-template/premade-template/content/content-table.html'
            },

            {
                title: 'Section Content',
                description: 'Add a section',
                url: 'assets/html-template/premade-template/content/content-section.html'
            },

            {
                title: 'Pictures Container w/ Text',
                description: 'Add a picture w/ text',
                url: 'assets/html-template/premade-template/content/content-picture-wtext.html'
            },

            {
                title: 'Pictures Container w/o Text',
                description: 'Add a picture w/o text',
                url: 'assets/html-template/premade-template/content/content-picture-wotext.html'
            },

            {
                title: 'Pictures Section',
                description: 'Add multiple pictures with rows',
                url: 'assets/html-template/premade-template/content/content-section-picture.html'
            },

            {
                title: 'Video Container',
                description: 'Add a video',
                url: 'assets/html-template/premade-template/content/content-video.html'
            }
        ],

        /* enable title field in the Image dialog*/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
              Note: In modern browsers input[type="file"] is functional without
              even adding it to the DOM, but that might not be the case in some older
              or quirky browsers like IE, so you might want to add it to the DOM
              just in case, and visually hide it. And do not forget do remove it
              once you do not need it anymore.
            */

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function() {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        content_css: 'assets/css/tinymce-css.css, https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css',
        content_style: 'img {width: 100%;}',

        visualblocks_default_state: true,
        end_container_on_empty_block: true,

        setup: function(eds) {
            eds.on('keyup', function(e) {
                var input = $('.form-update-subtopic   tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });

            eds.on('change', function(e) {
                var input = $('.form-update-subtopic   tox-edit-area__iframe');
                if ($(eds.getBody()).text().length == 0) {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-invalid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-valid');

                } else {
                    $('.form-update-subtopic   .tox-edit-area__iframe').addClass('is-valid');
                    $('.form-update-subtopic   .tox-edit-area__iframe').removeClass('is-invalid');
                    emptyField();

                }
                eds.on('change', function() {
                    tinymce.triggerSave();
                });
            });
        }
    });

</script>

<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>