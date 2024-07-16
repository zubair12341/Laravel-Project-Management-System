<div wire:poll.20000ms>




    <div class="container mt-5">
        <div class="row">
            <div class="col-10">
                <h2> Notifications</h2>
            </div>
            <div class="col-2">
                <a wire:click="status()" style="cursor: pointer;color:blue">Mark all of read</a>
            </div>
        </div>

        <div class="list-group mt-3">
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
                        <a href="{{ route('read-notification', $notification->id) }}">

                            <div class="list-group-item list-group-item-action flex-column align-items-start"
                                @if ($notification->status != 1) style="background-color: #ed9087" @endif>

                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">New Message</h5>
                                    <small><i class="zmdi zmdi-time"></i>
                                        expired in: {{ $expirationDate->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1"> {{ $domain->domain_service_name }} domain will be expired soon </p>
                                <i class="fas fa-bell"></i>
                            </div>
                        </a>
                    @endif

                    @if ($isExpiringSoonSsl && $domain->ssl_exp_date != null)
                        <a href="{{ route('read-notification', $notification->id) }}">

                            <div class="list-group-item list-group-item-action flex-column align-items-start"
                                @if ($notification->status != 1) style="background-color: #ed9087" @endif>

                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">New Message</h5>
                                    <small><i class="zmdi zmdi-time"></i>
                                        expired in: {{ $expirationDateSsl->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1"> {{ $domain->domain_service_name }} SSL will be expired soon </p>
                                <i class="fas fa-bell"></i>
                            </div>
                        </a>
                    @endif

                    @if ($isExpiringSoonWeb && $domain->website_exp_date != null)
                        <a href="{{ route('read-notification', $notification->id) }}">

                            <div class="list-group-item list-group-item-action flex-column align-items-start"
                                @if ($notification->status != 1) style="background-color: #ed9087" @endif>

                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">New Message</h5>
                                    <small><i class="zmdi zmdi-time"></i>
                                        expired in: {{ $expirationDateWeb->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1"> {{ $domain->domain_service_name }} Hosting will be expired soon </p>
                                <i class="fas fa-bell"></i>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
            @foreach ($notifications as $notification)
                <a href="{{ route('read-notification', $notification->id) }}">
                    @if (auth()->user()->role_id == '2')
                        <div class="list-group-item list-group-item-action flex-column align-items-start"
                            @if ($notification->status != 2) style="background-color: #BABABA" @endif>
                        @else
                            <div class="list-group-item list-group-item-action flex-column align-items-start"
                                @if ($notification->status != 1) style="background-color: #BABABA" @endif>
                    @endif
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">New Message</h5>
                        <small><i class="zmdi zmdi-time"></i> {{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $notification->message }}</p>
                    <i class="fas fa-bell"></i>
        </div>
        </a>
        @endforeach
        
    </div>
</div>

</div>
