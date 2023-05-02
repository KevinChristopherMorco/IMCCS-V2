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

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control startDate" id="startDate" name="startDate">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control endDate" id="endDate" name="endDate">
                            </div>
                        </div>

                    </div>
                    <table class="admin table table-striped table-hover table-bordered" id="myTable">
                        <thead>
                            <tr>

                                <th class="col-1"><input type="checkbox" class="checkbox-all" /></th>
                                <th class="hidden-header">Date<i class="fa fa-sort"></i></th>

                                <th>Name<i class="fa fa-sort"></i></th>
                                <th>Control Code <i class="fa fa-sort"></i></th>
                                <th class="col-2">Status <i class="fa fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = "SELECT * from institution_tbl ORDER BY name ASC";
                            $result = mysqli_query($mysqli, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr class="table-institution-data">

                                    <td class="col-1"><input type="checkbox" name="name1" class="checkbox-delete" /></td>
                                    <td class="hidden-header"><?php echo $row['created_at'] ?> <i class="fa-solid fa-clipboard" style="cursor: pointer;"></i></td>

                                    <td><a href="javascript:void(0)" class="institution-link" data-id="<?php echo $row['institution_id'] ?>" data-name="<?php echo $row['name'] ?>" data-type="<?php echo $row['type'] ?>"><?php echo $row['name'] ?></a></td>
                                    <td><?php echo $row['code'] ?> <i class="fa-solid fa-clipboard" style="cursor: pointer;"></i></td>

                                    <td class="col-2"> <span class="status"><?php echo $row['status'] ?><span></td>

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
            var type = $(this).data('type');




            event.preventDefault();


            Swal.fire({
                title: '<span style="font-size: 24px">This will view the total assessments of ' + name + '</span>',
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
                            name: name,
                            type: type
                        },

                        success: function(data) {
                            window.location = 'home-admin.php?subpage=view-institution-assessment-summary&institution_id=' + id + '&name=' + name + '&type=' + type
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
    // Get all the clipboard icons in the table
    const clipboardIcons = document.querySelectorAll('.fa-clipboard');

    // Loop through each clipboard icon
    clipboardIcons.forEach(icon => {
        // Add a click event listener to the icon
        icon.addEventListener('click', () => {
            // Get the parent row of the icon
            const row = icon.closest('tr');

            // Get the third table data element (institution code) of the row
            const institutionCodeCell = row.querySelectorAll('td')[2];

            // Get the text content of the element
            const institutionCode = institutionCodeCell.textContent.trim();

            // Use the Clipboard API to copy the text to the clipboard
            navigator.clipboard.writeText(institutionCode)
                .then(() => {
                    console.log('Copied to clipboard:', institutionCode);
                    Toast.fire({
                        icon: 'success',
                        title: 'Text copied to clipboard:</br>' + institutionCode,

                    })
                })
                .catch(error => console.error('Error copying to clipboard:', error));
        });
    });
</script>