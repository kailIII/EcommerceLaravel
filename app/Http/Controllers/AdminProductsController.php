<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;

use LaravelCommerce\Product;
use LaravelCommerce\ProductImage;
use LaravelCommerce\Tag;
use LaravelCommerce\Category;
use LaravelCommerce\Http\Requests\ProductRequest;
use LaravelCommerce\Http\Requests\ProductImageRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{

    private $productsModel;
    private $tagModel;

    public function __construct(Product $productModel, Tag $tagModel)
    {
        $this->productModel = $productModel;
        $this->tagModel = $tagModel;
    }

    public function index()
    {
        $products = $this->productModel->paginate(10);  
        return view('products.index',compact('products'));
    }

    public function create(Category $category)
    {
        $categories = $category->lists('name','id');

        return view('products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $input = $request->all();

        $Product = $this->productModel->fill($input);

        $Product->save();

        $this->updateProductTag($request, $Product->id );

        return redirect()->route('products');

    }

    public function edit($id, Category $category)
    {
        $product = $this->productModel->find($id);

        $categories = $category->lists('name','id');

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->productModel->find($id)->update($request->all());

        $this->updateProductTag($request, $id);
        
        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $images = $this->productModel->find($id)->images;
    
        foreach ($images as $image) 
        {
            $this->destroyImage($image, $image->id);
        }

        $this->productModel->find($id)->delete();
        return redirect()->route('products');
    }

    private function updateProductTag(ProductRequest $request, $id)
    {
        $product = $this->productModel->find($id);
        $idsTagsToSync = array();
        $tagsFromRequest = explode(',',$request->get('tags'));

        foreach($tagsFromRequest as $tag)
        {
            $tagId = $this->tagModel->where('name','=',$tag)->get(['id'])->first();
            if(empty($tagId["id"])) 
            {
                $tagId = $this->tagModel->create(['name'=>$tag]);
            }

            $idsTagsToSync[] = $tagId["id"];
        }

        $product->tags()->sync($idsTagsToSync);
    }


    public function images($id)
    {
        $product = $this->productModel->find($id);
        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->productModel->find($id);
        return view('products.create_image', compact('product'));
    }
    
    public function storeImage(ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        Storage::disk('public_local')->put($image->id.'.'.$image->extension, File::get($file));

        return redirect()->route('products.images',['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);
        
        if(file_exists(public_path() . '/uploads/' . $image->id.'.'.$image->extension))
        {    
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }

        $product = $image->product;
        $image->delete();

        return redirect()->route('products.images',['id'=>$product->id]);
    }
}
