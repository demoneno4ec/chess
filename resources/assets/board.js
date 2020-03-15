import $ from  'jquery';
import 'jquery-ui-dist/jquery-ui.min';
$(function(){
    setDraggable();
});

function setDraggable(){
    $('.figure').draggable();
}
