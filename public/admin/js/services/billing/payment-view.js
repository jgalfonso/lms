$(function () {
    var App = {
        baseUrl : window.location.protocol + '//' + window.location.host + '/admin/services/billing/payments/',
        csrfToken : $('meta[name="csrf-token"]').attr('content'),

        init: function () {
            this.setElements();
            this.bindEvents();

            //$("#actions a.disabled").removeAttr('onclick').removeAttr('href');  
        },

        setElements: function () {
            this.$print = $('#print'); 
        },
      
        bindEvents: function () {
            this.$print.printPage({
                url: App.baseUrl + "forms/" + $('#paymentID').val(),
                attr: "href",
                message:"Your document is being created..."
            });
        },
    }

    App.init();
}); 

