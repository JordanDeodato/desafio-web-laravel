<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    public function index()
    {
        $search = request('search');

        if ($search) {

            $orders = Order::where([
                ['name', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $orders = Order::all();
        }


        return view('orders.index', ['orders' => $orders, 'search' => $search]);
    }

    public function create()
    {

        return view('orders.create');
    }

    public function store(Request $request)
    {

        $order = new Order;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->date = $request->date;
        $order->street_name = $request->street_name;
        $order->street_number = $request->street_number;
        $order->district = $request->district;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zipcode = $request->zipcode;
        $order->coords = $request->coords;
        $order->status = $request->status;
        $order->amount = $request->amount;
        $order->details = $request->details;

        $order->save();

        return redirect('/orders')->with('msg', 'Pedido cadastrado com sucesso!');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return redirect('/orders')->with('msg', 'Pedido excluído com sucesso!');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit', ['order' => $order]);
    }

    public function update(Request $request)
    {
        Order::findOrFail($request->id)->update($request->all());

        return redirect('/orders')->with('msg', 'Pedido alterado com sucesso!');
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'Lista de Pedidos.xlsx');
    }

    public function maps()
    {

        $data_inicio = request('data_inicio');
        $data_fim = request('data_fim');
        $search = request('search');

        if ($data_inicio && $data_fim) {

            $orders = Order::whereBetween('date', [$data_inicio, $data_fim])->get();
        } else if ($search) {

            $orders = Order::where([
                ['district', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $orders = Order::all();
        }






        return View('/orders/maps', ['orders' => $orders, 'search' => $search, 'data_inicio' => $data_inicio, 'data_fim' => $data_fim]);
    }
}
