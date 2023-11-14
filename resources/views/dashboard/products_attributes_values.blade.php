@extends('dashboard.master')

@section('products_attributes_index')
    current active
@endsection

<style>

    @media (max-width: 976px) {
        .img-rounded {
            width: 50px !important;
            height: 50px !important;
        }
    }
</style>
@section('content')

    @role('User|SubUser')
    <div class="col-xs-12 margin-bottom-20">
        <a href="{{ route('dashboard.admin.products.attributes.values.add') }}"
           class="btn btn-primary btn-rounded waves-effect waves-light">
            <i class="ico ico-left fa fa-plus"></i>
            {{ __('master.add_new') }}
        </a>
    </div>
    @endrole
    <div class="row">
        <div class="col-xs-12">
            <div class="box-content bordered primary ">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>{{ __('master.attribute') }}</th>
                        <th>{{ __('master.value') }}</th>
                        <th>{{ __('master.edit') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes_values as $attribute)
                        <tr class="text-center">
                            <td>{{ $attribute->attribute['name_'.$store->getLang()] ?? $attribute->id }}</td>
                            <td>{{$attribute->value}}</td>
                            
                            <td> 
                            @role('User|SubUser')
                                <a href="{{ route('dashboard.admin.products.attributes.values.edit',$attribute->id) }}"
                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                    <i class="ico ico-left fas fa-edit"></i>
                                </a>
                            @endrole
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
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

    </script>
@endsection
