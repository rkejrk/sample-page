
var cate_list = new Array();
var post_navi_data = new Array();

function get_posts_info() {
    var posts_api = "http://localhost/wordpress/wp-json/wp/v2/my/get_posts";
    $.ajax({
        type: 'GET',
        url: posts_api,
        dataType: 'json',
        success: function (data) {
            post_navi_data = data;
            cate_ctrl();
            showTimeline(post_navi_data);
        }
    });
}

function set_resize_timeline() {
    if (post_navi_data != null) {
        showTimeline(post_navi_data);
    }
}

function cate_ctrl() {
    var cate_btns = document.getElementsByClassName('cate_btns').item(0).children;
    for (i = 0; i < cate_btns.length; i++) {
        if (i > 0) {

            var input = cate_btns.item(i).children.item(0);
            input.checked =true;
            cate_list[input.id] = true;
            input.addEventListener('change', (e) => {
                setFlag(e.target.id, e.target.checked);
                showTimeline(post_navi_data);
            });
        }
    }
}

function setFlag(id, value) {
    cate_list[id] = value;
}

function cateFilter() {
    return post_navi_data.filter((item) => {
        // どれか一つのカテゴリに当てはまったら表示
        var cate_data = item['category'];
        for (let i = 0; i < cate_data.length; i++) {
            var flag_key = 'cate-' + cate_data[i]['term_id'];
            if (cate_list[flag_key]) return true;
        }
        return false;
    });
}

function showTimeline(data) {
    var data = cateFilter(data);

    var time_line = document.getElementsByClassName('time-line').item(0);
    time_line.textContent = "";

    var height = time_line.offsetHeight;
    const date_height = 70;
    const dot_height = 25;
    // 表示可能件数
    var item_num = ((height - dot_height) / (date_height + dot_height));
    // どの倍数で表示するか
    var target_index = (data.length > item_num)? Math.floor(data.length / item_num): 1;


    var current_top = 0;
    for (var i = 0; data.length != 0 && i < item_num; i++) {
        var index = (i == 0) ? 0 : i * target_index;
        // 日付追加
        time_line.innerHTML += `<li><a href="${data[index].link}">${data[index].date}</a></li>`;


        // openedの高さを設定
        if (time_line.id == data[index].id) {
            time_line.innerHTML += `<li id="opened" style="top: ${current_top}px;"><a>${data[index].date}</a></li>`;
        }
        current_top += date_height;

        // 最後以外ドット追加
        if ((i + 1) < item_num) {
            time_line.innerHTML += '<li><div class="dot"></div></li>';
            time_line.innerHTML += '<li><div class="dot"></div></li>';
            time_line.innerHTML += '<li><div class="dot"></div></li>';
            current_top += dot_height;
        }
    }

}
