@if($stok->count() > 0)
@foreach( $stok as $s)
<tr>
	<td>{{$s->order->no_order}}</td>
	<td>{{$s->product->nama}}</td>
	<td class="tdout">{{$s->luas}}</td>
	@hasrole('admin')
	<td class="tduntung">{{ $s->keuntungan }}</td>
	@endhasrole
	
</tr>
@endforeach
<td colspan="2" class="text-center">Total Pemasukan</td>
<td class="out"></td>
@hasrole('admin')
<td class="total"></td>
@endhasrole
@else
    <tr>
    <td colspan="4" class="text-center"> Transaksi Data Tidak Ketemu </td>
    </tr>
@endif                        