<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="padding-top: 0px; padding-bottom: 0px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pt-2 pb-2">Dashboard</div>
                    <div class="dropdown">
                        <div class="dropdown-toggle pt-2 pb-2" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            welcome {{ Auth::user()->name }}
                        </div>
                        <ul class="dropdown-menu" id="menu_dropdown" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                {{-- <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <span class="dropdown-item">Logouts</span>
                                </form> --}}
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        style="width: 100%">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
