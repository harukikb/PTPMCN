$(function() {
    get_list_categorys();
    $('#form_add_cate').on('submit', function(e) {
        e.preventDefault();
        submit_add_category($('#form_add_cate').serializeArray());
        $('#form_add_cate')[0].reset();
    });
    
});
function submit_add_category(data) {
    var respon=$("#noti_respon");
    respon.html("");
    var url = "../tour/submit_add_category";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#cate_tour_table').DataTable().destroy();
            get_list_categorys();
            $('.modal').modal("hide");
            respon.html('<div class="callout callout-info" ><h4>Success!</h4>'+json_data.status_value+'</div>');
        }else{
            respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
        }
    };
    $.post(url, data, success);
}
function get_list_categorys() {
    var url = "../tour/get_list_cate_tour";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        show_list_categorys(json_data);
        $('.modal').modal("hide");
    };
    $.get(url, success);
}
// ' + category_edit_button(data[i]) + '<br />' + category_del_button(data[i]) + '
function show_list_categorys(data) {
    var list = $('#list_categorys');
    list.empty();
    for (var i = 0; i < data.length; i++) {
        var tr = $('<tr class="" id="category-' + data[i].cate_id + '"></tr>');
        tr.append('<td class="">' + data[i].cate_id + '</td>');
        tr.append('<td class="">' + data[i].cate_name + '</td>');
        tr.append('<td class="">' + data[i].cate_slug + '</td>');
        tr.append('<td class="">' + category_edit_button(data[i]) + '<br />' + category_del_button(data[i]) + '</td>');
        list.append(tr);
    }
    $('#cate_tour_table').DataTable( {
        "language": {
            "lengthMenu": "Hiển thị _MENU_",
            "zeroRecords": "Không tìm thấy",
            "info": "Hiển thị trang _PAGE_/_PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "emptyTable": "Không có dữ liệu",
            "infoFiltered": "(tìm kiếm trong tất cả _MAX_ mục)",
            "sSearch": "Tìm kiếm",
            "paginate": {
                "first":      "Đầu",
                "last":       "Cuối",
                "next":       "Sau",
                "previous":   "Trước"
            },
        },
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 3 ] }, //hide sort icon on header of column 0, 5
        ],
        'aaSorting': [[0, 'desc']]
    } );
    $("form").on('submit', function(event) {
        event.preventDefault();
    });

}
function category_edit_button(data)
{
    return btn = '<a data-toggle="modal" data-target="#modal_edit_'+data.cate_id+'"><i class="fa fa-fw fa-edit"></i></a>'+
    '<div class="modal fade"  id="modal_edit_'+data.cate_id+'" role="dialog">'+
          '<div class="modal-dialog">'+
            '<div class="modal-content">'+
              '<div class="modal-header">'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                  '<span aria-hidden="true">&times;</span></button>'+
                '<h4 class="modal-title">Sửa danh mục tour</h4>'+
              '</div>'+
              '<div class="modal-body">'+
                '<div id="noti_respon_'+data.cate_id+'"></div>'+
                '<form role="form" id="form-edit-category-'+data.cate_id+'">'+
                    '<div class="form-group" style="width:100%">'+
                        '<input type="hidden" style="width: 100%;" class="form-control" id="cate_id" name="cate_id" value="'+data.cate_id+'">'+
                        '<label>Tên Category</label>'+
                        '<input type="text" style="width: 100%;" class="form-control" id="cate_name" name="cate_name" value="'+data.cate_name+'">'+
                    '</div>'+
                    '<div class="form-group" style="width:100%">'+
                        '<label>Category Slug</label>'+
                        '<input type="text" style="width: 100%;" class="form-control" id="cate_slug" name="cate_slug" value="'+data.cate_slug+'">'+
                    '</div>'+
                '</form>'+
              '</div>'+
              '<div class="modal-footer">'+
                '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>'+
                '<button type="submit" class="btn btn-primary" id="submit_edit_cate_tour" name="submit_add_cate_tour" onclick="submit_edit_category(' + data.cate_id + ')">Save changes</button>'+
              '</div>'+
            '</div>'+
          '</div>'+
        '</div>';
        
}

function category_del_button(data)
{
    return btn = '<a class="btn_del" onclick="submit_del_category(' + data.cate_id + ')"><i class="fa fa-fw fa-remove"></i></a>';
}
function submit_del_category(cateid) {
    var respon=$("#noti_respon");
    respon.html("");
    if(confirm("Bạn thực sự muốn xóa danh mục tour này?")){
        var data = {
            cate_id:cateid,
        };
        var url = "../tour/check_del_category";
        var success = function(result) {
            var json_data = $.parseJSON(result);
            if (json_data.status) {
                $('#cate_tour_table').DataTable().destroy();
                get_list_categorys();
                respon.html('<div class="callout callout-info" ><h4>Success!</h4>'+json_data.status_value+'</div>');
            }else
            respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
        };
        $.post(url, data, success);
    }  
}
function submit_edit_category(data) {
    var respon=$("#noti_respon_"+ data);
    respon.html("");
    form = $('#form-edit-category-' + data);
    data = $('#form-edit-category-' + data).serializeArray();
    var url = "../tour/check_edit_category";
    var success = function(result) {
        var json_data = $.parseJSON(result);
        if (json_data.status) {
            $('#cate_tour_table').DataTable().destroy();
            get_list_categorys();
            form[0].reset();
            $('.modal').modal("hide");
            respon.html('<div class="callout callout-info" ><h4>Success!</h4>'+json_data.status_value+'</div>');
        }else
        respon.html('<div class="callout callout-info" style="background-color: #ef0000 !important;"><h4>Failed!</h4>'+json_data.status_value+'</div>');
    
    };
    $.post(url, data, success);
}
