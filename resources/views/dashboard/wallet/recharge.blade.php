@extends('dashboard.master')

@section('participants_index')
    current active
@endsection
@section('head_tag')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endsection
@section('content')
    <form action="{{route('dashboard.admin.wallet-recharge')}}" method="POST">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content bordered primary ">
                    @csrf
                    <div class="row">
                        <div class="col-xs-6">
                            <label>
                                {{__("master.amount")}}
                            </label>
                            <input class="form-control" name="amount" type="number"
                                   placeholder="{{__("master.amount")}}">
                        </div>
                        <div class="col-xs-6">
                            <label>
                                {{__("master.store")}}
                            </label>
                            <select class="form-control" name="store_id" id="stores">
                                @foreach($model as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xs-12 text-center margin-top-30">
                            <button class="btn btn-success" type="submit">{{__("master.recharge")}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#stores").select2({
                placeholder: '{{__("Choose Store")}}',
                selectionCssClass: 'form-control',
                theme: 'bootstrap4',

            });
        })
    </script>

@endsection
