window.onload = function () {
    var hidLayer = document.querySelector('.hidden-layer');
    var openHidLayer = document.querySelector('.open-hidlayer');
    var closeIcon = document.querySelector('.close-icon');
    var treeLeafs = document.querySelectorAll('.tree__leaf');
    var treePluses = document.querySelectorAll('.tree__plus');
    var select = document.getElementById('select');

    closeIcon.onclick = function () {
        hidLayer.classList.add('hidden');
    };

    if (openHidLayer) {
        openHidLayer.onclick = function () {
            hidLayer.classList.remove('hidden');
        };
    }

    for (var i = 0; i < treeLeafs.length; i++) {
        treeLeafs[i].onclick = function (e) {
            this.firstChild.classList.toggle('hidden');
        };
    }

    for (var i = 0; i < treePluses.length; i++) {
        var parent = treePluses[i].parentNode;
        var ul = parent.nextSibling;
        ul.classList.add('hidden');

        treePluses[i].onclick = function (e) {
            e.stopPropagation();
            this.parentNode.nextSibling.classList.toggle('hidden');
        };

    }
    if (select) {
        select.addEventListener('change', function () {
            var xhr = new XMLHttpRequest();
            var value = this.value;
            var title = document.getElementById('title');
            var desc = document.getElementById('desc');
            var newParent = document.getElementById('new_parent');
            var opts = newParent.options;

            xhr.open('GET', 'ajax.php?select=' + value, true);
            xhr.responseType = 'json';
            xhr.send();
            xhr.onload = function () {
                if (xhr.status != 200) {
                    alert('Ошибка ' + xhr.status + ': ' + xhr.statusText + '. Подгрузить данные не получилось!');
                } else {
                    var resp = xhr.response;
                    console.dir(resp);
                    title.value = resp.data[0].title;
                    desc.value = resp.data[0].description;
                    for (var j = 0; j < opts.length; j++) {
                        if (opts[j].value == resp.data[0].parent_id) {
                            newParent.selectedIndex = j;
                            break;
                        }
                    }
                }
            };
        });
    }
};