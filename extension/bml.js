javascript: (
    () => {
        function set_input(v, s) {
            const inv = document.createElement('input');
            inv.type = 'hidden';
            inv.name = s;
            inv.value = v;
            form.appendChild(inv);
        }
        let url = location.href.split('?')[0];
        if (url.indexOf('www.amazon.co.jp') >= 0) {
            const p_title = document.querySelector('title');
            let title = document.getElementById('productTitle').innerHTML.replace(/\r?\n/g, '');
            let sub_title = document.getElementById('productSubtitle');
            let author = p_title.innerHTML.split('|')[1];
            let star = document.querySelector('.a-icon-star').innerHTML.split('星のうち')[1];
            const cls = document.querySelector('ul.a-unordered-list.a-nostyle.a-vertical.zg_hrsr');
            const url_sp = url.split('/');
            const element_iframe = document.querySelector('iframe#bookDesc_iframe');
            const outline = element_iframe.contentWindow.document.querySelector('div#iframeContent').innerHTML;

            let id;
            let asin;
            let isbn;
            let img;
            let c1;
            let c2;
            let c3;

            if (url.indexOf('gp') >= 0) {
                id = url_sp[5];
            } else if (url.indexOf('dp') >= 0) {
                id = url_sp[4];
                if (id == 'dp') {
                    id = url_sp[5];
                    url_sp.splice(3, 1);
                    url = url_sp.join('/')
                }
            }

            !author ? author = p_title.innerHTML.split(': ')[1]: author;
            star ? star = parseFloat(star) : star = null;

            if (p_title.innerHTML.indexOf('Kindle') >= 0){
                title += ' | ' + sub_title.innerHTML.replace(/\r?\n/g, '');
                asin = id;
                img = document.getElementById('ebooksImgBlkFront').getAttribute('src');
                c1 = p_title.innerHTML.split(' | ')[2];
                c11 = cls.querySelectorAll('a')[0];
                !c1 ? c1 = c11.innerHTML : c1;
                c2 = cls.querySelectorAll('a')[1];
                c2 ? c2 = c2.innerHTML : null;
                c3 = cls.querySelectorAll('a')[2];
                c3 ? c3 = c3.innerHTML : null;

                window.open('', 'new_window');

                form = document.createElement('form');
                // form.action = 'http://localhost:8888/phpf/insert.php';
                form.action = 'https://jskm.sakura.ne.jp/phpf/insert.php';
                form.method = 'post';
                form.style.display = 'none';
                form.target = 'new_window';
                form.id = 'temp_form';
                document.body.appendChild(form);

                set_input(url, 'url');
                set_input(title, 'title');
                set_input(author, 'author');
                set_input(star, 'star');
                set_input(img, 'img');
                set_input(asin, 'asin');
                set_input(c1, 'c1');
                set_input(c2, 'c2');
                set_input(c3, 'c3');
                set_input(outline, 'outline');

                form.submit();
            }else{
                title += ' | ' + sub_title.innerHTML.split('–')[0].replace(/\r?\n/g, '');
                isbn = id;
                img = document.getElementById('imgBlkFront').getAttribute('src');
                c1 = cls.querySelectorAll('a')[0];
                c1 ? c1 = c1.innerHTML : null;
                c2 = cls.querySelectorAll('a')[1];
                c2 ? c2 = c2.innerHTML : null;
                c3 = cls.querySelectorAll('a')[2];
                c3 ? c3 = c3.innerHTML : null;

                window.open('', 'new_window');

                form = document.createElement('form');
                // form.action = 'http://localhost:8888/phpf/insert.php';
                form.action = 'https://jskm.sakura.ne.jp/phpf/insert.php';
                form.method = 'post';
                form.style.display = 'none';
                form.target = 'new_window';
                form.id = 'temp_form';
                document.body.appendChild(form);

                set_input(url, 'url');
                set_input(title, 'title');
                set_input(author, 'author');
                set_input(star, 'star');
                set_input(img, 'img');
                set_input(isbn, 'asin');
                set_input(c1, 'c1');
                set_input(c2, 'c2');
                set_input(c3, 'c3');
                set_input(outline, 'outline');

                form.submit();
            }
        } 
    }
)();
