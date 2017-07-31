<?php

namespace LaravelCommerce\Http\Controllers;

use Illuminate\Http\Request;

use LaravelCommerce\Http\Requests;
use LaravelCommerce\Http\Controllers\Controller;

use LaravelCommerce\Category;
use LaravelCommerce\Product;
use LaravelCommerce\Tag;

class StoreController extends Controller
{
	public function index(Category $category, Product $product)
	{

		$categories = $category->all();
		$pFeatured = $product->featured()->get();
		$pRecommend = $product->recommend()->get();

		return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
	}

	public function category($id, Category $category, Product $product)
	{
		$categories = $category->all();
		$category = $category->find($id);
		$products = $product->ofCategory($id)->get();

		return view('store.category', compact('categories', 'category', 'products'));
	}

	
	public function search(Request $request, Category $category, Product $product)
	{
		$categories = $category->all();

		$products = $product->ofName($request["search"])->get();

		return view('store.search', compact('categories', 'category', 'products'));
	}

	public function tag($id, Category $category, Tag $tag, Product $product)
	{
		$categories = $category->all();
		$tag = $tag->find($id);
		$products = $product->ofTag($id)->get()->all();

		return view('store.tag', compact('categories', 'tag', 'products'));
	}

	public function product($id, Category $category, Product $product)
	{
		$categories = $category->all();
		$product = $product->find($id);
		return view('store.product', compact('categories', 'product'));
	}

	public function about_us(){

		return view('/customer/about_us');
	}

	public function contact(){

		return view('/customer/contact');
	}
}
