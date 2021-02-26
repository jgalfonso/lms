$(function () {
    
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/manage-users/students',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$dob = $('.dob');
            this.$addEducationBackground = $('#add-education-background');
            this.$removeEducationBackground = $('.remove-education-background');
            this.$addEmploymentHistory = $('#add-employment-history');
            this.$removeEmploymentHistory = $('.remove-employment-history');
            this.$addCertificates = $('#add-certificates');
            this.$removeCertificates = $('.remove-certificates');
            this.$save = $('.save');
        },

        bindEvents: function () {
            this.$dob.datepicker({ format: 'dd-mm-yyyy', todayHighlight: true });

            this.$addEducationBackground.on('click', this.addEducationBackground);
            this.$removeEducationBackground.on('click', this.removeEducationBackground);
            this.$addEmploymentHistory.on('click', this.addEmploymentHistory);
            this.$removeEmploymentHistory.on('click', this.removeEmploymentHistory);
            this.$addCertificates.on('click', this.addCertificates);
            this.$removeCertificates.on('click', this.removeCertificates);
            this.$save.on('click', this.save);
        },

        addEducationBackground: function() {
            var source = $('.education-background'), clone = source.clone(true);

            clone.css('display', 'block');
            $('<form />').append(clone)[0].reset();

            clone.insertAfter("div.education-background:last");

            $(this).parent().parent().parent().parent().removeClass('education-background');
            $(this).parent().parent().parent().parent().find('a.remove-education-background').removeClass('hidden');
            $(this).hide();
        },

        removeEducationBackground: function() {
            $(this).parent().parent().parent().parent().parent().remove();
        },

        addEmploymentHistory: function() {
            var source = $('.employment-history'), clone = source.clone(true);

            clone.css('display', 'block');
            $('<form />').append(clone)[0].reset();

            clone.insertAfter("div.employment-history:last");

            $(this).parent().parent().parent().parent().removeClass('employment-history');
            $(this).parent().parent().parent().parent().find('a.remove-employment-history').removeClass('hidden');
            $(this).hide();
        },

        removeEmploymentHistory: function() {
            $(this).parent().parent().parent().parent().parent().remove();
        },

        addCertificates: function() {
            var source = $('.certificates'), clone = source.clone(true);

            clone.css('display', 'block');
            $('<form />').append(clone)[0].reset();

            clone.insertAfter("div.certificates:last");

            $(this).parent().parent().parent().parent().removeClass('certificates');
            $(this).parent().parent().parent().parent().find('a.remove-certificates').removeClass('hidden');
            $(this).hide();
        },

        removeCertificates: function() {
            $(this).parent().parent().parent().parent().parent().remove();
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
