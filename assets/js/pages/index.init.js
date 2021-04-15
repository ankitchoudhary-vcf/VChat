$(document).ready(function() {
    $(".popup-img").magnificPopup({
        type: "image",
        closeOnContentClick: !0,
        mainClass: "mfp-img-mobile",
        image: {
            verticalFit: !0
        }
    }), $("#user-status-carousel").owlCarousel({
        items: 4,
        loop: !1,
        margin: 16,
        nav: !1,
        dots: !1
    }), $("#user-profile-hide").click(function() {
        $(".user-profile-sidebar").hide();
    }), $(".user-profile-show").click(function() {
        $(".user-profile-sidebar").show();
    }), $(".chat-broadcast").click(function() {
        $(".user-chat").show();
        $(".user-chat").addClass("user-chat-show");
        $(".user-private-chat").hide();
    }), $(".user-chat-remove").click(function() {
        $(".user-chat").removeClass("user-chat-show");
    }), $(".chat-user-list li a").click(function(){
        $(".user-private-chat").addClass("user-private-chat-show");
        $(".user-private-chat").show();
        $(".user-chat").hide();
    }), $(".user-private-chat-remove").click(function(){
        $(".user-private-chat").removeClass("user-private-chat-show");
        $(".user-private-chat").hide();
        $(".user-chat").show();
    });
});