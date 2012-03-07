/**
 * This just makes them draggable
 * and configures the area and stuff
*/

$(document).ready(function() {
	$(".slide").live("click", function() {
            clearContent();
            setActiveSlide($(this).attr("id"));
            // show slide content
	});
        $("#buttonmenu .button").click(function() {
            removeNewElementDecorationFromNewElement();
            var clicked_button = $(this).attr("id");
            if (clicked_button == "element_text") {
                var new_element = getNewTextElement();
                addNewElementToContent(new_element);
                makeElementEditable(new_element);
                makeNewElementDraggable();
            } else if (clicked_button == "element_rectangular") {
                // add rect shape
            } else if (clicked_button == "element_image") {
                // add image
            } else if (clicked_button == "element_other") {
                // add somethig other
            } else if (clicked_button == "save") {
                saveSlideShow();
            } else if (clicked_button == "add_slide") {
                addNewSlide();
            }
        }); 
        setActiveSlide($(this).attr(".slide_1"));
});


function getNewTextElement() {
    var as = getActiveSlide();
    return $('<span class="'+as+' element_text new_element draggable">Text element</span>');
}

function getActiveSlide() {
    return $("#currentlyActiveSlide").html();
};
function setActiveSlide(id) {
    $("#currentlyActiveSlide").html(id);
    $(".slide").removeClass("active_slide");
    $("#"+id).addClass("active_slide");
};
function clearContent() {
    $("#slide_content").empty();
}
function getContentId() {
    return "#slide_content";
}
function addNewElementToContent(new_element) {
    var content = getContentId();
    $(content).append(new_element); 
    $(".new_element").highlightFade({speed:2000,iterator:'exponential'});
}
function removeNewElementDecorationFromNewElement() {
    $(".new_element").removeClass("new_element");
}

function makeAllDraggable() {
    makeClassDraggable(".draggable");
}
function makeElementEditable(element) {
    $(element).editable();
}
function makeNewElementDraggable() {
    makeClassDraggable(".draggable");   
}
function makeClassDraggable(element_class) {
    $(element_class).draggable({
        cursor         : 'move',
        containment    : '#slide_content',
        stack          : "#slide_content div",
        snap           : true,
        snapTolerance  : 3,
        start: function() {
            removeNewElementDecorationFromNewElement();
        },
        drag: function() {
            
        },
        stop: function() {

        }
    });
}
function saveSlideShow() {
    var id      = null;
    var content = $("#slide_content").html();
    var slides  = new Array(content, content, content, content, content, content);
    $.post("/notppt/web/app_dev.php/ajax/slideshow/save", {
        id     : id,
        name   : "Slideshown nimi",
        slides: slides
    }, function(data) {
        $("#slide_content").append(data);
    });
}
function addNewSlide() {
    var slide_num = getNumberForNewSlide();
    var element   = $('<div class="slide" id="slide_'+slide_num+'">Slide '+slide_num+'<img class="remove_slide" src="/notppt/web/bundles/goulunotpowerpoint/img/icon/notification_remove.png"/></div>');
    $(".slide_selection").append(element);
}
function getNumberForNewSlide() {
    return getNumberOfSlides()+1;
}
function getNumberOfSlides() {
    return $(".slide").length;
}