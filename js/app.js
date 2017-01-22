// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(function(){
  hljs.initHighlightingOnLoad();

  toggleHeaderImage();
  updateLivePreview();

  $("#layout").change(function() {
    toggleHeaderImage();
  });

  $('#content').keyup(function () {
    updateLivePreview();
  });

  $('a.deleteLink').click(function(){
    deleteModelLink(this);
  });

  enableTabs();
})

var deleteModelLink = function(link){
  var button = $('#deleteButton');
  $(button).attr('href', link.href);
};

var enableTabs = function(){
  $(document).delegate('#content', 'keydown', function(e) {
    var keyCode = e.keyCode || e.which;

    if (keyCode == 9) {
      e.preventDefault();
      var start = $(this).get(0).selectionStart;
      var end = $(this).get(0).selectionEnd;

      // set textarea value to: text before caret + tab + text after caret
      $(this).val($(this).val().substring(0, start)
                  + "\t"
                  + $(this).val().substring(end));

      // put caret at right position again
      $(this).get(0).selectionStart =
      $(this).get(0).selectionEnd = start + 1;
    }
  });
};

var updateLivePreview = function(){
  var markdowntext = markdown.toHTML($("#content").val());
  var data = $('<textarea />').html(markdowntext).text();
  $('#preview').html(data);
};

var toggleHeaderImage = function(){
  if($('#layout').val() != "post"){
    $("#image").attr("disabled", "disabled");
  }else{
    $("#image").removeAttr("disabled");
  }
};
