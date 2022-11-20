<?php

namespace App\Http\Controllers\Vue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Address;

class AddressController extends Controller
{
    /**
     * Return User  all Address 
    */
    public function UserAddress(){
        $address = Address::where('user_id',Auth::user()->id)->select('name','address','codeposti','id')->get();
        return response()->json(['addresses'=>$address],200);
    }

    /**
     * Store User Address 
     */
      public function UserAddAddress(Request $request)
      {
          $this->validate($request,[
              'name' =>'required|string',
              'address' => 'required|string',
              'codeposti' => 'required|numeric'
          ]);

          $address = new Address();
          $address->user_id = Auth::user()->id;
          $address->name = $request->name;
          $address->address = $request->address;
          $address->codeposti=$request->codeposti;
          $address->save();
          return response()->json(['message'=>"آدرس با موفقیت ثبت شد"],200);
      }

    /**
    * Return edit address info 
    */
   public function UserEditAddress($id){
       $address = Address::where('user_id',Auth::user()->id)->where('id',$id)->select('name','address','codeposti','id')->first();
       if($address == null)
       return response()->json(['error'=>"متاسفانه اجازه دسترسی ندارید"],422);
       else 
       return response()->json(['address'=>$address],200);
   }

    /**
    * Store Edited Address 
    */
   public function UserEditAddressStore(Request $request , $id){
       $this->validate($request,[
           'name' =>'required|string',
           'address' => 'required|string',
           'codeposti' => 'required|numeric'
       ]);

       $address = Address::where('id',$id)->where('user_id',Auth::user()->id)->first();
       if($address == null)
       return response()->json(['error'=>"متاسفانه اجازه دسترسی ندارید"],422);
       else{ 
       $address->user_id = Auth::user()->id;
       $address->name = $request->name;
       $address->address = $request->address;
       $address->codeposti=$request->codeposti;
       $address->save();
       return response()->json(['message'=>"آدرس با موفقیت بروزرسانی شد"],200);
       }
   }

   /**
    * Remove Address 
    */
   public function UserRemoveAddress($id)
     {
       $address = Address::where('user_id',Auth::user()->id)->where('id',$id)->first();
       if($address == null)
       return response()->json(['error'=>"متاسفانه اجازه دسترسی ندارید"],422);
       else 
       {
           $address->delete();
           return response()->json(['message'=>'آدرس با موفقیت حذف شد !'],200);
       } 
   }
   /**
    * User Address List 
    */
    public function UserAddressList(){
        $addresses = Address::where('user_id',Auth::user()->id)->select('id','name','address')->get();
        if($addresses->isEmpty())
        {
            $addresses = null ;
        }
        return response()->json(['addresses'=>$addresses],200);
        
    }
}
