$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'admission_id', 'className': 'hidden' },
            { data: 'checkbox', 'className': 'text-center' },
            { data: 'code' },
            { data: 'name' },
            { data: 'class' },
            { data: 'course'},
            { data: 'status' },
        ],
        "aoColumnDefs":[
            {
                "bSortable": false,
                "aTargets": [1, 6]
            }
        ],
        language: {
            paginate: {
                next: '»',
                previous: '«'
            }
        },
        aaSorting: [[2, 'asc']]
    });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/enrollment',
        classUrl : window.location.protocol + '//' + window.location.host + '/admin/setup/classes/view/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$courses = $('#course_id');
        },

        bindEvents: function () {
            this.$courses.on('change', this.filter);
        },

        filter : function() {

            var course_id = $('#course_id').find(":selected").val();

            $.ajax({
                url: App.baseUrl + '/filter-class-summary',
                method: 'GET',
                dataType: "json",
                data: {
                    course_id   : course_id,
                    _token      : App.csrfToken
                },
                success: function(data) {
                    if(data) {
                        table.clear().draw();

                        $.each(data, function(key, value) {

                            var checkbox = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="admission" class="mark check" value="' + value['admission_id'] + '" id="' + value['admission_id'] + '">' +
                                                '<span></span>' +
                                            '</label>';

                            var class_url = '<b>' + value.class_code + '</b><br/>' +
                                        '<a href="' + App.classUrl + value.class_id + '">' + value.class_name + '</a>'

                            table.row.add({
                                    "admission_id"  : value.admission_id,
                                    "checkbox"      : checkbox,
                                    "code"          : value.code,
                                    "name"          : value.firstname + ' ' + value.lastname,
                                    "class"         : class_url,
                                    "course"        : value.course_name,
                                    "status"        : value.status,
                                }).draw();
                        });
                    }
                },
                error : function(request, status, error) {
                    console.log(error)
                }
            });
        },
    }

    App.init();
});

function formatDate1(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join('-');
}
