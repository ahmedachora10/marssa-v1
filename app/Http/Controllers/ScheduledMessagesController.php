<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduledMessagesController extends Controller
{

    public function index()
    {
        return view("dashboard.scheduledMessages.index",
            [
                'data' => \App\Attribute::where(['key' => 'scheduledMessages', 'lang' => l()])->get(),
                'title_page' => 'scheduled_messagess',
                'stores' => \App\Store::all()
            ]);
    }


    public function create()
    {
        return view("dashboard.scheduledMessages.make", [
            'title_page' => __("scheduled_messages.add")
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'second' => 'required|numeric|integer|min:0|max:60',
            'minute' => 'required|numeric|integer|min:0|max:60',
            'hour' => 'required|numeric|integer|min:0|max:60',
            'day' => 'required|numeric|integer|min:0|max:30',
        ]);
        $message = [
            'second' => $request->second,
            'minute' => $request->minute,
            'hour' => $request->hour,
            'day' => $request->day,
        ];
        if ($request->has('files')) {
            $request->validate([
                'image' => 'array|required',
                'image.*' => 'file',
            ]);
            $fileExt = $request->file('image')[0]->getClientOriginalExtension();
            $fileName = md5(now()) . ".$fileExt";
            $request->file('image')[0]->move('public/wsFiles', $fileName);
            $fileUrl = "wsFiles/$fileName";
            $message['type'] = 'file';
            $message['image'] = $fileUrl;
            $message['name'] = "File.$fileExt";
            $message['ext'] = "$fileExt";
        } else {
            $request->validate([
                'message' => 'required|max:2000|string',
            ]);
            $message['type'] = 'text';
            $message['message'] = $request->message;
        }
        $attribute = \App\Attribute::create([
            'key' => 'scheduledMessages',
            'value' => json_encode($message),
            'store_id' => auth()->user()->store->id
        ]);
        Alert::success(__("Item Add Successfully"));
        return redirect()->route('dashboard.admin.store_settings.scheduled_messages.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view("dashboard.scheduledMessages.make", [
            'title_page' => __("scheduled_messages.edit"),
            'model' => \App\Attribute::where(['key' => 'scheduledMessages', 'lang' => l()])->findOrFail($id),
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'second' => 'required|numeric|integer|min:0|max:60',
            'minute' => 'required|numeric|integer|min:0|max:60',
            'hour' => 'required|numeric|integer|min:0|max:60',
            'day' => 'required|numeric|integer|min:0|max:30',
        ]);
        $message = [
            'second' => $request->second,
            'minute' => $request->minute,
            'hour' => $request->hour,
            'day' => $request->day,
        ];
        $attribute = \App\Attribute::where(['key' => 'scheduledMessages', 'store_id' => auth()->user()->store->id])->findOrFail($id);
        if (isset(json_decode($attribute->value)->image)) {
            @unlink(base_path("public/" . json_decode($attribute->value)->image));
        }
        if ($request->has('files')) {
            $request->validate([
                'image' => 'array|required',
                'image.*' => 'file',
            ]);
            $fileExt = $request->file('image')[0]->getClientOriginalExtension();
            $fileName = md5(now()) . ".$fileExt";
            $request->file('image')[0]->move('public/wsFiles', $fileName);
            $fileUrl = "wsFiles/$fileName";
            $message['type'] = 'file';
            $message['image'] = $fileUrl;
            $message['name'] = "File.$fileExt";
            $message['ext'] = "$fileExt";
        } else {
            $request->validate([
                'message' => 'required|max:2000|string',
            ]);
            $message['type'] = 'text';
            $message['message'] = $request->message;
        }
        $attribute->update([
            'key' => 'scheduledMessages',
            'value' => json_encode($message),
            'store_id' => auth()->user()->store->id
        ]);
        Alert::success(__("Item Add Successfully"));
        return redirect()->route('dashboard.admin.store_settings.scheduled_messages.index');
    }


    public function destroy($id)
    {
        \App\Attribute::where(['key' => 'scheduledMessages', 'lang' => l()])->findOrFail($id)->delete();
        Alert::success(__("Item Delete Successfully"));
        return redirect()->route('dashboard.admin.store_settings.scheduled_messages.index');
    }

    public function whatsapp(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'user.*' => 'required|exists:users,id',
        ]);
        if ($request->has('files')) {
            $request->validate([
                'image' => 'array|required',
                'image.*' => 'file',
            ]);
        } else {
            $request->validate([
                'message' => 'required|max:2000|string',
            ]);
        }
        $users = $request->user;
        if ($request->has('files')) {
            $ext = $request->file('image')[0]->getClientOriginalExtension();
            $name = md5(now()) . "." . $ext;
            $request->file('image')[0]->move("public/wsFiles", $name);
            $fileUrl = asset("wsFiles/$name");
            $fileExt = "File." . $ext;
            foreach ($users as $item) {
                $user = \App\User::find($item);
                if ($user) {
                    \App\Helper\Ws::make(PhoneFormat($user->mobile), $request->message)->asFile($fileUrl, $fileExt)->send();
                }
            }
            @unlink("wsFiles/$name");
        } elseif ($request->has('message')) {
            foreach ($users as $item) {
                $user = \App\User::find($item);
                if ($user) {
                    \App\Helper\Ws::make(PhoneFormat($user->mobile), $request->message)->send();
                }
            }
        } else {
            abort(400);
        }


        Alert::success(__("Send Successfully"));
        return back();
    }
}
