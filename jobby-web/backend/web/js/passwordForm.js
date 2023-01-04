$(document).ready(function() {
    if($(".cbPassword").is(":checked")){
        $(".password").show();
        $(".password_repeat").show();
    } else {
        $(".password").hide();
        $(".password_repeat").hide();
    }
});

$(".cbPassword").change(function() {
    if($(".cbPassword").is(":checked")){
        $(".password").show();
        $(".password_repeat").show();
    } else {
        $(".password").hide();
        $(".password_repeat").hide();
    }
});
