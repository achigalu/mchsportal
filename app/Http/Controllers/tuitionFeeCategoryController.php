<?php

namespace App\Http\Controllers;

use App\Models\Feecategory;
use Illuminate\Http\Request;

class tuitionFeeCategoryController extends Controller
{
    public function viewFeesCategory(){
        $data['title']='Fees Category List';
        $data['allfeescategory'] = Feecategory::getAllFeeCategoryList();
        return view('admin.tuitionFeeCategory.viewFeeCategory', $data);
    }

    public function addFeesCategory(){
        $data['title']= 'Create Fee Category';
        return view('admin.tuitionFeeCategory.addFeeCategory' , $data);
    }

    public function addFeeCategories(Request $request){
        $validated = $request->validate([
            'feecode' => 'required|max:50',
            'feename' => 'required|max:50',
            'localfee'=> 'required',
            'foreignfee'=> 'required'
        ]);

        $code = $request->feecode;
        $name = $request->feename;
       $alreadyfeecode = Feecategory::alreadyFeeCategoryCode($code);
       $alreadyfeename = Feecategory::alreadyFeeCategoryName($name);

        if(!empty($alreadyfeecode))
        {
            return redirect()->back()->with('invalid' , 'Fee code:'." ".$request->feecode.':'." ". ' already exist');
        }

        elseif(!empty($alreadyfeename))
        {
            return redirect()->back()->with('invalid' , 'Fee Category name:'." ". $request->feename.':'." ". 'already exist');
        }

        else{
            Feecategory::create([
                'feecode' => $request->feecode,
                'feename' => $request->feename,
                'local_fee' => $request->localfee,
                'foreign_fee' => $request->foreignfee
            ]);
        }
        
     return redirect()->back()->with('status' , 'Fee category'." ".$request->feename." " . 'created successfully');
    }

    public function editFeesCategory($id){
        $data['title'] = 'Edit Fee Category';
        $data['feecategory'] = Feecategory::singleFeeCategory($id);
        return view('admin.tuitionFeeCategory.editFeeCategory' , $data);
    }

    public function updateFeesCategory(Request $request, $id){
        $request->validate([
            'feecode' => 'required|max:20',
            'feename' => 'required|max:20',
            'localfee' => 'required',
            'foreignfee' => 'required'
        ]);

     $singlecategory = Feecategory::singleFeeCategory($id);
     if(!empty($singlecategory)) 
     {
        $singlecategory->update([
            'feecode' => $request->feecode,
            'feename' => $request->feename,
            'local_fee' => $request->localfee,
            'foreign_fee' => $request->foreignfee
        ]);
        return redirect()->back()->with('status' , 'Fee category'." ".$request->feename." " . 'updated successfully');
     } 
     return redirect()->back()->with('invalid' , 'Fee category'." ".$request->feename." " . 'not found');  
    }
}
