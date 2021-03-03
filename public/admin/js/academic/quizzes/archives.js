$(function () {

    var table = $('#dt').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: "checkbox" },
                { data: "title" },
                { data: "name" },
                { data: "availability" },
                { data: "due_date" },
                { data: "limit" },
                { data: "status" },
                { data: "action" },
            ],
            searching: false,
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [0,6,7],
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
        },

        bindEvents: function () {
            this.$classes.on('change', this.search);
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

                            var checkbox = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="project" class="mark check" value="' + row['project_id'] + '" id="' + row['project_id'] + '">' +
                                                '<span></span>' +
                                            '</label>';
                            var name = '<b>' + row['class_code'] + '</b>' +
                                        '<br />'
                                        + row['class_name'];

                            var action = '<a href="' + App.baseUrl + "/edit/" + row['quiz_id'] +'" class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></a>' +
                                         '<a href="' + App.baseUrl + "/view/" + row['quiz_id'] +'" class="btn btn-sm btn-default" title="View"><i class="icon-eye"></i></a>';

                            table.row.add( {
                                "checkbox"      : checkbox,
                                "title"         : '<a href="' + App.baseUrl + '/view/' + row.quiz_id + '">' + row.title + '</a>',
                                "name"          : name,
                                "availability"  : '01/01/2021',
                                "due_date"      : '01/01/2021',
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

    }

    App.init();
})
