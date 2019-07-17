$(document).ready(function() {
    $('.delete-comment-link').click(function(event) {
        event.preventDefault();
        $(this).closest('form').submit();
    });
    $('.fa-comment, .fa-heart, .fa-bookmark').closest('button').click(function() {
        let el = $(this).find('.far, .fas');
        if($(el).hasClass("far")){
            $(el).removeClass("far");
            $(el).addClass("fas");

        } else {
            $(el).removeClass("fas");
            $(el).addClass("far");
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('[id^="delete-button-"]').click(function(event) {
        $('#modal-delete').modal();
        let form = $(this).parent().find('#delete-form');
        $('#modal-delete').find('.modal-footer').html(`
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            ${form.html()}
        `)
    });
    $("body").on("submit", "form", function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });
    $('[id^="comment-form-"]').submit(function(event) {
        event.preventDefault();
        let inputs = $(this).find(':input');
        values = {};
        $(inputs).each(function() {
            values[this.name] = $(this).val();
        });
        let id = values['id'];
        let url = `/posts/${id}/comment`;
        let data = $(this).serialize();
        $(inputs)
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false);
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(data){
                let $post = $(`#post-${id}`);
                $post.find('#comments').append(data);
                $post.find('.delete-comment-link').click(function(event) {
                    event.preventDefault();
                    $(this).closest('form').submit();
                });

            }

        });
    });
});