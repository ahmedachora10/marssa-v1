<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Interface WalletController
{
    // here to show page of wallet
   public function show_wallet();

   // here to add balance in wallet
   public function add_balance_in_wallet(Request $request);

}
