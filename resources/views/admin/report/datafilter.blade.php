@if($order->count() > 0)
@foreach ($order as $o)
<tr>
    <td>{{$o->customer->nama}}</td>
    <td>{{$o->no_order}}</td>
    <td>{{number_format($o->uang_muka)}}</td>
    <td >{{number_format($o->total_biaya_setting)}}</td>
    <td class="tdtotal">{{$o->grand_total}}</td>
    <td class="tdpiutang">{{$o->piutang}}</td>
    <td class="tduntung">{{ $o->orderdetail->sum('keuntungan') }}</td>
    <td>{{ $o->created_at->format('Y-m-d') }}</td>
</tr>
@endforeach
<tr>
    <td colspan="8"></td>
</tr>
<tr>
    <td colspan="4" class="text-center">Total Pemasukan</td>
    
    <td class="total"></td>
    <td class="piutang"></td>
    <td class="untung"></td>
    <td></td>
</tr>
@else
    <tr>
    <td colspan="8" class="text-center"> Transaksi Data Tidak Ketemu </td>
    </tr>
@endif                        