$(function () {
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/setup/classes',
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
                formData.append('classIDS', JSON.stringify(App.getClassID()));

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
                                text: "Class selected successfully activated.",
                                type: "success",
                            }, function () {
                                window.location.reload();
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
                formData.append('classIDS', JSON.stringify(App.getClassID()));

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
                                text: "Class selected successfully closed.",
                                type: "success",
                            }, function () {
                                window.location.reload();
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

        getClassID : function() {
            var dt = [];

            dt.push({
                "classID" : $('#classID').val()
            });

            return dt;
        }, 

    }

    App.init();
}); 

