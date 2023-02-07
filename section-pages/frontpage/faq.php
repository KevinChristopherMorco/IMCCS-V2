<section id="faq" class="faq">
        <div class="shape">
            <img src="assets/images/faq/shape.svg" alt="shape" />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center mx-auto">
                        <h2 class="faq">Frequently Asked Questions</h2>
                        <p>
                            Here are some frequent questions that we usually encounter.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
            <?php $sql = "SELECT *
                            FROM faq_tbl";
                            $result = mysqli_query($mysqli, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                <div class="col-lg-6">
                    <div class="single-faq wow fadeInUp" data-wow-delay=".1s">
                        <div class="accordion">
                            <button class="faq-btn collapsed" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row['id'] ?>">
                                <span class="icon flex-shrink-0">
                                    <i class="lni lni-chevron-down"></i>
                                </span>
                                <span><?php echo $row['title'] ?></span>
                            </button>
                            <div id="collapse<?php echo $row['id'] ?>" class="accordion-collapse collapse">
                                <div class="faq-body">
                                <?php echo $row['description'] ?>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script>
         /*  $(document).ready(function() {

        
    });*/
    </script>