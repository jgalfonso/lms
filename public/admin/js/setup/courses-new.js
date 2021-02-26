$(function () {
    
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/setup/courses',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$save = $('.save');
        },

        bindEvents: function () {
            this.$save.on('click', this.save);
        },

        save: function() {
            if (App.validate()) return; 

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
                
                var form = document.getElementById('form');
                var formData = new FormData(form);

                $.ajax({
                    url: App.baseUrl + "/store",
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
                                window.location.href = App.baseUrl+'/view/'+data.id; 
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

        validate: function() {
            if (!$('#form').parsley().validate()) { 
                bootstrap_alert.warning('#alert', 'There are some error/s, please correct them bellow.'); 

                $('html, body').animate({
                    scrollTop: ($('#alert').offset().top - 300)
                },500);

                return true; 
            } else {
                return false;
            }
        }
        
    }

    App.init();
})
