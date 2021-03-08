$(function () {
    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });

    var table = $('#trainees').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'admission_id', 'className' : 'hidden'},
            { data: 'profile_id', 'className' : 'hidden'},
            { data: 'student_no'},
            { data: 'name'},
            { data: 'passed', 'className' : 'text-center'},
            { data: 'failed', 'className' : 'text-center'},
            { data: 'incomplete', 'className' : 'text-center'},
        ],
        "aoColumnDefs":[
            {
                "bSortable": false,
                "aTargets": [4,5,6]
            }
        ],
        language: {
            paginate: {
                next: '»',
                previous: '«'
            }
        },
        aaSorting: [[0, 'asc']]
    });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/assessment',
        url : window.location.protocol + '//' + window.location.host + '/admin/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$class = $('#class_id');
            this.$assess = $('#save');
            this.$validateAssess = $('#assess');

            this.$checkboxes = $('input:checkbox');
        },

        bindEvents: function () {
            this.$class.on('change', this.getTrainees);
            this.$assess.on('click', this.assess);
            this.$validateAssess.on('click', this.validate);

            this.$checkboxes.on('click', function() {
                var $box = $(this);

                if ($box.is(":checked")) {
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                }
            });
        },

        getTrainees : function() {

            var class_id = $('#class_id').find(":selected").val();

            $.ajax({
                url: App.baseUrl + '/getTrainees',
                method: 'GET',
                dataType: "json",
                data: {
                    classID    : class_id,
                    _token      : App.csrfToken
                },
                success: function(data) {
                    if(data) {

                        var class_info = data.class_data;
                        $('#class_code').html(': <b>' + class_info.code + '</b>');
                        $('#class_name').html(': <a href="' + App.url + "/setup/classes/view/" + class_info.class_id + '">' + class_info.name + '</a>');
                        $('#course_name').html(': ' + class_info.course);
                        $('#instructor').html(': ' + class_info.instructor);
                        $('#schedule').html(': ' + (class_info.start == null ? '' : formatDate(class_info.start)) + ' - ' + (class_info.end == null ? '' : formatDate(class_info.end)));
                        $('#no_trainees').html(': ' + data.no_trainees);
                        $('#class_status').html(': ' + class_info.status);
                        $('.inputDiv').append(
                                '<input type="hidden" name="course_id" value="' + class_info.course_id + '">' +
                                '<input type="hidden" name="no_trainees" value="' + data.no_trainees + '">'
                            );

                        table.clear().draw();

                        $.each(data.trainees, function(key, value) {
                            var passed = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="assess' + value.control_no + '" class="mark check passed" value="passed">' +
                                                '<span></span>' +
                                            '</label>';

                            var failed = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="assess' + value.control_no + '" class="mark check failed" value="failed">' +
                                                '<span></span>' +
                                            '</label>';

                            var incomplete = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="assess' + value.control_no + '" class="mark check incomplete" value="incomplete">' +
                                                '<span></span>' +
                                            '</label>';

                            var name = '<a href="">' + value.firstname + ' ' + value.lastname + '</a>' +
                                        '<br>' + value.email;

                            table.row.add({
                                    "admission_id"  : value.admission_id,
                                    "profile_id"    : value.profile_id,
                                    "student_no"    : value.control_no,
                                    "name"          : name,
                                    "passed"        : passed,
                                    "failed"        : failed,
                                    "incomplete"    : incomplete,
                                }).draw();

                            App.init();
                        });
                    }
                },
                error : function(request, status, error) {
                    console.log(error)
                }
            });
        },

        getTraineeData: function() {

            var dt = [];

            var notchecked = 0;
            $('#trainees > tbody > tr').each(function(index, row){
                var cols = $(row).children('td');

                var passed      = ($(cols[4]).find('input[type=checkbox]').is(":checked") ? 1 : null);
                var failed      = ($(cols[5]).find('input[type=checkbox]').is(":checked") ? 1 : null);
                var incomplete  = ($(cols[6]).find('input[type=checkbox]').is(":checked") ? 1 : null);

                if (passed == 0 && failed == 0 && incomplete == 0) {
                    notchecked++;
                }

                dt.push({
                    "admission_id"  : $(cols[0]).text(),
                    "profile_id"    : $(cols[1]).text(),
                    "passed"        : passed,
                    "failed"        : failed,
                    "incomplete"    : incomplete,
                });
            });

            var data = (notchecked > 0 ? 'empty' : dt);

            console.log(data);

            return data;
        },

        assess: function() {

            if (App.validate()) return;

            bootstrap_alert.close('#alert');

            var passed = 0;
            $('.passed:checkbox').each(function () {
                if ($(this).is(':checked')) {
                    passed++;
                }
            })

            var failed = 0;
            $('.failed:checkbox').each(function () {
                if ($(this).is(':checked')) {
                    failed++;
                }
            })

            var incomplete = 0;
            $('.incomplete:checkbox').each(function () {
                if ($(this).is(':checked')) {
                    incomplete++;
                }
            })

            swal({
                title: "",
                text: "Are you sure you want to save this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {

                var form = document.getElementById('new');
                var formData = new FormData(form);
                formData.append('traineesData', JSON.stringify(App.getTraineeData()));
                formData.append('class_id', $('#class_id').find(":selected").val());
                formData.append('passed', passed);
                formData.append('failed', failed);
                formData.append('incomplete', incomplete);

                $.ajax({
                    url: App.baseUrl + "/save-assessment",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': App.csrfToken},
                    success: function(data) {
                        if (data.success == true) {

                            swal({
                                title: "Success!",
                                text: "1 row successfully submitted.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl+'/view/' + data.id;
                            });
                        } else {
                            alert(data);
                        }
                    },
                    error : function(request, status, error) {
                        swal("Oops!", "Seems like there is an error. Please try again", "error");
                    },
                    contentType: false,
                    processData: false,
                    cache: false
                });
            });
        },

        validate: function() {

            if (!$('#new').parsley().validate()) {
                bootstrap_alert.warning('#alert', ' There are some error/s, please correct them bellow.');

                $('html, body').animate({
                    scrollTop: ($('#alert').offset().top - 300)
                },500);

                return true;
            } else if (App.getTraineeData() == 'empty') {

                bootstrap_alert.warning('#alert', ' Please assess all trainees.');

                $('html, body').animate({
                    scrollTop: ($('#alert').offset().top - 300)
                },500);

                return true;

            } else {
                $('#assessModal').modal('show');

                return false;
            }
        }

    }

    App.init();
})

function hide(e){
    var cols = $(e).closest('tr').children("td");

    $(e).closest('tr').hide();
}

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [month, day, year].join('/');
}
