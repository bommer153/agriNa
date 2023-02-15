@foreach($data as $chats)
    
                        @if($chats->sender == $auth)
                            <li class="d-flex justify-content-between mb-4">                                                           
                                <div class="card w-100">                                                      
                                    <div class="card-body">
                                        <p class="mb-0"> {{ $chats->message }}                                             
                                        </p>
                                </div>
                                </div>
                                <img src="{{ asset('storage/productImage/logo.png') }}" title="" alt="avatar"
                                class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                            </li>
                        @else
                            <li class="d-flex justify-content-between mb-4">
                                <img src="{{ asset('storage/productImage/logo.png') }}" title="" alt="avatar"
                                class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                <div class="card">                                                              
                                <div class="card-body">
                                    <p class="mb-0">
                                        {{ $chats->message }}
                                    </p>
                                </div>
                                </div>
                            </li>
                        @endif          
@endforeach