$(function () {

    var table = $('#dt').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: "checkbox" },
                { data: "name" },
                { data: "class" },
                { data: "instructor" },
                { data: "weight" },
                { data: "units" },
                { data: "schedule" },
            ],
            searching: false,
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [0, 4, 6],
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
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/class-activation',
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
                                                '<input type="checkbox" name="lesson" class="mark check" value="' + row['lesson_id'] + '" id="' + row['lesson_id'] + '">' +
                                                '<span></span>' +
                                            '</label>';
                            var name = '<b>' + row['class_code'] + '</b>' +
                                        '<br />'
                                        + row['class_name'];

                            var action = '<a href="' + App.baseUrl + "user-group/edit/" + row['group_id'] +'" class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></a>';

                            table.row.add( {
                                    "checkbox"    : checkbox,
                                    "title"       : '<a href="#">' + row.title + '</a>',
                                    "name"        : name,
                                    "instructor"  : '<div class="font-15">Debra Stewart</div>',
                                    "status"      : row['status'],
                                    "action"      : action,
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
