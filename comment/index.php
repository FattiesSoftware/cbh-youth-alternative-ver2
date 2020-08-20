<html>
<?php
require('require/githubconfig.php');
require('require/github.user.class.php');
require('require/logincheck.php');
require('include/header.php');
require('include/navbar.php');
require('include/style.php');
?>
<head>
<style>
.comment-form-container{
    width: 55%;
    padding: 10px;
    position: relative;
    margin: 0 auto;
    overflow: hidden;
}

.tunnaduong {
    width: 100%;
    padding: 10px;
    position: relative;
    margin: 0 auto;
}
.tunnaduong2 {
    width: 55%;
    padding: 10px;
    position: relative;
    margin: 0 auto;
}

.input-row {
    margin-bottom: 20px;
}

.input-field {
    width: 100%;
    border-radius: 2px;
    padding: 10px;
    border: #e0dfdf 1px solid;
}

.btn-submit {
    padding: 10px 20px;
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor:pointer;
}

ul {
    list-style-type: none;
}

.comment-row {
    border-bottom: #e0dfdf 1px solid;
    margin-bottom: 15px;
    padding: 15px;
}

.outer-comment {

    padding: 10px;

}

span.commet-row-label {
    font-style: italic;
}

span.posted-by {
    color: #09F;
}

.comment-info {
    font-size: 0.8em;
}
.comment-text {
    margin: 10px 0px;
}
.btn-reply {
    font-size: 0.8em;
    text-decoration: underline;
    color: #888787;
    cursor:pointer;
}
#comment-message {
    margin-left: 20px;
    color: #189a18;
    display: none;
}
#content {
    margin-top: 30px;margin-left: 100px;margin-right: 100px
}
#comment{
    margin-top:5px;  padding: 10px;border-radius: 7px;border:1px solid #d7d8fc;background-color: #fdfdfd;
}
#avatar{
    margin-bottom: 0px;float: left;   border-radius: 50%; margin-right: 15px
}
#tunganh{
    color:#07f;font-size:11px;display:none
}
#tunna{
    color: #e8e20a;display:none
}
#dot{
    display: inline;color: #6e7abe;font-size: 12px
}
#concac{
    float: right;color: gray;
}
#texxt{
    height:60px; min-height:60px;  max-height:60px;
}
</style>
<title>Comment System using PHP and Ajax</title>
<script src="jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="content">
    <div class="comment-form-container">
        <form id="frm-comment">
            <input type="hidden" name="comment_id" id="commentId"
                    placeholder="Name" /> <input class="input-field"
                    type="hidden" name="name" id="name" placeholder="Name" value="guest" />
    <label for="comment">Bình luận</label>
    <textarea class="form-control" id="comment" name="comment" placeholder="Bạn nghĩ gì về bài viết này?" rows="3"></textarea>
    <button type="button" id="submitButton" class="btn btn-primary" style="margin-top: 10px;float: right;">
    <i class="fas fa-paper-plane"></i> Gửi bình luận
    </button>
    <div id="comment-message">Bình luận đã được gửi đi!</div>

        </form>
    </div>
    <div id="output" class="tunnaduong2" style="padding-left: 0px;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;"></div>
    </div>
    <script>
            function postReply(commentId) {
                $('#commentId').val(commentId);
                $("#name").focus();
            }

            $("#submitButton").click(function () {
                   $("#comment-message").css('display', 'none');
                var str = $("#frm-comment").serialize();

                $.ajax({
                    url: "comment-add.php",
                    data: str,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                        if (response)
                        {
                            $("#comment-message").css('display', 'inline-block');
                            $("#name").val("");
                            $("#comment").val("");
                            $("#commentId").val("");
                           listComment();
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
            });
            
            $(document).ready(function () {
                   listComment();
            });

            function listComment() {
                $.post("comment-list.php",
                        function (data) {
                               var data = JSON.parse(data);
                            
                            var comments = "";
                            var replies = "";
                            var item = "";
                            var parent = -1;
                            var results = new Array();

                            var list = $("<ul class='outer-comment'>");
                            var item = $("<li>").html(comments);

                            for (var i = 0; (i < data.length); i++)
                            {
                                var commentId = data[i]['comment_id'];
                                parent = data[i]['parent_comment_id'];

                                if (parent == "0")
                                {
                                    comments = "<div class='tunnaduong id' id='comment' data-commentid=''>"+"<div id='upperpart'>"+"<a href='/profile.php?id='><img src='/images/ano.png' width='30' height='30' id='avatar'></a><a href='/profile.php?id='><b>"+ data[i]['comment_sender_name']+"</b></a> <i id='tunganh'  data-toggle='tooltip' title='Tài khoản đã xác minh' class='fas fa-check-circle'></i> <p data-toggle='tooltip' id='tunna' title='Quản trị viên đã xác minh'><i class='fas fa-crown'></i> Quản trị viên</p></div>"+"<div id='comment_noidung'><p>"+ data[i]['comment']+"</p></div>"+"<div id='bottompart'>"+"<a href='?action=like&id=' data-id='' id='likebutton' ><i class='far fa-heart' id='like-btn' class='like-btn'></i> Thích (<span class='likes'>"+"0"+"</span>)</a> <p id='dot'> 󠀠 •󠀠  </p> 󠀠 <a role='button' onclick='replycommentfunc()' id='replytocomment'><i class='far fa-comment-dots'></i> Trả lời</a><a role='button' onclick='hidereplycommentfunc()' id='replytocomment2' style='display:none;'><i class='far fa-comment-dots'></i> Trả lời</a><p id='concac'>"+ data[i]['date'] +"</p><p id='dot'> 󠀠 • 󠀠 </p><a href='#'><i class='far fa-flag'></i> Báo xấu</a></div>"+"<div id='replycommentpart' style='display:none'>"+"<form method='POST'><textarea class='form-control' id='texxt' name='reply_comment' placeholder='Đang trả lời bình luận' rows='2'></textarea><input type='text' name='replying-to-comment-id' value='' style='display:none'></input><button type='submit' name='submit2' id='sendcomment' class='btn btn-primary' style='margin-top: 10px;'><i class='fas fa-paper-plane'></i> Gửi bình luận</button></form></div></div>";

                                    var item = $("<li>").html(comments);
                                    list.append(item);
                                    var reply_list = $('<ul>');
                                    item.append(reply_list);
                                    listReplies(commentId, data, reply_list);
                                }
                            }
                            $("#output").html(list);
                        });
            }

            function listReplies(commentId, data, list) {
                for (var i = 0; (i < data.length); i++)
                {
                    if (commentId == data[i].parent_comment_id)
                    {
                        var comments = "<div class='tunnaduong id' id='comment' data-commentid=''>"+"<div id='upperpart'>"+"<a href='/profile.php?id='><img src='/images/ano.png' width='30' height='30' id='avatar'></a><a href='/profile.php?id='><b>"+ data[i]['comment_sender_name']+"</b></a> <i id='tunganh'  data-toggle='tooltip' title='Tài khoản đã xác minh' class='fas fa-check-circle'></i> <p data-toggle='tooltip' id='tunna' title='Quản trị viên đã xác minh'><i class='fas fa-crown'></i> Quản trị viên</p></div>"+"<div id='comment_noidung'><p>"+ data[i]['comment']+"</p></div>"+"<div id='bottompart'>"+"<a href='?action=like&id=' data-id='' id='likebutton' ><i class='far fa-heart' id='like-btn' class='like-btn'></i> Thích (<span class='likes'>"+"0"+"</span>)</a> <p id='dot'> 󠀠 •󠀠  </p> 󠀠 <a role='button' onclick='replycommentfunc()' id='replytocomment'><i class='far fa-comment-dots'></i> Trả lời</a><a role='button' onclick='hidereplycommentfunc()' id='replytocomment2' style='display:none;'><i class='far fa-comment-dots'></i> Trả lời</a><p id='concac'>"+ data[i]['date'] +"</p><p id='dot'> 󠀠 • 󠀠 </p><a href='#'><i class='far fa-flag'></i> Báo xấu</a></div>"+"<div id='replycommentpart' style='display:none'>"+"<form method='POST'><textarea class='form-control' id='texxt' name='reply_comment' placeholder='Đang trả lời bình luận' rows='2'></textarea><input type='text' name='replying-to-comment-id' value='' style='display:none'></input><button type='submit' name='submit2' id='sendcomment' class='btn btn-primary' style='margin-top: 10px;'><i class='fas fa-paper-plane'></i> Gửi bình luận</button></form></div></div>";
                        var item = $("<li>").html(comments);
                        var reply_list = $('<ul>');
                        list.append(item);
                        item.append(reply_list);
                        listReplies(data[i].comment_id, data, reply_list);
                    }
                }
            }
        </script>
</body>

</html>