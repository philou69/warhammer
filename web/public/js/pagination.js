function paginationOnClick() {
    $(".page").each(function(){
        $(this).click(function(e) {
            $('#contenu').load($(this).attr("href"), [], paginationOnClick );
            console.log($(this).attr("href"));
            e.preventDefault();
        })
    });
}



paginationOnClick();