$(function () {

    var table = $('#dt').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: "checkbox" },
                { data: "title" },
                { data: "availability" },
                { data: "due_date" },
                { data: "limit" },
                { data: "action" },
            ],
            searching: false,
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [0,4,5],
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
                    'archives' : 1,
                },
                success: function (data) {

                    if (data != '') {

                        table.clear().draw();

                        $.each(data, function (key, row) {

                            var checkbox = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="lesson" class="mark check" value="' + row.quiz_id + '" id="' + row.quiz_id + '">' +
                                                '<span></span>' +
                                            '</label>';

                            var action = '<a href="#" class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></a>';

                            table.row.add( {
                                    "checkbox"      : checkbox,
                                    "title"         : '<a href="' + App.baseUrl + '/view/' + row.quiz_id + '">' + row.title + '</a>',
                                    "availability"  : '01/01/2021',
                                    "due_date"      : '01/01/2021',
                                    "limit"    : '1hr',
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
