<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Request::is('home') ? 'active' : '' }} treeview">
          <a href="/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('home') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ Request::is('profile') ? 'active' : '' }} treeview">
          <a href="/profile">
            <i class="fa fa-files-o"></i>
            <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('profile') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>
        </li>
        
        <li class="{{ Request::is('allOrders') ? 'active' : '' }} treeview">
          <a href="/allOrders">
            <i class="fa fa-briefcase"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('allOrders') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>
          
        </li>
        <li class="{{ Request::is('allClients') ? 'active' : '' }} treeview">
          <a href="/allClients">
            <i class="fa fa-users"></i>
            <span>Clients</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('allClients') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ Request::is('allProducts') ? 'active' : '' }} treeview">
          <a href="/allProducts">
            <i class="fa fa-file"></i> <span>Products</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('allProducts') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>  
        </li>
        <li class="{{ Request::is('allTaxes') ? 'active' : '' }} treeview">
          <a href="/allTaxes">
            <i class="fa fa-edit"></i> <span>Taxes</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('allTaxes') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>  
        </li>
        @role('admin')
        <li class="{{ Request::is('Register') ? 'active' : '' }} treeview">
          <a href="/Register">
            <i class="fa fa-edit"></i> <span>Register</span>
            <span class="pull-right-container">
              <i class="fa {{ Request::is('Register') ? 'fa-angle-right' : 'fa-angle-left' }} pull-right"></i>
            </span>
          </a>  
        </li>
        @endrole
        
        
        <li class="treeview">
          <li class="treeview">
            <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout').submit();"><i class="fa fa-sign-out"></i>
                <span>Sign out</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <form id="logout" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </li> 
        </li>
</ul>
    