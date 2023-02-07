<?php include('modals/institution-add-modal.php'); ?>
<?php include('modals/institution-update-modal.php'); ?>
<?php include('modals/institution-view-modal.php'); ?>

<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section institution-section">
            <a href="javascript:void(0)" class="delete-link">
                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
            <div class="main-content">
                <div class="container page-container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>Manage Institution</h1>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0)" class="btn btn-custom flex-end add" style="width:170px;" title="add" data-toggle="tooltip"><i class="fa-solid fa-circle-plus"></i>Add Institution</a>
                            </div>

                        </div>
                    </div>
                    <table class="admin table table-striped table-hover table-bordered" id="myTable">
                        <thead>
                            <tr>

                                <th><input type="checkbox" class="checkbox-all" /></th>
                                <th>Name<i class="fa fa-sort"></i></th>
                                <th>Control Code <i class="fa fa-sort"></i></th>
                                <th>Status <i class="fa fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "select * from institution_tbl";
                            $result = mysqli_query($mysqli, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr class="table-institution-data">
                                    <td><input type="checkbox" name="name1" class="checkbox-delete" /></td>
                                    <td><a href="javascript:void(0)" class="institution-link" data-id="<?php echo $row['institution_id'] ?>" data-name="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a></td>
                                    <td><?php echo $row['code'] ?></td>

                                    <td> <span class="status"><?php echo $row['status'] ?><span></td>

                                    <td>
                                        <a href="javascript:void(0)" class="view btn btn-primary" data-id="<?php echo $row['institution_id']; ?>" title="View" data-toggle="tooltip"><i class="fa-solid fa-eye"></i>View</a>
                                        <a href="javascript:void(0)" class="edit btn btn-warning" data-id="<?php echo $row['institution_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                        <a href="javascript:void(0)" class="delete btn btn-danger" name="delete-institution-id" id="delete-id" title="Delete" data-id="<?php echo $row['institution_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                    </td>
                                </tr>


                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </section>
</main>

<script>
    $(document).ready(function() {

        var status = $(".status");
        $.each(status, function(i) {

            if ($(status[i]).text() == 'Active') {
                $(status[i]).addClass("active-status");
            } else {
                $(status[i]).addClass("inactive-status");
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('.institution-link').click(function() {
            var id = $(this).data('id');
            var name = $(this).data('name');




            event.preventDefault();


            Swal.fire({
                title: 'This will view the total assessments of ' + name,
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
                            name: name
                        },

                        success: function(data) {
                            window.location = 'home-admin.php?subpage=view-institution-assessment-summary&institution_id=' + id + '&name=' + name
                        },
                        error: function(xhr, status, error, data) {




                        }
                    });
                }
            });

        });
    })
</script>

<script>

</script>