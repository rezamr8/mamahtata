<div class="col-md-3">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Sidebar
        </div>

        <div class="panel-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                   
                    @if(Auth::check())

                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info list-group-item-heading">Dashboard</li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-link"></span> <a href="{{ route('customer.index') }}">  Customer</a></li>
                        <li class="list-group-item"><span class="glyphicon glyphicon-apple"></span><a href="{{ route('produk.index') }}"> Product </a></li>
                            
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-tablet" aria-hidden="true"></i><a href="{{ route('orders.index') }}"> Order</a></li>
                            <li class="list-group-item"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><a href="{{ route('orders.create') }}"> Buat Order</a></li>
                            <li class="list-group-item"><i class="fa fa-tablet"></i><a href="{{ route('report.index')}}"> Report</a></li>
                        </ul>
                        @if(Auth::user()->admin)
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-user-circle"></i><a href="{{ route('users.index') }}"> Users</a></li>
                        </ul>        
                        @endif            
                        
                        @endif
                </li>
            </ul>
        </div>
    </div>
</div>


