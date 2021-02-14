$(function () {
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true
    });

    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/academic/quizzes',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();
        },

        setElements: function () {
            CKEDITOR.replace('ckeditor');
            CKEDITOR.config.height = 300;

            this.$save = $('#save');
            this.$reject = $('#reject');
            this.$cancel = $('#cancel');

            this.$courses = $('#course');
        },

        bindEvents: function () {
            CKEDITOR.on('instanceReady', function () {
                $('form textarea').attr('required', '');
                $.each(CKEDITOR.instances, function (instance) {
                    CKEDITOR.instances[instance].on("change", function (e) {
                        for (instance in CKEDITOR.instances) {
                            CKEDITOR.instances[instance].updateElement();
                        }
                    });
                });
            });

            this.$save.on('click', this.save);
            this.$reject.on('click', this.reject);
            this.$cancel.on('click', this.cancel);

            this.$courses.on('change', this.getClasses);
        },

        cancel : function() {

        }
    }

    App.init();

})
