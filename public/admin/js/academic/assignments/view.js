$(function () {
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true
    });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/assignments',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$markAsActive = $('#mark-as-active');
            this.$markAsClose = $('#mark-as-close');
        },

        bindEvents: function () {
            this.$markAsActive.on('click', this.markAsActive);
            this.$markAsClose.on('click', this.markAsClose);
        },

        markAsActive : function() {
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
                formData.append('assignmentIDS', JSON.stringify(App.getAssignmentID()));

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
                                text: "Assignment selected successfully activated.",
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
                formData.append('assignmentIDS', JSON.stringify(App.getAssignmentID()));


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
                                text: "Assignment selected successfully closed.",
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

        getAssignmentID : function() {
            var dt = [];

            dt.push({
                "assignmentID" : $('#assignmentID').val()
            });

            return dt;
        },
    }

    App.init();

})
