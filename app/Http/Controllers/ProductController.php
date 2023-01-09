<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function index()
    {
        $eventActive = (new EventController())->eventActive();
        $eventName = $eventActive->name;
        $products = $eventActive->product;
        $eventInactive = (new EventController())->eventInactive();
        $events = Event::all();
        return view('products.index', compact('products', 'eventActive', 'events', 'eventInactive', 'eventName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
       $productValidated = $request->validate([
           'name' => 'required',
           'price' => 'required| numeric',
           'event_id' => 'required'
        ]);
        Product::create($productValidated);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request, Product $product)
    {
        try {
            $product->name = $request->name;
            $product->price = $request->price;
            $product->update();
            return redirect()->route('products.index');
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
