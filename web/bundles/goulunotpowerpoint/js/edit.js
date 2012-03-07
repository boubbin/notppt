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
        // setActiveSlide($(this).attr(".slide_1"));
});
function saveSlideShow() {
    var id          = $("#slideshowId").val();
    var name        = $("#slideshow_name").val();
    var slides      = new Array();
    var slide_array;
    $(".slide_wrapper").each(function(num, element) {
        slide_array = {
            id       : 'null',
            ord      : num,
            duration : Math.random()*9,
            showable : 1,
            content : $(element).html()
        };

        slides[num] = slide_array;
    });
    $.post("/notppt/web/app_dev.php/ajax/slideshow/save", {
        id     : id,
        name   : name,
        slides : slides
    }, function(data) {
        // tell everyone save went ok and stuff
    });
}

function getNewTextElement() {
    var as = getActiveSlide();
    return $('<span class="'+as+' element_text new_element draggable">Text element</span>');
}
function getActiveSlide() {
    if ($(".slide").length == 0) {return -1;}
    return $("#currentlyActiveSlide").html();
};
function setActiveSlide(id) {
    var as = getActiveSlide();
    if (as == id) {return;}
    if (as != "") {$("."+as).toggle();}
    if (id != "") {$("."+id).toggle();}
    $("#currentlyActiveSlide").html(id);
    $(".slide").removeClass("active_slide");
    $("#"+id).addClass("active_slide");
};
function clearContent() {
    // $("#slide_content").empty();
}
function getContentId() {
    var as = getActiveSlide();
    return "#"+as+"_wrapper";
}
function addNewElementToContent(new_element) {
    var content = getContentId();
    console.log("Will append to "+content);
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
    // $(element).editable();
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
            $(this).addClass("element_dragging");
            //addActiveElementDecorationToElement(element);
        },
        drag: function() {
            
        },
        stop: function() {
            $(this).removeClass("element_dragging");

        }
    });
}
function addNewSlide() {
    var slide_num                   = getNumberForNewSlide();
    var new_slide_election_element  = $('<div class="slide" id="slide_'+slide_num+'">Slide '+slide_num+'<img class="remove_slide" src="/notppt/web/bundles/goulunotpowerpoint/img/icon/notification_remove.png"/></div>');
    var new_slide_wrapper_element   = $('<div class="slide_wrapper" id="slide_'+slide_num+'_wrapper"></div>');
    $(".slide_selection").append(new_slide_election_element);
    $("#slide_content").append(new_slide_wrapper_element);
    setActiveSlide('slide_'+slide_num);
}
function getNumberForNewSlide() {
    return getNumberOfSlides()+1;
}
function getNumberOfSlides() {
    return $(".slide").length;
}