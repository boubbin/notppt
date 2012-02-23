/**
 * This just makes them draggable
 * and configures the area and stuff
*/

$(document).ready(function() {
    $(".draggable-item").each(function() {
        $(this).draggable({
            cursor         : 'move',
            containment    : '#slide_content',
            stack          : "#slide_content div",
            snap           : true,
            snapTolerance  : 3,
            start: function() {
                // this function body is excuted when
                // dragging starts
            },
            drag: function() {
                // this function body is executed while
                // dragging
                // $("#content").html(myescape($("#slides").html()));
            },
            stop: function() {
                // this function body is executed when
                // dragging stops
                // $("#content").html(myescape($("#slides").html()));
            }
        });
    });
});
$(document).ready(function() {
	$(".slide").click( function() {
		$.get("/goulu/notppt/web/bundles/goulunotpowerpoint/css/newslideshow.css", function (data) {
				$("#slide_content").html(data)
		});
	});
});