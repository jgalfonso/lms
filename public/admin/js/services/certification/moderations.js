$(function () {
    var table = $('#tbl-new').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'certificate_id', 'className': 'hidden' },
            { data: 'checkbox', 'className': 'text-center' },
            { data: 'trainee' },
            { data: 'class' },
            { data: 'course' },
            { data: 'assessment_date' },
            { data: 'dt_issued' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [1, 5, 6, 7],
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
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/certifications/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$tab = $('.tab');

            this.$selectAll = $('.select-all');
            this.$markAsForQA = $('.mark-as-forqa');
            this.$markAsForApproval = $('.mark-as-forapproval');
            this.$markAsReject = $('.mark-as-reject');
            this.$markAsRevertToQA = $('.mark-as-reverttoqa');
            this.$markAsApproved = $('.mark-as-approved');
        },

        bindEvents: function () {
            this.$tab.on('click', this.filter);

            this.$selectAll.on('click', function(e) {
                $('.checkbox').prop('checked', this.checked);
            });

            this.$markAsForQA.on('click', function(e) {
                App.moderate('For QA');
            });

            this.$markAsForApproval.on('click', function(e) {
                App.moderate('For Approval');
            });

            this.$markAsReject.on('click', function(e) {
                App.moderate('Rejected');
            });

            this.$markAsRevertToQA.on('click', function(e) {
                App.moderate('For QA');
            });

            this.$markAsApproved.on('click', function(e) {
                App.moderate('Active');
            });
        },

        filter: function (event) {
            var status = event.currentTarget.name;
            
            bootstrap_alert.close('#alert');

            $.ajax({
                url: App.baseUrl +(status == 'active' && 'get-bystatus' || 'get-entries'),
                method: 'GET',
                dataType: "json",
                data: { 
                    status : App.getStatus(status), 
                     _token: App.csrfToken
                },
                success: function(data) {

                    if(status == 'active') App.active(data);
                    else App.entries(data, status);

                    $('#current-tab').val(status);
                    App.$selectAll.prop('checked', false);
                },
                error : function(request, status, error) {
                    console.log(error)
                }
            });
        },

        entries: function(data, status) {
            var table = $('#tbl-' + status).DataTable({
                    responsive: true,
                    dom: 'Bfrtip',
                    scrollX: true,
                    bDestroy: true,
                    bInfo: false,
                    bLengthChange: false,
                    columns:[
                        { data: 'certificate_id', 'className': 'hidden' },
                        { data: 'checkbox', 'className': 'text-center' },
                        { data: 'trainee' },
                        { data: 'class' },
                        { data: 'course' },
                        { data: 'assessment_date' },
                        { data: 'dt_issued' },
                        { data: 'action', 'className': 'text-center' }
                    ],
                    "aoColumnDefs":[
                        {
                            "bSortable": false, 
                            "aTargets": [1, 5, 6, 7],
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

            if (data && data.length > 0) {

                table.clear().draw();

                $.each(data, function(key, value) {
                    
                    table.row.add({
                            "certificate_id"    : value.certificate_id,
                            "checkbox"          : '<label class="fancy-checkbox"><input type="checkbox" class="checkbox"><span style="width: 1%;"></span></label>',
                            "trainee"           : '<b>'+value.control_no+'</b><br/><a href="/admin/manage-users/students/view/'+value.profile_id+'">'+value.trainee+'</a>',
                            "class"             : '<b>'+value.class_code+'</b><br/><a href="/admin/setup/classes/view/'+value.class_id+'">'+value.class_name+'</a>',
                            "course"            : value.course,
                            "assessment_date"   : value.dt_issued,
                            "dt_issued"         : value.date_assessed,
                            "action"            : '<a href='+App.baseUrl+'moderations/'+value.certificate_id+' title="Moderate" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>'
                        }).draw();
                });

                $('#'+status+' .action-mark').show();
            } 
            else {

                $('#'+status+' .action-mark').hide();
            }
        },

        active: function(data) {

            var table = $('#tbl-active').DataTable({
                    responsive: true,
                    dom: 'Bfrtip',
                    scrollX: true,
                    bDestroy: true,
                    bInfo: false,
                    bLengthChange: false,
                    columns:[
                        { data: 'trainee' },
                        { data: 'class' },
                        { data: 'course' },
                        { data: 'certification_no' },
                        { data: 'registration_no' },
                        { data: 'action', 'className': 'text-center' }
                    ],
                    "aoColumnDefs":[
                        {
                            "bSortable": false, 
                            "aTargets": [5],
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

            if (data) {

                table.clear().draw();

                $.each(data, function(key, value) {
                    
                    table.row.add({
                            "trainee"           : '<b>'+value.control_no+'</b><br/><a href="/admin/manage-users/students/view/'+value.profile_id+'">'+value.trainee+'</a>',
                            "class"             : '<b>'+value.class_code+'</b><br/><a href="/admin/setup/classes/view/'+value.class_id+'">'+value.class_name+'</a>',
                            "course"            : value.course,
                            "certification_no"  : value.certificate_no,
                            "registration_no"   : value.registration_no,
                            "action"            : '<a href='+App.baseUrl+'view/'+value.certificate_id+' title="View" class="btn btn-sm btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>'
                        }).draw();
                });
            }
        },

        getStatus: function(status) {
            if(status == 'new') return 'New';
            if(status == 'qa') return 'For QA';
            if(status == 'approval') return 'For Approval';
            if(status == 'rejected') return 'Rejected';
            if(status == 'active') return 'Active';
        },

        moderate: function(status) {
            if (!$('#tbl-'+ $('#current-tab').val()).find('input[type="checkbox"]').is(":checked")) { 
                bootstrap_alert.warning('#alert', ' Please select a <b>certificate/certificates</b> before submitting.'); 
                $('html, body').animate({scrollTop:0}, 500); 
                return; 
            }

            bootstrap_alert.close('#alert');

            swal({
                title: "",
                text: "Are you sure you want to save this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                
                var formData = new FormData();
                formData.append('gradeID', App.getGradeID(status));
                formData.append('status', status);
                formData.append('certificateIDS', JSON.stringify(App.getCertificateIDS()));

                $.ajax({
                    url: App.baseUrl + "store",
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
                                window.location.href = App.baseUrl +'moderations'; 
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

        getGradeID: function(status) {
            if(status == 'For QA') return 1;
            if(status == 'For Approval') return 2;
            if(status == 'Rejected') return 5;
            if(status == 'Active') return 3;
        },

        getCertificateIDS : function() {
            var dt = [];
            
            $('#tbl-'+ $('#current-tab').val() +' tbody tr').each(function(index, row){
                var cols = $(row).children('td');

                if ($(cols[1]).find('input[type=checkbox]').is(":checked")) {
                    dt.push({
                        "certificateID" : $(cols[0]).text()
                    });
                }
            });

            return dt;
        }, 
    }

    App.init();
}); 

