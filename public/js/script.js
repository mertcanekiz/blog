$(document).ready(function() {
    $('.delete-comment-link').click(function(event) {
        event.preventDefault();
        $(this).closest('form').submit();
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
    $('[id^="likebutton"]').click(function(event) {
        let id = $(this).attr('id').replace('likebutton-', '');
        let url = `/posts/${id}/like`;
        $.ajax({
            type:'POST',
            url:url,
            success:function(data){
                let $post = $(`#post-${id}`);
                let button = $post.find('i.fa-heart');
                if (data.liked) {
                    $(button).removeClass("far");
                    $(button).addClass("fas");
                } else {
                    $(button).removeClass("fas");
                    $(button).addClass("far");
                }
            }
        });
    });
});