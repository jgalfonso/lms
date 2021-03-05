$(function () {
    var table = $('#tbl-new').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'class' },
            { data: 'course' },
            { data: 'trainees', 'className': 'text-right' },
            { data: 'assessor' },
            { data: 'assessment_date' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [2, 5],
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
        },

        bindEvents: function () {
            this.$tab.on('click', this.filter);
        },

        filter: function (event) {
            var status = event.currentTarget.name;
            
            $.ajax({
                url: App.baseUrl + 'get-entries',
                method: 'GET',
                dataType: "json",
                data: { 
                    status : App.getStatus(status), 
                     _token: App.csrfToken
                },
                success: function(data) {

                    if(status == 'active') App.active(data);
                    else App.entries(data, status);
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
                        { data: 'class' },
                        { data: 'course' },
                        { data: 'trainees', 'className': 'text-right' },
                        { data: 'assessor' },
                        { data: 'assessment_date' },
                        { data: 'action', 'className': 'text-center' }
                    ],
                    "aoColumnDefs":[
                        {
                            "bSortable": false, 
                            "aTargets": [2, 5],
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
                            "class"             : '<b>'+value.class_code+'</b><br/><a href="">'+value.class_name+'</a>',
                            "course"            : value.course,
                            "trainees"          : '<a href="">'+value.enrollees+'</a>',
                            "assessor"          : value.assessor,
                            "assessment_date"   : value.date_assessed,
                            "action"            : '<a href='+App.baseUrl+'moderations/'+value.assessment_id+' title="Moderate" class="btn btn-sm btn-default"><i class="fa fa-file-o" aria-hidden="true"></i></a>'
                        }).draw();
                });
            }
        },

        active: function(data) {

            var table = $('#tbl-awarded').DataTable({
                    responsive: true,
                    dom: 'Bfrtip',
                    scrollX: true,
                    bDestroy: true,
                    bInfo: false,
                    bLengthChange: false,
                    columns:[
                        { data: 'id', 'className': 'hide' },
                        { data: 'action', 'className': 'text-center' },
                        { data: 'announcement' },
                        { data: 'winner_1' },
                        { data: 'winner_2' },
                        { data: 'winner_3' },
                        { data: 'winner_4' },
                        { data: 'status', 'className': 'word-wrap' }
                    ],
                    "aoColumnDefs":[
                        {
                            "bSortable": false, 
                            "aTargets": [1, 3, 4, 5, 6, 7],
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

            if(data) {

                var col = 1;
                var entryID = [];
                var winnerAnnouncement = new Date('2021-01-21');
                var winner1 = '', winner2 = '', winner3 = '', winner4 = '';
                var published = true;
                var post = false;

                table.clear().draw();

                $.each(data, function(key, value) {

                    entryID.push(value.entry_id);
                    var winner =  (value.profile_id && '<a href="/profile/'+ value.profile_id +'">'+ value.name +'</a>' || value.name) +'<br /><span class="badge badge-'+ (value.contributor == 'Existing' && 'success' || 'danger') +' ml-0" style="margin-top:10px;">'+ value.contributor +'</span>';
                    if(value.status == 'Awarded') published = false;

                    switch(col) {
                        case 1:

                            winner1 = winner;
                            if(key+1 == data.length) post = true;
                            break;
                        case 2:

                            winner2 = winner;
                            if(key+1 == data.length) post = true;
                            break;
                        case 3:

                            winner3 = winner;
                            if(key+1 == data.length) post = true;
                            break;
                        default:

                            winner4 = winner;
                            post = true;
                    }

                    if(post == true) {

                        table.row.add({
                                "id"            : entryID,
                                "action"        : published && '<i class="icon-trophy"></i>' || (col == 4 && '<a onClick="publish(this);" class="btn btn-sm btn-default" title="Publish" style="cursor: pointer;"><i class="fa fa-check"></i></a>' || '<a class="btn btn-sm btn-default" title="Pending" style="color: #e1e8ed; cursor: not-allowed;"><i class="fa fa-check"></i></a>'),
                                "announcement"  : formatDate2(getEveryThursOfTheWeek(winnerAnnouncement)),
                                "winner_1"      : winner1,
                                "winner_2"      : winner2,
                                "winner_3"      : winner3,
                                "winner_4"      : winner4,
                                "status"        : published && 'Published' || (col == 4 && 'Ready to Publish' || (4-col)+' more Winner/s Needed to Publish')
                            }).draw();

                        col = 1;
                        entryID = [];
                        winnerAnnouncement = new Date(winnerAnnouncement.setDate(winnerAnnouncement.getDate() + 4));
                        winner1 = '';
                        winner2 = '';
                        winner3 = '';
                        winner4 = '';
                        published: true;
                        post = false;
                    }
                    else col += 1;
                });
            }
        },

        getStatus: function(status) {
            if(status == 'new') return 'New';
            if(status == 'qa') return 'For QA';
            if(status == 'approval') return 'For Approval';
            if(status == 'active') return 'Active';
        }
    }

    App.init();
}); 

