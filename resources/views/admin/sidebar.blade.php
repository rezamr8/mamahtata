<div class="col-md-3">
<div class="panel panel-default panel-flush">
    <div class="panel-heading">
        Main Menu
    </div>

    <div class="panel-body">
        <div id="jstree">
        <ul class="list-group">
            <li class="list-group-item list-group-item-heading"> Dashboard</li>
            @hasrole('admin')
             <li class="list-group-item" data-jstree='{"icon":"fa fa-users fa-2x"}'><a href="{{ route('customer.index') }}">&nbsp; CUSTOMER</a></li>
             <li class="list-group-item" data-jstree='{"icon":"fa fa-dropbox fa-2x"}'><a href="{{ route('produk.index') }}">&nbsp; PRODUK</a></li>
             
            @else
            @hasrole('setting')
             <li class="list-group-item" data-jstree='{"icon":"fa fa-users fa-2x"}'><a href="{{ route('customer.index') }}">&nbsp; CUSTOMER</a></li>
             
            @endhasrole
            @endhasrole
        </ul>


        <ul class="list-group">
            <li class="list-group-item" data-jstree='{"icon":"fa fa-tablet fa-2x"}'><a href="{{ route('orders.index') }}">&nbsp; ORDER</a></li>
           
            @hasanyrole('admin|setting')
            <li class="list-group-item" data-jstree='{"icon":"fa fa-shopping-cart fa-2x"}'><a href="{{ route('orders.create') }}">&nbsp; BUAT ORDER</a></li>
            
            @endhasanyrole
            @hasanyrole('admin|kasir')

           <li class="list-group-item" data-jstree='{"icon":"fa fa-book fa-2x"}'>
            &nbsp; REPORT
            <ul>
                <li class="list-group-item" data-jstree='{"icon":"fa fa-bar-chart fa-2x"}'><a href="{{ route('report.index') }}">&nbsp;TRANSAKSI</a></li>
                <li class="list-group-item" data-jstree='{"icon":"fa fa-list-alt fa-2x"}'><a href="{{ route('report.stok') }}">&nbsp;STOK</a></li>
            </ul>
            </li>
            

            @endhasanyrole
        </ul>



        @hasrole('admin')
        <ul class="list-group">
            <li class="list-group-item" data-jstree='{"icon":"fa fa-user-circle fa-2x"}'><a href="{{ route('users.index') }}">&nbsp; USERS</a></li>
            <li class="list-group-item" data-jstree='{"icon":"fa fa-user-plus fa-2x"}'><a href="{{ route('users.create') }}">&nbsp; BUAT USERS</a></li>
            
        </ul>
        @endhasrole


    </div>
    </div>

</div>
</div>


