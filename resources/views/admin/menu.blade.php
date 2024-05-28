<li>
    <a href="{{url('/admin')}}" class="@if(Request::is('admin')) link-active @endif"" 
        title="Dashboard">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Dashbord</span>
    </a>
</li>

<li>
    <a href="{{url('admin/employee/list')}}"  class="@if(Request::is('admin/employee/*')) link-active @endif" title="Employee">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Employee</span>
    </a>
</li>


<li>
    <a href="{{url('admin/team/list')}}"  class="@if(Request::is('admin/team/*')) link-active @endif" title="Employee">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Teams</span>
    </a>
</li>

<li>
    <a href="{{url('admin/project/list')}}"  class="@if(Request::is('admin/project/*')) link-active @endif" title="Project">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Project</span>
    </a>
</li>

<li>
    <a href="{{url('admin/report/list')}}"  class="@if(Request::is('admin/report/*')) link-active @endif" title="report">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Daily Report</span>
    </a>
</li>

<li>
    <a href="{{url('admin/chat/list')}}" class="@if(Request::is('employee/chat/*')) link-active @endif" 
        title="Chat">
        <span class="icon"><i class="fa fa-message"></i></span>
        <span class="link-text">Chat</span>
    </a>
</li>