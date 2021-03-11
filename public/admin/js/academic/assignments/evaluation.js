$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'student' },
            { data: 'title' },
            { data: 'attachment', 'className': 'text-right' },
            { data: 'date' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false,
                "aTargets": [4],
            },
            {
                "targets": [0],
                "searchable": true
            }
        ],
        language: {
            paginate: {
                next: '»',
                previous: '«'
            }
        },
        aaSorting: [[0, 'desc']]
    });

    var App = {
        host: window.location.protocol + '//' + window.location.host + '/',
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/assignments',
        studentURL : window.location.protocol + '//' + window.location.host + '/admin/manage-users/students',
        classesURL : window.location.protocol + '//' + window.location.host + '/admin/setup/classes',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$accordionThumb = $('.accordion-thumb');
            this.$classes = $('#classes');
            this.$courses = $('#course');
            this.$search = $('#search');
        },

        bindEvents: function () {
            this.$accordionThumb.on('click', function() {
                $(this).closest( "li" ).toggleClass("is-active").children(".accordion-panel").slideToggle("ease-out");
            });
            this.$classes.on('change', this.search);
            this.$courses.on('change', this.getClasses);
            this.$search.on('click', this.search);
        },

        getClasses : function() {

            var course_id = $('#course').find(":selected").val();

            if (course_id == 'Choose...') {
                $('#classes').find('option').remove();
                $('#classes').attr('disabled', true);

                return false;
            }

            $.ajax({
                url: App.baseUrl + "/getClasses",
                type: 'POST',
                data: {
                    course_id : course_id
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                success: function (data) {

                    if (data != '') {
                        $('#classes').find('option').remove();
                        $('#classes').attr('disabled', false);

                        $("#classes").append('<option value="">Choose...</option>')
                        $.each(data, function(key, value){
                            $("#classes").append('<option value="'+ value.class_id +'">'+ value.name +'</option>')
                        });
                    } else {
                        alert(data.success);
                    }

                },
                error : function(request, status, error) {
                    alert(error);
                },
            });
        },

        search : function() {
            var class_id = $('#classes').find(":selected").val();
            var keyword  = $('#keyword').val();

            $.ajax({
                url: App.baseUrl + '/filterSubmitted',
                method: 'GET',
                dataType: "json",
                data: {
                    'class_id' : class_id,
                    'keyword'  : keyword,
                },
                success: function (data) {
                    table.clear().draw();

                    if (data != '') {

                        $.each(data, function (key, row) {
                            // console.log(row);

                            var student = '<b>' + row['student_no'] + '</b>' +
                                        '<br />'
                                        + '<a href="' + App.studentURL + '/view/' + row['student_id'] + '">' + row['student'] + '</a>';

                            var title = '<a href="' + App.baseUrl + '/view/' + row['assignment_id'] + '">' + row['assignment'] + '</a>' + '<br /><b>' + row['class_code'] + '</b>' + '<br />'
                                        + '<a href="' + App.classesURL + '/view/' + row['class_id'] + '">' + row['class_name'] + '</a>';

                            var date_submitted = row.date_created.split(/[- :]/);
                            var date = `${date_submitted[2]}-${date_submitted[1]}-${date_submitted[0]}`;

                            var action = '<a href="' + App.baseUrl + "/submitted-attachments/" + row['participant_id'] +'" class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></a>';

                            table.row.add( {
                                "student"       : student,
                                "title"         : title,
                                "attachment"    : '3',
                                "date"          : date,
                                "action"        : action,
                            }).draw();
                        });


                    }
                },
                error: function () {
                }
            });

            table
                .search($('#keyword').val())
                .draw();
        }
    }

    App.init();
});
