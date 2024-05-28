<li>
    <a href="{{url('/employee')}}" class="@if(Request::is('employee')) link-active @endif" 
        title="Dashboard">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Dashbord</span>
    </a>
</li>


<li>
    <a href="{{url('employee/report/list')}}" class="@if(Request::is('employee/report/*')) link-active @endif" 
        title="Report">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Report</span>
    </a>
</li>

<li>
    <a href="{{url('employee/chat/list')}}" class="@if(Request::is('employee/chat/*')) link-active @endif" 
        title="Chat">
        <span class="icon"><i class="fa fa-message"></i></span>
        <span class="link-text">Chat</span>
    </a>
</li>