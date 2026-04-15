<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   public function __construct()
{
    $this->middleware('auth');
}
    // عرض جميع المنتجات
    public function index()
    {
        $products = Product::all(); 
        return view('admin.products.index', compact('products')); // عرضها في صفحة index
    }

    // عرض نموذج إضافة منتج
    public function create()
    {
        return view('admin.products.create'); // عرض نموذج إضافة منتج جديد
    }

    // تخزين منتج جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $productData = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $productData['image'] = $imageName; // تخزين الاسم فقط
        } else {
            $productData['image'] = 'default.jpg'; // إذا لم تكن هناك صورة
        }

        Product::create($productData);

        return redirect()->route('admin.products.index')
                         ->with('success', 'تم إضافة المنتج بنجاح!');
    }

    // عرض نموذج تعديل المنتج
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product')); // عرض نموذج التعديل
    }

    // تحديث المنتج
    public function update(Request $request, $id)
    {
        // التحقق من المدخلات
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $productData = $request->all();  // جلب جميع البيانات

        // إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image)); // حذف الصورة القديمة
            }

            // رفع الصورة الجديدة
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // إعطاء اسم فريد
            $image->move(public_path('images'), $imageName); // رفع الصورة إلى المجلد
            $productData['image'] = $imageName; // تخزين اسم الصورة الجديد
        }

        // تحديث باقي البيانات
        $product->update($productData);

        return redirect()->route('admin.products.index')
                         ->with('success', 'تم تحديث المنتج بنجاح!');
    }

    // حذف المنتج
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصورة من `public/images`
        if ($product->image && file_exists(public_path('images/' . $product->image))) {
            unlink(public_path('images/' . $product->image)); // حذف الصورة
        }

        $product->delete(); // حذف المنتج من قاعدة البيانات

        return redirect()->route('admin.products.index')
                         ->with('success', 'تم حذف المنتج بنجاح!');
    }
    
}