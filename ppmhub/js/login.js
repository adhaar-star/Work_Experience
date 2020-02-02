var Login = function() { 

    return {
        //main function to initiate the module
        init: function() {
            // init background slide images
            $('.login-bg').backstretch([
                "/vendors/common/img/temp/login/4.jpg",
                "/images/media.jpg",
                "/images/mac.jpg"
                ], {
                  fade: 1000,
                  duration: 8000
                }
            );
        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});