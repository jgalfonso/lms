$(function () {
    
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/setup/classes',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$time12 = $('.schedules');
            this.$add = $('#add');
            this.$remove = $('.remove');
            this.$save = $('.save');
        },

        bindEvents: function () {
            this.$time12.find('.time12').inputmask('hh:mm t', { placeholder: '__:__ _m', alias: 'time12', hourFormat: '12' });

            this.$add.on('click', this.add);
            this.$remove.on('click', this.remove);
            this.$save.on('click', this.save);
        },

        add: function() {
            var source = $('.schedules'), clone = source.clone(true);

            clone.css('display', 'block');
            $('<form />').append(clone)[0].reset();

            clone.insertAfter("div.schedules:last");

            $(this).parent().parent().parent().parent().removeClass('schedules');
            $(this).parent().parent().parent().parent().find('a.remove').removeClass('hidden');
            $(this).hide();
        },

        remove: function() {
            $(this).parent().parent().parent().parent().parent().remove();
        },

        save: function() {
            if (App.validate()) return; 

            bootstrap_alert.close('#alert');

            swal({
                title: "",
                text: "Are you sure you want to update this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                
                var form = document.getElementById('form');
                var formData = new FormData(form);

                $.ajax({
                    url: App.baseUrl + "/update",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': App.csrfToken},
                    success: function(data) {
                        if (data.success == true) {
                            
                            swal({
                                title: "Success!",
                                text: "1 row successfully updated.",
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
