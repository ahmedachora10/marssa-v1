@extends('dashboard.master')

@section('products_index')
    current active
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            
                <div class="row">
                    <div class="col-md-6">
            <div class="box-content bordered primary table-responsive">
                        <h5>{{__('master.total_stores')}}</h5>
                        <h5>{{$stores->count()}}</h5>
                    </div>
                </div>
                    <div class="col-md-6">
            <div class="box-content bordered primary table-responsive">
                        <h5>{{__('master.total_indebtedness')}}</h5>
                        <h5>{{$stores->sum('indebtedness')}}</h5>
                    </div>
                </div>
                </div>
            <div class="box-content bordered primary table-responsive">
                <table class="table table-borderd" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('master.store')}}</th>
                            <th>{{__('master.currency')}}</th>
                            <th>{{__('master.indebtedness_percent')}}</th>
                            <th>{{__('master.indebtedness')}}</th>
                            <th>{{__('master.max_indebtedness')}}</th>
                            <th>{{__('master.status')}}</th>
                            <th>{{__('master.disable_time')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $index=>$store)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$store->name}}</td>
                            <td>{{$store->information->currency}}</td>
                            <td>{{($store->indebtedness_percent) / 100}}</td>
                            <td>
                                @if($store->information->currency == 'أوقية قديمة')
                                <span class="@if($store->indebtedness >= $store->plan->max_indebtedness) text-danger @else text-success @endif">
                                {{$store->indebtedness }}
                                </span>
                                 @else 
                                <span class="@if($store->indebtedness  >= $store->plan->max_indebtedness) text-danger @else text-success @endif">
                                    {{ ($store->indebtedness) / 10}}
                                    </span>
                                @endif
                                </td>
                            <td>
                                @if($store->information->currency == 'أوقية قديمة')
                                {{$store->plan->max_indebtedness}}
                                 @else {{ ($store->plan->max_indebtedness) / 10}}
                                @endif</td>
                            <td>{{$store->status == 1 ? __('master.active') : __('master.Inactive')}}</td>
                            <td>{{$store->disable_time}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
        <div class="d-flex justify-content-start" style="direction:ltr;">
            {{$stores->appends(request()->query())->links()}}
        </div>
            </div>
        </div>
    </div>
@endsection
