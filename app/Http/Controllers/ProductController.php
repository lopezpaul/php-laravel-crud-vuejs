<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use \Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JavaScript;
use Spatie\ArrayToXml\ArrayToXml;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        $total = Product::sum('total');
        return view('Product/index', compact('products', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        JavaScript::put([
            'url_store_product' => route('product.store'),
            'url_products' => route('product.index'),
        ]);

        return view('Product/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        try {
            //Validate
            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|min:1|max:50|unique:products,name',
                'quantity' => 'required|numeric|min:1|max:999',
                'price' => 'required|numeric|min:1|max:9999',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $request->quantity * $request->price,
            ]);

            return response()->json(['errors' => false]);
        } catch (ValidationException $e) {
            $validator = $e->validator;
            $message = 'Validator fails.';
            if (($validator instanceof \Illuminate\Validation\Validator) && method_exists($e, 'errors')) {
                $message = implode(' ', $validator->errors()->all());
            }
            return response()->json(['errors' => true, 'description' => $message]);
        } catch (Exception $e) {
            return response()->json(['errors' => true, 'description' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        JavaScript::put([
            'url_update_product' => route('product.update', $product),
            'url_products' => route('product.index'),
            'product' => [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->quantity,
            ]
        ]);

        return view('Product/edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'bail|required|string|min:1|max:50',
                'quantity' => 'required|numeric|min:1|max:999',
                'price' => 'required|numeric|min:1|max:9999',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $product->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $request->quantity * $request->price,
            ]);

            return response()->json(['errors' => false]);
        } catch (ValidationException $e) {
            $validator = $e->validator;
            $message = 'Validator fails.';
            if (($validator instanceof \Illuminate\Validation\Validator) && method_exists($e, 'errors')) {
                $message = implode(' ', $validator->errors()->all());
            }
            return response()->json(['errors' => true, 'description' => $message]);
        } catch (Exception $e) {
            return response()->json(['errors' => true, 'description' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with(['info' => 'Product removed.']);
    }

    /**
     * Store all the Products in file
     * @param Request $request
     * @param string $type json|xml
     * @return mixed
     */
    public function backup(Request $request, $type = 'json')
    {
        try {
            $filename = 'products.json';
            $content = '';
            $products = Product::orderBy('created_at', 'desc')->get();
            switch ($type) {
                case 'xml':
                    $content = $this->storeXML($products);
                    $filename = 'products.xml';
                    break;
                default:
                    $content = json_encode($products);
            }
            Storage::put($filename, $content);
            return Storage::download($filename);
        } catch (Exception $e) {
            abort(404, 'File not found.');
        }
    }

    /**
     * @param $products
     * @return string $content
     */
    protected function storeXML($products)
    {
        $xml = new \SimpleXMLElement('<products/>');
        foreach ($products as $v) {
            $product = $xml->addChild('product');
            $product->addChild('id', $v->id);
            $product->addChild('name', $v->name);
            $product->addChild('price', $v->price);
            $product->addChild('quantity', $v->quantity);
            $product->addChild('total', $v->total);
        }
        return $xml->asXML();
    }
}
