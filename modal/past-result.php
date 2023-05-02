<link rel="stylesheet" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<style>
    .past-result-table {
        width: 100% !important;
    }

    .past-result-table thead th {
        background-color: maroon !important;
        color: white;
    }

    .past-result-table thead th:first-child {
        border-top-left-radius: 10px;
    }

    .past-result-table thead th:last-child {
        border-top-right-radius: 10px;
    }

    .table .verdict.passed span {
        background-color: green;
        color: white;
        border-radius: 5px;
        padding: 0 10px 0 10px;
    }

    .table .verdict.failed span {
        background-color: red;
        color: white;
        border-radius: 5px;
        padding: 0 10px 0 10px;

    }

    .hidden-header {
        visibility: collapse;
        display: none;

    }

    .btn-custom {
        background-color: #EA640C;
        color: #ffffff
    }

    .dataTables_wrapper .dataTables_filter .form-control {
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAABL0lEQVQ4ja3Tuy9EURDH8c8uhYhOiUqURBYVNpFI/BFaEVFptHqJTvwFCCVCT6IWUYhChSDiEe94ZRX33JDl7l1yf815zMz3zMw5h4yVS9hvwzC60YhzbGEBl385oBYzeEMJp9jDVVjfYuQv2S6HwDV0fLPlMYjdYJ+sBjgWnGclt6Iem/gQtSNReZxgX1R2JTXhEauVnHpCdhMpsFiLeEbdb5kR3SrsVAncCbCWJGApjEm9K1fsly83xBuHYSxUCSzgBUdJDnkc40D6pTTjCStpp46KSp9T+dls4R1dacAclgJ0A53fbDUYEv2akujZ9KUB48BpvIbAswC5CetrPIT5PfqrgUIrprCObcxjHA0o/hdaSb2481X+QBbQ8kyLWUDjTC/QngWQqIeZwX7oE1KjSPLb1uskAAAAAElFTkSuQmCC);
        background-repeat: no-repeat;
        background-color: #EDEDED;
        background-position: 5px 6px !important;
        height: 40px;
        width: 400px;
        padding-left: 30px;
        border: 2px solid gray;
        box-shadow: none;
        border-radius: 10px;
    }

    .dataTables_wrapper .dataTables_filter {
        float: right;
        text-align: right
    }

    .dataTables_wrapper .dataTables_paginate {
        float: right;
        text-align: right;
        padding-top: .25em;
        margin-top: 3px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin: 5px 5px;
        color: #000;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        cursor: pointer;
    }

    .dataTables_wrapper .dataTables_paginate li a {
        border: none;
        font-size: 95%;
        width: 30px;
        height: 30px;
        color: #999;
        margin: 0 2px;
        padding: 10px 100px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
        padding: 0;

    }

    .dataTables_wrapper .dataTables_paginate li a:hover {
        background-color: lightblue;
        color: maroon;
    }


    .page-item:not(:first-child) .page-link {

        margin-left: -1px;

    }

    .dataTables_wrapper .dataTables_paginate li a {
        border: none;
        font-size: 95%;
        width: 30px;
        height: 30px;
        color: #999;
        margin: 0 2px;
        margin-left: 2px;
        padding: 10px 100px;
        line-height: 30px;
        border-radius: 30px !important;
        text-align: center;
        padding: 0;

    }

    .page-link {
        background-color: transparent !important;
    }

    .active>.page-link {
        background-color: #941612 !important;
        color: white !important;
    }

    td:last-child a {
        margin: 0 0 1rem 0 !important;

    }

    /* .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #333 !important;
    border: 1px solid rgba(0, 0, 0, 0.3);
    background-color: rgba(230, 230, 230, 0.1);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(230, 230, 230, 0.1)), color-stop(100%, rgba(0, 0, 0, 0.1)));
    background: -webkit-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
    background: -moz-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
    background: -ms-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
    background: -o-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
    background: linear-gradient(to bottom, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%)
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
  .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #666 !important;
    border: 1px solid transparent;
    background: transparent;
    box-shadow: none
  }



  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color: white !important;

  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:active {
    outline: none;
    background-color: #2b2b2b;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
    background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
    background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
    box-shadow: inset 0 0 3px #111
  }*/

    .dataTables_wrapper .dataTables_paginate .ellipsis {
        padding: 0 1em
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_processing,
    .dataTables_wrapper .dataTables_paginate {
        color: #333
    }

    .dataTables_wrapper .dataTables_scroll {
        clear: both
    }

    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody {
        -webkit-overflow-scrolling: touch
    }

    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>th,
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>td,
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>th,
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td {
        vertical-align: middle
    }

    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>th>div.dataTables_sizing,
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>td>div.dataTables_sizing,
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>th>div.dataTables_sizing,
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td>div.dataTables_sizing {
        height: 0;
        overflow: hidden;
        margin: 0 !important;
        padding: 0 !important
    }

    .dataTables_wrapper.no-footer .dataTables_scrollBody {
        border-bottom: 1px solid rgba(0, 0, 0, 0.3)
    }

    .dataTables_wrapper.no-footer div.dataTables_scrollHead table.dataTable,
    .dataTables_wrapper.no-footer div.dataTables_scrollBody>table {
        border-bottom: none
    }

    .dataTables_wrapper:after {
        visibility: hidden;
        display: block;
        content: "";
        clear: both;
        height: 0
    }

    @media screen and (max-width: 767px) {

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            float: none;
            text-align: center
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: .5em
        }
    }

    .dataTables_paginate .paginate_button.previous,
    .dataTables_paginate .paginate_button.next {
        color: gray;
    }

    .dataTables_paginate .paginate_button.previous:hover,
    .dataTables_paginate .paginate_button.next:hover {
        cursor: pointer;
    }

    .dataTables_paginate .paginate_button.current {
        border: none;
        font-size: 95%;
        width: 25px;
        height: 25px;
        color: #ffffff;
        margin: 0 2px;
        margin-left: 2px;
        padding: 10px 100px;
        line-height: 25px;
        border-radius: 25px !important;
        text-align: center;
        padding: 0;
        background-color: maroon;
    }

    .container-label {
        display: block;
        font-weight: bold;
        cursor: pointer;
        background-color: #E4E5E7;
        color: #000;
        margin-bottom: 10px;
        padding: 10px 10px 10px 10px;
    }

    .container-table {
        overflow: hidden;
        height: 0;
        transition: height 0.3s ease-in-out;
        /* add transition property */
    }

    .table {
        margin-bottom: 20px;
    }

    .arrow {
        display: inline-block;
        width: 0;
        height: 0;
        margin-left: 5px;
        border: 4px solid transparent;
        font-weight: bolder;
    }

    .arrow-down {
        border-top-color: #000;
    }

    .arrow-up {
        border-bottom-color: #000;
    }
</style>

<script>
    function toggleContainer(containerId) {
        var container = document.getElementById(containerId);
        const arrow = container.previousElementSibling.querySelector('.arrow');
        const table = container.querySelector('.pre-result-table');

        if (container.style.height === "0px") {
            arrow.classList.remove('fa-chevron-down');
            arrow.classList.add('fa-chevron-up');
            // container.style.height = container.scrollHeight + "px";
            container.style.height = '550px'
        } else {
            arrow.classList.remove('fa-chevron-up');
            arrow.classList.add('fa-chevron-down');
            container.style.height = "0px";
        }
    }
</script>
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="past-result" class="welcome-help">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header modal-lg">
                <h5 class="modal-title">Assessment Results History</h5>
            </div>
            <div class="modal-body">
                <div class="container-label" onclick="toggleContainer('container1')">Pre Assessment Result <i class="fas fa-chevron-down arrow"></i>
                </div>
                <div class="container-table" id="container1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate">
                        </div>
                    </div>

                    <?php
                    $sql = "SELECT *
                            FROM assessment_chosen chosen INNER JOIN assessment_score score ON chosen.assessment_code = score.assessment_code  WHERE chosen.institution_id = '" . $_SESSION['institution_id'] . "' AND chosen.user_id =  '" . $_SESSION['user_id'] . "' ";
                    $result = mysqli_query($mysqli, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="table past-result-table pre-result-table">
                            <thead>
                                <tr>
                                    <th class="hidden-header">Hidden Date Taken</th>

                                    <th class="col-3">Date Taken</th>
                                    <th class="col-4">Assessment Code</th>
                                    <th class="col-2">Result</th>
                                    <th class="text-center col-3">Check Summary</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td class="hidden-header"><?php echo $row['created_at'] ?></td>

                                        <td class="col-3"><?php echo $row['created_at'] ?></td>
                                        <td class="col-4"><?php echo $row['assessment_code'] ?></td>
                                        <td class="col-2 verdict"><span><?php echo $row['verdict'] ?></span></td>
                                        <td class="text-center col-3">
                                            <button type="button" class="btn btn-success check-assessment-btn"><i class="fa-regular fa-file-lines"></i></button>
                                        </td>
                                    </tr>


                                <?php } ?>

                            <?php
                        } else { ?>
                                <div class="text-center">
                                    <p class="chosen-empty-result"><img src="assets/images/icons/search-gif.gif" width="45" height="45" alt="">No Pre Assessment Taken</p>
                                </div>
                            <?php   }

                            ?>

                            </tbody>
                        </table>
                        <hr style="border-top: 4px solid black;">

                </div>

                <div class="container-label" onclick="toggleContainer('container2')">Post Assessment Result<i class="fas fa-chevron-down arrow"></i></div>
                <div class="container-table" id="container2">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" id="postStartDate" name="postStartDate">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" id="postEndDate" name="postEndDate">
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT *
            FROM retake_chosen_tbl chosen INNER JOIN retake_score_tbl score ON chosen.code = score.code  WHERE chosen.institution_id = '" . $_SESSION['institution_id'] . "' AND chosen.user_id =  '" . $_SESSION['user_id'] . "' ";
                    $result = mysqli_query($mysqli, $sql);
                    if (mysqli_num_rows($result) > 0) {

                    ?>
                        <table class="table past-result-table post-result-table" id="post-result-table">
                            <thead>
                                <tr>
                                    <th class="hidden-header">Hidden Date Taken</th>

                                    <th class="col-3">Date Taken</th>
                                    <th class="col-4">Assessment Code</th>
                                    <th class="col-2">Result</th>
                                    <th class="text-center col-3">Check Summary</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tr>
                                        <td class="hidden-header"><?php echo $row['date_submitted'] ?></td>

                                        <td class="col-3"><?php echo $row['date_submitted'] ?></td>
                                        <td class="col-4"><?php echo $row['code'] ?></td>
                                        <td class="col-2 verdict"><span><?php echo $row['verdict'] ?></span></td>

                                        <!--
                                            <td>
                                                <button type="button" class="btn btn-success copy-btn"><i class="fa-regular fa-file-lines"></i></button>
                                            </td>
                            -->
                                        <td class="text-center col-3">
                                            <button type="button" class="btn btn-success check-retake-btn"><i class="fa-regular fa-file-lines"></i></button>
                                        </td>
                                    </tr>


                                <?php } ?>
                            <?php
                        } else { ?>
                                <div class="text-center">
                                    <p class="chosen-empty-result"><img src="assets/images/icons/search-gif.gif" width="45" height="45" alt="">No Post Assessment Taken</p>
                                </div>
                            <?php   }

                            ?>
                            </tbody>
                        </table>
                        <hr style="border-top: 4px solid black;">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.copy-btn').click(async function() {
            const button = event.target;
            const row = button.closest('tr');
            const cell = row.cells[1];
            const textToCopy = cell.textContent.trim();
            try {
                await navigator.clipboard.writeText(textToCopy);
                alert('Text Copied')
            } catch (error) {
                console.error('Failed to copy text: ', error);
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.check-assessment-btn').click(async function() {
            const button = event.target;
            const row = button.closest('tr');
            const cell = row.cells[2];
            const textToCopy = cell.textContent.trim();

            window.location = 'home-page.php?page=result&assessment_code=' + textToCopy;

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.check-retake-btn').click(async function() {
            const button = event.target;
            const row = button.closest('tr');
            const cell = row.cells[2];
            const textToCopy = cell.textContent.trim();

            window.location = 'home-page.php?page=retake-result&code=' + textToCopy;

        });
    });

    $(document).ready(function() {
        $('.table .verdict').each(function() {
            var text = $(this).text().toLowerCase();
            if (text == 'passed') {
                $(this).addClass('passed');
            } else if (text == 'failed') {
                $(this).addClass('failed');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('table.pre-result-table').DataTable({
            stateSave: true,
            pageLength: 5,
            stateSaveCallback: function(settings, data) {
                localStorage.setItem('myDataTablesState', JSON.stringify(data));
            },
            stateLoadCallback: function(settings) {
                return JSON.parse(localStorage.getItem('myDataTablesState'));
            },

            "columnDefs": [{
                "orderable": false,
                "targets": 0
            }],
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i> Excel File',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa-solid fa-file-pdf"></i> PDF File',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
            ],
            language: {
                search: '',
                searchPlaceholder: "Search",
                paginate: {
                    next: '<i class="fa-solid fa-circle-arrow-right"></i>',
                    previous: '<i class="fa-solid fa-circle-arrow-left"></i>'
                }
            },

            "initComplete": function() {
                $("#myTable").show();
                // Get the search input element
                var searchInput = $(this).closest('.dataTables_wrapper').find('input[type="search"]');

                // Add a custom class to the search input element
                searchInput.addClass('form-control');
            },
            "fnDrawCallback": function() {
                // Format all date cells as YYYY-MM-DD for filtering purposes
                $('table.pre-result-table tbody td:first-child').each(function() {
                    var dateStr = $(this).text();
                    console.log('Original date:', dateStr);

                    var formattedDate = moment(dateStr, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
                    console.log('Formatted date:', formattedDate);

                    $(this).text(formattedDate);
                });
                var api = this.api();
                var records = api.rows({
                    search: 'applied'
                }).data();
                if (records.length === 0) {
                    // No records found, update the table to show a message
                    var message = '<tr><td colspan="2">No matching records found</td></tr>';
                    $('table.pre-result-table tbody').html(message);
                }
            }
        });

        // Custom filter function for date range filtering
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var dateStr = data[1]; // Assumes date is in second column (index 1)
            var hiddenDateStr = data[0]; // Assumes hidden date is in first column (index 0)

            if (!startDate && !endDate) {
                // No date range selected, show all rows
                return true;
            }

            var momentDate = moment(dateStr, 'YYYY-MM-DD HH:mm:ss');
            var momentHiddenDate = moment(hiddenDateStr, 'YYYY-MM-DD HH:mm:ss');

            if (startDate && endDate) {
                // Filter by start and end dates
                var momentStartDate = moment(startDate, 'YYYY-MM-DD').startOf('day');
                var momentEndDate = moment(endDate, 'YYYY-MM-DD').endOf('day');
                if (momentDate.isBetween(momentStartDate, momentEndDate, null, '[]') ||
                    momentHiddenDate.isBetween(momentStartDate, momentEndDate, null, '[]')) {
                    return true;
                } else {
                    return false;
                }
            } else if (startDate && !endDate) {
                // Filter by start date only
                var momentStartDate = moment(startDate, 'YYYY-MM-DD').startOf('day');
                if (momentDate.isSameOrAfter(momentStartDate, 'day') ||
                    momentHiddenDate.isSameOrAfter(momentStartDate, 'day')) {
                    return true;
                } else {
                    return false;
                }
            } else if (!startDate && endDate) {
                // Filter by end date only
                var momentEndDate = moment(endDate, 'YYYY-MM-DD').endOf('day');
                if (momentDate.isSameOrBefore(momentEndDate, 'day') ||
                    momentHiddenDate.isSameOrBefore(momentEndDate, 'day')) {
                    return true;
                } else {
                    return false;
                }
            }
        });

        // Event handler for date range inputs
        $('#startDate').on('change', function() {
            var startDate = moment($(this).val(), 'YYYY-MM-DD');
            var minEndDate = startDate.startOf('month').format('YYYY-MM-DD');

            // Check if the selected start date is later than the selected end date
            if ($('#endDate').val() && $(this).val() > $('#endDate').val()) {
                $(this).val($('#endDate').val());
                startDate = moment($(this).val(), 'YYYY-MM-DD');
                minEndDate = startDate.format('YYYY-MM-DD');
            }

            $('#endDate').attr('min', minEndDate);
            $('table.pre-result-table').DataTable().draw();
        });

        $('#endDate').on('change', function() {
            var endDate = moment($(this).val(), 'YYYY-MM-DD');
            var maxStartDate = endDate.endOf('month').format('YYYY-MM-DD');
            // Check if the selected end date is earlier than the selected start date
            if ($('#startDate').val() > $(this).val()) {
                $(this).val($('#startDate').val());
                endDate = moment($(this).val(), 'YYYY-MM-DD');
            }

            $('#startDate').attr('max', maxStartDate);

            $('table.pre-result-table').DataTable().draw();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('table.post-result-table').DataTable({
            stateSave: true,
            pageLength: 5,
            stateSaveCallback: function(settings, data) {
                localStorage.setItem('myDataTablesState', JSON.stringify(data));
            },
            stateLoadCallback: function(settings) {
                return JSON.parse(localStorage.getItem('myDataTablesState'));
            },
            "columnDefs": [{
                "orderable": false,
                "targets": 0
            }],
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i> Excel File',
                    titleAttr: 'Excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa-solid fa-file-pdf"></i> PDF File',
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
            ],
            language: {
                search: '',
                searchPlaceholder: "Search",
                paginate: {
                    next: '<i class="fa-solid fa-circle-arrow-right"></i>',
                    previous: '<i class="fa-solid fa-circle-arrow-left"></i>'
                }
            },
            "initComplete": function() {
                $("#post-result-table").show();
                // Get the search input element
                var searchInput = $(this).closest('.dataTables_wrapper').find('input[type="search"]');

                // Add a custom class to the search input element
                searchInput.addClass('form-control');
            },
            "fnDrawCallback": function() {
                // Format all date cells as YYYY-MM-DD for filtering purposes
                $('table.post-result-table tbody td:first-child').each(function() {
                    var dateStr = $(this).text();
                    console.log('Original date:', dateStr);

                    var formattedDate = moment(dateStr, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
                    console.log('Formatted date:', formattedDate);

                    $(this).text(formattedDate);
                });
                var api = this.api();
                var records = api.rows({
                    search: 'applied'
                }).data();
                if (records.length === 0) {
                    // No records found, update the table to show a message
                    var message = '<tr><td colspan="2">No matching records found</td></tr>';
                    $('table.post-result-table tbody').html(message);
                }
            }
        });

        // Custom filter function for date range filtering
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var startDate = $('#postStartDate').val();
            var endDate = $('#postEndDate').val();
            var dateStr = data[1]; // Assumes date is in second column (index 1)
            var hiddenDateStr = data[0]; // Assumes hidden date is in first column (index 0)

            if (!startDate && !endDate) {
                // No date range selected, show all rows
                return true;
            }

            var momentDate = moment(dateStr, 'YYYY-MM-DD HH:mm:ss');
            var momentHiddenDate = moment(hiddenDateStr, 'YYYY-MM-DD HH:mm:ss');

            if (startDate && endDate) {
                // Filter by start and end dates
                var momentStartDate = moment(startDate, 'YYYY-MM-DD').startOf('day');
                var momentEndDate = moment(endDate, 'YYYY-MM-DD').endOf('day');
                if (momentDate.isBetween(momentStartDate, momentEndDate, null, '[]') ||
                    momentHiddenDate.isBetween(momentStartDate, momentEndDate, null, '[]')) {
                    return true;
                } else {
                    return false;
                }
            } else if (startDate && !endDate) {
                // Filter by start date only
                var momentStartDate = moment(startDate, 'YYYY-MM-DD').startOf('day');
                if (momentDate.isSameOrAfter(momentStartDate, 'day') ||
                    momentHiddenDate.isSameOrAfter(momentStartDate, 'day')) {
                    return true;
                } else {
                    return false;
                }
            } else if (!startDate && endDate) {
                // Filter by end date only
                var momentEndDate = moment(endDate, 'YYYY-MM-DD').endOf('day');
                if (momentDate.isSameOrBefore(momentEndDate, 'day') ||
                    momentHiddenDate.isSameOrBefore(momentEndDate, 'day')) {
                    return true;
                } else {
                    return false;
                }
            }
        });

        // Event handler for date range inputs
        $('#postStartDate').on('change', function() {
            var startDate = moment($(this).val(), 'YYYY-MM-DD');
            var minEndDate = startDate.startOf('month').format('YYYY-MM-DD');
            if ($('#postEndDate').val() && $(this).val() > $('#postEndDate').val()) {
                $(this).val($('#postEndDate').val());
                startDate = moment($(this).val(), 'YYYY-MM-DD');
                minEndDate = startDate.format('YYYY-MM-DD');
            }
            $('#postEndDate').attr('min', minEndDate);
            $('table.post-result-table').DataTable().draw();
        });

        $('#postEndDate').on('change', function() {
            var endDate = moment($(this).val(), 'YYYY-MM-DD');
            var maxStartDate = endDate.endOf('month').format('YYYY-MM-DD');
              // Check if the selected end date is earlier than the selected start date
              if ($('#postStartDate').val() > $(this).val()) {
                $(this).val($('#postStartDate').val());
                endDate = moment($(this).val(), 'YYYY-MM-DD');
            }
            $('#postStartDate').attr('max', maxStartDate);

            $('table.post-result-table').DataTable().draw();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.buttons-copy, .buttons-excel, .buttons-csv, .buttons-pdf').each(function() {
            $(this).removeClass('dt-button').addClass('btn btn-custom')

        })
    });
</script>

<script>
    // get the current date in YYYY-MM-DD format
    var today = new Date().toISOString().split('T')[0];

    // set the max attribute of the date inputs to today's date
    document.querySelector('#startDate').setAttribute('max', today);
    document.querySelector('#endDate').setAttribute('max', today);
    document.querySelector('#postStartDate').setAttribute('max', today);
    document.querySelector('#postEndDate').setAttribute('max', today);
</script>