@extends('Store.master_5')


@section('content')
    <section class="blog-details">
        <br/>
        <div class="container">
            <div class="row">
                @foreach($competitons as $competition)
                    <div class="col-lg-6">
                        <div class="container-section">
                            <div class="container-img">
                                @if($competition->thumbnails)
                                    <img src="{{$competition->thumbnails ? $competition->thumbnails[0] :($competition->images ? $competition->images[0] : null)  }}" />
                                @endif
                            </div>
                            <div class="left-section-description">
                                <h2>{{ $competition->name }}</h2>
                                <table class="table">
                                    <tr class="table-light">
                                        <td>تاريخ بدأ المسابقة</td>
                                        <td>{{ $competition->start_date }}</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td>تاريخ نهاية المسابقة</td>
                                        <td>{{ $competition->end_date }}</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td>نوع المسابقة</td>
                                        <td>
                                            <span class="badge bg-danger">
                                                @if($competition->condition_type == 'buy_products')
                                                    {{ __('master.buy_products') }}
                                                @else
                                                    {{ __('master.visits_links') }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="table-light">
                                        <td>عدد المشتركين فى المسابقة</td>
                                         @if($competition->condition_type == 'buy_products')
                                            <td>{{ $competition->competitors_count }} مشترك</td>
                                         @else
                                            <td>{{ $competition->competition_joiners_count }} مشترك</td>
                                         @endif
                                    </tr>
                                </table>
                                <a href="{{ url('details-competition/'.$competition->slug) }}" class="btn btn-success">
                                    تفاصيل المسابقة
                                </a>
                                <button class="btn btn-warning">
                                    مشاهدة الفيديو التعريفي
                                </button>
                            </div>
                        </div>
                    </div> 
                @endforeach
                {!! $competitons->links() !!}
            </div>
        </div>
    </section>
@endsection
{{--Developed Saed Z. Sinwar--}}

@section('head')
<style>
    .container-section{
        background-color: #eeee;
        margin-bottom: 10%;
        padding-bottom: 8%;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .container-section .container-img{
        padding: 20px;
        height: 320px;
        overflow: hidden;
    }
    .container-section .container-img img{
        border-radius: 13px;
        width: 100%;
        height: 100%;
    }
    .left-section-description{
        padding: 0px 24px;
        font-family: dinnextltw23,'sans-serif'!important;
        /*width: 50%;*/
    }
    .left-section-description h2{
        padding: 16px 0px;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .left-section-description p{
        font-size: 15px;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .left-section-description .btn-success
    {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .left-section-description .btn-warning{
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .left-section-description .btn{
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .left-section-description .badge
    {
        background-color: #dc3545!important;
        color: white;
        padding: 9px 20px;
        border-radius: 30px;
        font-family: dinnextltw23,'sans-serif'!important;
    }
    .table{
        font-family: dinnextltw23,'sans-serif'!important;
    }
</style>
@endsection