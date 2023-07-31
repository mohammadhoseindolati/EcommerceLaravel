<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories.index' , ['categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();

        return view('admin.categories.create', [

            'parentCategories' => $parentCategories,
            'attributes' => $attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $category = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'icon' => $request->icon,
            ]);

            foreach ($request->attribute_ids as $attributeId) {

                $attribute =  Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $request->variation_id == $attributeId ? 1 : 0,
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {

            DB::rollBack();

            alert()->error('مشکل در ایجاد دسته بندی', $ex->getMessage())->persistent('حله');

            return redirect()->back();
        }

        alert()->success('با تشکر', 'دسته بندی مورد نظر شما ایجاد شد .');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show' , ['category' => $category]) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.edit' , ['category' => $category , 'parentCategories' => $parentCategories , 'attributes' => $attributes]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => 'required',
            "slug" => 'required|unique:categories,slug,'.$category->id ,
            "parent_id" => 'required' ,
            "attribute_ids" => 'required',
            "attribute_is_filter_ids" => 'required' ,
            "variation_id" => 'required' ,
        ]) ;
        try {
            DB::beginTransaction();
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' => $request->parent_id,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'icon' => $request->icon,
            ]);

            $category->attributes()->detach();

            foreach ($request->attribute_ids as $attributeId) {

                $attribute =  Attribute::findOrFail($attributeId);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attributeId, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $request->variation_id == $attributeId ? 1 : 0,
                ]);
            }

            DB::commit();
        } catch (\Exception $ex) {

            DB::rollBack();

            alert()->error('مشکل در ویرایش دسته بندی', $ex->getMessage())->persistent('حله');

            return redirect()->back();
        }
        alert()->success('با تشکر', 'دسته بندی مورد نظر شما ویرایش شد .');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function categoryAttributes(Category $category){

        $attributes =  $category->attributes()->wherePivot('is_variation' , 0)->get() ;
        $variation =  $category->attributes()->wherePivot('is_variation' , 1)->first() ;

        return ['attributes' => $attributes , 'variation' => $variation];
    }
}
