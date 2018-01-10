@if($order->count() > 0)
@foreach ($order as $o)
<tr>
    <td>{{$o->customer->nama}}</td>
    <td>{{$o->no_order}}</td>
    <td>{{$o->uang_muka}}</td>
    <td class="tdtotal">{{$o->total}}</td>
    <td class="tdpiutang">{{$o->grand_total}}</td>
    <td>{{ $o->created_at->format('Y-m-d') }}</td>
</tr>
@endforeach
<tr>
    <td colspan="6"></td>
</tr>
<tr>
    <td colspan="3" class="text-center">Total Pemasukan</td>
    
    <td class="total"></td>
    <td class="piutang"></td>
</tr>
@else
    <tr>
    <td colspan="6" class="text-center"> Transaksi Data Tidak Ketemu </td>
    </tr>
@endif                        