$(document).ready(function () {

    $("a.switcher").bind("click", function (e) {
        e.preventDefault();

        var theid = $(this).attr("id");
        var theproducts = $("ul#property-list");
        var thefigure = $("ul#property-list figure");
        var theinfo = $("ul#property-list div");
        var classNames = $(this).attr('class').split(' ');

        if ($(this).hasClass("active")) {
            // if currently clicked button has the active class
            // then we do nothing!
            return false;
        } else {
            // otherwise we are clicking on the inactive button
            // and in the process of switching views!

            if (theid === "gridview") {
                $(this).addClass("active");
                $("#listview").removeClass("active");

                // remove the list class and change to grid
                theproducts.removeClass("list");
                theproducts.addClass("grid");
                //remove classes of inner layout
                thefigure.removeClass("columns alpha");
                theinfo.removeClass("columns omega");
            }

            else if (theid === "listview") {
                $(this).addClass("active");
                $("#gridview").removeClass("active");

                // remove the grid view and change to list
                theproducts.removeClass("grid");
                theproducts.addClass("list");
                // restore classes of inner layouts
                thefigure.addClass("columns alpha");
                theinfo.addClass("columns omega");
            }
        }
    });
});