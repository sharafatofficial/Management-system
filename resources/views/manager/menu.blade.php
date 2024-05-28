<li>
    <a href="{{url('/manager')}}" class="@if(Request::is('manager')) link-active @endif" 
        title="Dashboard">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Dashbord</span>
    </a>
</li>


<li>
    <a href="{{url('manager/report/list')}}" class="@if(Request::is('manager/report/list')) link-active @endif" 
        title="Dashboard">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">My Report</span>
    </a>
</li>

<li>
    <a href="{{url('manager/report/daily')}}" class="@if(Request::is('manager/report/daily')) link-active @endif" 
        title="Dashboard">
        <span class="icon"><i class="fa fa-qrcode"></i></span>
        <span class="link-text">Daily Report</span>
    </a>
</li>

<li>
    <a href="{{url('manager/chat/list')}}" class="@if(Request::is('employee/chat/*')) link-active @endif" 
        title="Chat">
        <span class="icon"><i class="fa fa-message"></i></span>
        <span class="link-text">Chat</span>
    </a>
</li>