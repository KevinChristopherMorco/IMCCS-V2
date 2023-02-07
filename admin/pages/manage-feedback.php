<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section faq-section">
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
                    </div>
                    <table class="admin table table-striped table-hover table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Name <i class="fa fa-sort"></i></th>
                                <th>Feedback <i class="fa fa-sort"></i></th>
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
                                    <td><?php echo $row['fullname'] ?></td>
                                    <td><?php echo $row['feedback_message'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </section>
</main>
