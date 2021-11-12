document.getElementById('scr').addEventListener('click',function(){
    chrome.tabs.executeScript({
        file: 'bml.js'
    });
});

document.getElementById('link').addEventListener('click', function () {
    chrome.tabs.executeScript({
        // code: "window.open('http://localhost:8888/phpf/login.php', 'new_tab')"
        code: "window.open('http://jskm.sakura.ne.jp/phpf/login.php', 'new_tab')"
    });
});