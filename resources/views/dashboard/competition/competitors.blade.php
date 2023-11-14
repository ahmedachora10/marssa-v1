@extends('dashboard.master')

@section('products_index')
    current active
@endsection

@push('css')
<style>
    .card{
        background-color: white;
        padding: 30px;
        margin-bottom: 23px;
        box-shadow: 0px 4px 6px 8px #eeee;
    }
    .loading-choice{
        display:none;
    }
    .inner-links {
        background-color: #eee;
        display:none;
    }
    .active-heade{
        background-color:#ffe8be;
    }
    @media (max-width: 976px) {
        .img-rounded {
            width: 50px !important;
            height: 50px !important;
        }
    }
    
</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>تفاصيل المسابقة</h4>
                </div>
                <div class="card-body">
                    {{ $competition->name }}
                    <a href="#" class="btn btn-warning btn-sm" style="float: left;">
                        تفاصيل المسابقة
                    </a>
                </div>
            </div>
            @if(($competition->winner && $competition->winner->isNotEmpty() ) || ($competition->winner_visits_links && $competition->winner_visits_links->isNotEmpty()))
                <div class="card">
                    <div class="card-header" style="padding:0px;text-align: center;">
                        <h4>الفائز بالمسابقة</h4>
                    </div>
                    <div class="card-body" style="padding: 0px;text-align: center;">
                        <div style="width: 208px;margin:auto">
                            <img src="https://png.pngtree.com/png-vector/20191029/ourmid/pngtree-first-prize-gold-trophy-icon-prize-gold-trophy-winner-first-prize-png-image_1908592.jpg"/>
                        </div>
                        <div class='alert'>
                            <h4>الفائز</h4>
                            <p>
                                @if($competition->condition_type == 'buy_products')
                                    @foreach($competition->winner  as $winner_link)
                                        <span class="badge bg-info" style="padding: 10px;border-radius: 31px;">
                                            {{ $winner_link->mobile }}  /   {{ $winner_link->client->name }}   
                                        </span>
                                    @endforeach
                                @else
                                    @foreach($competition->winner_visits_links  as $winner_link)
                                        <span class="badge bg-info" style="padding: 10px;border-radius: 31px;">
                                            {{ $winner_link->mobile }}  
                                        </span>
                                    @endforeach
                                @endif
                                <br/>
                            </p>
                            
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header" style="padding: 10px;text-align: center;">
                        <h4>اختيار فائز من المتسابقين</h4>
                    </div>
                    <div class="card-body" style="padding: 10px;text-align: center;">
                        <div class="loading-choice" style="width: 208px;margin:auto">
                            <img src="https://cdn.dribbble.com/users/1787505/screenshots/7300251/shot.gif"/>
                        </div>
                        <form method="post" action="{{ route('dashboard.merchant.competition_choice_winner',$competition->id) }}" id="choice-winner">
                            @csrf
                            <div class="form-group">
                                <lable>عدد الفائزين</lable>
                                <input type="number" name="count_winners" style="width: auto;margin: 16px auto;border-radius: 35px;background-color: #eee;" value="1" class="form-control" required/>
                            </div>
                            <button class="btn btn-danger" type="button">
                                اختيار فائز بطريقة عشوائية
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            @if($competition->condition_type == 'buy_products')
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" id="DataTables_Table_0" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>client name</th>
                            <th>client phone</th>
                            <th>date subscribe</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitors as $competitor)
                            <tr @if($competitor->winner == 1) style="background-color: #C8E6C9;" @endif>
                                <td>#{{ $competitor->id }}</td>
                                <td>{{ $competitor->client->name }}</td>
                                <td>{{ $competitor->client->mobile }}</td>
                                <td>{{ $competitor->created_at }}</td>
                                <td>
                                    @if($competitor->winner == 1)
                                      <img style="width: 40px;margin: auto;" src="https://png.pngtree.com/png-vector/20191029/ourmid/pngtree-first-prize-gold-trophy-icon-prize-gold-trophy-winner-first-prize-png-image_1908592.jpg" />
                                    @else
                                     -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="box-content bordered primary ">
                    <table class="table table-bordered" id="DataTables_Table_0" style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم جوال </th>
                            <th>نتائج المتسابق</th>
                            <th>تفاصيل الروابط</th>
                            <th>الفائز</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($competitors as $competitor)
                            <tr @if($competitor->winner == 1) style="background-color: #C8E6C9;" @endif>
                                <td>#{{ $competitor->id }}</td>
                                <td>{{ $competitor->mobile }}</td>
                                <td>{{ $competition->competition_links->sum('count_required') > $competitor->link_visits_count ? $competitor->link_visits_count : 'حقق الزيارات المطلوبه'   }}</td>
                                <td>
                                    <i class="fas fa-eye show_links" onClick="showVisits({{ $competitor->id }})" style="cursor:pointer"></i>
                                </td>
                                <td>
                                    @if($competitor->winner == 1)
                                      <img style="width: 40px;margin: auto;" src="https://png.pngtree.com/png-vector/20191029/ourmid/pngtree-first-prize-gold-trophy-icon-prize-gold-trophy-winner-first-prize-png-image_1908592.jpg" />
                                    @else
                                     -
                                    @endif
                                </td>
                            </tr>
                            @foreach($competitor->competition_link_visits as $link_visit)
                                @if($loop->iteration == 1)
                                    <tr class="inner-links item{{$competitor->id}}" @if($competitor->winner == 1) style="background-color: #C8E6C9;" @endif >
                                        <th>-</td>
                                        <th colspan="3">رابط المسابقة</th>
                                        <th>عدد الزيارات</th>
                                    </tr>
                                @endif
                                <tr class="inner-links item{{$competitor->id}}" @if($competitor->winner == 1) style="background-color: #C8E6C9;" @endif >
                                    <td>-</td>
                                    <td colspan="3">{{ $link_visit->competition_link->link }}</td>
                                    <td>{{ $link_visit->link_visits->count() }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/autoFill.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
        $(document).ready(function(){
            jQuery('table').on('click','.delete_competion',function(){
                if(confirm('تأكيد حذف المسابقة ؟') == true){
                    jQuery(this).parents('form').submit();
                }
            }); 
        });
        $(document).ready(function () {
            var t = $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'تصدير الي أكسيل',
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5]
                        }
                    }, {
                        extend: 'colvis',
                        text: 'العواميد الظاهرة'
                    }
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'تفاصيل';
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                "order": [[0, "desc"]],
                "language": {
                    "url": "{{(app()->getLocale() == 'ar') ? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                }
            });
            t.on('click', '.delete', function (e) {
                e.preventDefault();
                var form = $(this)
                Swal.fire({
                    title: 'هل انت متاد من الحذف ',
                    text: "لن تتمكن من الرجوع",
                    showCancelButton: true,
                    confirmButtonColor: '#ea4335',
                    cancelButtonColor: '#00bf4f',
                    cancelButtonText: 'الغِ',
                    confirmButtonText: 'نعم قم بالحذف !'
                }).then((result) => {
                    if (result.value) {
                        var data = form.serialize();
                        var url = form.attr('action')
                        var method = form.attr('method')
                        $.ajax({
                            url: url,
                            method: method,
                            data: data,
                            success: function (response) {
                                Swal.fire(
                                    'تم الحذف!',
                                    'تم حذف العنصر بنجاح',
                                )
                                location.reload();
                            }, error: function (response) {
                                console.warn(response)
                            }
                        })
                    }
                })
            });
        });
        
        jQuery(document).ready(function(){
            jQuery('form#choice-winner button').click(function(e){
                e.preventDefault();
                jQuery(this).slideUp(100);
                jQuery('.loading-choice').slideDown(300); 
                setTimeout(function(){
                    jQuery('form#choice-winner').submit();
                },5000);
                
            });
        });
        
        function showVisits(competitor_id){
            let self = event.target;
            jQuery(self).parents('tr').toggleClass('active-heade');
            jQuery('.item'+competitor_id).slideToggle(100);
        }
        

    </script>
@endsection