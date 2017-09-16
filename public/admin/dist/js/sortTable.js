/**
 * Created by Administrator on 2/1/2017.
 */
function sort(table_id){
    var sort = '';
    var table = $("#"+table_id);
    // lay ra cac the th.
    var th = $(table).find('> thead > tr > th');

    // xu ly su kien khi click vao cac the th.
    $(th).each(function(key,val){
        $(this).addClass("sorting_asc");

        $(this).click(function(){

            // lay ra vi tri cua truong can xap xep.
            var position = $(th).index($(this));

            sort = $(this).attr("class");
            sort = sort.split(" ");

            for(var i =0; i < sort.length; i++){
                if(sort[i] === "sorting_asc"){
                    sort = sort[i];
                    break;
                }

                if(sort[i] === "sorting_des"){
                    sort = sort[i];
                    break;
                }
            }

            if(sort !== "sorting_asc" && sort !== "sorting_des"){
                return;
            }

            var unsorted = true;
            while(unsorted){

                // lay ra tat ca cac the tr.
                var tbody = $("#"+table_id).find('tbody');
                var tr = $(tbody).find("tr:not(.collapse)");

                //console.log(tr);
                unsorted = false;

                for(var i = 0; i < (tr.length -1) ; i++){

                    var row = tr[i];
                    var next_row = tr[i+1];
                    var value = $(row).find("td").eq(position).html();
                    var next_value = $(next_row).find("td").eq(position).html();

                    value = value.replace(/,/g, '');
                    next_value = next_value.replace(/,/g, '');

                    if(!isNaN(value)){
                        value = parseFloat(value);
                        next_value = parseFloat(next_value);
                    }

                    //console.log("value : "+value+" next_value : "+next_value);
                    if( sort === 'sorting_asc' ? value > next_value : value < next_value){

                        // lay ra id cua 2 tr Dang xet.
                        var stt = $(row).attr("id").match(/[0-9]+/)[0];
                        var next_stt = $(next_row).attr("id").match(/[0-9]+/)[0];

                        // lay ra cac the tr chi tiet.
                        var row_detail = $("#row_detail_"+stt);
                        var next_row_detail = $("#row_detail_"+next_stt);

                        row_detail = row_detail[0];
                        next_row_detail = next_row_detail[0];


                        // chuyen vi tri cac the tr
                        // neu khong co phan chi tiet cua tung ban ghi.
                        if(typeof (row_detail) === "undefined"){
                            $(next_row).after(row);
                        }// neu co.
                        else{
                            $(next_row_detail).after(row);
                            $(row).after(row_detail);
                        }

                        unsorted = true;
                    }
                } // end for
            } // end while
            var sort_old = sort;
            sort = sort === 'sorting_asc' ? 'sorting_des' : 'sorting_asc';
            $(this).removeClass(sort_old).addClass(sort);
        }) // end click
    }); // end foreach.
}