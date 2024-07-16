<div wire:poll.50000ms>

    <a href="javascript:void(0);" class="dropdown-toggle " style="margin-left: 13px;" title="Notifications"
        data-toggle="dropdown" role="button"><img src="{{ asset('img/sidebar/4.png') }}" width="20" alt="">
        <div class="notify"><span class="heartbit"></span><span class="point text-white">{{ $count }}</span>
        </div>
    </a>
    <ul class="dropdown-menu  " style="width: 339px;height:430px">
        <li class="header">
            <div class="row">
                <div class="col-7">
                    Notifications
                </div>
                <div class="col-5">
                    <a wire:click="status()" style="font-size: 10px;cursor: pointer;color:blue">Mark all of read</a>
                </div>
            </div>

        </li>
        <li class="body">
            <ul class="menu list-unstyled" style="overflow-y: scroll !important;height: 350px;">
                @if (auth()->user()->role_id == '1')

                    @foreach ($domain_notifications as $notification)
                        @php
                            $domain = DB::table('domains')->find($notification->notification_id);

                            $now = Carbon\Carbon::now();
                            $expirationDate = Carbon\Carbon::parse($domain->domain_exp_date);
                            $isExpiringSoon = $expirationDate->diffInDays($now) <= 30;

                            $expirationDateSsl = Carbon\Carbon::parse($domain->ssl_exp_date);
                            $isExpiringSoonSsl = $expirationDateSsl->diffInDays($now) <= 30;

                            $expirationDateWeb = Carbon\Carbon::parse($domain->website_exp_date);
                            $isExpiringSoonWeb = $expirationDateWeb->diffInDays($now) <= 30;
                        @endphp
                        @if ($isExpiringSoon && $domain->domain_exp_date != null)
                            <li @if ($notification->status != 1) style="background-color: #ed9087" @endif>

                                <a href="{{ route('read-notification', $notification) }}">
                                    <div><i class="zmdi zmdi-notifications"></i></div>
                                    <div class="menu-info">
                                        <h4>{{ $domain->domain_service_name }} domain will be expired soon</h4>
                                        <p><i class="zmdi zmdi-time"></i>
                                            expired in: {{ $expirationDate->diffForHumans() }}
                                        </p>
                                    </div>

                                </a>
                            </li>
                        @endif
                        @if ($isExpiringSoonSsl && $domain->ssl_exp_date != null)
                            <li @if ($notification->status != 1) style="background-color: #ed9087" @endif>

                                <a href="{{ route('read-notification', $notification) }}">
                                    <div><i class="zmdi zmdi-notifications"></i></div>
                                    <div class="menu-info">
                                        <h4>{{ $domain->domain_service_name }} SSL will be expired soon</h4>
                                        <p><i class="zmdi zmdi-time"></i>
                                            expired in: {{ $expirationDateSsl->diffForHumans() }}
                                        </p>
                                    </div>

                                </a>
                            </li>
                        @endif
                        @if ($isExpiringSoonWeb && $domain->website_exp_date != null)
                            <li @if ($notification->status != 1) style="background-color: #ed9087" @endif>

                                <a href="{{ route('read-notification', $notification) }}">
                                    <div><i class="zmdi zmdi-notifications"></i></div>
                                    <div class="menu-info">
                                        <h4>{{ $domain->domain_service_name }} website will be expired soon</h4>
                                        <p><i class="zmdi zmdi-time"></i>
                                            expired in: {{ $expirationDateWeb->diffForHumans() }}
                                        </p>
                                    </div>

                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif

                @foreach ($notifications as $notification)
                    @if (auth()->user()->role_id == '2')
                        <li @if ($notification->status != 2) style="background-color: #BABABA" @endif>
                        @else
                        <li @if ($notification->status != 1) style="background-color: #BABABA" @endif>
                    @endif
                    <a href="{{ route('read-notification', $notification) }}">
                        <div><i class="zmdi zmdi-notifications"></i></div>
                        <div class="menu-info">
                            <h4>{{ $notification->message }}</h4>
                            <p><i class="zmdi zmdi-time"></i> {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>

                    </a>
        </li>
        @endforeach
        <li>
            <a href="{{ route('notification') }}">
                View all
            </a>
        </li>
    </ul>
    </li>
    </ul>

 
</div>
