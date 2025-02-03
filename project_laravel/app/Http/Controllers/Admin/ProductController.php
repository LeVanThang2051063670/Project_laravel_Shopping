<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::orderBy('id', 'DESC')->paginate(20);
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Phần create này cần truyền danh mục vào
        $cats = Category::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.product.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:150|unique:products',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'img' => 'required|file|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:4'
        ]);
        //lấy data xuống
        $data = $request->only('name', 'price', 'sale_price', 'status', 'description', 'category_id');

        // $imag_name = $request->img->getClientOriginAlName();
        $imag_name = $request->img->hashName();
        //img ten trong form
        // gan vao database
        $request->img->move(public_path('uploads/product'), $imag_name);
        $data['image'] = $imag_name;


        if ($product = Product::create($data)) {
            // thêm nhiều ảnh other_img[]
            if ($request->has('other_img')) {
                foreach ($request->other_img as $img) {
                    $other_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $other_name);
                    ProductImage::create([
                        'image' => $other_name,
                        'product_id' => $product->id
                    ]);
                }
            }

            return redirect()->route('product.index')->with('ok', 'Create new product success');

        }

        return redirect()->back()->with('no', 'Create fail');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $cats = Category::orderBy('name', 'ASC')->select('id', 'name')->get();
        return view('admin.product.edit', compact('cats', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required|min:4|max:150|unique:products,name,' . $product->id,
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'img' => 'file|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:4'

        ]);
        //lấy data xuống
        $data = $request->only('name', 'price', 'sale_price', 'status', 'description', 'category_id');

        // $imag_name = $request->img->getClientOriginAlName();
        //kiem tra co anh k
        if ($request->has('img')) {
            /////////////neu chon anh moi xoa luon anh cu////////////////////
            $img_name = $product->image;//lấy đường link ảnh
            $image_path = public_path('uploads/product') . '/' . $img_name;//lấy path ảnh
            if (file_exists($image_path)) {//kiểm tra có trong thư mục hay không
                unlink($image_path);
            }//kiểm tra nếu có tồn tại thì xóa
            ////////////////////--------------------/////////////////////////
            $imag_name = $request->img->hashName();//cap nhap lai ten
            $request->img->move(public_path('uploads/product'), $imag_name);//load ảnh mới vào
            $data['image'] = $imag_name;
        }//neu nguoi ta khong con anh thi k xu ly chỗ này


        if ($product->update($data)) {
            //neu san pham dang sua ma co anh truoc do thi duyet no ra
            //r bat dau xoa no roi moi them cai moi vao
            if ($request->has('other_img')) {
                if ($product->images->count() > 0) {
                    foreach ($product->images as $img) {
                        $other_image = $img->image;
                        $other_path = public_path('uploads/product') . '/' . $other_image;
                        if (file_exists($other_path)) {
                            unlink($other_path);
                        }

                    }
                    ProductImage::where('product_id', $product->id)->delete();
                }

                foreach ($request->other_img as $img) {
                    $other_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $other_name);

                    ProductImage::create([
                        'image' => $other_name,
                        'product_id' => $product->id
                    ]);
                }
            }
            return redirect()->route('product.index')->with('ok', 'Update product success');

        }
        return redirect()->back()->with('no', 'Update fail');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // minh cai nay la xoa duoc du lieu product
        // if ($product->delete()) {
        //     return redirect()->route('product.index')->with('ok', 'Delete product success');
        // }
        // return redirect()->back()->with('ok', 'Delete product fail');
        //----nâng cao hơn xóa cả ảnh con (product_img) trong product

        $img_name = $product->image;
        //neu san pham co nhieu anh thi duyet tung anh mot roi xoa di,xoa luon trong product
        if ($product->images->count() > 0) {
            foreach ($product->images as $img) {
                $other_image = $img->image;
                $other_path = public_path('uploads/product') . '/' . $other_image;
                if (file_exists($other_path)) {
                    unlink($other_path);
                }

            }
            // vì la khoai ngoai nen phải xóa cái productImage trước mới xóa product sau
            ProductImage::where('product_id', $product->id)->delete();
            if ($product->delete()) {
                $image_path = public_path('uploads/product') . '/' . $img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }

                return redirect()->route('product.index')->with('ok', 'Delete product success');
            }

        } else {
            if ($product->delete()) {
                $image_path = public_path('uploads/product') . '/' . $img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }

                return redirect()->route('product.index')->with('ok', 'Delete product success');
            }

        }


        return redirect()->back()->with('ok', 'Delete product fail');
    }


    public function destroyImage(ProductImage $image)
    {
        $img_name = $image->image;

        if ($image->delete()) {
            $image_path = public_path('uploads/product') . '/' . $img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->back()->with('ok', 'Delete image success');
        }
        return redirect()->back()->with('ok', 'Delete image fail');
    }

    public function discount()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.product.discount', compact('categories'));
    }
    // public function addDiscount(Request $request)
    // {
    //     $validated = $request->validate([
    //         'category_id' => 'required', // Có thể là 'all' hoặc id danh mục
    //         'discount' => 'required|numeric|min:0|max:100',
    //     ]);

    //     $discountFactor = 1 - ($validated['discount'] / 100); // Tính giảm giá

    //     if ($validated['category_id'] === 'all') {
    //         // Áp dụng giảm giá cho tất cả sản phẩm
    //         Product::query()->update([
    //             'sale_price' => DB::raw("price * $discountFactor")
    //         ]);
    //     } else {
    //         // Kiểm tra xem danh mục có tồn tại không
    //         $categoryExists = Category::find($validated['category_id']);

    //         if (!$categoryExists) {
    //             return redirect()->back()->with('no', 'Add discount fail');
    //         }

    //         // Áp dụng giảm giá cho sản phẩm thuộc danh mục
    //         Product::where('category_id', $validated['category_id'])
    //             ->update([
    //                 'sale_price' => DB::raw("price * $discountFactor")
    //             ]);
    //     }

    //     return redirect()->route('product.index')->with('ok', 'adddisscount thành công');
    // }

    public function addDiscount(Request $request)
    {
        $validated = $request->validate([
            'categories' => 'required|array', // Mảng chứa 'all' hoặc id danh mục
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $categories = $validated['categories'];
        $discountFactor = 1 - ($validated['discount'] / 100); // Tính giảm giá

        if (in_array('all', $categories)) {
            // Nếu chọn "Tất cả", áp dụng giảm giá cho tất cả sản phẩm
            Product::query()->update([
                'sale_price' => DB::raw("price * $discountFactor")
            ]);
        } else {
            // Lọc các danh mục hợp lệ
            $validCategories = Category::whereIn('id', $categories)->pluck('id');

            if ($validCategories->isEmpty()) {
                return redirect()->back()->with('no', 'Không tìm thấy danh mục hợp lệ');
            }

            // Áp dụng giảm giá cho các sản phẩm thuộc danh mục đã chọn
            Product::whereIn('category_id', $validCategories)
                ->update([
                    'sale_price' => DB::raw("price * $discountFactor")
                ]);
        }

        return redirect()->route('product.index')->with('ok', 'Giảm giá thành công');
    }

}
