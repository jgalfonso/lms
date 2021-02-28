$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'invoice_id', 'className': 'hidden' },
            { data: 'checkbox', 'className': 'text-center' },
            { data: 'invoice_no' },
            { data: 'customer' },
            { data: 'invoice_date' },
            { data: 'due_date' },
            { data: 'amount', 'className': 'text-right' },
            { data: 'status' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [1, 8]
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
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$search = $('#search');
        },

        bindEvents: function () {
            this.$search.on('click', this.search);
        },

        search : function() {
            $.ajax({
                url: App.baseUrl + '/search',
                method: 'GET',
                dataType: "json",
                data: { 
                    key : $('#key').val(), 
                    _token: App.csrfToken
                },
                success: function(data) {
                    if(data) {
                        table.clear().draw();

                        $.each(data, function(key, value) {
                            
                            table.row.add({
                                    "profile_id"    : value.profile_id,
                                    "avatar"        : value.meta && value.filename ? '<img src="/'+ JSON.parse(value.meta).thumb[0].path + value.filename +'" alt="" class="avtar-pic w35">' : '<div class="avtar-pic w35 '+ (value.gender == 'Male' ? 'bg-blue' : 'bg-pink') +'" data-toggle="tooltip" data-placement="top" title="" data-original-title="Avatar Name"><span>'+ value.firstname.charAt(0) + value.lastname.charAt(0) +'</span></div>',
                                    "name"          : '<a href="/admin/manage-users/students/view/'+ value.profile_id +'">'+ value.firstname +' '+ (value.middlename ? value.middlename+' ' : '') +' '+ value.lastname +'</a><br>'+ value.email,
                                    "student_no"    : value.control_no,
                                    "dob"           : formatDate1(value.dob),
                                    "age"           : value.age,
                                    "gender"        : value.gender,
                                    "action"        : '<a href="/admin/services/enrollment/new/'+ value.profile_id +'" title="Enroll & Add Class" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>'
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

