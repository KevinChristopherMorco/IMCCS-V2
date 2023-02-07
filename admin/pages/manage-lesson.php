<?php include('modals/lesson-add-modal.php'); ?>
<?php include('modals/lesson-update-modal.php'); ?>
<?php include('modals/lesson-view-modal.php'); ?>


<?php include('modals/subtopic-add-modal.php'); ?>
<?php include('modals/subtopic-update-modal.php'); ?>
<?php include('modals/subtopic-view-modal.php'); ?>


<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section topic-section">
            <a href="javascript:void(0)" class="delete-link">
                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
            <div class="main-content">
                <div class="container page-container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>Manage Topics</h1>
                            </div>

                        </div>
                    </div>
                    <ul class="nav nav-pills nav-fill pb-4">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#main-topic"><i class="fa-solid fa-person-chalkboard"></i>Manage Topics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#sub-topic"><i class="fa-solid fa-child-reaching"></i>Manage Subtopics</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="main-topic" class="tab-pane main-topic-section fade in active show">
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-custom flex-end add-lesson" style="width:200px;" title="add" data-toggle="tooltip"><i class="fa-solid fa-circle-plus"></i>Add Topic</a>
                            </div>
                            <table class="admin table table-striped table-hover table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-all" /></th>
                                        <th>ID <i class="fa fa-sort"></i></th>
                                        <th>Title <i class="fa fa-sort"></i></th>
                                        <th>Description <i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT *
                            FROM lesson_tbl";
                                    $result = mysqli_query($mysqli, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr class="table-topic-data">
                                            <td><input type="checkbox" class="checkbox-delete" /></td>
                                            <td><?php echo $row['lesson_id'] ?></td>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $row['description'] ?></td>


                                            <td>
                                                <a href="javascript:void(0)" class="add-subtopic btn btn-success" data-id="<?php echo $row['lesson_id']; ?>" data-title="<?php echo $row['title']; ?>" data-toggle="tooltip"><i class="fa-solid fa-file-circle-plus"></i>Add a Subtopic</a>
                                                <a href="javascript:void(0)" class="view-lesson btn btn-primary" data-id="<?php echo $row['lesson_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                                <a href="javascript:void(0)" class="edit-lesson btn btn-warning" data-id="<?php echo $row['lesson_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                <a href="javascript:void(0)" class="delete-lesson btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row['lesson_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="sub-topic" class="tab-pane subtopic-section fade in">
                        <a href="javascript:void(0)" class="delete-link">
                            <i class="fa-solid fa-trash-can delete-icon"></i> </a>
                        <table class="admin table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="checkbox-all" /></th>
                                    <th>ID <i class="fa fa-sort"></i></th>
                                    <th>Title <i class="fa fa-sort"></i></th>
                                    <th>Module <i class="fa fa-sort"></i></th>
                                    <th>Subtopic <i class="fa fa-sort"></i></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql2 = "SELECT * FROM subtopic_tbl";
                                $result2 = mysqli_query($mysqli, $sql2);

                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                    <tr class="table-subtopic-data">
                                        <td><input type="checkbox" class="checkbox-delete" /></td>
                                        <td><?php echo $row2['subtopic_id'] ?></td>
                                        <td><?php echo $row2['title'] ?></td>
                                        <td><?php echo $row2['module'] ?></td>
                                        <td><?php echo $row2['subtopic'] ?></td>

                                        <td>
                                            <a href="javascript:void(0)" class="view-subtopic btn btn-primary" data-id="<?php echo $row2['subtopic_id']; ?>" data-title="<?php echo $row2['title']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                            <a href="javascript:void(0)" class="edit-subtopic btn btn-warning" data-id="<?php echo $row2['subtopic_id']; ?>" data-title="<?php echo $row2['title']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                            <a href="javascript:void(0)" class="delete-subtopic btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row2['subtopic_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                        </td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </section>
</main>

<script>
    /*  $(document).ready(function() {

        jQuery(".view-student").click(function() {
            var id = $(this).data('id');

            $.ajax({
                type: 'POST',
                url: 'query/student-getid-view.php',
                data: {
                    user_id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#view-student-modal').modal('show');
                    $('#student-view-username').val(res.username);
                    $('#student-view-fname').val(res.fname);
                    $('#student-view-lname').val(res.lname);

                }
            });

        });
    });*/
</script>