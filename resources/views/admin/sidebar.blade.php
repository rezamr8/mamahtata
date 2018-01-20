<div class="col-md-3">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Main Menu
        </div>

        <div class="panel-body">
            
                   
                    @if(Auth::check())

                    <div class="list-group">
                        <div class="list-group-item list-group-item-heading">Dashboard</div>
                        <a href="{{ route('customer.index') }}" class="list-group-item"><i class="fa fa-users fa-2x"></i>&nbsp; Customer</a>
                        <a href="{{ route('produk.index') }}" class="list-group-item"><i class="fa fa-dropbox fa-2x"></i>&nbsp; Product</a>
                    </div>

                    
                        <div class="list-group">
                            <a href="{{ route('orders.index') }}" class="list-group-item"><i class="fa fa-tablet fa-2x"></i>&nbsp; Order</a>
                            <a href="{{ route('orders.create') }}" class="list-group-item"><i class="fa fa-shopping-cart fa-2x"></i>&nbsp; Buat Order</a>
                            <a href="{{ route('report.index')}}" class="list-group-item"><i class="fa fa-book fa-2x"></i>&nbsp; Report</a>
                        </div>
                        @if(Auth::user()->admin)
                        <div class="list-group">
                            <a href="{{ route('users.index') }}" class="list-group-item"><i class="fa fa-user-circle fa-2x"></i>&nbsp; Users</a>
                        </div>        
                        @endif            
                        
                        @endif

                       

              
        </div>
    </div>
</div>


