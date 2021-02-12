$(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 200;

    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true
    });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/lessons',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            this.$save = $('#save');
            this.$reject = $('#reject');
            this.$cancel = $('#cancel');

            this.$is_staff = $('#is_staff').val();

            this.$addLink = $('#addLink');
            this.$removeLink = $('.removeLink');
            this.$clearLink = $('.clearLink');

            this.$addAttach = $('#addAttach');
            this.$removeAttach = $('.removeAttach');
            this.$clearAttach = $('.clearAttach');

            this.$courses = $('#course');
        },

        bindEvents: function () {
            this.$save.on('click', this.save);
            this.$reject.on('click', this.reject);
            this.$cancel.on('click', this.cancel);

            // links
            this.$addLink.on('click', this.addLink);
            this.$clearLink.on('click', function() {
                $(this).closest('div.links').find("input[type=text], textarea, input[type=file]").val("");
            });
            this.$removeLink.on('click', function() {
                var parent = $(this).parent().parent().parent().parent().parent().remove();
            });

            //attachment
            this.$addAttach.on('click', this.addAttach);
            this.$clearAttach.on('click', function() {
                $(this).closest('div.attachs').find("input[type=text], textarea, input[type=file]").val("");
            });
            this.$removeAttach.on('click', function() {
                var parent = $(this).parent().parent().parent().parent().parent().remove();
            });

            this.$courses.on('change', this.getClasses);
        },

        /**
         * Submit form to save the user
         * validate first the form
         */
        save : function() {

            if (App.validate()) return;

            bootstrap_alert.close('#alert');

            swal({
                title: "",
                text: "Are you sure you want to save this record?",
                type: "warning",
                confirmButtonText: "Yes",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {

                var form = document.getElementById('new');
                var formData = new FormData(form);

                $.ajax({
                    url: App.baseUrl + "/store",
                    type: 'POST',
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function (data) {

                        if (data.success == true) {
                            swal({
                                title: "Success!",
                                text: "Successfully created new lesson.",
                                type: "success"
                            }, function () {
                                window.location.href = App.baseUrl + "/new";
                            });
                        } else {
                            alert(data.success);
                        }

                    },
                    error : function(request, status, error) {
                        alert(error);
                    },
                    contentType: false,
                    processData: false,
                    cache: false
                });


            });
        },

        /**
         * Add additional div for links
         */
        addLink: function () {

            var source = $('.link'),
               clone = source.clone(true),
               count = clone.length;

            clone.removeClass('link');
            clone.css('display', 'block');
            $('<form />').append(clone)[0].reset();

            clone.insertAfter("div.newLink:last");
        },

        /**
         * Add additional div for attachments
         */
        addAttach: function () {

            var source = $('.attach'),
               clone = source.clone(true),
               count = clone.length;

            clone.removeClass('attach');
            clone.css('display', 'block');
            $('<form />').append(clone)[0].reset();

            clone.insertAfter("div.newAttach:last");
        },

        getClasses : function() {

            var course_id = $('#course').find(":selected").val();

            if (course_id == 'Choose...') {
                $('#classes').find('option').remove();
                $('#classes').attr('disabled', true);

                return false;
            }

            $.ajax({
                url: App.baseUrl + "/getClasses",
                type: 'POST',
                data: {
                    course_id : course_id
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                success: function (data) {

                    if (data != '') {
                        $('#classes').find('option').remove();
                        $('#classes').attr('disabled', false);

                        $("#classes").append('<option value="">Choose...</option>')
                        $.each(data, function(key, value){
                            $("#classes").append('<option value="'+ value.class_id +'">'+ value.name +'</option>')
                        });
                    } else {
                        alert(data.success);
                    }

                },
                error : function(request, status, error) {
                    alert(error);
                },
            });
        },

        community : function() {

            var dt = {};

            $('div.checkbox-group :checkbox:checked').each(function(){

                if ($(this).is(":checked")) {
                    var name = $(this).attr('name');

                    dt[name] = 1;
                }
            });

            return dt;
        },

        roles : function() {

            var dt = [];

            $('div.checkbox-group2 :checkbox:checked').each(function(){

                if ($(this).is(":checked")) {
                    dt.push({
                        "role" : $(this).attr('name')
                    });
                }
            });

            return dt;
        },

        validate : function() {
            if (!$('#new').parsley().validate() ) {

                bootstrap_alert.warning('#alert', ' There are some error/s, please correct them bellow.');

                $('html, body').animate({
                    scrollTop: ($('#alert').offset().top - 300)
                },500);

                return true;

            }
        },

        cancel : function() {
            if (App.$is_staff == 1) {
                window.location.href = App.baseUrl + 'staffs';
            } else {
                window.location.href = App.baseUrl + 'users';
            }

        }
    }

    App.init();

})
