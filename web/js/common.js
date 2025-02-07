$(document).ready(function() {

    /**
     * сортирует изображения
     * */
    $('.image-preview-container-o').sortable({
        stop(ev, ui) {
            let sort = [];
            $('.image-preview-container-o .image-preview-o').each(function(index, element){
                sort.push($(element).attr('data-id'));
            });
            $.ajax({
                url: '/images/save-sort',
                method: 'post',
                data: {ids: JSON.stringify(sort)},
                success(response) {
                    if(response.result) {
                        displaySuccessMessage(response.message)
                    }
                },
                error(e) {
                    console.log('error', e)
                }
            });
        }
    });


    $(document).on('click', '.copy__str', function(e) {
        e.preventDefault();
        functions.copyText($(this))
    });

    $(document).on('click', '.btn-show-submenu', function(e) {
        e.preventDefault();
        console.log('Клик')
        let parent = $(this).closest('.row');
        if(parent.find('.col-md-3.column-submenu').hasClass('hide')) {
            console.log('hide')
            parent.find('.column-submenu.col-md-3').removeClass('hide');
            parent.find('.column-submenu.col-md-12').addClass('col-md-9').removeClass('col-md-12');
            $(this).text('Скрыть панель');
        }
        else {
            console.log('visible')
            parent.find('.column-submenu.col-md-3').addClass('hide');
            parent.find('.column-submenu.col-md-9').addClass('col-md-12').removeClass('col-md-9');
            $(this).text('Показать панель');
        }
    });

    // циклится сука

        let location = window.location;
        console.log('location', location)
        if(location.search.length) {
            let split = location.search.split('=');
            console.log('location', location)
            if(split[0] == '?folder' && split[1].length) {
                console.log('split', split[1])
                let tab = $('.column-submenu a[data-folder-id="' + split[1] + '"]');
                console.log('нашел таб', tab)
                if(tab.length) {
                    console.log('таб есть', tab)
                    window.location = '/?AccessSearch[folder_id]=' + split[1]
                }
            }
        }

    let itemsTree = $('#menu-items-tree');
    if (itemsTree.length) {
        itemsTree.jstree({
            'core': {
                'data': {
                    'url': '/ajax/get-tree-children',
                    'data': function (node) {

                    },
                },
                'dblclick_toggle': false,
                'check_callback': true,
            },
            'plugins': ['wholerow', 'dnd', 'actions'],
        }).on('move_node.jstree', function (e, data) {
            onMoveMenuItem();
            // console.log(data);
            console.log();
            // pagesTree.jstree(true).toggle_node(data.node);
        });

        itemsTree.jstree(true).add_action('all', {
            'id': 'action-remove',
            'class': 'bi bi-trash float-end',
            'callback': function(node_id, node, action_id, action_el) {
                if (confirm('Вы уверены?')) {
                    removeMenuItem(node.id);
                }
            }
        });
        itemsTree.jstree(true).add_action('all', {
            'id': 'action-edit',
            'class': 'bi bi-pencil float-end',
            'callback': function(node_id, node, action_id, action_el) {
                location.href = '/folder/update?id=' + node.id;
            }
        });
    }

    $(document).on('change', '.change-status-o', function(e) {
        e.preventDefault();
        let self = $(this);
        let taskId = self.attr('data-id');
        let statusId = self.val();
        $.ajax({
            url: '/ajax/change-task-status',
            type: 'POST',
            data: {task_id: taskId, status_id: statusId},
            success: function (res) {
                console.log('request res', res);
                if(res.error == 0) {
                    window.location.reload()
                }
            },
            error: function (e) {
                console.log('Error!', e);
            }
        });
    });

    /**
     *
     * @param id
     */
    function removeMenuItem(id) {
        $.post(`/ajax/remove-menu-item?id=${id}`, function(res) {
            itemsTree.jstree('refresh');
        });
    }

    /**
     *
     */
    function onMoveMenuItem() {
        let data = [];
        let items = itemsTree.jstree(true).get_json('#', {flat:true});
        for (let key in items) {
            let item = items[key];
            data.push({
                'id': item.id,
                'position': key,
                'parent_id': item.parent === '#' ? 0 : item.parent,
            });
        }
        console.log(data);
        $.post('/ajax/move-items', {data: data}, function(res) {
            console.log(res);
        });
    }
})
