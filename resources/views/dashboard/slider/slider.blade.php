@extends('dashboard.master')

@section('index')
    current
@endsection

@section('head_tag')
    <style>
        tspan {
            font-family: DINN-Medium;
        }

        .store-item__plan {
            background: #fff url("{{ asset('site/images/bg.png') }}") no-repeat top left;
            background-size: 80% auto;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .05);
            transition: transform .2s;
        }

        .plan1 {
            background: url({{ asset('site/images/sparkles.svg') }}) no-repeat
        }

        .plan2 {
            background: url({{ asset('site/images/plan-plus.png') }}) no-repeat
        }

        .plan3 {
            background: url({{ asset('site/images/falling-star.svg') }}) no-repeat
        }

        .plan2_color {
            color: #764aaf !important;
        }

        .plan3_color {
            color: #55ccfc !important;
        }
    </style>
@endsection

@section('content')


    <div class="row small-spacing">
    <a href="{{ route('dashboard.admin.slider.add_slider')}}" class="btn btn-primary ">  {{  __('store.add')  }} <i class="fas fa-plus"></i></a>
            <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">{{  __('store.image')  }}</th>
            <th scope="col">{{  __('store.edit')  }}</th>
            
            </tr>
        </thead>
        <tbody>
        @foreach($slider as $slide)
            <tr>
            <th scope="row">#</th>
            <td>@if(!empty( $slide->image)) 
            <img style="max-width: 90px;" 
            src="{{url('/')}}/{{ $slide->image }}" 
            class="img-responsive  img-thumbnail size-medium" 
            alt="slider" loading="lazy">
              @else 
            <img style="    max-width: 90px;" src="https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty-300x240.jpg" class="img-responsive  img-thumbnail size-medium" alt="" loading="lazy">
             @endif </td>
            <td> <a href="{{ route('dashboard.admin.slider.edit_slider',['id'=>$slide->id])}}" class="btn btn-info " ><i class="fa fa-edit"></i></a> <a data-href="{{ route('dashboard.admin.slider.delete_slider',['id'=>$slide->id])}}" class="btn btn-danger delete" ><i class="fa fa-trash-alt"></i></a></td>
           
            </tr>
        @endforeach
       
        
        </tbody>
        </table>
    </div>
@endsection


@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
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
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
    


   
        $(document).ready(function() {
         
         
            $(".delete").click(function(){
              
            var url = $(this).attr("data-href");
            Swal.fire({
                title: "{{  __('store.msg_delete')  }}",
               
                showCancelButton: true,
                confirmButtonText: "{{  __('store.delete')  }}",

                }).then((result) => {
                    console.log(result);
                    if (result.value) {
                       console.log(url);
                       console.log(result);
                        window.location.href= url; 
                    } 
                })
            })

            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'تصدير الي أكسيل',
                        exportOptions: {
                            columns: [ 0,2,3,4,5 ]
                        }
                    },{
                        extend: 'colvis',
                        text: 'العواميد الظاهرة'
                    }
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'تفاصيل';
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": "{{(app()->getLocale() == 'ar') ? '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json' : '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json'}}"
                }
            });
        } );
    </script>
@endsection
