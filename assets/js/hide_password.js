jQuery(function ($) {
    $(document).ready(function () {
        const hiddenPasswordLength = 10;
        const rows = []
        $(".credential_box:not(.credential_head)").each(function () {
            rows.push({
                password: $(this).children().children(".credential_password_data").children(".credential_password").html(),
                item: $(this).children().children(".credential_password_data").children(".credential_password"),
                button: $(this).children().children(".credential_button")
            })
        })
        rows.forEach(item => {
            item.item.html("*".repeat(hiddenPasswordLength));
            $(item.button).on("click", function(){
                if($(this).data("show") == "hide"){
                    item.item.html(item.password);
                    $(this).data("show", "show")
                }else if($(this).data("show") == "show"){
                    item.item.html("*".repeat( hiddenPasswordLength ));
                    $(this).data("show", "hide")
                }})
        })
    })
})