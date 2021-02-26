$(function () {
    var table = $('#dt').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        scrollX: true,
        bInfo: false,
        bDestroy: true,
        bLengthChange: false,
        columns:[
            { data: 'class_id', 'className': 'hidden' },
            { data: 'checkbox', 'className': 'text-center' },
            { data: 'class' },
            { data: 'course' },
            { data: 'instructor' },
            { data: 'status' },
            { data: 'action', 'className': 'text-center' }
        ],
        "aoColumnDefs":[
            {
                "bSortable": false, 
                "aTargets": [1, 5, 6],
            },
            { 
                "targets": [3], 
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
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/setup/classes',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$courses = $('#courses');
            this.$selectAll = $('.select-all');

            this.$markAsActive = $('#mark-as-active');
            this.$markAsClose = $('#mark-as-close');
        },

        bindEvents: function () {
            this.$courses.on('change', this.filter);

            this.$selectAll.on('click', function(e) {
                $('.checkbox').prop('checked', this.checked);
            });

            this.$markAsActive.on('click', this.markAsActive);
            this.$markAsClose.on('click', this.markAsClose);
        },

        filter : function(e) {
            if(e.target.value) {
                var course = e.target.options[event.target.options.selectedIndex].text;

                table
                    .search(course)
                    .draw();
            } else {
   
                table
                    .search('')
                    .draw();
            }
           
        },

        markAsActive : function() {
            if (!$('#dt').find('input[type="checkbox"]').is(":checked")) { 
                bootstrap_alert.warning('#alert', ' Please select a <b>class/clasess</b> before submitting.'); 
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
                formData.append('classIDS', JSON.stringify(App.getClassIDS()));

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
                                text: "Class/classes selected successfully activated.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl; 
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
                bootstrap_alert.warning('#alert', ' Please select a <b>class/clasess</b> before submitting.'); 
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
                formData.append('classIDS', JSON.stringify(App.getClassIDS()));

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
                                text: "Class/classes selected successfully closed.",
                                type: "success",
                            }, function () {
                                window.location.href = App.baseUrl; 
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

        getClassIDS : function() {
            var dt = [];

            $('#dt tbody tr').each(function(index, row){
                var cols = $(row).children('td');

                if ($(cols[1]).find('input[type=checkbox]').is(":checked")) {
                    dt.push({
                        "classID" : $(cols[0]).text()
                    });
                }
            });

            return dt;
        }, 

    }

    App.init();
}); 

