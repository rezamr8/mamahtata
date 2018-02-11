<div class="col-md-3">
<div class="panel panel-default panel-flush">
    <div class="panel-heading">
        Main Menu
    </div>

    <div class="panel-body">
        
        <div class="list-group">
            <div class="list-group-item list-group-item-heading">Dashboard</div>
            @hasrole('admin')
             <a href="{{ route('customer.index') }}" class="list-group-item"><i class="fa fa-users fa-2x"></i>&nbsp; Customer</a>
             <a href="{{ route('produk.index') }}" class="list-group-item"><i class="fa fa-dropbox fa-2x"></i>&nbsp; Product</a>
            @else
            @hasrole('setting')
             <a href="{{ route('customer.index') }}" class="list-group-item"><i class="fa fa-users fa-2x"></i>&nbsp; Customer</a>
            @endhasrole
            @endhasrole
        </div>


        <div class="list-group">
            <a href="{{ route('orders.index') }}" class="list-group-item"><i class="fa fa-tablet fa-2x"></i>&nbsp; Order</a>
            @hasanyrole('admin|setting')
            <a href="{{ route('orders.create') }}" class="list-group-item"><i class="fa fa-shopping-cart fa-2x"></i>&nbsp; Buat Order</a>
            @endhasanyrole
            @hasanyrole('admin|kasir')
            {{-- <div id="jstree">
                <ul class="list-group">
                    <li class="list-group-item">Report
                        <ul class="list-group">
                            <li class="list-group-item" data-jstree='{"icon":"fa fa-book fa-2x"}'>child 1</li>
                            <li class="list-group-item"><a href="{{ route('report.index')}}"> Report</a></li>
                        </ul>
                    </li>
                </ul>
            {{-- <a href="{{ route('report.index')}}" class="list-group-item"><i class="fa fa-book fa-2x"></i>&nbsp; Report</a> --}}
            {{-- </div> --}} 
            <a href="{{ route('report.index')}}" class="list-group-item"><i class="fa fa-book fa-2x"></i>&nbsp; Report</a>
            @endhasanyrole
        </div>



        @hasrole('admin')
        <div class="list-group">
            <a href="{{ route('users.index') }}" class="list-group-item"><i class="fa fa-user-circle fa-2x"></i>&nbsp; Users</a>
            <a href="{{ route('users.create') }}" class="list-group-item">&nbsp; Buat User</a>
        </div>
        @endhasrole


    </div>

</div>
</div>


