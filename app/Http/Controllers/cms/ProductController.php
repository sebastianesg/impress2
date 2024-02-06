<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variable;
use App\Models\Client;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
class ProductController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('cms.products.productList', compact('products'));
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        return view('cms.products.productCreate',['mode'=>'create']);
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product($request->all());
        $product->save();
        return redirect()->route('products.index')->with('saved', true);
    }

    /**
     * Display the specified client.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('cms.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('cms.products.productCreate',['product'=>$product,'mode'=>'edit']);
    }

    /**
     * Update the specified client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
            $product->update($request->all());
            $product->save();
            return redirect()->route('products.index')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return back()->with(['deleted' => true]);
    }

    private static function validateForm(Request $request, $id){
        $validated = $request->validate([
            'full_name' => 'required',
            'identification' => 'required|integer',
            'email' => 'required|email',
            'phone' => 'required',
            'wsp' => 'required',
        ]);
        return $validated;
    }

    public function requests($id){
        $client=Client::find($id);
        $requests = $client->requests;
        return view('cms.clients.requests', ['requests'=>$requests]);
    }
    public function getClient($id)
    {
        $client=Client::find($id);
        return json_encode($client);
    }

    public function api()
    {
        $products = Product::all();
        $combos = Combo::with('products')->get();
    
        $data = [
            'products' => [],
            'combos' => [],
        ];
    
        // Productos
        foreach ($products as $product) {
            $data['products'][] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'type' => 'product',
            ];
        }
    
        // Combos
        foreach ($combos as $combo) {
            $comboData = [
                'id' => $combo->id,
                'name' => $combo->name,
                'price' => $combo->price,
                'type' => 'combo',
                'descuento' => $combo->descuento,
                'products' => [],
            ];
    
            // Productos dentro del combo
            foreach ($combo->products as $comboProduct) {
                $comboData['products'][] = [
                    'id' => $comboProduct->id,
                    'name' => $comboProduct->name,
                    'price' => $comboProduct->price,
                ];
            }
    
            $data['combos'][] = $comboData;
        }
    
        return response()->json($data);
    }
    public function getPdfPrice()
    {

        return response()->json(['price' => 10]);
    }
    public function updatePrices()
    {
        $pagePrice = Variable::where('name', 'PAGE_PRICE')->value('value');

        // Lógica para actualizar precios en la tabla de productos
        $products = Product::all();
        foreach ($products as $product) {
            $product->price =  $product->paginas * $pagePrice;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Precios actualizados correctamente.');
    }
    public function importProducts(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // Importa los productos desde el archivo Excel
            Excel::filter('chunk')->load($request->file('file')->getRealPath())->chunk(250, function($results) {
                foreach($results->toArray() as $row) {
                    // Busca un producto existente por nombre
                    $product = Product::where('name', $row['name'])->first();

                    if ($product) {
                        // Si existe, actualiza los datos
                        $product->update([
                            'price' => $row['price'],
                            // Agrega otros campos según sea necesario
                        ]);
                    } else {
                        // Si no existe, crea un nuevo producto
                        Product::create([
                            'name' => $row['name'],
                            'price' => $row['price'],
                            // Agrega otros campos según sea necesario
                        ]);
                    }
                }
            });

            return redirect()->back()->with('success', 'Productos importados exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al importar productos: ' . $e->getMessage());
        }
    }

    public function showImportForm()
    {
        return view('cms.products.import');
    }

    public function importFromExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            $file = $request->file('excel_file');

            // Importar datos desde el archivo Excel
            Excel::import(new ProductsImport, $file);

            return redirect()->route('products.index')->with('success', 'Productos importados correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Error al importar productos: ' . $e->getMessage());
        }
    }
}
