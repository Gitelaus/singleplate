$('.icon-plus').on('click', function(){
    var clone = $('.sub-item.default').clone();
    clone.removeClass('default');
    clone.appendTo('.sub-items');
});

function toggleFieldType(){
    var element = $(this);
    var type = element.prop('tagName');
    element.replaceWith("<input value='" + element.text() + "' placeholder='Title'/>");
    var newElement = $('.sub-item input');
    newElement.focus();
    newElement.select();
    newElement.on('blur keyup', function(e){
        console.log(e);
        if(e.type == "keyup" && e.keyCode != 13){
            return;
        }
        newElement.replaceWith("<" + type + ">" + newElement.val() + "</" + type + ">");   
        $('.sub-item span').on('click',toggleFieldType);        
    });
}

// $('.sub-item span').on('click',toggleFieldType);

function inputBlur(element){
    var input = $(this);
    input.replaceWith("<span>" + input.val() + "</span>");
}
