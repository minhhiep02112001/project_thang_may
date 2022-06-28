<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Vendor;
use App\Model\Category;
use App\Model\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'san_pham');
    }

    protected function resourceAbilityMap()
    {
        return array_merge(parent::resourceAbilityMap(), ['index' => 'view']);
    }

    public function index(Request $request)
    {
        //

        $products = Product::latest()->paginate(10);

        if ($request->has('search')) {

            $products = Product::where('name', 'like', "%{$request->get('search')}%")->paginate(10);
        }
        $rank = $products->firstItem();
        return view('admin.product.index', ['products' => $products, 'rank' => $rank]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where([
            'parent_id' => 0,
            'type' => 0
        ])->get();
        $vendors = Vendor::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'vendors', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate(
            [
                'name' => 'required|max:255|unique:categories,name',
                'image' => 'required|file|mimes:jpg,png,jpeg,gif,svg|max:10000',
                'category_id' => 'required',
                'url' => 'max:255',
                'sku' => 'max:255',
                'meta_title' => 'max:255',
                'product_images.*' => 'file|mimes:jpg,png,jpeg,gif,svg|max:20000',
            ],
            [
                'name.required' => 'Tên sản phẩm không được để trống !!!',
                'name.required' => 'Tên sản phẩm đã tồn tại !!!',
                'name.max' => 'Tên sản phẩm không được quá 255 ký tự !!!',
                'name.required' => 'Danh mục không được để trống !!!',
                'url.max' => 'Url không được quá 255 ký tự !!!',
                'sku.max' => 'Mã hàng (SKU) không được quá 255 ký tự !!!',
                'meta_title.max' => 'Meta title không được quá 255 ký tự !!!',
                'product_images.*.mimes' => "File ảnh không hợp lệ",
                'product_images.*.file' => "File ảnh không hợp lệ",
            ]
        );

        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while (file_exists('./uploads/product/' . $fileName)) {
                $fileName = str_random(10) . $fileName;
            }
            $file->move('./uploads/product', $fileName);
            $image = './uploads/product/' . $fileName;
        }

        try {
            DB::beginTransaction();
            $product = Product::create([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'image' => $image,
                'stock' => $request->stock,
                'price' => $request->price,
                'sale' => $request->sale,
                'position' => $request->position,
                'is_active' => ($request->is_active) ? 1 : 0,
                'is_hot' => ($request->is_hot) ? 1 : 0,
                'category_id' => $request->category_id,
                'url' => $request->url,
                'sku' => $request->sku,
                'color' => $request->color,
                'memory' => $request->memory,
                'brand_id' => $request->brand_id,
                'vendor_id' => $request->vendor_id,
                'summary' => $request->summary,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'user_id' => Auth::user()->id,
            ]);

            if ($request->hasFile('product_images.*')) {
                $file = $request->product_images;
                for ($i = 0; $i < count($file); $i++) {
                    // code...
                    $fileName = $file[$i]->getClientOriginalName();
                    while (file_exists('./uploads/product/' . $fileName)) {
                        $fileName = str_random(10) . $fileName;
                    }
                    $file[$i]->move('./uploads/product', $fileName);
                    ProductImage::create(
                        [
                            'product_id' => $product->id,
                            'image' => './uploads/product/' . $fileName,
                            'url' => '',
                            'is_active' => $request->input("is_active_images.$i"),
                            'position' => $request->input("images_position.$i") != null ? $request->input("images_position.$i") : 0
                        ]
                    );
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            if (file_exists($image)) {
                unlink($image);
            }

            DB::rollback();
        }

        return redirect()->route('san-pham.index')->with('success', 'Thêm thành công !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $san_pham)
    {
        $categories = Category::where([
            'parent_id' => 0,
            'type' => 0
        ])->get();
        $vendors = Vendor::all();
        $brands = Brand::all();
        $product = $san_pham;
        return view('admin.product.edit', compact('product', 'categories', 'vendors', 'brands'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Product $san_pham)
    {


        $validated = $request->validate(
            [
                'name' => 'required|max:255|unique:categories,name,' . $san_pham->id,
                'image' => 'file|mimes:jpg,png,jpeg,gif,svg|max:20000',
                'category_id' => 'required',
                'url' => 'max:255',
                'sku' => 'max:255',
                'meta_title' => 'max:255',
                'product_images.*' => 'file|mimes:jpg,png,jpeg,gif,svg|max:20000',
            ],
            [
                'name.required' => 'Tên sản phẩm không được để trống !!!',
                'name.required' => 'Tên sản phẩm đã tồn tại !!!',
                'name.max' => 'Tên sản phẩm không được quá 255 ký tự !!!',
                'name.required' => 'Danh mục không được để trống !!!',
                'url.max' => 'Url không được quá 255 ký tự !!!',
                'sku.max' => 'Mã hàng (SKU) không được quá 255 ký tự !!!',
                'meta_title.max' => 'Meta title không được quá 255 ký tự !!!',
                'product_images.*.mimes' => "File ảnh không hợp lệ",
                'product_images.*.file' => "File ảnh không hợp lệ",
            ]
        );

        $old_image = $san_pham->image;
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            while (file_exists('./uploads/product/' . $fileName)) {
                $fileName = str_random(10) . $fileName;
            }
            $file->move('./uploads/product', $fileName);
            $image = './uploads/product/' . $fileName;
        }

        try {
            DB::beginTransaction();

            DB::table('products')->where('id', $san_pham->id)->update([
                'name' => $request->name,
                'slug' => str_slug($request->name),
                'image' => ($image != '') ? $image : $old_image,
                'stock' => $request->stock,
                'price' => $request->price,
                'sale' => $request->sale,
                'position' => $request->position,
                'is_active' => ($request->is_active) ? 1 : 0,
                'is_hot' => ($request->is_hot) ? 1 : 0,
                'category_id' => $request->category_id,
                'url' => $request->url,
                'sku' => $request->sku,
                'color' => $request->color,
                'memory' => $request->memory,
                'brand_id' => $request->brand_id,
                'vendor_id' => $request->vendor_id,
                'summary' => $request->summary,
                'description' => $request->description,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'user_id' => Auth::user()->id,
            ]);

            /// start update product_images :
            if ($request->input('id_product_images')) { // nếu tồn tại product_images

                ProductImage::where('product_id', $san_pham->id)->get()->each(function ($item) use ($request) {
                    if (!in_array($item->id, $request->input('id_product_images'))) {
                        @unlink($item->image);
                        $item->delete();
                    }
                }); /// Xóa những item ảnh khi người dùng xóa

                $arrProductImages = ProductImage::where('product_id', $san_pham->id)->get(); // lấy ra tất cả ảnh chi tiết sản phẩm :
                for ($i = 0; $i < count($request->input('id_product_images')); $i++) {
                    if ($arrProductImages->contains('id', $request->input("id_product_images.$i"))) {
                        /// chạy vòng lặp request  nếu $request->input('id_product_images') tồn tại trong arrProductImages[cột id] thì update lại vị trí và hiển thị !!! [khi có nhu cầu sửa vị trí và hiển thị]
                        $product_image = ProductImage::find($request->input("id_product_images.$i"));
                        $product_image->position = $request->input("images_position.$i") != null ? $request->input("images_position.$i") : 0;
                        $product_image->is_active = $request->input("is_active_images.$i") != null ? $request->input("is_active_images.$i") : 0;
                        $product_image->save();
                    } else {
                        //  không tồn tại thì tạo mới :: ( mặc định $request->input('id_product_images') == 0 ) [ thêm mới ]
                        $product_image = new ProductImage();
                        $product_image->product_id = $san_pham->id;
                        $product_image->is_active = $request->input("is_active_images.$i");
                        $product_image->position = $request->input("images_position.$i") != null ? $request->input("images_position.$i") : 0;
                        if ($request->hasFile("product_images.$i")) {
                            $file = $request->file("product_images.$i");
                            $fileName = $file->getClientOriginalName();
                            while (file_exists('./uploads/product/' . $fileName)) {
                                $fileName = str_random(10) . $fileName;
                            }
                            $file->move('./uploads/product', $fileName);
                            $product_image->image = './uploads/product/' . $fileName;
                        }
                        $product_image->save();
                    }
                }
            } else { // nhu cầu xóa hết ảnh kèm theo
                ProductImage::where('product_id', $san_pham->id)->delete();
            }
            // end update product_images

            if ($image != '') {
                @unlink(old_image); // nếu thay đổi hình ảnh chính trong sản phẩm => xóa hình cũ
            }
            DB::commit();

        } catch (\Exception $ex) {
            if (file_exists($image)) {
                @unlink($image);
            }
            DB::rollback();
        }

        return redirect()->route('san-pham.index')->with('success', 'Sửa thành công !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $san_pham)
    {
        $status = $text = $iconColor = ''; /// Khai báo trạng thái và icon trả về client
        $arrImages = $san_pham->product_images()->get();
        $old_image = $san_pham->image;
        if ($san_pham->delete()) { // nếu xóa thành công status == true và ngược lại ;
            $arrImages->each(function ($item) {
                @unlink($item->image);
                $item->delete();
            });
            @unlink($old_image); //xóa hết tất cả hình ảnh

            $status = 'success';
            $text = 'Xóa thành công';
            $iconColor = 'green';
        } else {
            $status = 'error';
            $text = 'Xóa không thành công';
            $iconColor = 'red';
        }
        return response()->json([
            'icon' => $status,
            'text' => $text,
            'iconColor' => $iconColor
        ], 200);
        //trả về client chuỗi json;
    }
}
//./uploads/product/UFRXtMyKFxtrinh-lang-sieu-xe-mui-tran-mclaren-720s-spider-5-2018-12-09-18-02-00.jpg
