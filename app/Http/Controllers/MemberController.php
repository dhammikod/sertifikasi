<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\member;
use App\Models\book;
use App\Models\borrow;

class MemberController
{
    public function member(){
        $member = member::all();

        return view('/Member/member', [
            'titlepage' => "Member page",
            'Members' => $member,
        ]);
    }

    public function create_member(){
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $member = member::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
        ]);

        return redirect('/member');
    }

    public function edit_member(){
        $validated = request()->validate([
            'member_id' => 'required|integer|exists:member,id'
        ]);

        $member = member::find($validated['member_id']);

        #check if this functino is accesed by navigating from authorpage or not
        if(isset($_POST["edit_done"])){
            $member->address = $_POST["address"];
            $member->name = $_POST["name"];
            $member->save();

            return redirect('/member');
        }else{
            return view('/member/edit_member',[
                'titlepage' => "Edit Member",
                'member' => $member,
            ]);
        }
    }

    public function delete_member(){
        $validated = request()->validate([
            'member_id' => 'required|exists:member,id',
        ]);
    
        $member = member::find($validated['member_id']);
    
        //todo
        //make sure every book lent is also deleted in borrows table
        $member->delete();
        
        return redirect('/member');
    }
}
