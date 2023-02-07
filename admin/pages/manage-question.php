<?php include('modals/assessment-add-modal.php'); ?>
<?php include('modals/assessment-update-modal.php'); ?>
<?php include('modals/assessment-view-modal.php'); ?>

<?php include('modals/assessment-add-choices-modal.php'); ?>
<?php include('modals/assessment-view-choices-modal.php'); ?>
<?php include('modals/assessment-update-choices-modal.php'); ?>
<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section">
            <div class="main-content">
                <div class="container page-container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>Manage Assessment</h1>
                            </div>

                        </div>
                    </div>

                    <ul class="nav nav-pills nav-fill pb-4">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#assessment"><i class="fa-solid fa-file-circle-check"></i>Assessment Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#question"><i class="fa-solid fa-clipboard-question"></i>Question Bank</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="assessment" class="tab-pane assessment-section fade in active show">
                            <a href="javascript:void(0)" class="delete-link">
                                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-custom flex-end add-assessment" style="width:200px;" title="add" data-toggle="tooltip"><i class="fa-solid fa-circle-plus"></i>Add Assessment</a>
                            </div>
                            <table class="admin table table-striped table-hover table-bordered" id="assessment-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-all" /></th>
                                        <th>Assessment Title <i class="fa fa-sort"></i></th>
                                        <th>Difficulty <i class="fa fa-sort"></i></th>
                                        <th>Time Estimate <i class="fa fa-sort"></i></th>
                                        <th>Deadline<i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM assessment_tbl";
                                    $result = mysqli_query($mysqli, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr class="table-assessment-data">
                                            <td><input type="checkbox" name="name1" class="checkbox-delete" /></td>
                                            <td><a href="javascript:void(0)" data-id="<?php echo $row['assessment_id']; ?>" data-title="<?php echo $row['title']; ?>" class="assessment-link"><?php echo $row['title'] ?></a></td>
                                            <td><?php echo $row['difficulty'] ?></td>
                                            <td><?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></td>
                                            <td><?php echo date("F j, Y g:i a", strtotime($row['deadline'])) ?></td>


                                            <td>
                                                <a href="javascript:void(0)" class="add-assessment-choice btn btn-success" data-id="<?php echo $row['assessment_id']; ?>" data-name="<?php echo $row['title']; ?>" data-toggle="tooltip"><i class="fa-solid fa-file-circle-plus"></i>Add Question</a>
                                                <a href="javascript:void(0)" class="view-assessment btn btn-primary" data-id="<?php echo $row['assessment_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                                <a href="javascript:void(0)" class="edit-assessment btn btn-warning" data-id="<?php echo $row['assessment_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                <a href="javascript:void(0)" class="delete-assessment btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row['assessment_id']; ?>,<?php echo $row['assessment_id']; ?>]" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="question" class="tab-pane assessment-question-section fade">
                            <a href="javascript:void(0)" class="delete-link">
                                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
                            <table class="admin table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-all" /></th>
                                        <th>Title <i class="fa fa-sort"></i></th>
                                        <th>Question <i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = "SELECT *
                            FROM assessment_question_tbl";
                                    $result2 = mysqli_query($mysqli, $sql2);

                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                        <tr class="table-assessment-question-data">
                                            <td><input type="checkbox" name="name1" class="checkbox-delete" /></td>
                                            <td><?php echo $row2['assessment_title'] ?></td>
                                            <td><?php echo $row2['assessment_question'] ?></td>


                                            <td>
                                                <a href="javascript:void(0)" class="view-question btn btn-primary" data-id="<?php echo $row2['question_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                                <a href="javascript:void(0)" class="edit-question btn btn-warning" data-id="<?php echo $row2['question_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                <a href="javascript:void(0)" class="delete-question btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row2['question_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                            </td>
                                        </tr>
                                        <?php include('modals/lesson-update-modal.php'); ?>


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
    /*
    $(document).ready(function() {

        $('.assessment-link').click(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');




            event.preventDefault();


            Swal.fire({
                title: 'This will view the summary of: ' + title,
                text: "Do you want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed',
                reverseButtons: true,
                allowOutsideClick: false,
                showDenyButton: true,

                denyButtonText: `Don't save`,
                customClass: {
                    confirmButton: 'edit-primary-button'
                },

            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        data: {
                            assessment_id: id,
                            title: title
                        },

                        success: function(data) {
                            window.location = 'home-admin.php?subpage=view-assessment-summarys&assessment_id=' + id + '&title=' + title
                        },
                        error: function(xhr, status, error, data) {




                        }
                    });
                }
            });

        });
    })*/
</script>

<script>
    $(document).ready(function() {

        $('.assessment-link').click(function() {
            var id = $(this).data('id');
            var title = $(this).data('title');




            event.preventDefault();


            Swal.fire({
                title: 'This will view the summary of: ' + title,
                text: "Do you want to proceed?",
                icon: 'warning',
                html: `Do you want to proceed?</br> Please select one of the options.
                <br> <br> <b>

           </b>
       <br> <br> <br>
       <div class="actions">
       <button type="button" class="btn btn-cancel swal2-styled swal2-cancel" >Cancel</button>
      <button type="button" class="btn btn-yes edit-primary-button swal2-styled swal2-confirm">Pre Assessment</button>
      <button type="button" class="btn btn-no edit-primary-button swal2-styled swal2-confirm">Post Assessment</button></div>`,
                showCancelButton: false,
                confirmButtonText: 'Yes, proceed',
                reverseButtons: true,
                allowOutsideClick: false,
                showDenyButton: false,
                showConfirmButton: false,

                denyButtonText: `Don't save`,
                customClass: {
                    confirmButton: 'edit-primary-button'
                },
                didOpen: () => {
                    const yes = document.querySelector('.btn-yes')
                    const no = document.querySelector('.btn-no')
                    const cancel = document.querySelector('.btn-cancel')

                    yes.addEventListener('click', () => {
                        $.ajax({
                            type: "GET",
                            data: {
                                assessment_id: id,
                                title: title
                            },

                            success: function(data) {
                                window.location = 'home-admin.php?subpage=view-assessment-summarys&assessment_id=' + id + '&title=' + title
                            },
                            error: function(xhr, status, error, data) {




                            }
                        });
                    })

                    no.addEventListener('click', () => {
                        $.ajax({
                            type: "GET",
                            data: {
                                assessment_id: id,
                                title: title
                            },

                            success: function(data) {
                                window.location = 'home-admin.php?subpage=view-retake-summary&assessment_id=' + id + '&title=' + title
                            },
                            error: function(xhr, status, error, data) {




                            }
                        });
                    })

                    cancel.addEventListener('click', () => {
                        swal.close()
                    })
                }

            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        data: {
                            assessment_id: id,
                            title: title
                        },

                        success: function(data) {
                            window.location = 'home-admin.php?subpage=view-assessment-summarys&assessment_id=' + id + '&title=' + title
                        },
                        error: function(xhr, status, error, data) {




                        }
                    });
                }
            });

        });
    })
</script>