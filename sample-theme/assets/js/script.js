

sentenceGenerator('type-bg');

window.addEventListener('resize', function () {
  sentenceGenerator('type-bg');
  set_resize_timeline();
});

window.addEventListener('load', function () {
  scrollAnimOn();
  get_posts_info();
});

/**
 * 文字列を生成する
 */
function sentenceGenerator() {
  const output = document.getElementsByClassName('type-bg');
  if (output.length > 0) {
    const font_size = 16;
    const line_height = 20;
    const width = window.innerWidth;
    const height = window.innerHeight;
    var rand_str_list = [];

    // 列がheightを超えるまで繰り返す
    const height_count = height / line_height;
    // mask
    // while (rand_str_list.length * line_height <= height) {
    while (rand_str_list.length <= height_count) {
      const rows_per = rand_str_list.length / height_count;
      const text_width = width * rows_per;
      var rand_str = '';
      // 行の文字数が十分に増えるまで繰り返す
      while (rand_str.length * font_size <= text_width) {
        const big_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const small_chars = 'abcdefghijklmnopqrstuvwxyz';

        rand_str += big_chars.charAt(Math.floor(Math.random() * big_chars.length));

        const max_chars = Math.random() * (13 - 3) + 3;
        for (var i = 0; i < max_chars; i++) {
          rand_str += small_chars.charAt(Math.floor(Math.random() * small_chars.length));
        }
        rand_str += ' ';
      }
      rand_str_list.push(rand_str);


      const add_html = '<p style="width:' + text_width + 'px;">' + rand_str + `</p>`;
      output.item(0).innerHTML = add_html + output.item(0).innerHTML;
      output.item(1).innerHTML = output.item(1).innerHTML + add_html;
    }
  }
}

function sentenceGeneratorWithMask() {
  const output = document.getElementsByClassName('type-bg');
  if (output.length > 0) {
    var rand_str_list = [];
    const font_size = 16;
    const line_height = 20;
    const width = window.innerWidth;
    const height = window.innerHeight;

    while (rand_str_list.length * line_height <= height) {
      var rand_str = '';
      // 行の文字数が十分に増えるまで繰り返す
      while (rand_str.length * font_size <= width) {
        const big_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const small_chars = 'abcdefghijklmnopqrstuvwxyz';

        rand_str += big_chars.charAt(Math.floor(Math.random() * big_chars.length));

        const max_chars = Math.random() * (13 - 3) + 3;
        for (var i = 0; i < max_chars; i++) {
          rand_str += small_chars.charAt(Math.floor(Math.random() * small_chars.length));
        }
        rand_str += ' ';
      }
      rand_str_list.push(rand_str);
    }

    var add_html = ``;
    //結果を出力
    for (const str of rand_str_list) {
      add_html += '<p style="width:' + width + 'px;">' + str + `</p>`;
    }
    output.item(0).innerHTML = add_html;
    output.item(1).innerHTML = add_html;
  }
}

/**
 * menuの開閉
 */
function menuOpen() {
  const menu = document.getElementsByClassName('menu-list').item(0);

  if (menu.hasAttribute('disabled')) {
    menu.removeAttribute('disabled');
    menu.setAttribute('class', 'menu-list fadeDown');

  } else {
    menu.setAttribute('class', 'menu-list fadeUpOut');
    // アニメーション後に非表示にする
    menu.addEventListener('animationend', animEndEvent);
  }
}

/**
 * 非表示にして、イベントを削除するメソッド
 * animationendEventで使用する
 */
function animEndEvent() {
  const ctrl_item = document.getElementsByClassName('menu-list').item(0);
  ctrl_item.setAttribute('disabled', 'disabled');
  ctrl_item.removeEventListener('animationend', animEndEvent);
}

/**
 * aタグ以外にリンクイベントを付与
 * @param {string} url 
 */
function openLink(url) {
  window.location.href = url;
}

var container = document.getElementsByClassName('content-wrap').item(0);
/**
 * スクロールイベント
 */
function scrollAnimOn() {
  if (container != null) {
    var scroll = container.scrollTop;
    var windowHeight = window.innerHeight;

    var el_anim_dis = document.querySelectorAll('.scroll-render:not(.active)');
    el_anim_dis.forEach((item) => {
      var pos = item.offsetTop;
      if (scroll > pos - windowHeight) {
        item.classList.add("active");
      }
    });

  }
}
if (container != null) {
  container.addEventListener('scroll', function () {
    scrollAnimOn();
  });
  container.addEventListener('touchmove', function () {
    scrollAnimOn();
  });
}