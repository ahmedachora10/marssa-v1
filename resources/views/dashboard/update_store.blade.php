@extends('dashboard.master')


@section('participants_index')
    current active
@endsection

@section('head_tag')
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/RWD-table-pattern/css/rwd-table.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/light/assets/plugin/modal/remodal/remodal-default-theme.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            
            <div class="box-content bordered primary ">
                <form method="post" action="{{ route('dashboard.admin.update-stores-ind') }}">
                                                  @csrf
                    <div class="form-group mb-2">
                        <h4>
                            {{ $store->name }}
                        </h4>
                    </div>     
                    <hr>
                    <div class="form-group mb-2">
                                                            <label>
                                                                {{ app()->getLocale() == 'ar' ? 'أقصي عمولة' : 'Max Indebtedness'  }}
                                                            </label>
                                                            <input type="hidden" name="store_id" value="{{$store->id}}">
                                                            <input type="numbers" step="0.001" class="form-control" name="max_indebtedness" value= "{{ $store->max_indebtedness }}">
                                                        </div>
                    <div class="form-group mb-2">
                                                            <label>
                                                                {{ app()->getLocale() == 'ar' ? 'العمولة المستحقة' : 'Indebtedness'  }}
                                                            </label>
                                                            <input type="numbers" step="0.001" class="form-control" name="indebtedness" value= "{{ $store->indebtedness }}">
                                                        </div>
                    <div class="form-group mb-2">
                                                            <label>
                                                                {{ app()->getLocale() == 'ar' ? 'نسبة العمولة' : 'Indebtedness Precentage'  }}
                                                            </label>
                                                            <input type="numbers" step="0.001" class="form-control" name="indebtedness_percent" value= "{{ $store->indebtedness_percent }}">
                                                        </div>
                                                  
                                                  
                    <button type="submit" class="btn btn-primary"> {{ app()->getLocale() == 'ar' ? 'حفظ' : 'Save' }} </button>
                                                 
                </form>
            </div>
        </div>
    </div>
@endsection


{{--Developed Ahmed W.Ezzeldine--}}
