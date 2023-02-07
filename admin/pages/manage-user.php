<?php include('modals/faculty-add-modal.php'); ?>
<?php include('modals/faculty-update-modal.php'); ?>
<?php include('modals/faculty-view-modal.php'); ?>

<?php include('modals/student-add-modal.php'); ?>
<?php include('modals/student-update-modal.php'); ?>
<?php include('modals/student-view-modal.php'); ?>

<?php include('modals/personnel-add-modal.php'); ?>
<?php include('modals/personnel-update-modal.php'); ?>
<?php include('modals/personnel-view-modal.php'); ?>


<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section">
            <div class="main-content">
                <div class="container page-container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>Manage Users</h1>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-fill pb-4">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#faculty"><i class="fa-solid fa-person-chalkboard"></i>Faculty Accounts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#student"><i class="fa-solid fa-child-reaching"></i>Student Accounts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#personnel"><i class="fa-solid fa-clipboard-user"></i>Personnel Accounts</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="faculty" class="tab-pane faculty-section fade in active show">
                            <a href="javascript:void(0)" class="delete-link">
                                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-custom flex-end add-faculty" style="width:170px;" title="add" data-toggle="tooltip"><i class="fa-solid fa-circle-plus"></i>Add Faculty</a>
                            </div>
                            <table class="admin table table-striped table-hover table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-all" /></th>
                                        <th>Username <i class="fa fa-sort"></i></th>
                                        <th>Firstname <i class="fa fa-sort"></i></th>
                                        <th>Lastname <i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT *
                            FROM user_tbl as user
                            INNER JOIN student_faculty_profile_tbl as prfl
                            ON user.user_id = prfl.user_id WHERE user.usertype = 'Faculty'";
                                    $result = mysqli_query($mysqli, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr class="table-faculty-data">
                                            <td><input type="checkbox" class="checkbox-delete" /></td>
                                            <td><a href="javascript:void(0)" data-id="<?php echo $row['user_id']; ?>" data-name="<?php echo $row['fname']; ?>" class="user-link"><?php echo $row['username'] ?></a></td>
                                            <td><?php echo $row['fname'] ?></td>
                                            <td><?php echo $row['lname'] ?></td>


                                            <td>
                                                <a href="javascript:void(0)" class="view-faculty btn btn-primary" data-id="<?php echo $row['user_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                                <a href="javascript:void(0)" class="edit-faculty btn btn-warning" data-id="<?php echo $row['user_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                <a href="javascript:void(0)" class="delete-faculty btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row['user_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-content">

                        <div id="student" class="tab-pane student-section fade">
                            <a href="javascript:void(0)" class="delete-link">
                                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-custom flex-end add-student" style="width:170px;" title="add" data-toggle="tooltip"><i class="fa-solid fa-circle-plus"></i>Add Students</a>
                            </div>
                            <table class="admin table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-all" /></th>
                                        <th>Username <i class="fa fa-sort"></i></th>
                                        <th>Firstname <i class="fa fa-sort"></i></th>
                                        <th>Lastname <i class="fa fa-sort"></i></th>
                                        <th>Institution <i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = "SELECT *
                            FROM user_tbl as user
                            INNER JOIN student_faculty_profile_tbl as prfl
                            ON user.user_id = prfl.user_id WHERE user.usertype = 'Student'";
                                    $result2 = mysqli_query($mysqli, $sql2);

                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                        <tr class="table-student-data">
                                            <td><input type="checkbox" class="checkbox-delete" /></td>
                                            <td><a href="javascript:void(0)" data-id="<?php echo $row2['user_id']; ?>" data-name="<?php echo $row2['fname']; ?>" class="user-link"><?php echo $row2['username'] ?></a></td>
                                            <td><?php echo $row2['fname'] ?></td>
                                            <td><?php echo $row2['lname'] ?></td>
                                            <td><?php echo $row2['institution'] ?></td>

                                            <td>
                                                <a href="javascript:void(0)" class="view-student btn btn-primary" data-id="<?php echo $row2['user_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                                <a href="javascript:void(0)" class="edit-student btn btn-warning" data-id="<?php echo $row2['user_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                <a href="javascript:void(0)" class="delete-student btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row2['user_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                            </td>
                                        </tr>


                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="personnel" class="tab-pane personnel-section fade">
                            <a href="javascript:void(0)" class="delete-link">
                                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-custom flex-end add-personnel" style="width:170px;" title="add" data-toggle="tooltip"><i class="fa-solid fa-circle-plus"></i>Add Personnel</a>
                            </div>
                            <table class="admin table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkbox-all" /></th>
                                        <th>Username <i class="fa fa-sort"></i></th>
                                        <th>Firstname <i class="fa fa-sort"></i></th>
                                        <th>Lastname <i class="fa fa-sort"></i></th>
                                        <th>Institution <i class="fa fa-sort"></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql2 = "SELECT *
                            FROM user_tbl as user
                            INNER JOIN student_faculty_profile_tbl as prfl
                            ON user.user_id = prfl.user_id WHERE user.usertype = 'Personnel'";
                                    $result2 = mysqli_query($mysqli, $sql2);

                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                        <tr class="table-personnel-data">
                                            <td><input type="checkbox" class="checkbox-delete" /></td>
                                            <td><a href="javascript:void(0)" data-id="<?php echo $row2['user_id']; ?>" data-name="<?php echo $row2['fname']; ?>" class="user-link"><?php echo $row2['username'] ?></a></td>
                                            <td><?php echo $row2['fname'] ?></td>
                                            <td><?php echo $row2['lname'] ?></td>
                                            <td><?php echo $row2['institution'] ?></td>

                                            <td>
                                                <a href="javascript:void(0)" class="view-personnel btn btn-primary" data-id="<?php echo $row2['user_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                                <a href="javascript:void(0)" class="edit-personnel btn btn-warning" data-id="<?php echo $row2['user_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                                <a href="javascript:void(0)" class="delete-personnel btn btn-danger" id="delete-id" title="Delete" data-id="<?php echo $row2['user_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
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

        $('.user-link').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');




            event.preventDefault();


            Swal.fire({
                title: 'This will view the taken assessments of ' + name,
                text: "Do you want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed',
                reverseButtons: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'edit-primary-button'
                },

            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        data: {
                            user_id: id,
                            fname: name
                        },

                        success: function(data) {
                            window.location = 'home-admin.php?subpage=view-user-assessment&user_id=' + id + '&fname=' + name
                        },
                        error: function(xhr, status, error, data) {




                        }
                    });
                }
            });

        });
    })
</script>