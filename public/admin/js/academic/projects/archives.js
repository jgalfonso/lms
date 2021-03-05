$(function () {

    var table = $('#dt').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            "bInfo": false,
            scrollX: true,
            columns:[
                { data: "project_id", 'className': 'hidden' },
                { data: "checkbox", 'className' : 'text-center'},
                { data: "title" },
                { data: "name" },
                { data: "instructor" },
                { data: "start" },
                { data: "end" },
                { data: "status" },
                { data: "action" },
            ],
            searching: false,
            "aoColumnDefs":[
                {
                    "bSortable": false,
                    "aTargets": [0,1,7,8],
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
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/projects',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$classes = $('#classes');

            this.$checkAll = $('.markAll');

            this.$markAsActive = $('#markActive');
            this.$markAsClose = $('#markClose');
        },

        bindEvents: function () {
            this.$classes.on('change', this.search);

            this.$checkAll.on('change', function() {
                if ($(this).is(':checked')) {
                    $('.mark').not(this).prop('checked', true);
                } else {
                    $('.mark').not(this).prop('checked', false);
                }
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

                            var checkbox = '<label class="fancy-checkbox text-center">' +
                                                '<input type="checkbox" name="project" class="mark check" value="' + row['project_id'] + '" id="' + row['project_id'] + '">' +
                                                '<span></span>' +
                                            '</label>';
                            var name = '<b>' + row['class_code'] + '</b>' +
                                        '<br />'
                                        + row['class_name'];

                                        var action = '<a href="' + App.baseUrl + "/edit/" + row['project_id'] +'" class="btn btn-sm btn-default" title="Edit"><i class="icon-pencil"></i></a>' +
                                                     '<a href="' + App.baseUrl + "/view/" + row['project_id'] +'" class="btn btn-sm btn-default" title="View"><i class="icon-eye"></i></a>';

                            table.row.add( {
                                    "project_id"  : row['project_id'],
                                    "checkbox"    : checkbox,
                                    "title"       : '<a href="' + App.baseUrl + '/view/' + row.project_id + '">' + row.title + '</a>',
                                    "name"        : name,
                                    "instructor"  : '<div class="font-15">Debra Stewart</div>',
                                    "start"       : formatDate(row.start),
                                    "end"         : formatDate(row.end),
                                    "status"      : row.status,
                                    "action"      : action,
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
                bootstrap_alert.warning('#alert', ' Please select a <b>project/s</b> before submitting.');
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
                formData.append('projectIDs', JSON.stringify(App.getProjectIDs()));

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
                                text: "Project/s selected successfully activated.",
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
                bootstrap_alert.warning('#alert', ' Please select <b>project/s</b> before submitting.');
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
                formData.append('projectIDs', JSON.stringify(App.getProjectIDs()));

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
                                text: "Project/s selected successfully closed.",
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

        getProjectIDs : function() {
            var dt = [];

            $('#dt tbody tr').each(function(index, row){
                var cols = $(row).children('td');

                if ($(cols[1]).find('input[type=checkbox]').is(":checked")) {
                    dt.push({
                        "projectID" : $(cols[0]).text()
                    });
                }
            });

            return dt;
        },

    }

    App.init();
})

function formatDate(date) {
    var d = new Date(date),
        month = '' + d.getMonth(),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month, year].join('-');
}
