$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})


// 关注和取消关注
$('.like-button').click(function (event) {

    var target = $(event.target);

    var current_like = target.attr('like-value');
    var user_id = target.attr('like-user');
    var unfan_url = "/user/unFan";
    var fan_url = "/user/fan";

    if (current_like == 1) {
        $.ajax({
            url: unfan_url,
            data:{
                user_id:user_id
            },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr('like-value', 0);
                target.text('关注');
            }
        })
    } else {
        $.ajax({
            url: fan_url,
            data:{
                user_id:user_id
            },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr('like-value', 1);
                target.text('取消关注');
            }
        })
    }

})


// 文本编辑器

var editor = new wangEditor('content');

editor.config.uploadImgUrl = "{{url('/posts/image/upload')}}";

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

editor.create();

