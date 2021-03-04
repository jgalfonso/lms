$(function () {

    var table = $('#dt').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: 'quiz_id', 'className': 'hidden' },
                { data: "checkbox", 'className': 'text-center' },
                { data: "title" },
                { data: "name" },
                { data: "availability" },
                { data: "due_date" },
                { data: "limit" },
                { data: "status" },
                { data: "action", 'className': 'text-center' },
            ],
            searching: false,
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [1,7,8],
                }
            ],
            "order" : [],
            language: {
                paginate: {
                    next: '»',
                    previous: '«'
                }
            }
        });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/quizzes',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$classes = $('#classes');
            this.$selectAll = $('.select-all');

            this.$markAsActive = $('#mark-as-active');
            this.$markAsClose = $('#mark-as-close');
        },

        bindEvents: function () {
            this.$classes.on('change', this.search);
            this.$selectAll.on('click', function(e) {
                $('.checkbox').prop('checked', this.checked);
            });

            this.$markAsActive.on('click', this.markAsActive);
            this.$markAsClose.on('click', this.markAsClose);
        },

        search : function() {
            var class_id = $('#classes').find(":selected").val();

            $.ajax({
                url: App.baseUrl + '/filter',
                method: 'GET',
                dataType: "json",
                data: {
                    'class_id' : class_id,
                    'archives' : 1
                },
                success: function (data) {
                    table.clear().draw();

                    if (data != '') {

                        $.each(data, function (key, row) {

                            var checkbox = '<label class="fancy-checkbox">' +
                                                '<input type="checkbox" name="project" class="mark check" value="' + row['project_id'] + '" id="' + row['project_id'] + '">' +
                                                '<span></span>' +
                                            '</label>';
                            var name = '<b>' + row['class_code'] + '</b>' +
                                        '<br />'
                                        + row['class_name'];

                            var start_date = row.start.split(/[- :]/);
                            var start = `${start_date[2]}-${start_date[1]}-${start_date[0]}`;

                            var end_date = row.end.split(/[- :]/);
                            var end = `${end_date[2]}-${end_date[1]}-${end_date[0]}`;

                            var action = '<a href="' + App.baseUrl + "/edit/" + row['quiz_id'] +'" class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></a>';

                            table.row.add( {
                                "quiz_id"       : row.quiz_id,
                                "checkbox"      : checkbox,
                                "title"         : '<a href="' + App.baseUrl + '/view/' + row.quiz_id + '">' + row.title + '</a>',
                                "name"          : name,
                                "availability"  : start,
                                "due_date"      : end,
                                "limit"         : '1hr',
                                "status"        : row.status,
                                "action"        : action,
                            }).draw();
                        });


                    }
                },
                error: function () {
                }
            });
        },

        markAsActive : function() {
            if (!$('#dt').find('input[type="checkbox"]').is(":checked")) {
                bootstrap_alert.warning('#alert', ' Please select a <b>quiz/quizzes</b> before submitting.');
                $('html, body').animate({scrollTop:0}, 500);
                return;
            }

            bootstrap_alert.close('#alert');

            swal({
                title: "",
                text: "Are you sure you want to activate this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {


                const formData = new FormData();
                formData.append('quizIDS', JSON.stringify(App.getQuizIDS()));

                $.ajax({
                    url: App.baseUrl + "/activate",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': App.csrfToken},
                    success: function(data) {
                        if (data.success == true) {

                            swal({
                                title: "Success!",
                                text: "Quiz/quizzes selected successfully activated.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl + '/recent';
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

        markAsClose : function() {
            if (!$('#dt').find('input[type="checkbox"]').is(":checked")) {
                bootstrap_alert.warning('#alert', ' Please select a <b>quiz/quizzes</b> before submitting.');
                $('html, body').animate({scrollTop:0}, 500);
                return;
            }

            bootstrap_alert.close('#alert');

            swal({
                title: "",
                text: "Are you sure you want to close this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {


                const formData = new FormData();
                formData.append('quizIDS', JSON.stringify(App.getQuizIDS()));

                $.ajax({
                    url: App.baseUrl + "/close",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': App.csrfToken},
                    success: function(data) {
                        if (data.success == true) {

                            swal({
                                title: "Success!",
                                text: "Quiz/quizzes selected successfully closed.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl + '/archives';
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

        getQuizIDS : function() {
            var dt = [];

            $('#dt tbody tr').each(function(index, row){
                var cols = $(row).children('td');

                if ($(cols[1]).find('input[type=checkbox]').is(":checked")) {
                    dt.push({
                        "quizID" : $(cols[0]).text()
                    });
                }
            });

            return dt;
        },

    }

    App.init();
})
