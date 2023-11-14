<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliaterMarketplace extends Model
{
    //
    protected $appendTo = [
        'message_whatsapp'
    ];
    protected $fillable = ['user_id','store_id','status','phone_whatsapp','code_affiliate','password'];
    public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }

    public function store(){
         return $this->belongsTo(Store::class,'store_id','id');
    }

    public function getMessageWhatsappAttribute(){
        $name       =  $this->user->username ?? $this->user->name;
        $password   =  $this->password ?? 'استخدم كلمة المرور الخاصة بك فى منصة marssa';
        $url        =  url('login');
        $store_name =  $this->store->name ?? ' - ';
        $message = "لقد تم الموافقة على طلبك لتسويق بالعمولة لمتجر $store_name و تحقيق ارباح من خلال مدعويك للمتجر لكى تقوم بدعوة أصدقائق و مدعويك يمكن متابعة ذالك من خلال لوحة النحكم الخاصة بك و التى بياناتها كالاتى
        %0D         اسم المستخدم : $name
        %0D        كلمة المرور : $password
        %0D        رابط لوحة التحكم : $url";
        $message = str_replace(' ','%20',$message);
        return $message;
    }
}
