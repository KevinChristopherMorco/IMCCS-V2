<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section feedback-section">
            <a href="javascript:void(0)" class="delete-link">
                <i class="fa-solid fa-trash-can delete-icon"></i> </a>
            <div class="main-content">
                <div class="container page-container">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>Manage Feedbacks</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control startDate" id="" name="startDate">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control endDate" id="" name="endDate">
                            </div>
                        </div>
                    </div>
                    <table class="admin table table-striped table-hover table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkbox-all" /></th>
                                <th class="hidden-header">Date <i class="fa fa-sort"></i></th>

                                <th>Name <i class="fa fa-sort"></i></th>
                                <th>Feedback <i class="fa fa-sort"></i></th>
                                <th>Action <i class="fa fa-sort"></i></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT *
                            FROM feedbacks";
                            $result = mysqli_query($mysqli, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr class="table-feedback-data">
                                    <td><input type="checkbox" name="name1" class="checkbox-delete" /></td>
                                    <td class="hidden-header"><?php echo $row['created_at'] ?></td>

                                    <td><?php echo $row['fullname'] ?></td>
                                    <td><?php echo $row['feedback_message'] ?></td>
                                    <td><a href="javascript:void(0)" class="delete-feedback btn btn-danger" name="delete-feedback-id" id="feedback-id" title="Delete" data-id="<?php echo $row['feedback_id']; ?>" data-toggle="tooltip"><i class="fa-solid fa-trash-can"></i>Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </section>
</main>