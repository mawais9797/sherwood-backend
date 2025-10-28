$(document).on("submit", '#saveForm', function (e) {
    e.preventDefault();
    let button = $(this).find("button");
    let icon = button.find("i");
    icon.removeClass("hidden");
    button.attr("disabled", true);
    document.getElementById("saveForm").submit();
})
$(document).ready(function () {
    // Listen for change event on file input
    $('.uploadFile').change(function () {
        let image_tag = $(this).parent().find('.file_choose_icon').find("img");
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                image_tag.attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
$(function () {
    $(".basic-datatable").DataTable({
        responsive: true,
    });
});
var editorOptions = {
    theme: 'snow' // Choose the theme for the editor (snow or bubble)
};

// Initialize Quill on textareas with class 'editor'
var editors = document.querySelectorAll('.editor');
editors.forEach(function (editorEl) {
    ClassicEditor
        .create(editorEl, {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'blockQuote',
                    '|',
                    'insertTable'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            }
        })
        .catch(error => {
            console.error(error);
        });
});
$(function () {
 
    $(".rateYo").rateYo({
   
      onChange: function (rating, rateYoInstance) {
   
        $(this).next().val(rating);
      }
    });
  });
  $('.rateYo-show').rateYo({
    rating: 5.0,
    fullStar: true,
    readOnly: true,
    normalFill: '#ddd',
    ratedFill: '#f6a623',
    starWidth: '14px',
    spacing: '2px'
});
$(document).on("click",'#sidebarnav > li > a.has-arrow',function(e){
    e.preventDefault();
    let current=$(this);
    current.toggleClass("active")
    current.next().toggleClass('in')
})