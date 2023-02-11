<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Nome', 
            'Telefone', 
            'Data', 
            'Endereço', 
            'número', 
            'Bairro', 
            'Cidade', 
            'Estado', 
            'CEP', 
            'Coordenadas', 
            'Status do pedido', 
            'Valor do pedido', 
            'Detalhes do pedido', 
            'Data de criação do pedido', 
            'Data de edição do pedido'
        ];
    }
}
