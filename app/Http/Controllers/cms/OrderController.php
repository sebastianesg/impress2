<?php

namespace App\Http\Controllers\cms;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CustmoProduct;
use App\Models\Order;
use App\Models\User;
use App\Models\Variable;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('cms.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $clients = Client::all();
        $pagePrice = Product::where('name', 'Impresiones personales')->value('price');
        return view('cms.orders.create',['mode'=>'create','users'=>$users,'clients'=>$clients,'pagePrice'=>$pagePrice]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_details' => 'required',
        ]);
        $userId = auth()->user()->id;
        $data = array_merge($request->all(), ['user_id' => $userId,'estado' => 'pendiente']);

        $order = Order::create($data);
        Log::info($request->all());
        $productData = [];
        if ($request->input('products')){            
            foreach ($request->input('products') as $productId) {
                $product = Product::find($productId);
                $productData[$productId] = ['precio' => $product->price, 'estado' => 'pendiente'];
            }}
        $customLinks = $request->input('custom_links');
        $customQuantities = $request->input('custom_quantities');
        $customPrices = $request->input('custom_prices');
        if ($request->input('custom_links')){    
        foreach ($customLinks as $index => $customLink) {
            $customProduct = CustmoProduct::create([
                'path' => $customLink,
                'price' => $customPrices[$index],
                'pages' => $customQuantities[$index],
            ]);
            $order->custmoProducts()->attach($customProduct->id);
        }}
    
        // Asocia los productos con precios a la orden
        $order->products()->attach($productData);
        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        
        $order->update($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully');
    }
    public function show($id)
{
    $order = Order::findOrFail($id);
    $users = User::all();
    return view('cms.orders.show', compact('order', 'users'));
}
public function markProductCompleted($orderId, $productId)
{
    $order = Order::findOrFail($orderId);
    $product = Product::findOrFail($productId);

    $order->products()->updateExistingPivot($product, ['estado' => 'completed']);

    return redirect()->back()->with('success', 'Product marked as completed.');
}

public function markOrderCompleted($orderId)
{
    $order = Order::findOrFail($orderId);

    $order->update(['estado' => 'completed']);

    return redirect()->back()->with('success', 'Order marked as completed.');
}

public function ordersResponsibleForRealization()
{
    // Obtener el usuario logeado
    $user = Auth::user();

    // Obtener los pedidos de los cuales el usuario es responsable de realizar y que estén en estado "pendiente"
    $orders = Order::where('realizer_id', $user->id)
                   ->where('estado', '=', 'pendiente')
                   ->get();

    return view('cms.orders.misPedidos', compact('orders'));
}
public function ordersResponsibleForShipping()
{
    // Obtener el usuario logeado
    $user = Auth::user();

    // Obtener los pedidos de los cuales el usuario es responsable de enviar y que no estén en estado "enviado"
    $orders = Order::where('shipper_id', $user->id)
                   ->where('estado', '!=', 'enviado')
                   ->get();

    return view('cms.orders.misEnvios', compact('orders'));
}

public function markAsReady($orderId)
{
    $order = Order::findOrFail($orderId);
    
    // Verificar si el estado actual es "pendiente"
    if ($order->estado == 'pendiente') {
        // Cambiar el estado a "ready"
        $order->estado = 'ready';
        $order->save();

        // Puedes devolver una respuesta JSON u otro tipo de respuesta si lo deseas
        return response()->json(['message' => 'Orden marcada como lista']);
    }

    // Si el estado no es "pendiente", puedes devolver un error u otra respuesta
    return response()->json(['message' => 'La orden no está en estado pendiente'], 422);
}

public function markAsSent($orderId)
{
    $order = Order::findOrFail($orderId);
    
    // Verificar si el estado actual es "ready"
    if ($order->estado == 'ready') {
        // Cambiar el estado a "enviado"
        $order->estado = 'enviado';
        $order->save();

        // Puedes devolver una respuesta JSON u otro tipo de respuesta si lo deseas
        return response()->json(['message' => 'Orden marcada como enviada']);
    }

    // Si el estado no es "ready", puedes devolver un error u otra respuesta
    return response()->json(['message' => 'La orden no está en estado listo para enviar'], 422);
}

}
