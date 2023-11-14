@extends('dashboard.master')

@section('store_settings')
    current active
@endsection


@section('head_tag')
    <style>
        .word_break {
            word-break: break-all;
        }
    </style>
@endsection
@section('content')
    @if (session('message'))
        <div class="small-spacing">
            <div class="col-xs-12">
                <div class="alert @if(session('message') == "Successfully") alert-success @else alert-danger @endif alert-dismissible"
                     role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ __('master.'.session('message')) }}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="col-xs-12">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="box-content bordered primary min-height">
                    <h4 class="box-title">{{ __('master.message') }} #{{ $contact->id }}</h4>
                    <table class="table table-hover no-margin">
                        <tbody>
                        <tr>
                            <td>{{ __('master.full_name') }}</td>
                            <td>
                                <span>{{ $contact->name }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('master.email_address') }}</td>
                            <td>
                                <span>{{ $contact->email }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('master.status') }}</td>
                            @if($contact->status == 1)
                                <td class="text-warning">{{ __('master.Pending') }}</td>
                            @else
                                <td class="text-success">{{ __('master.Answered') }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td>{{ __('master.date') }}</td>
                            <td>
                                {{ date('Y-m-d H:i', strtotime($contact->created_at)) }}
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('master.referrer') }}</td>
                            <td class="word_break">
                                {{ $contact->referer }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                {{ $contact->content }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6 col-xs-12">
                <div class="box-content bordered primary min-height">
                    <h4 class="box-title">{{ __('master.reply_message') }} #{{ $contact->id }}</h4>
                    @if($contact->status == 2)
                        <table class="table table-hover no-margin">
                            <tbody>
                            <tr>
                                <td>{{ __('master.date') }}</td>
                                <td>
                                    {{ date('Y-m-d H:i', strtotime($contact->updated_at)) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    {{ $contact->response }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <form method="post" action="{{ route('dashboard.admin.contacts.send') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $contact->id }}">
                            <div class="form-group  @error('response') has-error @enderror">
                        <textarea class="form-control" id="response" rows="7" name="response"
                                  placeholder="{{ __('master.reply_message_notes') }}">{{ old('response') }}</textarea>
                                @error('response')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-xs-12 margin-top-30 text-center">
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                                    {{ __('master.send') }}
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
{{--Developed Saed Z. Sinwar--}}
